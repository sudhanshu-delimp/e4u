<?php

namespace App\Http\Controllers\Escort;

use App\Http\Controllers\Controller;
use App\Models\Escort;
use App\Models\Purchase;
use App\Models\SuspendProfile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\WalletService;
use App\Mail\Escort\Listing\SuspendMailer;
use Illuminate\Support\Facades\Mail;

class EscortSuspendProfileController extends Controller
{
    protected $account;
    protected $walletService;

    public function __construct(WalletService $walletService)
    {
        $this->walletService = $walletService;
        $this->middleware(function ($request, $next) {
            $this->account = auth()->user();
            return $next($request);
        });
    }

    public function suspendProfileCredit(Request $request)
    {
        try {
            $profileId = $request->profile_id;
            $escortProfile = getEscortDetail($profileId);
            $startDate = $request->start_date;
            $endDate = $request->end_date;
            $refund = getSuspendRefundAmount($escortProfile, $startDate, $endDate);
            $existSuspendedDate = $escortProfile->mainPurchase
                ->suspendProfile()
                ->overlapping($startDate, $endDate)
                ->exists();

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
        $escortProfile = getEscortDetail($request->suspend_profile_id);
        $escortTimezone = $escortProfile->time_zone;
        $requestStartDate = Carbon::parse($request->start_date)->startOfDay();
        $requestEndDate = Carbon::parse($request->end_date)->endOfDay();

        # If suspended periods already exists then add future date
        $existSuspendedDate = $escortProfile->suspendProfile()->overlapping($request->start_date, $request->end_date)->exists();

        if ($existSuspendedDate) {
            return response()->json([
                'success' => false,
                'message' => "This date range overlaps with an already suspended period for this listing.",
            ]);
        }

        # calculate credit
        $refundAmount = getSuspendRefundAmount($escortProfile, $request->start_date, $request->end_date);

        $utcStart = Carbon::createFromFormat('Y-m-d H:i:s', $requestStartDate, $escortTimezone)->setTimezone('UTC');
        $utcEnd = Carbon::createFromFormat('Y-m-d H:i:s', $requestEndDate, $escortTimezone)->setTimezone('UTC');


        # Store suspend profile details
        $suspendProfile = SuspendProfile::create(
            [
                'purchase_id' => $escortProfile->purchase_id,
                'escort_profile_id' => $request->suspend_profile_id,
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
                    'escort_id' => $request->suspend_profile_id,
                    'start_date' => $requestStartDate,
                    'end_date' => $requestEndDate,
                ]
            );
            /* Send Suspend Mail */
            Mail::to($this->account->email)->send(new SuspendMailer(compact('suspendProfile')));
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
}
