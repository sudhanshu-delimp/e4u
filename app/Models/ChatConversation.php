<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatConversation extends Model
{
    protected $table = 'chat_conversations';

    protected $guarded = [];

    protected $casts = [
        'last_message_at' => 'datetime',
    ];

    public function messages()
    {
        return $this->hasMany(ChatMessage::class, 'conversation_id');
    }

    public function hasParticipant(int $userId): bool
    {
        return (int) $this->user_one_id === $userId
            || (int) $this->user_two_id === $userId;
    }

    public function otherUserId(int $userId): int
    {
        return (int) $this->user_one_id === $userId
            ? (int) $this->user_two_id
            : (int) $this->user_one_id;
    }

    /**
     * Find the conversation between two users, or null.
     */
    public static function between(int $a, int $b): ?self
    {
        return static::query()
            ->where('user_one_id', min($a, $b))
            ->where('user_two_id', max($a, $b))
            ->first();
    }
}