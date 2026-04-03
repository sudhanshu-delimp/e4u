<?php

namespace App\Http\Controllers\Center\Profile;

use App\Http\Controllers\Controller;
use App\Models\MassageBrb;
use App\Models\MassageSuspendProfile;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MassageProfileActionController extends BaseController
{
   

    public function add(Request $request) 
    {

        # If profile is suspended then brb can't add note : date store during suspended profile in utc timezone
        $isProfileSuspended  = MassageSuspendProfile::where('massage_profile_id',$request->profile_id)->where('status',true)->orderBy('id', 'desc')->first();
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

        $newBrb = new MassageBrb;
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


}
