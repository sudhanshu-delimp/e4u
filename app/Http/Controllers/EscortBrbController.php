<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\EscortBrb;
use App\Models\SuspendProfile;

class EscortBrbController extends Controller
{
    function add(Request $request) {
        try{
            $isProfileSuspended  = SuspendProfile::where('escort_profile_id',$request->profile_id)->where('status',true)->orderBy('id', 'desc')->first();
            if($isProfileSuspended != null){
                # get date and convert into perth timezone for comparing timezone
                $suspendedEndDate = Carbon::parse($isProfileSuspended->end_date, config('app.escort_server_timezone'));
                $suspendedStartDate = Carbon::parse($isProfileSuspended->start_date, config('app.escort_server_timezone'));

                if(Carbon::now(config('app.escort_server_timezone')) >= $suspendedStartDate && Carbon::now(config('app.escort_server_timezone')) <= $suspendedEndDate){
                    $response = [
                        'success' => false,
                        'brbtime' => '',
                        'message' => "Profile is suspended, You can't add brb."
                    ];
                    return response()->json(compact('response'));
                }
            }

            $newBrb = new EscortBrb;
            $newBrb->profile_id = $request->profile_id;
            $newBrb->date_set = date('Y-m-d');

            $brbtime = date('d-m-Y h:i A', strtotime($request->brb_date));
            $newBrb->brb_note = $request->brb_note;
            $escortDetail = getEscortDetail($request->profile_id);
            $profileTimezone = config("escorts.profile.states.$escortDetail[state_id].cities.$escortDetail[city_id].timeZone");

            $localDateTime = Carbon::createFromFormat('Y-m-d h:i a', "$request->brb_date", $profileTimezone);
            $expiresAtUtc = $localDateTime->copy()->setTimezone('UTC');

            $newBrb->selected_time = date('Y-m-d H:i', strtotime($request->brb_date));
            $newBrb->brb_time = $expiresAtUtc;
            if($newBrb->save()) {
            // $response = [
            //     'success' => true,
            //     'brbtime' => $brbtime,
            //     'message' => 'BRB has been added to your Profile.'
            // ];
            return response()->json([
                'success' => true,
                'brbtime' => $brbtime,
                'message' => 'BRB has been added to your Profile.',
            ]);
            } else {
            // $response = [
            //     'success' => false,
            //     'brbtime' => '',
            //     'message' => 'BRB add failed'
            // ];
            return response()->json([
                'success' => false,
                'message' => 'BRB add failed'
            ], 422);
            }
       }
       catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
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
