<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ViewerSetting;
use Illuminate\Database\Seeder;

class AddViewerDefaultSettingSeeder extends Seeder
{
    public function run()
    {
            $users = User::where('type', 0)->get();
            foreach ($users as $user) 
            {
                $exists = ViewerSetting::where('user_id', $user->id)->exists();
                if (!$exists) {
                    ViewerSetting::create([
                        'user_id' => $user->id,
                        'user_type' => $user->type,
                        'features_push_notifications_from_escorts' => 1,
                        'features_direct_chatting_with_escorts' => 1,
                        'features_write_reviews' => 1,
                        'features_enable_my_legbox' => 1,
                        'features_enable_my_notebox' => 1,
                        'listings_preferences_view' => 1,
                        'interests_with_male' => 1,
                        'interests_with_female' => 1,
                        'interests_with_trans' => 1,
                        'interests_with_cross_dresser' => 1,
                        'interests_with_couples' => 1,
                        'idle_preference_time' => 60,
                    ]);
                }
            }
    }
}
