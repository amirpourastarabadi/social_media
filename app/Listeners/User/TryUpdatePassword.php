<?php

namespace App\Listeners\User;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Response;
use Illuminate\Queue\InteractsWithQueue;

class TryUpdatePassword
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
    public function handle(object $event): void
    {
        abort_if(is_null($event->user), Response::HTTP_UNAUTHORIZED, 'invalid inputs.');

        abort_if($event->user->reset_password_token !== $event->resetPasswordToken, Response::HTTP_UNAUTHORIZED, 'invalid inputs.');
        
        $event->user->update(['password' => $event->newPassword]);
    }
}
