<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CallingChanged implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public int $userId, public bool $enabled, public array $recipientIds)
    {
    }

    public function broadcastOn(): array
    {
        return array_map(fn ($id) => new PrivateChannel('user.' . (int) $id), $this->recipientIds);
    }

    public function broadcastAs(): string
    {
        return 'CallingChanged';
    }

    public function broadcastWith(): array
    {
        return ['user_id' => $this->userId, 'enabled' => $this->enabled];
    }
}