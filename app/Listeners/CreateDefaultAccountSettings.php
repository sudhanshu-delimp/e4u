<?php

namespace App\Listeners;


use App\Models\AccountSetting;
use Illuminate\Auth\Events\Registered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

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
            if(isset($user['id']))
            {
                AccountSetting::create([
                    'user_id'  => $user['id'],
                    'password_updated_date' => date('Y-m-d H:i:s'),
                    'password_expiry_days'   => '30',
                    'is_text_notificaion_on' => '0',
                    'is_email_notificaion_on' => '0',
                ]);
            }    
           
        }

       
    }
}
