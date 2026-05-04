<?php

namespace App\Console\Commands;

use App\Models\MasseurGallery;
use Illuminate\Console\Command;
use App\Models\MasseurMedia;
use App\Models\MasseurVerification;
use App\Models\User;
use App\Models\Masseur;
use Illuminate\Support\Facades\Mail;
use App\Mail\SystemMasseurMediaUnverifiedDueToNoVerificationMail;

class MasseurMediaExpireCron extends Command
{
    protected $signature = 'masseur-media:expire';
    protected $description = 'Expire pending masseur media after 48 hours';

    public function handle()
    {
        $now = now();

        // LIVE (change to 60*48 for production)
        $expireMinutes = 60*48;

        // Step 1: get unique masseur_token_ids having pending media
        $masseur_token_ids = MasseurMedia::where('varified', '0')
            ->whereNull('media_verification_id')
            ->pluck('masseur_token_id')
            ->unique();

        foreach ($masseur_token_ids as $masseur_token_id) {

            // Step 2: get masseur profile
            $masseur_profile = MasseurGallery::where('masseur_token_id', $masseur_token_id)->first();

            if (!$masseur_profile) {
                \Log::warning("Masseur profile not found for token: " . $masseur_token_id);
                continue;
            }

            // Step 3: get first pending media time
            $firstPendingMediaTime = MasseurMedia::where('masseur_token_id', $masseur_token_id)
                ->where('varified', '0')
                ->where('type', 0)
                ->min('created_at');

            if (!$firstPendingMediaTime) {
                continue;
            }

            // Step 4: check expiry (48 hr logic)
            if (now()->diffInMinutes($firstPendingMediaTime) < $expireMinutes) {
                continue;
            }

            // Step 5: check if verification exists (pending)
            $hasVerification = MasseurVerification::where('masseur_id', $masseur_profile->masseur_profile_id)
                ->where('status', '0')
                ->exists();

            // Step 6: expire media if no verification
            if (!$hasVerification) {

                // get all pending media
                $masseur_media_data = MasseurMedia::where('masseur_token_id', $masseur_token_id)
                    ->where('varified', '0')
                    ->where('type', 0)
                    ->get();

                if ($masseur_media_data->isEmpty()) {
                    continue;
                }

                // get user_id from first record
                $userId = $masseur_media_data->first()->user_id;

                // update all media to unverified (2)
                foreach ($masseur_media_data as $media) {
                    $media->update(['varified' => '2']);
                }

                // get user details
                $user = User::select('name', 'member_id', 'email')
                    ->where('id', $userId)
                    ->first();

                if (!$user) {
                    \Log::warning("User not found for user_id: " . $userId);
                    continue;
                }

                // get masseur member id
                $masseurMemberId = Masseur::where('id', $masseur_profile->masseur_profile_id)
                    ->value('member_id');

                // prepare email data
                $body = [
                    'name' => $user->name ?? $user->email,
                    'email' => $user->email,
                    'member_id' => $user->member_id,
                    'masseur_member_id' => $masseurMemberId,
                ];

                // send mail
                Mail::to($body['email'])
                    ->queue(new SystemMasseurMediaUnverifiedDueToNoVerificationMail($body));

                \Log::info("Masseur media expired for user_id: " . $userId);
            }
        }

        $this->info('Masseur media expiration cron executed successfully.');
    }
}