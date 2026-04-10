<?php

namespace App\Console\Commands;

use App\Mail\MediaVerificationAdvertiserMail;
use App\Mail\SystemMediaUnverifiedDueToNoVerificationMail;
use Illuminate\Console\Command;
use App\Models\EscortMedia;
use App\Models\MediaVerification;
use App\Models\User;
use Carbon\Carbon;
use Mail;

class EscortsMediaExpireCron extends Command
{
    protected $signature = 'media:expire';
    protected $description = 'Expire pending media after 48 hours';

    public function handle()
    {
        $now = now();

        // TESTING
        // $expireMinutes = 2;

        // LIVE
        $expireMinutes = 60 * 48;

        // Step 1: users with pending media
        $userIds = EscortMedia::where('varified', '0')
            ->pluck('user_id')
            ->unique();
        foreach ($userIds as $userId) {

            // Step 2: first pending media time
            $firstPendingMediaTime = EscortMedia::where('user_id', $userId)
                ->where('varified', '0')
                ->where('type', 0)
                ->where('template', '0')
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
                    ->where('type', 0)
                    ->where('template', '0')
                    ->update(['varified' => '2']);
                $user = User::select('name', 'member_id', 'email')
                ->where('id', $userId)
                ->first();
                $body = [
                    'name' => $user->name ?? $user->email,
                    'email' => $user->email,
                    'member_id' => $user->member_id,
                    // 'agent_id' => $user->my_agent->member_id ?? null,
                ];

                    \Mail::to($body['email'])
                        ->queue(new SystemMediaUnverifiedDueToNoVerificationMail($body));

                    \Log::info("Media expired (no verification) for user_id: " . $userId);
            }
        }

        $this->info('Media expiration cron executed successfully.');
    }
}
