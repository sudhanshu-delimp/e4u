<?php

namespace App\Broadcasting;

use App\Services\ChatSocket;
use Illuminate\Broadcasting\Broadcasters\Broadcaster;

class SocketBroadcaster extends Broadcaster
{
    public function auth($request) { return true; }

    public function validAuthenticationResponse($request, $result) { return $result; }

    public function broadcast(array $channels, $event, array $payload = [])
    {
        unset($payload['socket']);
        $users = [];
        $all = false;

        foreach ($channels as $ch) {
            $ch = (string) $ch;
            if (preg_match('/^(?:private-)?user\.(\d+)$/', $ch, $m)) {
                $users[] = (int) $m[1];
            } elseif (str_starts_with($ch, 'presence-')) {
                $all = true;   // UserOffline: all
            }
            // chat.{id} channel ignore: recipient ko user.{id} 
        }

        if ($all) {
            ChatSocket::emit(null, $event, $payload);
        } elseif ($users) {
            ChatSocket::emit($users, $event, $payload);
        }
    }
}