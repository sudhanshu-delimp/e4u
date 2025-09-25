<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class AccountSettingController extends BaseController
{
    public function viewer_update_setting(Request $request)
    {

            $user = auth()->user();
            $data = [
                'advertiser_email'              => $request->boolean('advertiser_email') ? '1' : '0',
                'advertiser_text'               => $request->boolean('advertiser_text') ? '1' : '0',
                'escort_email'                  => $request->boolean('escort_email') ? '1' : '0',
                'escort_text'                   => $request->boolean('escort_text') ? '1' : '0',
                'idle_preference_time'          => $request->input('idle_time', '30'),
                'twofa'                         => $request->input('twofa', '2'),
            ];

            $setting = $user->viewer_settings;
            if ($setting) {
                $setting->update($data);
            } else {
                $user->viewer_settings()->create(array_merge($data, ['user_id' => $user->id,'user_type' => '0']));
            }

         return $this->successResponse('Notification settings updated successfully!');
    }

    public function viewer_change_features(Request $request)
    {

            $user = auth()->user();
            $data = [
                'features_push_notifications_from_escorts'              => $request->boolean('features_push_notifications_from_escorts') ? '1' : '0',
                'features_direct_chatting_with_escorts'                 => $request->boolean('features_direct_chatting_with_escorts') ? '1' : '0',
                'features_write_reviews'                                => $request->boolean('features_write_reviews') ? '1' : '0',
                'features_enable_my_legbox'                             => $request->boolean('features_enable_my_legbox') ? '1' : '0',
                'features_enable_my_notebox'                            => $request->boolean('features_enable_my_notebox') ? '1' : '0',
                'listings_preferences_view'                             => $request->input('listings_preferences_view', '2'),
                'interests_with_male'                                   => $request->boolean('interests_with_male') ? '1' : '0',
                'interests_with_female'                                 => $request->boolean('interests_with_female') ? '1' : '0',
                'interests_with_trans'                                  => $request->boolean('interests_with_trans') ? '1' : '0',
                'interests_with_cross_dresser'                          => $request->boolean('interests_with_cross_dresser') ? '1' : '0',
                'interests_with_couples'                                => $request->boolean('interests_with_couples') ? '1' : '0',
            ];

            $setting = $user->viewer_settings;
            if ($setting) {
                $setting->update($data);
            } else {
                $user->viewer_settings()->create(array_merge($data, ['user_id' => $user->id,'user_type' => '0']));
            }

         return $this->successResponse('Features settings updated successfully!');
    }


    public function get_viewer_features(Request $request)
    {
         $setting = User::with('viewer_settings')->where('id',auth()->user()->id)->first();
         return view('user.dashboard.change-features',['setting'=>$setting]);
    }

    
}
