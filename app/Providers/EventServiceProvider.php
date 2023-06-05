<?php

namespace App\Providers;

use App\Events\EmailVerificationEvent;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use App\Listeners\User\SendVerificationEmail;
use App\Events\User\RegistrationEvent;
use App\Listeners\FindRequestedUser;
use App\Listeners\TryVerifyUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;
use App\Listeners\User\UserCreation;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        RegistrationEvent::class => [
            UserCreation::class,
            SendVerificationEmail::class,
        ],
        EmailVerificationEvent::class => [
            FindRequestedUser::class,
            TryVerifyUser::class
        ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
