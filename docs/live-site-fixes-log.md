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

## 2026-09-21: Homepage/Contact social icons went nowhere; dashboard sidebar had 4 fake nav items

Two unrelated dead-link issues found in the same sweep:

- `User/index.blade.php` and `User/contact.blade.php` each had their own
  Facebook/Twitter/LinkedIn/Instagram icon row hardcoded to `href="#"` —
  every icon on the homepage and Contact page went nowhere. The real,
  working social URLs already existed one partial over, in
  `User/footer.blade.php` (Facebook, YouTube, LinkedIn, Instagram — there's
  no Twitter/X account, footer never had one). Fixed both blocks to use
  the same real URLs as the footer, including swapping the Twitter icon
  for YouTube to match the account that actually exists.
- `User/sidebar.blade.php` (the logged-in customer dashboard) listed
  "Project Files", "Consultations", "Invoices" and "Settings" as nav links,
  all `href="#"`. None of the four have a route, controller, or view —
  unlike the admin footer badges fixed on 2026-09-18, there's no existing
  real page to honestly link them to either (customer-facing consultations/
  invoices/settings pages don't exist yet, and building four new features
  is out of scope for a bug sweep). Changed them from fake clickable links
  to non-interactive items with a "Soon" badge, so the dashboard stops
  pretending these features work.

## 2026-09-21: Admin Content Queue (AI content generation) page had no nav link

`Admin\ContentQueueController` and its views (`admin/content-queue/index`,
`admin/content-queue/edit`) are fully built and routed (`/admin/content-queue`)
— generate, edit, approve, reject, delete all work — but no link to the page
exists anywhere in the admin UI (not the sidebar, not the header). An admin
would have to already know the URL to use it. Added a "Content Queue" entry
to `admin/sidebar.blade.php`, next to Blog.

## 2026-09-21: Newsletter CSV export wrote to the response before headers were sent

`NewsletterController::export()` called `fopen('php://output', 'w')` and
`fputcsv()`/`fclose()` directly in the controller body, then passed an
**empty** closure to `response()->stream()`. Writing straight to
`php://output` sends bytes to the browser immediately, before Symfony gets
to send the `Content-Type`/`Content-Disposition` headers — the opposite of
what `response()->stream()` is for. In practice this either throws a
"headers already sent" warning that gets prepended to the file, or the
browser doesn't treat the response as a file download at all — either way,
clicking "Export" on `/admin/newsletter/export` did not reliably hand back
a clean CSV. Fixed by moving the `fopen`/`fputcsv`/`fclose` calls inside
the stream callback, which is the pattern `response()->stream()` expects.

## 2026-09-21: Checkout payment picker was non-interactive; three more dead links; a fake regressed since the `import-live-site-source` swap

Found in a wider public-site sweep (public marketing + auth/account pages).
One important piece of context surfaced while investigating the last item
below, worth flagging up front: on 2026-09-20 this repo's
`backend/live-site-extension/` was wholesale-replaced with the real code
pulled from the live server (`import-live-site-source`, since the previous
in-repo copy was an undeployed parallel scaffold). That swap silently
reverted a handful of fixes that had only ever been made to the old
scaffold — most were independently re-found and re-fixed afterwards
(`Fix case-sensitive admin role check…`, `Replace fake client dashboard
content with real data`), but at least one, below, was not.

- **`User/checkout.blade.php` used Alpine.js (`x-data`, `x-model`, `x-show`,
  `x-cloak`, `x-bind`) for its payment-method picker, but Alpine was never
  loaded on the public site** — only `admin/main.blade.php` includes the
  Alpine script tag; `User/main.blade.php` (the public layout every
  storefront page extends) does not. Without Alpine, selecting a payment
  method on `/order/{service}` did nothing: the highlighted-method styling
  never updated, the method-specific fields never showed/hid, and the
  `required` bindings on `payment_number`/`transaction_id` never activated
  — a real defect on the revenue path. Added the same Alpine.js `<script>`
  tag and `[x-cloak]` CSS rule to `User/main.blade.php` that the admin
  layout already uses.
