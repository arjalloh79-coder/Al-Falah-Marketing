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
