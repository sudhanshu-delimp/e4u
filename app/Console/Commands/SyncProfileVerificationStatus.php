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

    // Status constants (0 = pending, 1 = verified, 2 = unverified)
    private const PENDING    = '0';
    private const VERIFIED   = '1';
    private const UNVERIFIED = '2';

    public function handle()
    {
        Log::info('=== START CRON ===');

        $users = User::where('status', 1)
            ->whereIn('type', ['3', '4'])
            ->get();

        foreach ($users as $user) {

            // ESCORT (TYPE 3)
            if ($user->type == '3') {

                $profiles = Escort::where('user_id', $user->id)
                    ->where('default_setting', 0)
                    ->whereHas('purchase', fn($q) => $q->where('status', 'listed'))
                    ->get();

                foreach ($profiles as $escort) {

                    // Only the thumbnail (position 1) decides the status
                    $thumbnail = $escort->gallary()
                        ->wherePivot('type', 0)
                        ->wherePivot('position', 1)
                        ->first();

                    $status = $this->normalizeStatus($thumbnail->varified ?? null);

                    $this->saveStatus($escort->id, '3', $status);
                }
            }

            // MASSAGE (TYPE 4)
            if ($user->type == '4') {

                $profiles = MassageProfile::where('user_id', $user->id)
                    ->where('default_setting', 0)
                    ->whereHas('purchase', fn($q) => $q->where('status', 'listed'))
                    ->get();

                foreach ($profiles as $profile) {

                    // Only the thumbnail (position 1) decides the status
                    $image_data = get_image_position_detail($profile, 1);

                    $status = $this->normalizeStatus($image_data['varified'] ?? null);

                    $this->saveStatus($profile->id, '4', $status);
                }
            }
        }

        Log::info('=== END CRON ===');

        $this->info('Profile verification status synced successfully');
    }

    /**
     * Store the actual thumbnail status.
     * Missing or unexpected value -> pending.
     */
    private function normalizeStatus($value): string
    {
        $value = (string) ($value ?? self::PENDING);

        return in_array($value, [self::PENDING, self::VERIFIED, self::UNVERIFIED], true)
            ? $value
            : self::PENDING;
    }

    private function saveStatus($profileId, string $type, string $status): void
    {
        $key = [
            'profile_id' => $profileId,
            'type'       => $type,
        ];

        $exists = DB::table('profile_verification_status')->where($key)->exists();

        if ($exists) {
            DB::table('profile_verification_status')->where($key)->update([
                'status'     => $status,
                'updated_at' => now(),
            ]);
        } else {
            DB::table('profile_verification_status')->insert($key + [
                'status'     => $status,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}