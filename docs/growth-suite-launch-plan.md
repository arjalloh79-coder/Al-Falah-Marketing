# Al-Falah Growth Suite — Launch Plan

Status as of 2026-09-02. Owner: Al-Falah Marketing (arjalloh79@gmail.com). Built on Base44, currently 6 services published, 0 orders logged.

## What this app is

A standalone ordering front-end for the 6 services already sold on al-falahmarketing.com (Web Dev, Digital Marketing, Branding & Design, AI & Automation, Content Creation, IT Solutions). Visitors browse services and submit a **no-login quote/order request** — no checkout, no payment processing at launch. Follow-up and invoicing stay manual (WhatsApp/email + a manual invoice), matching how the agency already closes deals.

## Confirmed decisions

| Decision | Choice | Why |
|---|---|---|
| Code ownership | Export/sync Base44 app to GitHub | Version control, lets me edit code directly instead of only data |
| Login | None — quote/order form only | Fastest to launch, matches manual-invoicing sales process |
| Currency | USD (source of truth) + GNF/SLL shown as estimate | USD keeps invoicing simple; local estimate helps Guinea/Sierra Leone visitors gauge cost |
| Domain | `app.al-falahmarketing.com` | Keeps brand + SEO equity on the main domain |
| Payments | Manual invoicing (no gateway yet) | Matches current ops; revisit once order volume justifies Stripe/PayPal |

## Architecture

- **Base44** stays the backend: hosting, database (Service/Order entities), and the MCP tool bridge already connected to this session.
- **GitHub sync** (Base44 Settings → GitHub) exports the app's React/JS source to a repo. Once that repo exists, add it to this session and I edit code directly — same workflow as this repo.
- **No separate client backend needed** — Base44's built-in entity API covers Orders; Zapier (already connected) handles outbound notifications and Sheet logging.

## Data model changes

**Order** (extend beyond the current bare entity):
- `customer_name`, `email`, `phone_whatsapp`, `country` (Guinea / Sierra Leone / USA / Other)
- `service_id` (ref to Service)
- `billing_type` (one_time / monthly) — copied from the selected service
- `status` (new / contacted / quoted / won / lost)
- `notes` (free text from the client)
- `estimated_local_amount`, `estimated_local_currency` (GNF/SLL, computed at submit time from the static FX table, stored so it doesn't drift if rates change later)

**Service**: add `billing_type` (one_time / monthly) so pricing logic and the currency estimate stay consistent — currently implied only by `price_label`.

## Currency handling (USD + local estimate)

- Maintain a small static FX config (e.g. `fxRates.json`: `{ GNF: 8600, SLL: 22700 }` per USD) inside the app — no live FX API needed for launch.
- Display: `$299/mo — est. 2,570,000 GNF/mo` with a small note: *"Local currency shown as an estimate. Invoices are issued in USD."*
- I'll remind you to refresh the two numbers every 1–2 months (a 2-minute edit) — exchange rates in both countries can move.

## Order flow (no login)

1. Visitor picks a service → clicks **Request a Quote**.
2. Short form: name, email, WhatsApp/phone, country, notes → submit.
3. Base44 creates an `Order` record (`status: new`).
4. Automation fires (see below): owner gets notified, client gets an auto-confirmation, row logged to the Leads/Orders tracker.
5. You follow up manually via WhatsApp/email using the existing `alfalah-whatsapp-sales-assistant` playbook, then invoice manually once scope is agreed.

## Notifications & tracking

Reuse what's already live rather than building new plumbing:
- New Order → Zapier → email alert to you + row in a new **Orders** tab on the existing [Leads tracker](https://docs.google.com/spreadsheets/d/16khY9MvQdI80zZlJ8a5VmpXQjGsJfymbVD3H-f_0MI0/edit).
- New Order → auto-confirmation email to the client ("We got your request, we'll reach out within 24h").
- The `al-falah-lead-triage` skill already classifies inbound leads — I'll extend its scope to also pick up Growth Suite orders once the Sheet tab exists.

## Branding & bilingual

- Colors: `#3B82F6` / `#10B981` / `#F59E0B` / `#111827`, font Outfit — applied so the app reads as one product with the main site.
- EN/FR toggle matching the main site, translations drawn from the same voice already used in `content/batch-1/`.

## Domain

- Add `app.al-falahmarketing.com` in Base44's custom-domain settings → it gives you a CNAME target.
- Add that CNAME at your DNS provider (wherever al-falahmarketing.com's DNS is managed — likely the same place the main site's records live).
- Base44 issues SSL automatically once DNS resolves (usually under an hour).

## Pre-launch QA

- Submit a test order end-to-end in English and French, on mobile and desktop.
- Confirm owner alert + client confirmation + Sheet row all fire correctly.
- Check all 6 service pages, images, and currency display render correctly.
- Click every link (nav, footer, social) for dead links.

## Launch checklist

- [ ] Google Analytics (or reuse the main site's property) + Search Console verification on the new subdomain.
- [ ] Basic SEO meta (title/description per service, OG image).
- [ ] Privacy Policy + Terms page — required since the form collects name/email/phone.
- [ ] Custom domain live with valid SSL.
- [ ] Announce on the socials already active (Facebook/Instagram/LinkedIn) once QA passes.

## Immediate next step (blocking everything else)

**You:** In Base44, go to **Settings → GitHub** and connect/create the repo for the Growth Suite app (e.g. `arjalloh79-coder/al-falah-growth-suite`). Share the repo name here once it's created — I'll pull it into this session and start building against the real code immediately.
