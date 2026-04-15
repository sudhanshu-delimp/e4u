<?php

namespace App\Http\Controllers\Center\Profile;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\MassageBrb;
use App\Models\MassageSuspendProfile;
use App\Services\WalletService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MassageProfileActionController extends BaseController
{

    protected $walletService;


    public function __construct(WalletService $walletService)
    {
        $this->walletService = $walletService;
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
        $escortDetail = getEscortDetail($request->profile_id);
        $profileTimezone = config("escorts.profile.states.$escortDetail[state_id].cities.$escortDetail[city_id].timeZone");

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
            $refund = getMassageSuspendRefundAmount($massageProfile, $startDate, $endDate);
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

}
