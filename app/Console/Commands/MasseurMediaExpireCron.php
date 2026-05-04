<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\MasseurMedia;
use App\Models\MasseurVerification;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class MasseurMediaExpireCron extends Command
{
    protected $signature = 'masseur-media:expire';
    protected $description = 'Expire pending masseur media after 48 hours';

    public function handle()
    {
        $now = now();

        // LIVE
        $expireMinutes = 60 * 48;

        // Step 1: users with pending media
        $userIds = MasseurMedia::where('varified', '0')
            ->pluck('user_id')
            ->unique();

        foreach ($userIds as $userId) {

            // Step 2: first pending media time
            $firstPendingMediaTime = MasseurMedia::where('user_id', $userId)
                ->where('varified', '0')
                ->where('type', 0)
                ->min('created_at');

            if (!$firstPendingMediaTime) {
                continue;
            }

            // Step 3: 48 hr check
            if ($firstPendingMediaTime > $now->copy()->subMinutes($expireMinutes)) {
                continue;
            }

            // Step 4: verification check
            $hasVerification = MasseurVerification::where('user_id', $userId)
                ->where('status', '0') // pending verification
                ->exists();

            // Step 5: expire if no verification
            if (!$hasVerification) {

                MasseurMedia::where('user_id', $userId)
                    ->where('varified', '0')
                    ->where('type', 0)
                    ->update([
                        'varified' => '2' // rejected/unverified
                    ]);

                $user = User::select('name', 'member_id', 'email')
                    ->where('id', $userId)
                    ->first();

                $body = [
                    'name' => $user->name ?? $user->email,
                    'email' => $user->email,
                    'member_id' => $user->member_id,
                ];

                Mail::to($body['email'])
                    ->queue(new \App\Mail\SystemMediaUnverifiedDueToNoVerificationMail($body));

                \Log::info("Masseur media expired (no verification) for user_id: " . $userId);
            }
        }

        $this->info('Masseur media expiration cron executed successfully.');
    }
}