<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\Admin\DomainController;
use App\Http\Controllers\User\UserDomainController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\PasswordResetController;



Route::get('/', [UserController::class, 'index'])->name('home');
Route::get('/About-us', [UserController::class, 'about'])->name('about');
Route::get('/Services', [UserController::class, 'service'])->name('service');
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');


Route::post('/contact-submit', [ContactController::class, 'store'])->name('contact.store');


Route::get('/Blog', [UserController::class, 'blog'])->name('blog');
Route::get('/blog/{slug}', [UserController::class, 'show'])->name('blog.show');

// NOTE: the unprotected duplicate of GET /admin that used to sit here has been
// removed. The protected definition further down (auth + admin) is the real one.

// Admin: user management
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
    Route::post('/users/store', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/users/{id}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/blogs', [AdminBlogController::class, 'index'])
        ->name('admin.blogs.index');
    Route::get('/admin/blogs/create', [AdminBlogController::class, 'create'])
        ->name('admin.blogs.create');
    Route::post('/admin/blogs', [AdminBlogController::class, 'store'])
        ->name('admin.blogs.store');
    Route::delete('/admin/blogs/{blog}', [AdminBlogController::class, 'destroy'])
        ->name('admin.blogs.destroy');
});

// Admin Contact Enquiries Route
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/contacts', [AdminController::class, 'contacts'])->name('admin.contacts.index');
    Route::delete('/admin/contacts/{id}', [AdminController::class, 'destroyContact'])->name('admin.contacts.destroy');
});

// consultation route (public: this is the website booking form)
Route::post('/consultation-store', [ConsultationController::class, 'store'])->name('consultation.store');


// Guest Authentication Routes Grid
Route::middleware('guest')->group(function () {
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/login', [UserController::class, 'loginProcess'])->name('login.perform');

    // Public self-registration is CLOSED. Client accounts are created from the
    // admin panel instead. The route names are kept so any old bookmark or
    // stray link lands on the login page rather than erroring.
    Route::get('/signup', fn () => redirect()->route('login'))->name('signup');
    Route::post('/signup', fn () => redirect()->route('login'))->name('signup.perform');

    // Password reset
    Route::get('/forgot-password', [PasswordResetController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [PasswordResetController::class, 'reset'])->name('password.update');
});

// Protected Platform Gateways
Route::middleware('auth')->group(function () {
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

    // Standard User Dashboard Routing
    Route::get('/dashboard', function () {
        return view('User.dashboard');
    })->name('user.dashboard');

    // Admin Group Dashboard Routing
   Route::middleware('admin')->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])
            ->name('admin.index');
    });
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/portfolio', [PortfolioController::class, 'adminIndex'])->name('admin.portfolio.index');
    Route::get('/portfolio/create', [PortfolioController::class, 'create'])->name('admin.portfolio.create');
    Route::post('/portfolio/store', [PortfolioController::class, 'store'])->name('admin.portfolio.store');
    Route::delete('/portfolio/{id}', [PortfolioController::class, 'destroy'])->name('admin.portfolio.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/consultations', [ConsultationController::class, 'index'])->name('admin.consultations.index');
    Route::post('/admin/consultations/{id}/confirm', [ConsultationController::class, 'confirm'])->name('admin.consultations.confirm');
    Route::post('/admin/consultations/{id}/reschedule', [ConsultationController::class, 'reschedule'])->name('admin.consultations.reschedule');
});


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/domains', [DomainController::class, 'index'])->name('admin.domains.index');
    Route::post('/admin/domains/store', [DomainController::class, 'store'])->name('admin.domains.store');
    Route::delete('/admin/domains/{id}', [DomainController::class, 'destroy'])->name('admin.domains.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/my-domains', [UserDomainController::class, 'index'])->name('user.domains.index');
});

// Services & pricing, and client testimonials.
// Both are stored as JSON files under storage/app/content, not database tables.
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
    Route::post('/services', [ServiceController::class, 'save'])->name('services.store');
    Route::get('/services/{id}/edit', [ServiceController::class, 'edit'])
        ->whereNumber('id')->name('services.edit');
    Route::put('/services/{id}', [ServiceController::class, 'update'])
        ->whereNumber('id')->name('services.update');
    Route::post('/services/{id}/toggle', [ServiceController::class, 'toggle'])
        ->whereNumber('id')->name('services.toggle');
    Route::delete('/services/{id}', [ServiceController::class, 'destroy'])
        ->whereNumber('id')->name('services.destroy');

    Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');
    Route::get('/testimonials/create', [TestimonialController::class, 'create'])->name('testimonials.create');
    Route::post('/testimonials', [TestimonialController::class, 'save'])->name('testimonials.store');
    Route::get('/testimonials/{id}/edit', [TestimonialController::class, 'edit'])
        ->whereNumber('id')->name('testimonials.edit');
    Route::put('/testimonials/{id}', [TestimonialController::class, 'update'])
        ->whereNumber('id')->name('testimonials.update');
    Route::post('/testimonials/{id}/toggle', [TestimonialController::class, 'toggle'])
        ->whereNumber('id')->name('testimonials.toggle');
    Route::delete('/testimonials/{id}', [TestimonialController::class, 'destroy'])
        ->whereNumber('id')->name('testimonials.destroy');
});




Route::get('/language/{locale}', function ($locale) {

    if (!in_array($locale, ['en', 'fr'])) {
        abort(404);
    }

    Session::put('locale', $locale);

    return back();

})->name('language.switch');


Route::get('/services/web-development', [UserController::class, 'web'])->name('services.web-development');
Route::get('/services/digital-marketing', [UserController::class, 'digital'])->name('services.digital-marketing');
Route::get('/services/branding', [UserController::class, 'branding'])->name('services.branding');
Route::get('/services/automation', [UserController::class, 'automation'])->name('services.automation');
Route::get('/services/content-creation', [UserController::class, 'content'])->name('services.content');
Route::get('/services/it-solutions', [UserController::class, 'solution'])->name('services.solution');

Route::get('/privacy-policies', [UserController::class, 'privacy'])->name('privacy.policy');
Route::get('/terms-conditions', [UserController::class, 'terms'])->name('terms.conditions');



Route::post('/newsletter-subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// Newsletter Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {


    // Newsletter routes
    Route::get('/newsletter', [NewsletterController::class, 'index'])->name('newsletter.index');
    Route::delete('/newsletter/{id}', [NewsletterController::class, 'destroy'])->name('newsletter.destroy');
    Route::get('/newsletter/export', [NewsletterController::class, 'export'])->name('newsletter.export');
    Route::post('/newsletter/bulk-delete', [NewsletterController::class, 'bulkDelete'])->name('newsletter.bulk-delete');
});
