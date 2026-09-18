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
