<?php

namespace App\Http\Controllers\Escort;

use App\Http\Controllers\Controller;
use App\Models\Escort;
use App\Models\Purchase;
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
        # retrieved profile listed date range and note - user can suspend thier profile within listed date range only
        $escortProfile = Escort::where(['enabled' => 1, 'id' => $request->suspend_profile_id])->with(['purchase'=>function($query){
            $query->where('end_date' ,'>=', Carbon::now(config('app.timezone')))->first();
        }])->first();

        if(!$escortProfile){
            $response = [
                'success' => false,
                'suspend' => '',
                'message' => 'Escort profile not found!'
            ];
        }

        $startDate = isset($escortProfile->purchase[0]->start_date) 
            ? Carbon::parse($escortProfile->purchase[0]->start_date, config('app.escort_server_timezone')) 
            : Carbon::now(config('app.escort_server_timezone'));

        $endDate = isset($escortProfile->purchase[0]->end_date) 
            ? Carbon::parse($escortProfile->purchase[0]->end_date, config('app.escort_server_timezone')) 
            : Carbon::now(config('app.escort_server_timezone'));

        

        $requestStartDate = Carbon::parse($request->start_date, config('app.escort_server_timezone'));
        $requestEndDate = Carbon::parse($request->end_date, config('app.escort_server_timezone'));

        if (!($requestStartDate->greaterThanOrEqualTo($startDate) && $requestEndDate->lessThanOrEqualTo($endDate))) {
            $response = [
                'success' => false,
                'suspend' => '',
                'message' => 'Please select date range between your listed periods '.$startDate->format('d-m-Y'). ' to '.$endDate->format('d-m-Y'),
            ];
            return response()->json(compact('response'));
        }

        # If suspended periods already exists then add future date
        $existSuspendedDate = SuspendProfile::where('escort_profile_id', $request->suspend_profile_id)->where('status', true)->orderBy('id','desc')->first();

        if($existSuspendedDate && !($requestStartDate > Carbon::parse($existSuspendedDate->end_date,config('app.escort_server_timezone')) && $requestEndDate > Carbon::parse($existSuspendedDate->end_date,config('app.escort_server_timezone')))){
            $response = [
                'success' => false,
                'suspend' => '',
                'message' => 'You have already suspended this profile in past. please select future date after '.Carbon::parse(($existSuspendedDate->end_date),config('app.escort_server_timezone'))->format('d-m-Y'),
            ];
            return response()->json(compact('response'));
        }

        # calculate credit
        $planId = $request->hiddenSuspendPlanId;
        $diffDays = $request->diffDays;

        [$total_dis, $credit] = calculateFee($planId, $diffDays);

        # Store suspend profile details
        $suspendProfile = SuspendProfile::create(
            [
                'escort_profile_id' => $request->suspend_profile_id,
                'user_id'=> auth()->user()->id,
                'start_date' => Carbon::parse($request->start_date, config('app.timezone')),
                'end_date' => Carbon::parse($request->end_date, config('app.timezone')),
                'credit' => $credit,
                'note' => null,
            ]
        );

        if($suspendProfile) {
            $response = [
                'success' => true,
                'suspend' => $suspendProfile,
                'message' => 'Profile ID '.$request->suspend_profile_id.' has been suspended for '.$diffDays. ' days.',
                'suspended_at' => Carbon::parse($suspendProfile->created_at)->setTimezone(config('app.escort_server_timezone'))->format('d-m-Y h:i A'),
                'profile_id'=>$request->suspend_profile_id,
            ];
        } else {
            $response = [
                'success' => false,
                'suspend' => '',
                'message' => 'Profile not suspended!',
                'suspended_at' => '',
                'profile_id'=>'',
            ];
        }

        return response()->json(compact('response'));
    }
}
