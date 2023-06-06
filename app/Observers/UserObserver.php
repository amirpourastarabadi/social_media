<?php

namespace App\Observers;

use App\Models\EmailVerification;
use App\Models\User;
use Ramsey\Uuid\Uuid;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        EmailVerification::generateTokenFor($user);
    }

    /**
     * Handle the User "creating" event.
     */
    public function creating(User $user): void
    {
        $user->uuid = Uuid::uuid4()->toString();
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
