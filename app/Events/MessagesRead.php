<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessagesRead implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public int $conversationId,
        public int $readerId,
        public int $upToId,
        public int $recipientId
    ) {
    }

    public function broadcastOn(): array
    {
        // Sent to the user who wrote the messages
        return [new PrivateChannel('user.' . $this->recipientId)];
    }

    public function broadcastAs(): string
    {
        return 'MessagesRead';
    }

    public function broadcastWith(): array
    {
        return [
            'conversation_id' => $this->conversationId,
            'reader_id'       => $this->readerId,
            'up_to_id'        => $this->upToId,
            'read_at'         => now()->toIso8601String(),
        ];
    }
}