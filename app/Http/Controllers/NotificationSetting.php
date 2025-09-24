<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class NotificationSetting extends BaseController
{
    public function viewwer_update_notification_setting(Request $request)
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

            $setting = $user->viewer_notification_setting;
            if ($setting) {
                $setting->update($data);
            } else {
                $user->viewer_notification_setting()->create(array_merge($data, ['user_id' => $user->id,'user_type' => '0']));
            }

         return $this->successResponse('Notification settings updated successfully!');
    }
}
