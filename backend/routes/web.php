<?php

use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\LeadController as PublicLeadController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Public lead-capture forms — rate-limited (3 per IP per hour) to match docs/lead-capture-setup.md.
Route::post('/contact-submit', [PublicLeadController::class, 'contactSubmit'])
    ->middleware('throttle:3,60')
    ->name('contact.submit');

Route::post('/consultation-store', [PublicLeadController::class, 'consultationStore'])
    ->middleware('throttle:3,60')
    ->name('consultation.store');

// Public checkout — payment-method-specific flow (see config/payment_methods.php).
Route::get('/order/{service}', [CheckoutController::class, 'show'])->name('checkout.show');
Route::post('/order/{service}', [CheckoutController::class, 'store'])
    ->middleware('throttle:5,60')
    ->name('checkout.store');
Route::get('/order/{service}/card-return', [CheckoutController::class, 'cardReturn'])->name('checkout.card-return');
Route::get('/order-confirmation/{order}', [CheckoutController::class, 'confirmation'])->name('checkout.confirmation');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin area — requires login (Breeze auth). Only an authenticated admin user can manage
// services, view/action orders, and triage leads.
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('services', ServiceController::class);
    Route::resource('orders', OrderController::class)->only(['index', 'show', 'update', 'destroy']);
    Route::resource('leads', LeadController::class)->only(['index', 'show', 'update', 'destroy']);
});

require __DIR__.'/auth.php';
