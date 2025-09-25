<?php

namespace App\Listeners;


use App\Models\User;
use App\Models\ViewerSetting;
use App\Models\AccountSetting;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Events\Registered;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\ViewerNotificationSetting;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateDefaultAccountSettings
{
    
    public function __construct()
    {
        //
    }

    public function handle($event)
    {
    
        $userdata  =  json_decode(json_encode($event),true);

       

        if(isset($userdata['escode']) || isset($userdata['user']))
        {
            $user = isset($userdata['escode']) ? $userdata['escode'] : $userdata['user'];

             Log::info($user);


            if(isset($user['id']))
            {
                AccountSetting::create([
                    'user_id'  => $user['id'],
                    'password_updated_date' => date('Y-m-d H:i:s'),
                    'password_expiry_days'   => '30',
                    'is_text_notificaion_on' => '0',
                    'is_email_notificaion_on' => '0',
                ]);

               $user  = User::where('id',$user['id'])->first();

               ########### For Viewer ##########################
               if($user &&  $user->type=='0')
               {
                   ViewerSetting::create([
                        'user_id'=>$user['id'],
                        'user_type'=>$user->type
                    ]);
               }
               ########### For Viewer ##########################

            }    
           
        }

       
    }
}
