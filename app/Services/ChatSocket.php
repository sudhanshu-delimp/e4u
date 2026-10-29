<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatSocket
{
    public static function token(int $userId, int $ttl = 43200): string
    {
        $payload = rtrim(strtr(base64_encode(json_encode(['uid' => $userId, 'exp' => time() + $ttl])), '+/', '-_'), '=');
        return $payload . '.' . hash_hmac('sha256', $payload, config('chat.socket.secret'));
    }

    public static function emit(?array $userIds, string $event, array $data = []): void
    {
        try {
            Http::withHeaders(['X-Chat-Secret' => config('chat.socket.secret')])
                ->timeout(2)
                ->post(rtrim(config('chat.socket.url'), '/') . '/emit', [
                    'users' => $userIds === null ? null : array_values(array_unique($userIds)),
                    'event' => $event,
                    'data'  => $data,
                ]);
        } catch (\Throwable $e) {
            Log::warning('Chat socket emit failed: ' . $e->getMessage());
        }
    }
}