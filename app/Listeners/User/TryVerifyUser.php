<?php

namespace App\Listeners\User;

use App\Exceptions\EmailVerificationException;
use Illuminate\Http\Response;

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
