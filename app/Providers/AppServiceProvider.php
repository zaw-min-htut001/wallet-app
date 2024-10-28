<?php

namespace App\Providers;

use Facades\View;
use Illuminate\Support\Facades\Auth;
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
        view()->composer('*', function ($view) {
            $unread_count = 0;

            if (Auth::check()) { // Check if a user is authenticated
                $user = Auth::user();

                if ($user) {
                    $unread_count = $user->unreadNotifications->count();
                }
            }
            $view->with('unread_count', $unread_count);
        });
    }
}
