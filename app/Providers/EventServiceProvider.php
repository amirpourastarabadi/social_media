<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use App\Listeners\User\RemoveOldResetPasswordTokens;
use App\Listeners\User\GeneratePasswordResetToken;
use App\Events\User\PasswordResetRequestEvent;
use App\Listeners\User\SendVerificationEmail;
use App\Events\User\EmailVerificationEvent;
use App\Events\User\FollowEvent;
use App\Events\User\UpdateUserProfileEvent;
use App\Listeners\User\PasswordResetEmail;
use App\Listeners\User\FindRequestedUser;
use App\Listeners\User\TryUpdatePassword;
use App\Events\User\PasswordUpdateEvent;
use App\Events\User\RegistrationEvent;
use App\Listeners\User\AddConnection;
use Illuminate\Auth\Events\Registered;
use App\Listeners\User\UpdateProfile;
use App\Listeners\User\TryVerifyUser;
use App\Listeners\User\AttemptLogin;
use App\Listeners\User\SendNewConnectionMessage;
use App\Listeners\User\UserCreation;
use App\Listeners\User\UpdateUser;

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
        ],
        UpdateUserProfileEvent::class => [
            UpdateUser::class,
            UpdateProfile::class
        ],
        PasswordResetRequestEvent::class => [
            FindRequestedUser::class,
            RemoveOldResetPasswordTokens::class,
            GeneratePasswordResetToken::class,
            PasswordResetEmail::class,
        ],
        PasswordUpdateEvent::class => [
            FindRequestedUser::class,
            TryUpdatePassword::class,
            AttemptLogin::class,
        ],
        FollowEvent::class => [
            AddConnection::class,
            SendNewConnectionMessage::class,
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
