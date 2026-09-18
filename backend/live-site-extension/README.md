# Live site extension: orders + checkout

**Status: deployed and verified live on al-falahmarketing.com (2026-09-18).**
Two real test orders (#1, #2) were placed via the live checkout page and
confirmed visible in Admin → Orders — safe to delete from
`/admin/orders` whenever convenient, or leave them.

This folder mirrors the real folder structure of the live `al-falahmarketing.com`
Laravel app (the one at `domains/al-falahmarketing.com/public_html` on Hostinger,
git remote `manishkarantiwaripsyt/alfalah-final`). It adds a service checkout
flow (Orange Money, MTN Money, Moov Money, Wave, bank transfer, and an
optional Stripe card path) and an admin Orders screen — the one piece of
functionality that genuinely didn't exist in that app yet.

It does **not** touch `ServiceController.php`, `TestimonialController.php`,
or `AdminController.php` — those are someone else's in-progress work
(services/testimonials admin CRUD) and are left alone. This only adds new
files, plus two small, precise insertions into files that ARE being actively
edited (`routes/web.php`, `resources/views/admin/sidebar.blade.php`) — see
below rather than overwriting them wholesale.

## 1. Upload the new files (no edits needed — drop in as-is)

Using hPanel File Manager, copy each file below into the same relative path
inside `domains/al-falahmarketing.com/public_html/`:

- `database/migrations/2026_09_18_000000_create_orders_table.php`
- `app/Models/Order.php`
- `app/Http/Controllers/CheckoutController.php`
- `app/Http/Controllers/Admin/OrderController.php`
- `config/payment_methods.php`
- `resources/views/User/checkout.blade.php`
- `resources/views/User/order-confirmation.blade.php`
- `resources/views/admin/orders/index.blade.php`
- `resources/views/admin/orders/show.blade.php`

## 2. Patch `routes/web.php` (do not replace the whole file — it's being actively edited)

**A.** Near the top, in the existing `use` block, add two lines. Right after:
```php
use App\Http\Controllers\Admin\TestimonialController;
```
add:
```php
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\OrderController;
```

**B.** Right after this existing line:
```php
Route::post('/consultation-store', [ConsultationController::class, 'store'])->name('consultation.store');
```
add:
```php

// Public checkout — payment-method-specific flow (see config/payment_methods.php).
Route::get('/order/{service}', [CheckoutController::class, 'show'])->name('checkout.show');
Route::post('/order/{service}', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/order/{order}/card-return', [CheckoutController::class, 'cardReturn'])->name('checkout.card-return');
Route::get('/order-confirmation/{order}', [CheckoutController::class, 'confirmation'])->name('checkout.confirmation');
```

**C.** Right after this existing block (the admin consultations routes):
```php
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/consultations', [ConsultationController::class, 'index'])->name('admin.consultations.index');
    Route::post('/admin/consultations/{id}/confirm', [ConsultationController::class, 'confirm'])->name('admin.consultations.confirm');
    Route::post('/admin/consultations/{id}/reschedule', [ConsultationController::class, 'reschedule'])->name('admin.consultations.reschedule');
});
```
add:
```php

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/admin/orders/{id}', [OrderController::class, 'show'])->name('admin.orders.show');
    Route::post('/admin/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.status');
    Route::delete('/admin/orders/{id}', [OrderController::class, 'destroy'])->name('admin.orders.destroy');
});
```

## 3. Patch `resources/views/admin/sidebar.blade.php`

Right after the "Meeting Quries" (consultations) `<a>` block, i.e. right after:
```blade
        <a href="{{ route('admin.consultations.index') }}"
            class="flex items-center px-4 py-3 text-gray-400 hover:bg-slate-800 hover:text-white rounded-lg transition duration-200">
            <i class="fas fa-briefcase w-5"></i>
            <span class="mx-3 font-semibold">Meeting Quries</span>
            <span class="ml-auto bg-primary text-white text-xs px-2 py-1 rounded-full">
                {{ \App\Models\Consultation::count() }}
            </span>
        </a>
```
add:
```blade

        <a href="{{ route('admin.orders.index') }}"
            class="flex items-center px-4 py-3 {{ Request::routeIs('admin.orders.*') ? 'bg-slate-800 text-white' : 'text-gray-400' }} hover:bg-slate-800 hover:text-white rounded-lg transition duration-200">
            <i class="fas fa-shopping-cart w-5"></i>
            <span class="mx-3 font-semibold">Orders</span>
            <span class="ml-auto bg-primary text-white text-xs px-2 py-1 rounded-full">
                {{ \App\Models\Order::count() }}
            </span>
        </a>
```

## 4. Add to `.env`

```
PAYMENT_ORANGE_MONEY_NUMBER=
PAYMENT_MTN_MONEY_NUMBER=
PAYMENT_MOOV_MONEY_NUMBER=
PAYMENT_WAVE_NUMBER=
PAYMENT_BANK_DETAILS=

# Leave blank to keep card checkout disabled. Also requires
# `composer require stripe/stripe-php` before it can actually be turned on —
# not installed yet.
STRIPE_SECRET_KEY=
```
Checkout will show "[SET THIS UP]" for any payment method left blank —
matches the same "pay externally, submit proof, admin confirms" model
documented in this repo's `docs/payment-flows.md`.

## 5. Run the migration

Via SSH, from the app root (`domains/al-falahmarketing.com/public_html`):
```bash
php artisan migrate --force
```
This only runs the one new `orders` migration — everything already migrated
is untouched.

If SSH is unreliable, the fallback documented in `docs/hostinger-deploy.md`
(a one-time throwaway PHP script that calls `migrate`, then is deleted
immediately) works the same way here.

## 6. Verify

- Find a service's numeric id (Admin → Services & Tarifs → edit a service,
  the id is in the URL), then visit `/order/{that id}` — checkout page
  should render with "[SET THIS UP]" placeholders until real account numbers
  are added to `.env`.
- Submit a test order (any non-card method) — should redirect to
  `/order-confirmation/{id}` and show up in Admin → Orders.
- Card option should show as unavailable until Stripe is set up.

## Real fixes made during deployment (2026-09-18)

- The public views (`checkout.blade.php`, `order-confirmation.blade.php`)
  actually extend `User.main`, not `layouts.app` as originally guessed —
  already corrected in this folder.
- The admin views (`admin/orders/index.blade.php`, `admin/orders/show.blade.php`)
  actually extend `admin.main` with `@section('admin-content')`, not
  `admin.layout`/`content` as originally guessed — already corrected.
- The SSH account's default `php` CLI is 8.2; the live site actually runs
  8.4.19. Use `/opt/alt/php84/usr/bin/php` explicitly for any `artisan`
  command run over SSH (e.g. `/opt/alt/php84/usr/bin/php artisan migrate --force`).
- **Pre-existing bug, unrelated to this extension, fixed live**: `app/Http/Middleware/IsAdmin.php`
  compared `Auth::user()->role === 'admin'`, but stored role values are
  `'Admin'` (capital A) — the comparison always failed, locking every admin
  account out of `/admin`. Fixed to `strtolower(Auth::user()->role ?? '') === 'admin'`.
  Not yet ported back into this repo copy — do that if/when the live
  `app/Http/Middleware/IsAdmin.php` is added here.

## What this supersedes

The `backend/` folder elsewhere in this repo (a separate, standalone Laravel
app) was built before we discovered the live site already has its own real
backend. It's now superseded by this extension and should not be deployed —
kept only for reference (the payment-method logic here is a direct port of
that work, adapted to `ContentStore`-based services and this app's
conventions).
