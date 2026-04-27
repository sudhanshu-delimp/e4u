<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Escort;
use App\Models\MassageProfile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SyncProfileVerificationStatus extends Command
{
    protected $signature = 'profile:sync-status';
    protected $description = 'Sync Escort & Massage Profile Verification Status';

    public function handle()
    {
        Log::info('=== START CRON ===');

        $users = User::where('status', 1)
            ->whereIn('type', ['3','4'])
            ->get();

        foreach ($users as $user) {

            /*
            =========================
            🔹 ESCORT (TYPE 3)
            =========================
            */
            if ($user->type == '3') {

                $profiles = Escort::where('user_id', $user->id)
                    ->where('default_setting', 0)
                    ->whereHas('purchase', fn($q) => $q->where('status', 'listed'))
                    ->get();

                foreach ($profiles as $escort) {

                    $media = $escort->gallary()
                        ->wherePivot('type', 0)
                        ->wherePivotIn('position', [1,2,3,4,5,6,7])
                        ->get();

                    $thumbnailStatus = '0';

                    foreach ($media as $item) {
                        if ($item->pivot->position == 1) {
                            $thumbnailStatus = (string) ($item->varified ?? '0');
                        }
                    }

                    // FINAL RULE (SIMPLIFIED)
                    $finalStatus = ($thumbnailStatus == '1') ? '1' : '2';

                    DB::table('profile_verification_status')->updateOrInsert(
                        [
                            'profile_id' => $escort->id,
                            'type' => '3'
                        ],
                        [
                            'status' => $finalStatus,
                            'updated_at' => now(),
                            'created_at' => now()
                        ]
                    );
                }
            }

            /*
            =========================
            🔹 MASSAGE (TYPE 4)
            =========================
            */
            if ($user->type == '4') {

                $profiles = MassageProfile::where('user_id', $user->id)
                    ->where('default_setting', 0)
                    ->whereHas('purchase', fn($q) => $q->where('status', 'listed'))
                    ->get();

                foreach ($profiles as $profile) {

                    $thumbnailStatus = '0';

                    for ($i = 1; $i <= 7; $i++) {

                        $image_data = get_image_position_detail($profile, $i);

                        if (!empty($image_data) && $i == 1) {
                            $thumbnailStatus = (string) ($image_data['varified'] ?? '0');
                        }
                    }

                    // FINAL RULE (SIMPLIFIED)
                    $finalStatus = ($thumbnailStatus == '1') ? '1' : '2';

                    DB::table('profile_verification_status')->updateOrInsert(
                        [
                            'profile_id' => $profile->id,
                            'type' => '4'
                        ],
                        [
                            'status' => $finalStatus,
                            'updated_at' => now(),
                            'created_at' => now()
                        ]
                    );
                }
            }
        }

        Log::info('=== END CRON ===');

        $this->info('Profile verification status synced successfully');
    }
}