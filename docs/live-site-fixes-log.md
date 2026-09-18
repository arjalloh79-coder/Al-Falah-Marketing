# Live site fixes log

Running log of real bugs found and fixed directly on the live
al-falahmarketing.com Laravel app (`domains/al-falahmarketing.com/public_html`
on Hostinger), found incidentally while doing other work. None of these are
related to Al-Falah Marketing's own content/automation work — they're
pre-existing issues in the site codebase itself, now that we own and
maintain it directly.

## 2026-09-18: IsAdmin middleware locked out every admin account

`app/Http/Middleware/IsAdmin.php` compared `Auth::user()->role === 'admin'`
(lowercase), but every admin account's `role` column is stored as `'Admin'`
(capital A) — the comparison always failed, redirecting every admin login
back to the customer dashboard. Fixed to
`strtolower(Auth::user()->role ?? '') === 'admin'`.

## 2026-09-18: Portfolio/blog images broken (missing storage symlink + wrong disk)

All images referencing `asset('storage/...')` — portfolio thumbnails, blog
thumbnails — rendered as broken icons. Two layered issues:

1. **Missing symlink.** `public/storage` didn't exist. Running
   `php artisan storage:link` created it, but images still 404'd.
2. **LiteSpeed refuses to follow the symlink** (it points outside the
   `public/` document root — a common shared-hosting security restriction),
   so even with the symlink present, direct static serving of
   `public/storage/*` never worked.
3. **Root cause, once diagnosed:** Laravel 11's `filesystems.php` has a
   newer `'serve' => true` option that makes the framework auto-register a
   PHP-level route (`storage/{path}`, name `storage.local`) to serve a
   disk's files without needing the OS symlink at all — the modern fix for
   exactly this shared-hosting problem. But in this app's config, `'serve'
   => true` was set on the **`local`** disk (root `storage/app/private`,
   basically unused) instead of the **`public`** disk (root
   `storage/app/public`, where portfolio/blog images are actually uploaded
   via `Storage::disk('public')`). Laravel's auto-registered route was
   therefore looking in the wrong directory and 404ing.

   Fixed in `config/filesystems.php`: set `'serve' => false` on `local`,
   `'serve' => true` on `public`. Laravel's built-in route then serves the
   real files correctly, via PHP, with no dependency on the web server
   following any symlink.

Verified live: portfolio thumbnails render correctly at `/admin/portfolio`
for all entries after the fix.

## 2026-09-18: Dashboard was 100% fake data; Profile/Settings/user-edit didn't exist

`AdminController::index()` passed no data to the view at all — the whole
`/admin` dashboard (all 4 stat cards, the "Recent Inquiries" table) was
hardcoded mockup content ("Johnathan Reed", "1,284" leads, "45.2k" blog
views, etc.), not connected to anything real. Separately, the profile
dropdown's "My Profile"/"Settings" links and the Users tab's "Edit" button
were all `href="#"` — no controller methods, no routes, no views existed
for any of them.

Fixed:
- `AdminController::index()` now computes real stats (`Contact::count() +
  Consultation::count()`, `Blog::count()`, `Portfolio::count()`, new
  contacts in the last 7 days) and passes the 5 latest real `Contact`
  records to a rebuilt dashboard view.
- Added `AdminController::profile()` / `updateProfile()` + a real
  `admin.profile` page (name, email, password change).
- Added `AdminController::editUser()` / `updateUser()` + a real
  `admin.users.edit` page, wired to the previously-dead Edit button.
- Added `Admin\SettingsController` + a real `admin.settings` page for the
  checkout payment account numbers (Orange Money/MTN/Moov/Wave/bank
  details), stored in `storage/app/content/settings.json` — the same
  JSON-file pattern `ContentStore` already uses for services/testimonials.
  `config/payment_methods.php` now reads from this file first, falling
  back to `.env` (legacy) then to `[SET THIS UP]`.
- Also fixed while touching `header.blade.php`: the avatar image pointed
  at `https://via.placeholder.com/100`, an unreliable/deprecated service —
  switched to `ui-avatars.com` generating real initials from the logged-in
  user's name (also previously hardcoded as "Abdulrahman" regardless of
  who was actually logged in).

## 2026-09-18: Login always sent admins to the fake customer dashboard

Same case-sensitivity bug as `IsAdmin.php`, independently duplicated in
`UserController::loginProcess()`: `Auth::user()->role === 'admin'`
(lowercase) against a `'Admin'`-cased stored value, so it always fell
through to `redirect()->intended(route('user.dashboard'))` — the fake
mockup dashboard — instead of `route('admin.index')`. Fixed the same way:
`strtolower(Auth::user()->role ?? '') === 'admin'`.

## 2026-09-18: Admin footer "USA Experience" / "Africa Growth" were dead badges

Plain `<span>` elements in `admin/footer.blade.php`, styled to look like
clickable links (blue/accent color) but with no `href` at all. No
region-filtering feature exists for portfolio items to link to honestly,
so both now link to the real public Portfolio page (`route('portfolio')`,
opens in a new tab) — the actual evidence of that USA/Africa work, rather
than inventing a filter that doesn't exist.

## 2026-09-18: Payment Settings page was minimal and every method always showed on checkout

`admin/settings.blade.php` and `Admin\SettingsController` (built earlier the
same day) only captured a bare number per mobile money method and a single
freeform textarea for bank details — and `config/payment_methods.php` had
been hand-patched directly on the live server to read from
`storage/app/content/settings.json`, a change that was never copied back
into this repo, so the repo's copy of that file had silently drifted from
what's actually running.

Rebuilt the Settings page and its config on both sides:
- Each mobile money method (Orange Money, MTN, Moov, Wave) now also has an
  **account holder name** field, shown alongside the number on checkout
  (`+224 611 351 302 (Al-Falah Marketing SARL)`) so customers can confirm
  they're sending to the right account before paying.
- Bank transfer is now three structured fields (bank name, account name,
  account number) plus an optional notes field (branch/SWIFT/etc.), instead
  of one opaque textarea — `payment_methods.php` joins them into the
  multi-line "Send to:" block on checkout (`checkout.blade.php` now renders
  it through `nl2br`).
- Every method — mobile money and bank — has an **"Active on checkout"**
  toggle. It defaults on the moment an admin fills in that method's details
  (so nothing extra has to be flipped), but can be switched off independently
  to hide a method from customers without wiping out the saved account info.
  This directly fixes the old behavior where all 5 methods + Card always
  showed on checkout, "[SET THIS UP]" placeholder and all, even completely
  unconfigured ones.
- Card/Stripe now shows a read-only "Live" / "Not set up" status on the
  Settings page instead of not appearing at all — it stays server/`.env`-only
  since a Stripe secret key doesn't belong in the JSON settings file.
- `CheckoutController` now filters `config('payment_methods')` down to only
  enabled methods before handing them to the checkout view (both for display
  and for validating the submitted `payment_method`), and picks the first
  enabled method as the default radio selection instead of hardcoding
  `orange_money` (which would have broken if an admin ever disabled it).
  If an admin disables every method, checkout now shows a clear "no payment
  method active, contact us directly" message instead of a broken empty form.
