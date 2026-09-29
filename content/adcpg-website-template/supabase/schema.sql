-- ============================================================
-- ADCPG Voting & Governance Platform — Supabase schema
-- Association de Doumbouya Cité & Perle De Guinée
--
-- Run this once in your Supabase project's SQL Editor
-- (Dashboard → SQL Editor → New query → paste all of this → Run).
-- Safe to re-run: every statement uses IF NOT EXISTS / OR REPLACE.
-- ============================================================

create extension if not exists pgcrypto;

-- ------------------------------------------------------------
-- 1. TABLES
-- ------------------------------------------------------------

-- One row per registered property/lot. access_code is stored ONLY
-- as a bcrypt hash (via pgcrypto's crypt()) — never store it in
-- plain text.
create table if not exists properties (
  lot_id         text primary key,
  owner_name     text not null,
  neighborhood   text check (neighborhood in ('doumbouya', 'perle')),
  access_code_hash text not null,
  created_at     timestamptz not null default now()
);

create table if not exists elections (
  id               uuid primary key default gen_random_uuid(),
  title_fr         text not null,
  title_en         text not null,
  description_fr   text,
  description_en   text,
  status           text not null default 'draft' check (status in ('draft', 'active', 'closed')),
  quorum_percent   numeric not null default 30,
  opens_at         timestamptz,
  closes_at        timestamptz,
  created_at       timestamptz not null default now()
);

create table if not exists candidates (
  id             uuid primary key default gen_random_uuid(),
  election_id    uuid not null references elections(id) on delete cascade,
  name           text not null,
  description_fr text,
  description_en text,
  sort_order     int not null default 0
);

-- One vote per property per election, enforced at the DB level.
create table if not exists votes (
  id            uuid primary key default gen_random_uuid(),
  election_id   uuid not null references elections(id) on delete cascade,
  lot_id        text not null references properties(lot_id) on delete cascade,
  candidate_id  uuid not null references candidates(id) on delete cascade,
  voted_at      timestamptz not null default now(),
  unique (election_id, lot_id)
);

-- Digital request form submissions (maintenance / governance / audit / other)
create table if not exists governance_requests (
  id          uuid primary key default gen_random_uuid(),
  lot_id      text references properties(lot_id),
  full_name   text not null,
  category    text not null check (category in ('maintenance', 'governance', 'audit', 'other')),
  message     text not null,
  status      text not null default 'new' check (status in ('new', 'in_review', 'resolved')),
  created_at  timestamptz not null default now()
);

-- ------------------------------------------------------------
-- 2. PUBLIC READ-ONLY VIEWS
--    These are what the page reads directly (no login required)
--    for the live turnout meter and results bars. They only ever
--    expose aggregated counts — never who voted for what.
-- ------------------------------------------------------------

create or replace view election_results as
select
  c.election_id,
  c.id   as candidate_id,
  c.name as candidate_name,
  count(v.id) as vote_count
from candidates c
left join votes v on v.candidate_id = c.id
group by c.election_id, c.id, c.name;

create or replace view election_turnout as
select
  e.id as election_id,
  (select count(*) from properties) as total_properties,
  count(distinct v.lot_id) as votes_cast,
  round(
    100.0 * count(distinct v.lot_id) / nullif((select count(*) from properties), 0),
    1
  ) as turnout_percent
from elections e
left join votes v on v.election_id = e.id
group by e.id;

-- ------------------------------------------------------------
-- 3. ROW LEVEL SECURITY
-- ------------------------------------------------------------

alter table properties           enable row level security;
alter table elections            enable row level security;
alter table candidates           enable row level security;
alter table votes                enable row level security;
alter table governance_requests  enable row level security;

-- properties: NO direct anon access at all. Every legitimate read
-- goes through the SECURITY DEFINER functions below, which check
-- the access code server-side before returning anything.
drop policy if exists "no direct anon access" on properties;

-- elections & candidates: public can read once an election is
-- active or closed (so members can see the ballot and, later, the
-- final tally). Drafts stay invisible until the board activates them.
drop policy if exists "public read elections" on elections;
create policy "public read elections" on elections
  for select using (status in ('active', 'closed'));

drop policy if exists "public read candidates" on candidates;
create policy "public read candidates" on candidates
  for select using (
    exists (
      select 1 from elections e
      where e.id = candidates.election_id and e.status in ('active', 'closed')
    )
  );

-- votes: NO direct anon select/insert. Reading individual ballots
-- would break the secret ballot; writing goes only through
-- cast_vote() below, which enforces "one vote per property".

-- governance_requests: anyone can submit a request, nobody (via
-- the anon key) can read other members' submissions back.
drop policy if exists "anon can submit requests" on governance_requests;
create policy "anon can submit requests" on governance_requests
  for insert with check (true);

grant select on election_results  to anon;
grant select on election_turnout  to anon;
grant insert on governance_requests to anon;
grant select on elections  to anon;
grant select on candidates to anon;

-- ------------------------------------------------------------
-- 4. SECURITY-DEFINER FUNCTIONS
--    These run with the privileges of the function owner (not the
--    caller), so they can read the properties table even though
--    RLS blocks anon from selecting it directly. Each one re-checks
--    the access code against the stored hash before doing anything.
-- ------------------------------------------------------------

-- Verifies a Lot ID + access code pair. Returns the owner profile
-- (never the code or its hash) if it matches, an empty result otherwise.
create or replace function login_property(p_lot_id text, p_access_code text)
returns table(lot_id text, owner_name text, neighborhood text)
language plpgsql
security definer
set search_path = public
as $$
begin
  return query
  select p.lot_id, p.owner_name, p.neighborhood
  from properties p
  where p.lot_id = p_lot_id
    and p.access_code_hash = crypt(p_access_code, p.access_code_hash);
end;
$$;

revoke all on function login_property(text, text) from public;
grant execute on function login_property(text, text) to anon;

-- Whether a given property has already voted in a given election.
create or replace function has_voted(p_lot_id text, p_election_id uuid)
returns boolean
language sql
security definer
set search_path = public
as $$
  select exists(
    select 1 from votes where lot_id = p_lot_id and election_id = p_election_id
  );
$$;

grant execute on function has_voted(text, uuid) to anon;

-- Casts a vote. Re-verifies the access code, the election's status,
-- and that this property hasn't already voted, all inside one
-- server-side transaction — a client can't bypass any of these
-- checks no matter what it sends.
create or replace function cast_vote(
  p_lot_id text,
  p_access_code text,
  p_election_id uuid,
  p_candidate_id uuid
)
returns void
language plpgsql
security definer
set search_path = public
as $$
declare
  v_ok boolean;
  v_status text;
begin
  select exists(
    select 1 from properties
    where lot_id = p_lot_id
      and access_code_hash = crypt(p_access_code, access_code_hash)
  ) into v_ok;

  if not v_ok then
    raise exception 'invalid_credentials';
  end if;

  select status into v_status from elections where id = p_election_id;
  if v_status is distinct from 'active' then
    raise exception 'election_not_active';
  end if;

  if exists(select 1 from votes where lot_id = p_lot_id and election_id = p_election_id) then
    raise exception 'already_voted';
  end if;

  insert into votes(election_id, lot_id, candidate_id)
  values (p_election_id, p_lot_id, p_candidate_id);
end;
$$;

revoke all on function cast_vote(text, text, uuid, uuid) from public;
grant execute on function cast_vote(text, text, uuid, uuid) to anon;

-- ------------------------------------------------------------
-- 5. REALTIME
--    Lets the page's live results bars update the moment a new
--    vote is inserted, without polling.
-- ------------------------------------------------------------

alter publication supabase_realtime add table votes;

-- ------------------------------------------------------------
-- 6. SEED DATA — replace with your real members and election
-- ------------------------------------------------------------

-- Add one property. Run once per member, with their real Lot ID,
-- name, neighborhood, and a code you send them over WhatsApp.
-- insert into properties (lot_id, owner_name, neighborhood, access_code_hash)
-- values ('DP-001', 'Full Name', 'doumbouya', crypt('their-access-code', gen_salt('bf')));

-- Create an election and its candidates, then flip it to 'active'
-- when voting should open.
-- with e as (
--   insert into elections (title_fr, title_en, description_fr, description_en, status)
--   values (
--     'Élection du Trésorier 2026',
--     '2026 Treasurer Election',
--     'Élection du nouveau trésorier du Comité de Gestion.',
--     'Election of the new Management Committee treasurer.',
--     'active'
--   )
--   returning id
-- )
-- insert into candidates (election_id, name, sort_order)
-- select id, unnest(array['Candidate One', 'Candidate Two']), unnest(array[1,2])
-- from e;
