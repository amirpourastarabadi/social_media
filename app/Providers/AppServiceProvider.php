<?php

namespace App\Providers;

use App\Models\EmailVerification;
use App\Models\User;
use App\Observers\EmailVerificationObserver;
use App\Observers\UserObserver;
use App\Utilities\FileSystem\Upload;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(Upload::class, Upload::class);
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
