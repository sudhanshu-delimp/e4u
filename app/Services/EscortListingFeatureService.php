<?php

namespace App\Services;

use Illuminate\Http\Request;

use App\Models\EscortPinup;
use App\Models\EscortBumpup;
use App\Models\TourLocation;
use App\Models\TourProfile;
use Illuminate\Support\Facades\DB;
use Exception;

use Carbon\Carbon;

class EscortListingFeatureService
{
    private function getValue(?Request $request, array $data, string $key, $default = null)
    {
        return $data[$key] ?? $request?->input($key, $default) ?? $default;
    }

    public function registerBumpUp(?Request $request = null, array $data = [])
    {
        $escortId = $this->getValue($request, $data, 'escort_id');

        $escortDetail = getEscortDetail($escortId);

        $profileTimezone = config("escorts.profile.states.$escortDetail->state_id.cities.$escortDetail->city_id.timeZone");

        $nowLocal = Carbon::now($profileTimezone);

        $localStart = $nowLocal->copy();
        $localEnd   = $nowLocal->copy()->addHours(24);

        $utcStart = $localStart->copy()->setTimezone('UTC');
        $utcEnd   = $localEnd->copy()->setTimezone('UTC');

        $escortBumpUp = EscortBumpup::create([
            'user_id'        => $escortDetail->user->id,
            'escort_id'      => $escortDetail->id,
            'start_date'     => $localStart->format('Y-m-d'),
            'end_date'       => $localEnd->format('Y-m-d'),
            'utc_start_time' => $utcStart,
            'utc_end_time'   => $utcEnd,
        ]);

        return $escortBumpUp;
    }

    public function registerPinUp(?Request $request = null, array $data = [])
    {
        $escortId = $this->getValue($request, $data, 'pinup_profile_id');
        $tour_location_id = $this->getValue($request, $data, 'tour_location_id');
        $pinup_week = $this->getValue($request, $data, 'pinup_week');
        $escortDetail = getEscortDetail($escortId);

        $profileTimezone = config("escorts.profile.states.$escortDetail->state_id.cities.$escortDetail->city_id.timeZone");

        [$startDate, $endDate] = explode('|', $pinup_week);

        $localStart = Carbon::createFromFormat(
            'Y-m-d',
            $startDate,
            $profileTimezone
        )->startOfDay();

        $localEnd = Carbon::createFromFormat(
            'Y-m-d',
            $endDate,
            $profileTimezone
        )->endOfDay();

        $utcStart = $localStart->copy()->setTimezone('UTC');
        $utcEnd = $localEnd->copy()->setTimezone('UTC');

        $escortPinUp = EscortPinup::create([
            'user_id' => $escortDetail->user->id,
            'escort_id' => $escortDetail->id,
            'state_id' => $escortDetail->state_id,
            'city_id' => $escortDetail->city_id,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'utc_start_time' => $utcStart,
            'utc_end_time' => $utcEnd,
        ]);


        if ($tour_location_id) {

            TourLocation::where('id', $tour_location_id)
                ->update([
                    'is_pinup' => '1'
                ]);

            TourProfile::where([
                'tour_location_id' => $tour_location_id,
                'escort_id' => $escortId
            ])->update([
                'is_pinup' => $escortPinUp->id
            ]);
        }

        return $escortPinUp;
    }

    public function upgradeMembership(?Request $request = null, array $data = [])
    {
        $profileId = $this->getValue($request, $data, 'escort_id');
        $membershipId = $this->getValue($request, $data, 'membership');
        $profileDetail = getEscortDetail($profileId);
        $oldPurchase = $profileDetail->mainPurchase;
        $newPurchase = $oldPurchase->replicate();

        list($usedDicount, $usedAmount) = calculateTotalFee($oldPurchase->membership, ($oldPurchase->days_number - $profileDetail->left_listing_days), $profileDetail->user);
        list($dicount, $amount, $unitAmount, $unitDiscount) = calculateTotalFee($membershipId, $profileDetail->left_listing_days, $profileDetail->user);

        $today = Carbon::today($profileDetail->TimeZone);
        $startOfToady = $today->copy()->startOfDay()->setTimezone('UTC');
        $endOfToady = $today->copy()->endOfDay()->setTimezone('UTC');

        $oldPurchase->end_date = $today->format('d-m-Y');
        $oldPurchase->status = 'expire';
        $oldPurchase->utc_end_time = $endOfToady;
        $oldPurchase->paid_rate = $usedAmount;
        $oldPurchase->save();

        $newPurchase->parent_id = $oldPurchase->id;
        $newPurchase->membership = $membershipId;
        $newPurchase->start_date =  $today->copy()->format('d-m-Y');
        $newPurchase->utc_start_time =  $startOfToady;
        $newPurchase->rate = $unitAmount;
        $newPurchase->discount_rate = $unitDiscount;
        $newPurchase->total_rate = $profileDetail->left_listing_days * $unitAmount;
        $newPurchase->paid_rate = $amount;
        $newPurchase->save();

        $profileDetail->purchase_id = $newPurchase->id;
        $profileDetail->membership = $membershipId;
        $profileDetail->save();

        return $newPurchase;
    }
}
