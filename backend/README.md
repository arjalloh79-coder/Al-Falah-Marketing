# Al-Falah Marketing — backend

A Laravel backend for Al-Falah Marketing: public services catalog, lead capture (contact + consultation forms), order placement, and an authenticated admin dashboard to manage all three. See `../docs/custom-backend-plan.md` for why this exists and what it replaces.

## What's here

- **Services** — the 6 real offerings (Web Dev, Digital Marketing, Branding, AI & Automation, Content Creation, IT Solutions), seeded via `ServiceSeeder`.
- **Orders** — customer orders with West Africa payment methods (Orange Money, MTN Money, Wave, Moov Money, bank transfer, card).
- **Leads** — contact/consultation form submissions, with spam prevention built in (honeypot field, rate limiting, minimum message length — see `LeadController`).
- **Admin dashboard** (`/admin`, behind login) — manage services, view/update order status, triage leads.

## Local setup

```bash
composer install
cp .env.example .env
php artisan key:generate
# Edit .env: set ADMIN_EMAIL / ADMIN_PASSWORD before seeding a real environment
php artisan migrate --seed
npm install && npm run build   # only needed to rebuild the admin dashboard's CSS/JS
php artisan serve
```

Log into `/login` with the `ADMIN_EMAIL` / `ADMIN_PASSWORD` from `.env`.

## Public endpoints (what the live site/frontend calls)

| Endpoint | Method | Purpose |
|---|---|---|
| `/api/services` | GET | Active services catalog (JSON) |
| `/api/services/{id}` | GET | One service (JSON) |
| `/contact-submit` | POST | General contact form (rate-limited 3/hour/IP) |
| `/consultation-store` | POST | "Free consultation" booking form (rate-limited 3/hour/IP) |
| `/api/orders` | POST | Place an order (rate-limited 5/hour/IP) |

The contact/consultation forms expect the same field names as the current live site (see `../docs/site-source/homepage-2026-08-29.html`): `first_name`/`last_name`/`email`/`phone`/`service_interest`/`message` for contact, `name`/`email`/`meeting_date`/`subject` for consultation. Both also expect a hidden honeypot field named `website_url`, left empty by real users.

All of the above were tested end-to-end locally (migrations, seeder, contact form success/honeypot/short-message rejection, rate limiting at request #4, order placement, admin login + dashboard) before this was committed.

## Deployment

This session can write and validate the code, but **cannot deploy it** — this Claude Code session's network policy blocks all outbound access to Hostinger and the live site. Deployment is a manual step:

1. Confirm the Hostinger plan supports PHP + MySQL (any "Web Hosting" tier does; this doesn't need VPS/Cloud).
2. Push this `backend/` directory to the host via Git or FTP (or set up CI to do it).
3. Point the database config at a real MySQL database instead of sqlite (`DB_CONNECTION=mysql` + credentials).
4. Run `php artisan migrate --seed` on the server (with a real `ADMIN_PASSWORD` set first).
5. Point the live site's contact/consultation forms and services catalog at this backend's endpoints instead of (or alongside) whatever currently handles them.

Don't cut over from Base44 on day one — run this alongside it until it's proven with real traffic, per the rollout plan in `../docs/custom-backend-plan.md`.

## Known gaps (by design, for now)

- No real payment gateway integration (Orange Money/MTN/Wave/Moov APIs) — orders capture a payment method + reference, not a processed transaction. See `../docs/custom-backend-plan.md`.
- reCAPTCHA is documented (`../docs/lead-capture-setup.md`) but not wired into `LeadController` yet — honeypot + rate limiting + validation are live; reCAPTCHA needs real site/secret keys to add.
- Admin user management (adding more staff logins) isn't built — currently one seeded admin account.
