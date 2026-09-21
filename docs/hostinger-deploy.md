# Deploying to Hostinger (Business Web Hosting)

Step-by-step for getting `backend/` live on your actual Hostinger account. This session cannot do this step itself (no network access to Hostinger from here) — this is for you (or whoever has hPanel/FTP access) to follow.

## Your actual account details (confirmed 2026-09-17)

- **Plan:** Business Web Hosting — 200GB disk, 3072MB RAM, 2 CPU cores, 600,000 inodes, 60 PHP workers. Comfortably enough for this app.
- **Server:** server1851, North America (USA, MA)
- **FTP host:** `ftp://al-falahmarketing.com` (IP `147.93.42.37`)
- **FTP username:** `u450276459.al-falahmarketing.com`
- **FTP password:** not recorded here — you have it; don't paste account passwords into chat, FTP or otherwise.
- **Upload path:** `public_html`
- **Note on "supported frameworks" in hPanel:** the Node.js/React/etc. list you saw is for Hostinger's separate Node app hosting feature — not relevant here. This backend is PHP/Laravel; its frontend build step already ran and the compiled output is bundled into the deployment zip, so no Node runtime is needed on the server at all.

**Requirement to check:** the backend needs **PHP 8.4.1 or newer** (Laravel 13 pulls in Symfony 8.x components, which raised the floor from 8.3 to 8.4.1 — `composer.lock` locks these versions already). Business plans support this, but you'll likely need to explicitly select it for the domain (see Step 2) — Hostinger's default PHP version is often older, and picking 8.3 is not enough.

## Step 0: Get the deployment bundle

I already built, tested, and sent you `al-falah-backend-deploy.zip` (~27MB) — it has the application code, all dependencies (`vendor/`), and the compiled frontend assets. **No Composer or npm needed on the server at all.** It does *not* include `.env` or a database (Step 4 covers that).

## Step 1: Upload and extract

1. Log into **hPanel** → **Files** → **File Manager** (or use an FTP client with the details above).
2. Navigate to `public_html`.
3. Upload `al-falah-backend-deploy.zip`.
4. Right-click it in File Manager → **Extract**.

## Step 2: Set the PHP version

1. hPanel → **Advanced** → **PHP Configuration** for `al-falahmarketing.com`.
2. Select **PHP 8.4** (or newer). PHP 8.3 and below are not enough — Composer will refuse to run (`require >= 8.4.1`, you're running 8.2.33/8.3.x) and `php artisan migrate` will fail the same way.

## Step 3: Create the MySQL database

1. hPanel → **Databases** → **MySQL Databases**.
2. Create a new database and a database user, note down: database name, username, password, host (usually `localhost`).

## Step 4: Set the document root

Laravel's web server needs to point at the `public` folder *inside* the app, not the app root — otherwise the whole codebase (including `.env`) would be reachable over the web.

1. hPanel → **Websites** → `al-falahmarketing.com` → look for **Document root** (Business plans typically expose this).
2. Point it at wherever you extracted the zip's `public` folder, e.g. `public_html/backend/public` (adjust to match the actual extracted folder name).

If this backend should live at a **subdomain or subpath** instead of replacing the main site outright (recommended for the "run it alongside the current site first" rollout plan — see `custom-backend-plan.md`), create a subdomain in hPanel (e.g. `app.al-falahmarketing.com`) and point *that* subdomain's document root at the extracted `public` folder instead.

## Step 5: Configure `.env`

Copy `.env.example` (included in the zip) to `.env` in the app's root (same level as `artisan`), and fill in:

```
APP_NAME="Al-Falah Marketing"
APP_ENV=production
APP_KEY=                          # generate in Step 6
APP_DEBUG=false
APP_URL=https://al-falahmarketing.com   # or the subdomain from Step 4

ADMIN_EMAIL=your-real-admin-email@al-falahmarketing.com
ADMIN_PASSWORD=a-real-strong-password-not-the-default

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=<from Step 3>
DB_USERNAME=<from Step 3>
DB_PASSWORD=<from Step 3>

# Payment receiving accounts (see payment-flows.md) — fill in when ready,
# checkout shows "[SET THIS UP]" for anything left blank.
PAYMENT_ORANGE_MONEY_NUMBER=
PAYMENT_MTN_MONEY_NUMBER=
PAYMENT_MOOV_MONEY_NUMBER=
PAYMENT_WAVE_NUMBER=
PAYMENT_BANK_DETAILS=

# Leave blank to keep card payments disabled
STRIPE_SECRET_KEY=
STRIPE_PUBLISHABLE_KEY=
```

## Step 6: Generate the app key and run migrations (via SSH)

Business Web Hosting plans normally include SSH access:

1. hPanel → **Advanced** → **SSH Access** — turn it on if it isn't already, and note the host/port/credentials shown there.
2. From your terminal:
   ```bash
   ssh -p <port-from-hpanel> u450276459.al-falahmarketing.com@al-falahmarketing.com
   cd public_html/backend    # or wherever you extracted it
   php artisan key:generate --force
   php artisan migrate --seed --force
   ```

**If SSH turns out not to be available** on this plan tier, fall back to a one-time throwaway script instead — create a PHP file in the app root:
```php
<?php
// DELETE THIS FILE IMMEDIATELY AFTER RUNNING — it executes arbitrary artisan commands.
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->call('key:generate', ['--force' => true]);
$kernel->call('migrate', ['--seed' => true, '--force' => true]);
echo $kernel->output();
```
Visit it once in your browser (not through the public document root — put it somewhere not web-accessible if possible, or delete it the instant it's run), confirm success, **then delete the file immediately** — leaving it live is a serious security hole.

## Step 7: Verify it's live

Visit `<your APP_URL>/api/services` — should return JSON with the 6 seeded services. Then try `/login` with the `ADMIN_EMAIL`/`ADMIN_PASSWORD` you set, and `/order/1` to see the checkout flow render.

## Step 8: Point the live site at it (when ready)

The existing site's contact/consultation forms and services catalog can point at this backend's routes (`/contact-submit`, `/consultation-store`, `/api/services`, `/order/{service}`) once you're ready to cut over — see the rollout plan in `custom-backend-plan.md`. Don't rush this; proving the new backend standalone first (e.g. on a subdomain) before touching the live site's forms is the safer order.

## If something goes wrong

- **500 error, blank page:** set `APP_DEBUG=true` temporarily in `.env` to see the real error, then set it back to `false` once fixed — never leave debug mode on in production.
- **"could not find driver" DB error:** the selected PHP version might not have `pdo_mysql` enabled — check hPanel's PHP extension list for the domain.
- **CSS/JS look broken:** confirm `public/build/` made it into the extracted files, and that `APP_URL` in `.env` matches the actual domain/subdomain you're using.
- **SSH connection refused:** double-check SSH is toggled on in hPanel and you're using the exact port it lists (Hostinger often uses a non-standard SSH port, not 22).
- **"Composer dependencies require a PHP version >= 8.4.1. You are running 8.2.33" (or similar) when running `composer install`/`migrate`:** the domain's PHP version in hPanel is still set below 8.4 — redo Step 2 and select PHP 8.4 (or newer), then re-run the command. SSH sessions sometimes use a different default PHP binary than the one hPanel sets for the domain; if selecting 8.4 in hPanel doesn't fix it, run `php -v` over SSH to check which PHP the shell actually resolves to, and use the versioned binary Hostinger provides for SSH (e.g. `/usr/bin/php8.4` — check hPanel's SSH/PHP docs for the exact path) instead of the bare `php` command if they differ.
