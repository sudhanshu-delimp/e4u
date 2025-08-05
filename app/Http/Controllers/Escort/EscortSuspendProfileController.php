<?php

namespace App\Http\Controllers\Escort;

use App\Http\Controllers\Controller;
use App\Models\Escort;
use App\Models\Purchase;
use App\Models\SuspendProfile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'total_dis' => number_format((float)$total_dis, 2, '.', ''),
            'total_rate' => number_format((float)$total_rate, 2, '.', ''),
        ]);
    }

    function suspendProfile(Request $request) 
    {
        # retrieved profile listed date range and note - user can't suspend thier profile beyond listed date range 
        $escortProfile = Escort::where(['enabled' => 1, 'id' => $request->suspend_profile_id])->with(['purchase'=>function($query){
            $query->where('utc_end_time' ,'>=', Carbon::now(config('app.timezone')))->first();
        }])->first();

        if(!$escortProfile){
            $response = [
                'success' => false,
                'suspend' => '',
                'message' => 'Escort profile not found!'
            ];
        }

        # get timezone of escort
        $escortTimezone = config('app.escort_server_timezone');
        if($escortProfile && $escortProfile->state_id && $escortProfile->city_id){
            $escortTimezone = config('escorts.profile.states')[$escortProfile->state_id]['cities'][$escortProfile->city_id]['timeZone'];
        }

        # get purchase start date because we we want escort can't suspend their profile beyond start date
        $startDate = isset($escortProfile->purchase[0]->start_date) 
            ? Carbon::parse($escortProfile->purchase[0]->start_date)->startOfDay() 
            : Carbon::now($escortTimezone)->startOfDay();

        # get purchase end date because we we want escort can't suspend their profile beyond end date
        $endDate = isset($escortProfile->purchase[0]->end_date) 
            ? Carbon::parse($escortProfile->purchase[0]->end_date)->endOfDay() 
            : Carbon::now($escortTimezone)->endOfDay();
            
        // $startDate = isset($escortProfile->purchase[0]->start_date) 
        //     ? Carbon::parse($escortProfile->purchase[0]->start_date, $escortTimezone) 
        //     : Carbon::now($escortTimezone);

        // $endDate = isset($escortProfile->purchase[0]->end_date) 
        //     ? Carbon::parse($escortProfile->purchase[0]->end_date, $escortTimezone) 
        //     : Carbon::now($escortTimezone);

        

        $requestStartDate = Carbon::parse($request->start_date)->startOfDay();
        $requestEndDate = Carbon::parse($request->end_date)->endOfDay();

        # Compare timezone
        if (!($requestStartDate->greaterThanOrEqualTo($startDate) && $requestEndDate->lessThanOrEqualTo($endDate))) {
            $response = [
                'success' => false,
                'suspend' => '',
                'message' => 'Please select date range between your listed periods '.$startDate->format('d-m-Y'). ' to '.$endDate->format('d-m-Y'),
            ];
            return response()->json(compact('response'));
        }

        # If suspended periods already exists then add future date
        $existSuspendedDate = SuspendProfile::where('escort_profile_id', $request->suspend_profile_id)->where('status', true)->orderBy('end_date','desc')->first();

        if($existSuspendedDate && !($requestStartDate > Carbon::parse($existSuspendedDate->end_date)->endOfDay() && $requestEndDate > Carbon::parse($existSuspendedDate->end_date)->endOfDay())){
            $response = [
                'success' => false,
                'suspend' => '',
                'message' => 'You have already suspended this profile in past. please select future date after '.Carbon::parse(($existSuspendedDate->end_date), $escortTimezone)->format('d-m-Y'),
            ];
            return response()->json(compact('response'));
        }

        # calculate credit
        $planId = $request->hiddenSuspendPlanId;
        $diffDays = $request->diffDays;

        [$total_dis, $credit] = calculateFee($planId, $diffDays);

        $utcStart = Carbon::createFromFormat('Y-m-d H:i:s', $requestStartDate, $escortTimezone)->setTimezone('UTC');
        $utcEnd = Carbon::createFromFormat('Y-m-d H:i:s', $requestEndDate, $escortTimezone)->setTimezone('UTC');


        # Store suspend profile details
        $suspendProfile = SuspendProfile::create(
            [
                'escort_profile_id' => $request->suspend_profile_id,
                'user_id'=> auth()->user()->id,
                'start_date' => Carbon::parse($request->start_date),
                'utc_start_date' => $utcStart,
                'end_date' => Carbon::parse($request->end_date),
                'utc_end_date' => $utcEnd,
                'credit' => $credit,
                'note' => null,
            ]
        );

        if($suspendProfile) {
            $response = [
                'success' => true,
                'suspend' => $suspendProfile,
                'message' => 'Profile ID '.$request->suspend_profile_id.' has been suspended for '.$diffDays. ' days.',
                'suspended_at' => Carbon::parse($suspendProfile->created_at)->setTimezone($escortTimezone)->format('d-m-Y h:i A'),
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
