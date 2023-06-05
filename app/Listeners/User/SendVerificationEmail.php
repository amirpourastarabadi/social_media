<?php

namespace App\Listeners\User;

use App\Mail\VerifyEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendVerificationEmail implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }
    
    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        Mail::to($event->user->email)->send(new VerifyEmail($event->user));
    }
}
