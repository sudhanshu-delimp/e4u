<?php

namespace App\Console\Commands;

use App\Mail\MediaVerificationAdvertiserMail;
use Illuminate\Console\Command;
use App\Models\EscortMedia;
use App\Models\MediaVerification;
use App\Models\User;
use Carbon\Carbon;

class EscortsMediaExpireCron extends Command
{
    protected $signature = 'media:expire';
    protected $description = 'Expire pending media after 48 hours';

    public function handle()
    {
        $now = now();

        // TESTING
        $expireMinutes = 2;

        // LIVE
        // $expireMinutes = 60 * 48;

        // Step 1: users with pending media
        $userIds = EscortMedia::where('varified', '0')
            ->pluck('user_id')
            ->unique();
        foreach ($userIds as $userId) {

            // Step 2: first pending media time
            $firstPendingMediaTime = EscortMedia::where('user_id', $userId)
                ->where('varified', '0')
                ->min('created_at');

            if (!$firstPendingMediaTime) {
                continue;
            }

            // Step 3: 48 hr cross?
            if ($firstPendingMediaTime > $now->copy()->subMinutes($expireMinutes)) {
                continue;
            }

            // Step 4: check verification uploaded or not
            $hasVerification = MediaVerification::where('user_id', $userId)->where('status', '0')
                ->exists();

            // if verification uploaded or not 
            if (!$hasVerification) {

                EscortMedia::where('user_id', $userId)
                    ->where('varified', '0')
                    ->update(['varified' => '2']);

                \Log::info("Media expired (no verification) for user_id: " . $userId);
            }
        }

        $this->info('Media expiration cron executed successfully.');
    }
}
