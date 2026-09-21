<?php

namespace App\Providers;

use App\Models\Notification;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('admin.header', function ($view) {
            $view->with([
                'unreadNotificationsCount' => Notification::unread()->count(),
                'recentNotifications' => Notification::latest()->take(8)->get(),
            ]);
        });
    }
}
