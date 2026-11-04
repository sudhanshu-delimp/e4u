<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserOnline implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public int $userId)
    {
    }

    // Same channel as UserOffline
    public function broadcastOn(): array
    {
        return [new PresenceChannel('online')];
    }

    public function broadcastAs(): string
    {
        return 'UserOnline';
    }

    public function broadcastWith(): array
    {
        return ['user_id' => $this->userId];
    }
}