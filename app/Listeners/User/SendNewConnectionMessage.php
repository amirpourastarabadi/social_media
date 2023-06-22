<?php

namespace App\Listeners\User;

use App\Mail\NewConnectionEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendNewConnectionMessage
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
        Mail::to($event->following->email)->send(new NewConnectionEmail($event->follower));
    }
}