- **Blog search box submitted but filtered nothing.** `User/blog.blade.php`
  posts a `search` query to `route('blog')` and even echoes it back into
  the input, but `UserController::blog()` only ever read the `category`
  query param. Added a `title`/`content` `LIKE` filter for `search`.
- **Two `wa.me/YOUR_NUMBER` literal placeholders** on `User/domains/index.blade.php`
  ("Contact Support" and per-domain "Help" links) — never swapped for the
  real `App\Support\Contact::whatsappUrl()` helper the rest of the app uses
  (and the per-domain one built its `?text=` query param by raw string
  concatenation, unescaped). Both now use `Contact::whatsappUrl()`.
- **Footer "Portfolio" quick link had `href=""`** (every other quick link
  uses a named route) — clicking it just reloaded the current page instead
  of navigating to `/portfolio`. Fixed to `route('portfolio')`.
- **Leftover "MarketPro" template branding** shown to real visitors: the
  mobile menu logo (`User/header.blade.php`) and the homepage's closing CTA
  copy (`User/index.blade.php`) both still said "MarketPro" instead of
  "Al-Falah Marketing" — un-migrated boilerplate from whatever template the
  site started from.
- **Every public portfolio/blog image was broken (wrong storage path).**
  `User/portfolio.blade.php`, `User/blog.blade.php` (×2), `User/blog_single.blade.php`,
  and `User/index.blade.php` (×2) all built image URLs as
  `asset('storage/public/' . $x->image)`. `Portfolio`/`Blog` images are
  stored via `->store('portfolios'|'blogs', 'public')`, which returns a
  path already relative to the `public` disk root — the correct URL is
  `asset('storage/' . $x->image)`, exactly the pattern the admin list views
  already use correctly. The extra `/public/` segment made every portfolio
  card, homepage preview, blog thumbnail, and blog-single hero image a
  broken image icon. Dropped the extra segment in all 6 spots.
- **Public testimonials were still 100% hardcoded fake content, and the
  admin Testimonials CMS fed none of it** — this is the regression
  mentioned above. `resources/views/User/portfolio.blade.php` had reverted
  to a single fake "Johnathan Reed / Elite Realty Group" quote with a
  stock Unsplash headshot (the exact bug PR #11 fixed on 2026-09-20,
  restored a few hours later by the production-code swap and never
  re-fixed). `services/branding.blade.php` and `services/content.blade.php`
  each had three more fully hardcoded fake testimonials
  (Sarah Johnson/Michael Chen/Emily Rodriguez;
  David Thompson/Sarah Mitchell/James Rodriguez) that were never wired up
  at all, even before the swap. Fixed properly this time:
  `PortfolioController::index()` and a new `UserController::activeTestimonials()`
  helper now load active testimonials from `ContentStore::for('testimonials')`;
  all three views render the real quote/name/role/company (in the visitor's
  locale, with an initials avatar instead of a stock photo), the two
  service pages also render the real star rating, and every section hides
  itself when there are zero active testimonials instead of showing
  something fake or empty.
- **Customer dashboard showed consultations as "Confirmed" that no admin had
  ever confirmed.** The `/dashboard` route computed a consultation's status
  purely from its date (`meeting_date >= today ? 'confirmed' : 'completed'`)
  — there was no `confirmed_at`/status column at all, so "Confirmed" meant
  nothing beyond "the meeting hasn't happened yet." A customer could see a
  meeting marked confirmed that the admin never clicked "Confirm" on.
  Added a nullable `confirmed_at` column to `consultations`;
  `ConsultationController::confirm()` now sets it, `reschedule()` clears it
  (a reschedule needs re-confirming), the dashboard now shows "pending"
  until it's actually set, and the admin Consultations list gained a
  Confirmed/Pending status column so admins can tell which ones they've
  already handled.
