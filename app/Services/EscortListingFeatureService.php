<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\EscortBumpup;
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
        print_this($data);
        $escortId = $this->getValue($request, $data, 'escort_id');

        $escortDetail = getEscortDetail($escortId);

        $profileTimezone = config("escorts.profile.states.$escortDetail->state_id.cities.$escortDetail->city_id.timeZone");

        $nowLocal = Carbon::now($profileTimezone);

        $localStart = $nowLocal->copy();
        $localEnd   = $nowLocal->copy()->addHours(24);

        $utcStart = $localStart->copy()->setTimezone('UTC');
        $utcEnd   = $localEnd->copy()->setTimezone('UTC');

        return EscortBumpup::create([
            'user_id'        => $escortDetail->user->id,
            'escort_id'      => $escortDetail->id,
            'start_date'     => $localStart->format('Y-m-d'),
            'end_date'       => $localEnd->format('Y-m-d'),
            'utc_start_time' => $utcStart,
            'utc_end_time'   => $utcEnd,
        ]);
    }
}
