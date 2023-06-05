<?php

namespace App\Providers;

use App\Models\EmailVerification;
use App\Models\User;
use App\Observers\EmailVerificationObserver;
use App\Observers\UserObserver;
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
        User::observe(UserObserver::class);
        EmailVerification::observe(EmailVerificationObserver::class);
    }
}
