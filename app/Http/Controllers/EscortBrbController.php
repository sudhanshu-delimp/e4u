<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\EscortBrb;

class EscortBrbController extends Controller
{
    function add(Request $request) {
        $newBrb = new EscortBrb;
        $newBrb->profile_id = $request->profile_id;
        $newBrb->date_set = date('Y-m-d');
        
        $brbtime = date('d-m-Y h:i A', strtotime($request->brb_date.' '.$request->brb_time));
        $newBrb->brb_note = $request->brb_note;
        $escortDetail = getEscortDetail($request->profile_id);
        $profileTimezone = config("escorts.profile.states.$escortDetail[state_id].cities.$escortDetail[city_id].timeZone");
        
        $localDateTime = Carbon::createFromFormat('Y-m-d H:i', "$request->brb_date $request->brb_time", $profileTimezone);
        $expiresAtUtc = $localDateTime->copy()->setTimezone('UTC');
        
        $newBrb->selected_time = date('Y-m-d H:i', strtotime($request->brb_date.' '.$request->brb_time));
        $newBrb->brb_time = $expiresAtUtc;
        if($newBrb->save()) {
            $response = [
                'success' => true,
                'brbtime' => $brbtime,
                'message' => 'BRB has been added to your Profile.'
            ];
        } else {
            $response = [
                'success' => false,
                'brbtime' => '',
                'message' => 'BRB add failed'
            ];
        }
        return response()->json(compact('response'));
    }

    function inactive($id) {
        $newBrb = new EscortBrb;
        $newBrb = $newBrb::find($id);
        $newBrb->active = 'N';
        if($newBrb->save()) {
            $response = [
                'success' => true,
                'message' => 'BRB disabled'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'BRB disable failed'
            ];
        }

        return response()->json(compact('response'));
    }
}
