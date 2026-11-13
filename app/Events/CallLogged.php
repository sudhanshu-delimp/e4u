<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CallLogged implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public array $payload, public array $recipientIds)
    {
    }

    public function broadcastOn(): array
    {
        return array_map(fn ($id) => new PrivateChannel('user.' . (int) $id), $this->recipientIds);
    }

    public function broadcastAs(): string
    {
        return 'CallLogged';
    }

    public function broadcastWith(): array
    {
        return $this->payload;
    }
}