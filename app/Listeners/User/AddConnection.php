<?php

namespace App\Listeners\User;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class AddConnection
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
        DB::transaction(function () use ($event) {
            $event->follower->followings()->detach($event->following->getKey());
            $event->follower->followings()->attach($event->following->getKey(), ['created_at' => now()]);
        });
    }
}
