<?php

namespace App\Http\Controllers\Center\Profile;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\MassageBrb;
use App\Models\MassageBumpup;
use App\Models\MassageProfile;
use App\Models\MassagePurchase;
use App\Models\MassageSuspendProfile;
use App\Services\WalletService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MassageProfileActionController extends BaseController
{

    protected $walletService;
    protected $account;

    public function __construct(WalletService $walletService)
    {
        $this->walletService = $walletService;
        $this->middleware(function ($request, $next) {
            $this->account = auth()->user();
            return $next($request);
        });
    }



    ################## Add Brb ###########################
    public function add(Request $request)
    {

        # If profile is suspended then brb can't add note : date store during suspended profile in utc timezone
        $isProfileSuspended  = MassageSuspendProfile::where('massage_profile_id', $request->profile_id)->where('status', true)->orderBy('id', 'desc')->first();
        if ($isProfileSuspended != null) {
            # get date and convert into perth timezone for comparing timezone
            $suspendedEndDate = Carbon::parse($isProfileSuspended->end_date, config('app.escort_server_timezone'));
            $suspendedStartDate = Carbon::parse($isProfileSuspended->start_date, config('app.escort_server_timezone'));

            if (Carbon::now(config('app.escort_server_timezone')) >= $suspendedStartDate && Carbon::now(config('app.escort_server_timezone')) <= $suspendedEndDate) {
                $response = [
                    'success' => false,
                    'brbtime' => '',
                    'message' => "Profile is suspended, You can't add to closed."
                ];

                return response()->json(compact('response'));
            }
        }

        $newBrb = new MassageBrb;
        $newBrb->profile_id = $request->profile_id;
        $newBrb->date_set = date('Y-m-d');

        $brbtime = date('d-m-Y h:i A', strtotime($request->brb_date . ' ' . $request->brb_time));
        $newBrb->brb_note = $request->brb_note;

         $home_state = auth()->user()->state_id;
         $profileTimezone = config("escorts.profile.states.$home_state.timeZone");
        
        // $escortDetail = getEscortDetail($request->profile_id);
        // $profileTimezone = config("escorts.profile.states.$escortDetail[state_id].cities.$escortDetail[city_id].timeZone");

        $localDateTime = Carbon::createFromFormat('Y-m-d H:i', "$request->brb_date $request->brb_time", $profileTimezone);
        $expiresAtUtc = $localDateTime->copy()->setTimezone('UTC');

        $newBrb->selected_time = date('Y-m-d H:i', strtotime($request->brb_date . ' ' . $request->brb_time));
        $newBrb->brb_time = $expiresAtUtc;
        if ($newBrb->save()) {
            $response = [
                'success' => true,
                'brbtime' => $brbtime,
                'message' => 'Closed has been added to your Profile.'
            ];
        } else {
            $response = [
                'success' => false,
                'brbtime' => '',
                'message' => 'Closed add failed'
            ];
        }
        return response()->json(compact('response'));
    }
    ################## End Add Brb ########################


    ################## Suspend Profile #####################
    public function suspendProfileCredit(Request $request)
    {
        try {
            $profileId = $request->profile_id;
            $massageProfile = getMassageDetail($profileId);

            $startDate = $request->start_date;
            $endDate = $request->end_date;
            $refund = getMassageSuspendRefundAmount($profileId, $startDate, $endDate);
            $existSuspendedDate = $massageProfile->suspendProfile()->overlapping($startDate, $endDate)->exists();
            if ($existSuspendedDate) {
                return response()->json([
                    'success' => false,
                    'message' => "This date range overlaps with an already suspended period for this listing.",
                ]);
            } else {
                return response()->json([
                    'success' => true,
                    'refund_amount' => $refund,
                ]);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred. Please try again.', 'error' => $e->getMessage()], 500);
        }
    }

    function suspendProfile(Request $request)
    {
        $user = auth()->user();
        $massageProfile = getMassageDetail($request->suspend_profile_id);
        $escortTimezone = $massageProfile->time_zone;
        $requestStartDate = Carbon::parse($request->start_date)->startOfDay();
        $requestEndDate = Carbon::parse($request->end_date)->endOfDay();

        # If suspended periods already exists then add future date
        $existSuspendedDate = $massageProfile->suspendProfile()->overlapping($request->start_date, $request->end_date)->exists();

        if ($existSuspendedDate) {
            return response()->json([
                'success' => false,
                'message' => "This date range overlaps with an already suspended period for this listing.",
            ]);
        }

        # calculate credit
        $refundAmount = getMassageSuspendRefundAmount($massageProfile, $request->start_date, $request->end_date);

        $utcStart = Carbon::createFromFormat('Y-m-d H:i:s', $requestStartDate, $escortTimezone)->setTimezone('UTC');
        $utcEnd = Carbon::createFromFormat('Y-m-d H:i:s', $requestEndDate, $escortTimezone)->setTimezone('UTC');


        # Store suspend profile details
        $suspendProfile = MassageSuspendProfile::create(
            [
                'massage_profile_id' => $request->suspend_profile_id,
                'user_id' => $user->id,
                'start_date' => Carbon::parse($request->start_date),
                'utc_start_date' => $utcStart,
                'end_date' => Carbon::parse($request->end_date),
                'utc_end_date' => $utcEnd,
                'credit' => $refundAmount,
                'note' => null,
            ]
        );

        if ($suspendProfile) {
            $this->walletService->credit(
                $user,
                $refundAmount,
                $suspendProfile,
                'Suspend Profile.',
                [
                    'user_id' => $user->id,
                    'massage_profile_id' => $request->suspend_profile_id,
                    'start_date' => $requestStartDate,
                    'end_date' => $requestEndDate,
                ]
            );

            $response = [
                'success' => true,
                'suspend' => $suspendProfile,
                'message' => 'Profile ID ' . $request->suspend_profile_id . ' has been suspended for ' . (Carbon::parse($requestStartDate)->diffInDays(Carbon::parse($requestEndDate)) + 1) . ' days.',
                'suspended_at' => Carbon::parse($suspendProfile->created_at)->setTimezone($escortTimezone)->format('d-m-Y h:i A'),
                'profile_id' => $request->suspend_profile_id,
            ];
        } else {
            $response = [
                'success' => false,
                'suspend' => '',
                'message' => 'Profile not suspended!',
                'suspended_at' => '',
                'profile_id' => '',
            ];
        }

        return response()->json(compact('response'));
    }
    ################## End Suspend Profile ##################



    public function validateDateRange(Request $request)
    {
        try {
            $response['success'] = false;
            $startDate = $request->startDate;
            $endDate = $request->endDate;
            $profile_Id = $request->profile_Id;
            $massage = getMassageDetail($profile_Id);

            $conflictExists = MassagePurchase::overlapping($startDate, $endDate)
                ->whereHas('massageprofile', function ($q) use ($massage) {
                    $q->where('user_id', auth()->user()->id);
                    $q->where('state_id', '<>', $massage->state_id);
                })
                ->with('massageprofile:id,state_id')
                ->orderByDesc('end_date')
                ->first()?->massage?->state?->name;

            if ($conflictExists) {
                $response['success'] = true;
                $response['message'] = "You have a Current or Upcomming Listing in {$conflictExists}. To create multiple Listings across Locations, use the Tour creator.";
            }

            return response()->json($response);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }


    
    public function getTransactionSummury(Request $request)
    {   

        $profile_id = isset($request->profile_id) ? $request->profile_id : ""; 
        $membership = isset($request->membership) ? $request->membership : ""; 
        $start_date = isset($request->start_date) ? $request->start_date : ""; 
        $end_date = isset($request->end_date) ? $request->end_date : ""; 
        $loginAccount = $this->account;
        $massage = MassageProfile::where('id', $profile_id)->first();
        $resposne_data = [];
      
        if($profile_id && $membership && $start_date && $end_date )
        {
            if(!empty(($start_date)))
            $daysDiff = Carbon::parse($end_date)->diffInDays(Carbon::parse($start_date))+1;
            list($discount, $rate) = calculateTotalFee($membership, $daysDiff, $loginAccount);
            $fullFee = $rate + $discount;
            //$totalAmount = $rate;
            $resposne_data = 
            [
                'profile_id' => $profile_id,
                'listing' =>    1,
                'business_name' => ($massage->business_name) ? $massage->business_name : "",
                'start_date' => date('d-m-Y',strtotime($start_date)),
                'end_date'   => date('d-m-Y',strtotime($end_date)),
                'days' => $daysDiff,
                'membership' => $membership,
                'rate' => number_format($discount > 0 ? ($fullFee / $daysDiff) : ($rate / $daysDiff), 2),
                'full_fee' => number_format($fullFee, 2),
                'discount' => number_format($discount, 2),
                'discount_fee' =>  number_format($rate, 2),
            ];


            $response['success'] = true;
            $response['data'] = $resposne_data;

        }
        else
        {
            $response['success'] = false;
            $response['data'] = [];
        }

        return $response;
         
    }



    public function bumpup_register(Request $request)
    {
        try 
        {
        
                $home_state = auth()->user()->state_id;
                $profileTimezone = config("escorts.profile.states.$home_state.timeZone");

                $nowLocal = Carbon::now($profileTimezone);
                $localStart = $nowLocal->copy();
                $localEnd   = $nowLocal->copy()->addHours(24);
                $utcStart = $localStart->copy()->setTimezone('UTC');
                $utcEnd = $localEnd->copy()->setTimezone('UTC');


                $isSuspended = MassageSuspendProfile::where('massage_profile_id', $request->massage_id)
                        ->where('user_id', auth()->user()->id)
                        ->where('utc_start_date', '<=', now('UTC'))
                        ->where('utc_end_date', '>=', now('UTC'))
                        ->exists();

                    if ($isSuspended) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Profile ID ' . $request->massage_id . ' is currently suspended. You cannot Bump Up this Profile.'
                        ], 422);
                    }


                $checkout_number = md5(time());
                $purchase = [
                'checkout_number'  => $checkout_number,
                'user_id' => auth()->id(),
                'massage_id' => $request->massage_id,
                'start_date' => $localStart->format('Y-m-d'),
                'end_date' => $localEnd->format('Y-m-d'),
                'utc_start_time' => $utcStart,
                'utc_end_time' => $utcEnd,
                ];

                session()->forget('MassagePurchase');
                session(['MassagePurchase' => $purchase]);
                $checkout_data['checkout_number'] = $purchase['checkout_number'];
                $checkout_data['start_date'] = $purchase['start_date'];
                $checkout_data['end_date'] = $purchase['end_date'];

                // MassageBumpup::create([
                //     'user_id' => auth()->id(),
                //     'massage_id' => $request->massage_id,
                //     'start_date' => $localStart->format('Y-m-d'),
                //     'end_date' => $localEnd->format('Y-m-d'),
                //     'utc_start_time' => $utcStart,
                //     'utc_end_time' => $utcEnd,
                // ]);

                return response()->json([
                    'data' => $checkout_data,
                    'success' => true,
                    'message' => 'Validated successfully.'
                ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while Bumping Up Profile.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }    

}
