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

        # get timezone of escort
        $escortTimezone = config('app.escort_server_timezone');
        if($escortProfile && $escortProfile->state_id && $escortProfile->city_id){
            $escortTimezone = config('escorts.profile.states')[$escortProfile->state_id]['cities'][$escortProfile->city_id]['timeZone'];
        }

        $startDate = isset($escortProfile->purchase[0]->start_date) 
            ? Carbon::parse($escortProfile->purchase[0]->start_date, $escortTimezone) 
            : Carbon::now($escortTimezone);

        $endDate = isset($escortProfile->purchase[0]->end_date) 
            ? Carbon::parse($escortProfile->purchase[0]->end_date, $escortTimezone) 
            : Carbon::now($escortTimezone);

        

        $requestStartDate = Carbon::parse($request->start_date, $escortTimezone);
        $requestEndDate = Carbon::parse($request->end_date, $escortTimezone);

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

        if($existSuspendedDate && !($requestStartDate > Carbon::parse($existSuspendedDate->end_date, $escortTimezone) && $requestEndDate > Carbon::parse($existSuspendedDate->end_date, $escortTimezone))){
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

        # Store suspend profile details
        $suspendProfile = SuspendProfile::create(
            [
                'escort_profile_id' => $request->suspend_profile_id,
                'user_id'=> auth()->user()->id,
                'start_date' => Carbon::parse($request->start_date)
                    ->startOfDay()
                    ->setTimezone(config('app.timezone')),
                'end_date' => Carbon::parse($request->end_date)
                  ->endOfDay()
                  ->setTimezone(config('app.timezone')),
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
