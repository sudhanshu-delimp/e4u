<?php

namespace App\Http\Controllers\Escort;

use App\Http\Controllers\Controller;
use App\Models\EscortViewerInteractions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EscortViewerInteractionController extends Controller
{
    public function escortUpdateViewerInteraction(Request $request)
    {
        $userid = Auth::user()->id;
        $isExistAction = EscortViewerInteractions::where('viewer_id',$request->viewer_id)->where('user_id',$userid )->first();

        if($isExistAction){

            $escort_disabled_contact = $isExistAction->escort_disabled_contact;
            $escort_disabled_notification = $isExistAction->escort_disabled_notification;
            $is_blocked = $isExistAction->escort_blocked_viewer ?? false;

            if(isset($request->escort_disabled_contact)){
                $escort_disabled_contact = false;
                if($request->escort_disabled_contact == 'disable'){
                    $escort_disabled_contact = true;
                }
            }

            if(isset($request->escort_disabled_notification)){
                $escort_disabled_notification = false;
                if($request->escort_disabled_notification == 'disable'){
                    $escort_disabled_notification = true;
                }
                
            }

            if(isset($request->is_blocked)){
                if($request->is_blocked == true){
                    $is_blocked = true;
                }

                if($request->is_blocked == false){
                    $is_blocked = false;
                }
            }

            $result  = EscortViewerInteractions::where('viewer_id',$request->viewer_id)
            ->where('user_id',$userid )
            ->update([
                'escort_id' => null,
                'escort_disabled_contact' => $escort_disabled_contact,
                'escort_disabled_notification' => $escort_disabled_notification ,
                'escort_blocked_viewer' => $is_blocked,
            ]);

        }else{

            $result  = EscortViewerInteractions::create([
                'user_id' => $userid,
                'escort_id' => null,
                'viewer_id' => $request->viewer_id,
                'action_by' => 'member',
                'escort_disabled_contact' => isset($request->escort_disabled_contact) && $request->escort_disabled_contact == 'enable' ? true : false ,
                'escort_disabled_notification' => isset($request->escort_disabled_notification) && $request->escort_disabled_notification == 'disable' ? true : false ,
                'escort_blocked_viewer' => isset($request->is_blocked) && $request->is_blocked ? true : false ,
            ]);
        }

        $data = array(
            "status"     => 200,
            "message"    => $request->message,
            "type"    => $request->type,
            "data" => $result,
            "previous_status" => $request->current_status,
        );

        return response()->json($data);

    }
}
