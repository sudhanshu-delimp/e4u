<?php

namespace App\Listeners;


use App\Models\AccountSetting;
use Illuminate\Auth\Events\Registered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateDefaultAccountSettings
{
    
    public function __construct()
    {
        //
    }

    public function handle(Registered $event)
    {
        $user = $event->user;
        AccountSetting::create([
            'user_id'  => $user->id,
            'password_updated_date' => date('Y-m-d H:i:s'),
            'password_expiry_days'   => '30',
            'is_text_notificaion_on' => '0',
            'is_email_notificaion_on' => '0',
        ]);
    }
}
