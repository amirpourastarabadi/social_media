<?php

namespace App\Events\User;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PasswordUpdateEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public array $result = [];
    /**
     * Create a new event instance.
     */
    public function __construct(public string $userEmail, public string $newPassword, public string $resetPasswordToken)
    {
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }

    public function getResult(null|string $key = null): string|array
    {
        return is_null($key) ? $this->result : $this->result[$key] ?? null;
    }
}
