<?php

namespace App\Observers;

use App\Models\PasswordReset;
use Illuminate\Support\Str;

class PasswordResetObserver
{
    /**
     * Handle the PasswordReset "created" event.
     */
    public function created(PasswordReset $passwordReset): void
    {
        //
    }

    /**
     * Handle the PasswordReset "creating" event.
     */
    public function creating(PasswordReset $passwordReset): void
    {
        $passwordReset->token = bcrypt(Str::random(256));
        $passwordReset->created_at = now();
    }

    /**
     * Handle the PasswordReset "updated" event.
     */
    public function updated(PasswordReset $passwordReset): void
    {
        //
    }

    /**
     * Handle the PasswordReset "deleted" event.
     */
    public function deleted(PasswordReset $passwordReset): void
    {
        //
    }

    /**
     * Handle the PasswordReset "restored" event.
     */
    public function restored(PasswordReset $passwordReset): void
    {
        //
    }

    /**
     * Handle the PasswordReset "force deleted" event.
     */
    public function forceDeleted(PasswordReset $passwordReset): void
    {
        //
    }
}
