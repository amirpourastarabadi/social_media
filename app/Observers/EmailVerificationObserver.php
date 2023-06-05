<?php

namespace App\Observers;

use App\Models\EmailVerification;
use Illuminate\Support\Str;


class EmailVerificationObserver
{
    /**
     * Handle the EmailVerification "creating" event.
     */
    public function creating(EmailVerification $emailVerification): void
    {
        $emailVerification->token = bcrypt(Str::random(256));
    }

    /**
     * Handle the EmailVerification "created" event.
     */
    public function created(EmailVerification $emailVerification): void
    {
        //
    }

    /**
     * Handle the EmailVerification "updated" event.
     */
    public function updated(EmailVerification $emailVerification): void
    {
        //
    }

    /**
     * Handle the EmailVerification "deleted" event.
     */
    public function deleted(EmailVerification $emailVerification): void
    {
        //
    }

    /**
     * Handle the EmailVerification "restored" event.
     */
    public function restored(EmailVerification $emailVerification): void
    {
        //
    }

    /**
     * Handle the EmailVerification "force deleted" event.
     */
    public function forceDeleted(EmailVerification $emailVerification): void
    {
        //
    }
}
