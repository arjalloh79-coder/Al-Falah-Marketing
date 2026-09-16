# Custom backend — plan & architecture

## Why this exists

Decision (2026-09-16): build a custom Laravel backend instead of continuing on Base44. Rationale given: preference for an owned, Claude-maintained system over a third-party no-code platform for the majority of ongoing business tasks.

## Stack

- **Laravel** (PHP) — matches the existing live site's stack (`al-falahmarketing.com` already runs Laravel/PHP, confirmed from its form CSRF tokens and route structure). This means it can deploy to the same Hostinger hosting without a plan upgrade, assuming a standard "Web Hosting" tier (PHP + MySQL) — confirm the exact plan name in hPanel.
- **MySQL** — Laravel's default, and what Hostinger's PHP hosting plans provide.
- Lives in this repo under `backend/` — a full, runnable Laravel app, not just docs.

## Data model (mirrors what's already proven in Base44 + the Sheets trackers)

**Service** — the 6 offerings, editable via admin:
`name, short_description, description, features (json), price, price_label, currency, category, icon_name, image_url, is_active, sort_order`

**Order** — replaces the Base44 Orders entity:
`service_id (fk), service_name, customer_name, customer_email, customer_phone, customer_company, payment_method (enum: orange_money, mtn_money, wave, moov_money, bank_transfer, card), payment_number, transaction_id, total_amount, status (enum: pending, confirmed, in_progress, completed, cancelled), project_details`

**Lead** — replaces the Google Sheets Leads tracker, feeds the `al-falah-lead-triage` skill:
`source (contact_form, consultation_form, email, whatsapp), first_name, last_name, business, email, phone, service_interest, message, status (new, replied, needs_verification, archived_spam), next_step, notes`

**AdminUser** — Laravel's built-in auth, for logging into the dashboard.

## What ships in this scaffold

1. Migrations + Eloquent models for Service, Order, Lead.
2. A seeder that loads the real 6 services (same data already in Base44/the live site) so the backend isn't empty on first run.
3. Public API routes: services catalog (read), lead submission (contact + consultation forms — with the spam-prevention measures from `lead-capture-setup.md` built in: honeypot field, rate limiting, min-length validation), order creation.
4. A minimal authenticated admin area (`/admin`) to view/manage Services, Orders, and Leads — replacing what Base44's UI currently provides.
5. `.env.example` with the config keys needed (DB credentials, mail, reCAPTCHA keys) — no real secrets committed.

## What this does NOT include yet

- Payment processing integration (Orange Money / MTN / Wave / Moov APIs) — orders capture payment *method* and a manually-entered transaction ID/reference, same as how the Base44 Orders entity works today. Real payment gateway integration is a separate, larger project — mobile money APIs in Guinea/Sierra Leone often require in-country business registration and direct provider agreements, not just an API key.
- Actual deployment — I can write and validate the code locally (this session has PHP/Composer), but I cannot deploy to Hostinger myself: this session's network policy blocks all outbound access to Hostinger and the live site. Deployment is a manual step for whoever has FTP/SSH/Git access to the hosting account.
- Migrating existing data out of Base44 — if/when this replaces Base44, existing Service/Order records there would need exporting and importing into the new database. Not done automatically; ask when ready.

## Rollout plan

1. Build and validate the backend locally in this repo (this session).
2. Review it, or have a developer review it.
3. Deploy to Hostinger (manual — see `docs/hostinger-deploy.md` once plan tier is confirmed).
4. Point the live site's forms at the new backend, or run it standalone with its own admin dashboard first while Base44 stays live, then cut over once proven.
5. Decommission Base44 once the new system is trusted with real traffic — don't cut over on day one.
