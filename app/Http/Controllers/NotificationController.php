<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\NotificationRequest;
use Illuminate\Validation\ValidationException;

class NotificationController extends Controller
{
    
    protected $notification;
    public function __construct()
    {
        $this->notification = new Notification;
    }


    public function sendNotification(NotificationRequest $request)
    {
      try 
        {
            $data = $request->all();
            $sendNotification = $this->notification->sendNotification($data);

            $response = $sendNotification
                ? ['success' => true, 'message' => 'Notification Sent Successfully']
                : ['success' => false, 'message' => 'Error Occurred while Sending Notification'];
            return response()->json($response);

        } 
        catch (ValidationException $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation Error',
                    'errors' => $e->errors()
                ], 422);
            }
    }



    public function getNotification(Request $request)
    {

        if (Auth::check()) 
        {
                $userId = Auth::id();
                $alert_notifications = [];
                $support_notifications = [];
                $notifications = $this->notification->where([
                    'to_user' => $userId,
                    'is_seen' => '0',
                ])->latest()->take(5)->get();

               if ($notifications->isNotEmpty()) 
                {

                    foreach($notifications as $notification)
                    {
                        if($notification->notification_listing_type=='1')
                        {
                            $support_notifications['data'][] = $notification;
                            if($notification->is_seen=='0')
                            $support_notifications['is_new'] = 1;

                        }
                        

                        if($notification->notification_listing_type=='2')
                        {
                        $alert_notifications['data'][] = $notification;
                        if($notification->is_seen=='0')
                        $alert_notifications['is_new'] = 1;
                        }
                    }
    
               }

                return response()->json([
                    'success' => true, 
                    'support_notifications' => $support_notifications, 
                    'alert_notifications' => $alert_notifications, 
                    'message' => 'Notification List'
                ]);
        } 
                
        else 
        {
          return response()->json(['success' => false, 'message' => '']); 
        }
    }



     public function makeNotificationSeen(Request $request)
     {
        if(isset($request->notification_id) && $request->notification_id !='')
        {
           $this->notification->where([
                    'id' => $request->notification_id,
                ])->update(['is_seen' => '1']);
          return response()->json(['success' => true, 'message' => 'updated']);      
        }
        else
        {
            return response()->json(['success' => false, 'message' => 'not updated']);    
        }
    }

}
