<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Escort;
use App\Models\EscortBrb;
use App\Models\Timezone;

class EscortBrbController extends Controller
{
    function add(Request $request)
    {
        $defaultTimezone = date_default_timezone_get();
        $timezoneId = "";
        $newBrb = new EscortBrb;
        $profileId =  $request->profile_id;
        $newBrb->profile_id = $profileId;
       
        $newBrb->brb_time = date('Y-m-d H:i:s', strtotime($request->brb_date . ' ' . $request->brb_time));
        $brbtime = date('d-m-Y h:i A', strtotime($request->brb_date . ' ' . $request->brb_time));
        /*$escort = Escort::select(['id', 'state_id', 'profile_name'])->where('id', $profileId)->first();
        if ($escort) {
            $stateId = $escort->state_id;
            $timezonert = Timezone::select(['id', 'state_id', 'timezone_id'])->where('state_id', $stateId)->first();
            if ($timezonert) {
                $timezoneId = $timezonert->timezone_id;
                $dt = Carbon::parse($newBrb->brb_time ); // or 'Australia/Brisbane', etc.
                $calcuttaTime = $dt->setTimezone($timezoneId);
                $newBrb->brb_time = $calcuttaTime;
            }
        }*/
        $newBrb->date_set = date('Y-m-d');

        $newBrb->brb_note = $request->brb_note;
        if ($newBrb->save()) {
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


    function inactive($id)
    {
        $newBrb = new EscortBrb;
        $newBrb = $newBrb::find($id);
        $newBrb->active = 'N';
        if ($newBrb->save()) {
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
