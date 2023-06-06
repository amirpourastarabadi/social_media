<?php

namespace App\Listeners;

use App\Exceptions\EmailVerificationException;
use App\Models\EmailVerification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Response;
use Illuminate\Queue\InteractsWithQueue;

class TryVerifyUser
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event)
    {
        if (is_null($event->user) || $event->user->first_valid_token !== $event->token) {
            throw new EmailVerificationException('invalid request', Response::HTTP_BAD_REQUEST);
        }

        $event->user->emailToken()->where('token', $event->token)->first()->update(['verified_at' => now()]);
        return 'email verified successfully';
    }
}
