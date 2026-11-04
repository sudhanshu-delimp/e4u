<?php

namespace App\Listeners;

use App\Events\UserOnline;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\DB;

class MarkUserOnline
{
    public function handle(Login $event): void
    {
        $id = $event->user ? (int) $event->user->getAuthIdentifier() : 0;

        if (! $id) {
            return;
        }

        DB::table('users')->where('id', $id)->update(['last_online_at' => now()]);

        // A broadcast failure must never block the login
        try {
            broadcast(new UserOnline($id));
        } catch (\Throwable $e) {
            report($e);
        }
    }
}