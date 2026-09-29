# ADCPG Voting & Governance — Supabase setup

This connects the "Vote", "Transparency", and "Assembly & Roadmap" sections of
`index.html` to a real backend. Everything on the page degrades gracefully
until you complete this setup — it shows "not connected yet" messages instead
of erroring out.

**Important — where this works:** the voting module makes real network calls
to Supabase. That works once the page is hosted on a real domain (GitHub
Pages, Netlify, your own server, etc.). It will **not** work from inside a
Claude Artifact preview link — that preview sandboxes outbound network calls
to a fixed allowlist that doesn't include Supabase. Deploy the file
somewhere real to test the live voting flow.

## 1. Create a Supabase project

1. Go to [supabase.com](https://supabase.com) and create a free account/project.
2. Wait for the project to finish provisioning (a couple of minutes).

## 2. Run the database schema

1. In the Supabase dashboard, open **SQL Editor → New query**.
2. Copy the entire contents of [`supabase/schema.sql`](supabase/schema.sql) in
   this folder and paste it in.
3. Click **Run**. It creates the `properties`, `elections`, `candidates`,
   `votes`, and `governance_requests` tables, two public read-only result
   views, Row Level Security policies, and three server-side functions
   (`login_property`, `has_voted`, `cast_vote`).

This is safe to re-run if you need to tweak something later — every
statement uses `IF NOT EXISTS` / `OR REPLACE`.

## 3. Add your members' properties

Each property needs a Lot ID, the owner's name, and an access code. The code
is never stored in plain text — `crypt()` hashes it on the way in.

In the SQL Editor, run one insert per property (adjust the neighborhood and
pick a code to send that owner over WhatsApp):

```sql
insert into properties (lot_id, owner_name, neighborhood, access_code_hash)
values ('DP-014', 'Mr Abdulrahman Jalloh', 'doumbouya', crypt('7F2K9Q', gen_salt('bf')));
```

Repeat for all 74+ properties. (If you have the list in a spreadsheet, this
is easy to generate as a batch of `insert` statements — ask and I can turn a
CSV of Lot ID / owner name / neighborhood into ready-to-run SQL.)

Then send each owner their Lot ID and code over WhatsApp — that's their login
for the Vote section.

## 4. Create an election

```sql
with e as (
  insert into elections (title_fr, title_en, description_fr, description_en, status)
  values (
    'Élection du Trésorier 2026',
    '2026 Treasurer Election',
    'Élection du nouveau trésorier du Comité de Gestion.',
    'Election of the new Management Committee treasurer.',
    'active'   -- 'draft' hides it, 'active' opens voting, 'closed' ends it
  )
  returning id
)
insert into candidates (election_id, name, sort_order)
select id, unnest(array['Candidate One', 'Candidate Two']), unnest(array[1,2])
from e;
```

Only one election should be `'active'` at a time — the page always shows the
most recent active one. Set `status` to `'closed'` when voting ends; the
ballot then shows final results instead of the voting form.

## 5. Get your API keys

In the Supabase dashboard: **Project Settings → API**. You need:
- **Project URL** (looks like `https://abcdefgh.supabase.co`)
- **`anon` `public` key** (long string starting with `eyJ...`)

Do **not** use the `service_role` key on this page — that key bypasses RLS
entirely and must never be exposed in client-side code.

## 6. Wire it into the page

Open `index.html`, find this block near the bottom (search for `CONFIGURE ME`):

```js
var SUPABASE_URL = 'https://YOUR-PROJECT-REF.supabase.co';
var SUPABASE_ANON_KEY = 'YOUR-PUBLIC-ANON-KEY';
```

Replace both placeholder values with your real Project URL and anon key,
save, and deploy the file. The Vote, Transparency, and Assembly sections will
start reading and writing real data immediately — no other code changes
needed.

## 7. Managing requests submitted through the "Demande" button

Maintenance/governance/audit requests land in the `governance_requests`
table. View them anytime in the Supabase dashboard under **Table Editor →
governance_requests**, or query:

```sql
select * from governance_requests order by created_at desc;
```

## How the security works, in plain terms

- Access codes are never stored or sent as plain text after the initial
  WhatsApp message — the database only ever holds a one-way hash.
- The anon key embedded in the page is meant to be public; it can't read
  `properties` or individual `votes` rows directly because Row Level
  Security blocks that. It can only call the three narrow functions
  (`login_property`, `has_voted`, `cast_vote`), each of which re-checks the
  access code against the stored hash before doing anything.
- "One vote per property per election" is enforced twice: once in
  `cast_vote()`'s own check, and again by a database-level `unique`
  constraint on `(election_id, lot_id)` — so even a bug or a race condition
  can't produce a duplicate vote.
- Individual ballots (who voted for whom) are never exposed to the browser.
  Only two aggregated, anonymous views are public: turnout percentage and
  per-candidate vote totals.

This is a reasonable security model for a community HOA vote — not
bank-grade cryptographic voting, but real server-side verification with no
way for a client to read another member's code or cast an extra vote.
