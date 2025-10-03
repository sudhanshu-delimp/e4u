<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BaseController;
use App\Models\EscortViewerInteractions;
use App\Http\Requests\NotificationRequest;
use Illuminate\Validation\ValidationException;

class NotificationController extends BaseController
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




    public function legbox_notification_list()
    {
        list($result, $count) = $this->legbox_notification_pagination(
            request()->get('start'),
            request()->get('length'),
            (request()->get('order')[0]['column']),
            request()->get('order')[0]['dir']
        );
        $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $result
        );

        return response()->json($data);
    }


    public function legbox_notification_pagination($start, $limit, $order_key, $dir)
    {

    
            $listing = Notification::with(['from_user_data' => function($query) {
                $query->select('id', 'state_id', 'member_id', 'name') 
                      ->with('state'); 
            }])
            ->where('to_user', auth()->user()->id)
            ->where('notification_type', 'legbox_notification');


            $listing = Notification::select('notifications.*')
                ->join(
                    DB::raw('(SELECT MAX(id) as id FROM notifications 
                            WHERE to_user = '.auth()->id().' 
                            AND notification_type = "legbox_notification" 
                            GROUP BY from_user) as latest'),
                    'notifications.id',
                    '=',
                    'latest.id'
                )
                ->with(['from_user_data' => function($query) {
                    $query->select('id', 'state_id', 'member_id', 'name')
                        ->with('state');
                }]);


        $search = request()->input('search.value');
        if (!empty($search)) {
                $listing->whereHas('from_user_data', function ($query) use ($search) {
                    $query->where('member_id', 'like', "%{$search}%");
                });
        }   

        $total_listing = $listing->count();
        $listings = $listing->offset($start)->limit($limit)->orderByDesc('notifications.id')->get();

        $i = 1;
                //dd($agents);
        foreach($listings as $key => $item) {

            $item->user_member_id = isset($item->from_user_data->member_id) ? $item->from_user_data->member_id : 'NA';
            $item->user_name = isset($item->from_user_data->name) ? $item->from_user_data->name: 'NA';
            $item->user_message = isset($item->title) ? $item->title : 'NA';
            $dropdown = '<div class="dropdown no-arrow ml-3">
                                             <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                             </a>
                                             <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                               <a class="dropdown-item notification-action d-flex justify-content-start gap-10 align-items-center" href="javascript:void(0)" data-action="enable" data-id='.$item->from_user_data->id.'>  <i class="fa fa-bell"></i> Enable</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center notification-action" href="javascript:void(0)"  data-action="disable" data-id='.$item->from_user_data->id.'  data-toggle="modal"> <i class="fa fa-bell-slash" aria-hidden="true"></i>
                                            Disable </a>
                                             </div>
                                          </div>';
            
            
            $item->action = $dropdown;
            $i++;
        }

        return [$listings, $total_listing];
    }

    public function enable_disable_legbox_notification(Request $request)
    {

        $escortViewerInteractions = EscortViewerInteractions::where('escort_id',$request->requestId)->first();
        if($escortViewerInteractions)
        {
            if($request->requestId=='enable')    
            $escortViewerInteractions->escort_disabled_notification='1';

             if($request->requestId=='disable')    
            $escortViewerInteractions->escort_disabled_notification='0';

            $escortViewerInteractions->save();
            return $this->successResponse('Updated Successfully'); 
        }
        else
        return $this->errorResponse('Error Occurred while  '.$request->message.' Setting');
    }

}
