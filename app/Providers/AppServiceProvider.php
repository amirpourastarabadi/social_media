<?php

namespace App\Providers;

use App\Observers\EmailVerificationObserver;
use App\Utilities\FileSystem\FileSystem;
use Illuminate\Support\ServiceProvider;
use App\Models\EmailVerification;
use App\Observers\UserObserver;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(FileSystem::class, FileSystem::class);
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
