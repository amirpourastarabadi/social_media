<?php

namespace App\Listeners\User;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AttemptLogin
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
        $event->result['auth_token'] = User::attemptToLogin($this->getCredentials($event))->auth_token;
    }

    private function getCredentials($event)
    {
        return [
            'password' => $event->newPassword,
            'email' => $event->userEmail,
        ];
    }
}
