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
            $result  = EscortViewerInteractions::where('viewer_id',$request->viewer_id)->where('user_id',$userid )->update([
                'escort_id' => null,
                'escort_disabled_contact' => isset($request->escort_disabled_contact) && $request->escort_disabled_contact == 'enable' ? true : false ,
                'escort_disabled_notification' => isset($request->escort_disabled_notification) && $request->escort_disabled_notification == 'enable' ? true : false ,
                'escort_blocked_viewer' => isset($request->is_blocked) && $request->is_blocked ? true : false ,
            ]);

        }else{

            $result  = EscortViewerInteractions::create([
                'user_id' => $userid,
                'escort_id' => null,
                'viewer_id' => $request->viewer_id,
                'action_by' => 'member',
                'escort_disabled_contact' => isset($request->escort_disabled_contact) && $request->escort_disabled_contact == 'enable' ? true : false ,
                'escort_disabled_notification' => isset($request->escort_disabled_notification) && $request->escort_disabled_notification == 'enable' ? true : false ,
                'escort_blocked_viewer' => isset($request->is_blocked) && $request->is_blocked ? true : false ,
            ]);
        }

        $data = array(
            "status"     => 200,
            "message"    => $request->message,
            "type"    => $request->type,
            "data" => $result,
        );

        return response()->json($data);

    }
}
