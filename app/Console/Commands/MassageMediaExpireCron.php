<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\MassageMedia;
use App\Models\MediaVerification;
use App\Models\User;
use Carbon\Carbon;

class MassageMediaExpireCron extends Command
{
    protected $signature = 'massage_media:expire';
    protected $description = 'Expire pending massage media after 48 hours';

    public function handle()
    {
        $now = now();

        // TESTING
        // $expireMinutes = 2;

        // LIVE
        $expireMinutes = 60 * 48;

        // Step 1: users with pending media
        $userIds = MassageMedia::where('varified', '0')
            ->pluck('user_id')
            ->unique();

        foreach ($userIds as $userId) {

            // Step 2: first pending media time
            $firstPendingMediaTime = MassageMedia::where('user_id', $userId)
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
            $hasVerification = MediaVerification::where('user_id', $userId)
                ->where('status', '0')
                ->exists();

            // if verification NOT uploaded
            if (!$hasVerification) {

                MassageMedia::where('user_id', $userId)
                    ->where('varified', '0')
                    ->update(['varified' => '2']);

                $user = User::select('name', 'member_id', 'email')
                    ->where('id', $userId)
                    ->first();

                $body = [
                    'name' => $user->name ?? $user->email,
                    'email' => $user->email,
                    'member_id' => $user->member_id,
                ];

                \Mail::to($body['email'])
                    ->queue(new \App\Mail\SystemMediaUnverifiedDueToNoVerificationMail($body));

                \Log::info("Massage media expired (no verification) for user_id: " . $userId);
            }
        }

        $this->info('Massage media expiration cron executed successfully.');
    }
}