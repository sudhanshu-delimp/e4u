<?php

use App\Models\ChatConversation;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

// Private conversation channel: only the two participants can listen
Broadcast::channel('chat.{conversationId}', function (User $user, int $conversationId) {
    $conversation = ChatConversation::find($conversationId);

    return $conversation && $conversation->hasParticipant($user->id);
});

// Private per-user channel (unread badge, new chat notifications)
Broadcast::channel('user.{id}', function (User $user, int $id) {
    return (int) $user->id === (int) $id;
});

// Presence channel for online dots and typing whispers
Broadcast::channel('online', function (User $user) {
    return [
        'id'        => $user->id,
        'name'      => $user->name,
        'member_id' => $user->member_id,
        'avatar'    => $user->avatar_img,
        'type'      => (int) $user->type,
    ];
});