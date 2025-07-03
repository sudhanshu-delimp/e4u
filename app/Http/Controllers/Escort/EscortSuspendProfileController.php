<?php

namespace App\Http\Controllers\Escort;

use App\Http\Controllers\Controller;
use App\Models\Escort;
use App\Models\SuspendProfile;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EscortSuspendProfileController extends Controller
{
    public function suspendProfileCredit(Request $request)
    {
        
         // Get the inputs from the request
        $planId = $request->input('plan_id');
        $diffDays = $request->input('days');

        //dd($request->all(),$planId, $diffDays);

        // Validate input (optional but recommended)
        if (!$planId || !$diffDays) {
            return response()->json(['error' => 'Select profile first.'], 400);
        }

        // Call your function to calculate the fee
        [$total_dis, $total_rate] = calculateFee($planId, $diffDays);

        // Return the result
        return response()->json([
            'total_dis' => $total_dis,
            'total_rate' => $total_rate,
        ]);
    }

    function suspendProfile(Request $request) 
    {
        dd($request->all());
            // "hiddenSuspendPlanId" => "3"
            // "suspend_profile_id" => "376"
            // "start_date" => "2025-07-04"
            // "end_date" => "2025-07-08"

        # retrieved profile listed date range and note - user can suspend thier profile within listed date range only
        $escortProfile = Escort::where(['enabled' => 1, 'id' => $request->suspend_profile_id])->first();

        if(!$escortProfile){
            $response = [
                'success' => false,
                'suspend' => '',
                'message' => 'Escort profile not found!'
            ];
        }

        $startDate = $escortProfile->start_date;
        $endDate = $escortProfile->end_date;

        if(!($request->start_date >= $startDate && $request->end_date <= $endDate) )
        {
            $response = [
                'success' => false,
                'suspend' => '',
                'message' => 'Please select correct date range!'
            ];

        }

        # calculate credit
        [$total_dis, $credit] = calculateFee($planId, $diffDays);

        # Store suspend profile details
        $suspendProfile = SuspendProfile::create([
            'escort_profile_id'=> $request->suspend_profile_id,
            'start_date'=> $request->start_date,
            'end_date'=> $request->end_date,
            'credit'=> $credit,
            'note'=> null,
        ]);

        if($suspendProfile) {
            $response = [
                'success' => true,
                'suspend' => $suspendProfile,
                'message' => 'Profile ID '.$request->profile_id.' has been suspended.'
            ];
        } else {
            $response = [
                'success' => false,
                'suspend' => '',
                'message' => 'Profile not suspended!'
            ];
        }

        return response()->json(compact('response'));

        //$suspendProfile = new EscortBrb;
        // $newBrb->profile_id = $request->profile_id;
        // $newBrb->date_set = date('Y-m-d');
        
        // $brbtime = date('d-m-Y h:i A', strtotime($request->brb_date.' '.$request->brb_time));
        // $newBrb->brb_note = $request->brb_note;
        // $escortDetail = getEscortDetail($request->profile_id);
        // $profileTimezone = config("escorts.profile.states.$escortDetail[state_id].cities.$escortDetail[city_id].timeZone");
        
        // $localDateTime = Carbon::createFromFormat('Y-m-d H:i', "$request->brb_date $request->brb_time", $profileTimezone);
        // $expiresAtUtc = $localDateTime->copy()->setTimezone('UTC');
        
        // $newBrb->selected_time = date('Y-m-d H:i', strtotime($request->brb_date.' '.$request->brb_time));
        // $newBrb->brb_time = $expiresAtUtc;

        

        // $response = [
        //     'success' => false,
        //     'suspendedProfile' => '',
        //     'message' => 'Profile ID '.$request->profile_id.' has been suspended'
        // ];

        
    }
}
