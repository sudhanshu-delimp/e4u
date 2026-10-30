<?php

namespace App\Listeners;

use App\Events\UserOffline;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\DB;

class MarkUserOffline
{
    public function handle(Logout $event): void
    {
        $id = $event->user ? (int) $event->user->getAuthIdentifier() : 0;

        if (! $id) {
            return;
        }

        // Pushed back past the 5 minute "online" window, so a reload also shows offline
        DB::table('users')->where('id', $id)->update(['last_online_at' => now()->subMinutes(10)]);

        // Tell every open chat page right now. A broadcast failure must never block the logout.
        try {
            broadcast(new UserOffline($id));
        } catch (\Throwable $e) {
            report($e);
        }
    }
}