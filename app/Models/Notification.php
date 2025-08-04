<?php

namespace App\Models;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;

    protected $table = "notification";

    public function sendNotification($data)
    {

        try 
        {
            if(!empty($data))
            {   
                if((!empty($data['to_user'])) && isset($data['notification_type']) && $data['notification_type']!="")
                {
                    $notification_type = $data['notification_type'];
                    $title =  isset($data['title']) ? $data['title'] : '';
                    $message =  isset($data['message']) ? $data['message'] : '';
                    $notification_icon = $this->notificationIcon($notification_type);
                    $notification_listing_type = isset($data['notification_listing_type']) ? $data['notification_listing_type'] : '2';

                        $send_notification = [];
                        $send_to = array_unique($data['to_user']);
                        foreach ($send_to as $userId) 
                        {
                            $send_notification[] = [
                                'title' => $title,
                                'message' => $message,
                                'to_user' => $userId,
                                'notification_icon' => $notification_icon,
                                'notification_listing_type' => $notification_listing_type,
                                'notification_type' => $notification_type,
                                'is_seen' => '0',
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s')
                
                            ];

                        }

                        Notification::insert($send_notification);
                        return true;
                  }
            }
         } 
        catch (Exception $e) {
             Log::info($e->getMessage());
             return false;
        }
       
    }



    public function notificationIcon($notification_type)
    {
        $icon  = config('constants.NotificationIcon.general');

        if($notification_type=='general')
            $icon = config('constants.NotificationIcon.general');

        if($notification_type=='agent_accept')
            $icon = config('constants.NotificationIcon.agent_accept');

        if($notification_type=='agent_follow_up')
           $icon = config('constants.NotificationIcon.agent_follow_up');

        return $icon;
        
    }
}
    


