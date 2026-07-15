<?php

/**
 * Custom helper functions
 */

use App\Mail\LoginOtpMail;
use App\Models\AdvertiserDiscount;
use App\Models\AlertNotic;
use App\Models\City;
use App\Models\Country;
use App\Models\Escort;
use App\Models\EscortAdditionalInformation;
use App\Models\EscortMedia;
use App\Models\EscortStatistics;
use App\Models\GlobalNotification;
use App\Models\MassageAvailability;
use App\Models\MassageMedia;
use App\Models\MassageProfile;
use App\Models\MassagePurchase;
use App\Models\MassageRate;
use App\Models\MassageService;
use App\Models\MassageStatistics;
use App\Models\Masseur;
use App\Models\MasseurMedia;
use App\Models\Notification;
use App\Models\Purchase;
use App\Models\State;
use App\Models\User;
use App\Sms\SendSms;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

use function PHPSTORM_META\type;

if (!function_exists('generateReferenceNo')) {
    function generateReferenceNo(string $modelClass): string
    {
        $lastRecord = $modelClass::latest('id')->first();

        $nextId = $lastRecord ? $lastRecord->id + 1 : 1;

        return now()->format('Ymd') . str_pad($nextId, 5, '0', STR_PAD_LEFT);
    }
}

if (!function_exists('old_calculateTotalFee')) {
    function old_calculateTotalFee($plan = 0, $days = 0)
    {
        $dis_rate = 0;
        if ($plan == 1) {
            $actual_rate = 8;
            if ($days <= 21) {
                $rate = 8;
            } else {
                $rate = 7.5;
                $dis_rate = 0.5;
            }
        } else if ($plan == 2) {
            $actual_rate = 6;
            if ($days <= 21) {
                $rate = 6;
            } else {
                $rate = 5.7;
                $dis_rate = 0.3;
            }
        } else if ($plan == 3) {
            $actual_rate = 4;
            if ($days <= 21) {
                $rate = 4;
            } else {
                $rate = 3.8;
                $dis_rate = 0.2;
            }
        } else {
            $actual_rate = 0;
            $rate = 0;
            $dis_rate = 0;
        }

        if ($days !== null && $days <= 21) {
            $total_rate = $days * $rate;
            $total_dis = 0;
        } else {
            $days_21 = 21 * $actual_rate;
            $above_day = $days - 21;
            $total_rate = ($above_day * $rate + $days_21);
            $total_dis = $above_day * $dis_rate;
        }
        $total_amount = $total_rate;
        $total_amount -= $total_dis;
        return [$total_dis, $total_rate, $total_amount];
    }
}


if (!function_exists('calculateTotalFee')) {
    function calculateTotalFee($membership_id, $days, $userObject = null, $purchaseObject = null)
    {
        $appliedDiscountAmount = 0; // Changes By Rizwan

        if (!empty($userObject)) {
            $appiedDiscount = $userObject->activeFeeDiscount;
        }
        $discount_day = 21;
        if (!empty($purchaseObject)) {  /* To manage price changes done by Admin , to use same price at the time of purchase */
            $normalRate   = $purchaseObject->rate;
            $discountRate = $purchaseObject->discount_rate;
        } else {
            $pricing = \App\Models\Pricing::where('membership_id', $membership_id)->first();
            if (!$pricing) {
                return [0, 0, 0, 0, 0];
            }
            $normalRate   = $pricing->price;

            if (!empty($appiedDiscount)) {
                $discountRate = AdvertiserDiscount::getNetDiscount($pricing, $appiedDiscount);
            } else {
                $discountRate = $pricing->discount_amount ?: $normalRate;
            }
        }

        if ($days <= $discount_day) {
            $total_rate     = $days * $normalRate;
            $total_discount = 0;
            return [$total_discount, $total_rate, $normalRate, $discountRate, $appliedDiscountAmount]; // Changes By Rizwan add $appliedDiscountAmount
        }


        $normalDays   = $discount_day;
        $discountDays = $days - $discount_day;

        if (!empty($pricing->day) && $pricing->day == 1) {  // frequency 
            $total_rate  = ($normalDays * $normalRate) + ($discountDays * $discountRate);
        } elseif (!empty($pricing->day) && $pricing->day == 2) {  // frequency 
            $normalWeeks   = ceil($normalDays / 7);
            $discountWeeks = ceil($discountDays / 7);

            $total_rate  = ($normalWeeks * $normalRate) + ($discountWeeks * $discountRate);
        } else {
            $total_rate = ($normalDays * $normalRate) + ($discountDays * $discountRate);
        }

        $total_discount = $discountDays * ($normalRate - $discountRate);
        $appliedDiscountAmount = ($discountDays * $discountRate);



        return [$total_discount, $total_rate, $normalRate, $discountRate, $appliedDiscountAmount];
    }
}

if (!function_exists('getPinupFee')) {
    function getPinupFee()
    {
        $pricing = \App\Models\Pricing::where('membership_id', 6)->first();
        return !empty($pricing) ? number_format($pricing->price, 2, '.', '') : 0;
    }
}

if (!function_exists('getBumpupFee')) {
    function getBumpupFee()
    {
        $pricing = \App\Models\Pricing::where('membership_id', 7)->first();
        return !empty($pricing) ? number_format($pricing->price, 2, '.', '') : 0;
    }
}

if (!function_exists('getPlanFee')) {
    function getPlanFee($planId = null)
    {
        if (!empty($planId)) {
            $pricing = \App\Models\Pricing::where('membership_id', $planId)->first();
            return !empty($pricing) ? $pricing->price : 0;
        } else {
            return 0;
        }
    }
}


if (!function_exists('formatCurrency')) {
    /**
     * Format the amount
     */
    function formatCurrency($amount, $currency = '$')
    {
        $amount = number_format($amount, 2, '.', ''); // keep 2 decimals
        list($intPart, $decimalPart) = explode('.', $amount);

        $lastThree = substr($intPart, -3);
        $restUnits = substr($intPart, 0, -3);

        if ($restUnits != '') {
            $restUnits = preg_replace("/\B(?=(\d{2})+(?!\d))/", ",", $restUnits);
            $formatted = $restUnits . "," . $lastThree;
        } else {
            $formatted = $lastThree;
        }

        return $currency . '' . $formatted . '.' . $decimalPart;
    }
}

/**
 * Get membership type by membership ID
 */
if (!function_exists('getMembershipType')) {
    function getMembershipType($membership)
    {
        switch ($membership) {
            case (1):
                return "Platinum";
                break;
            case (2):
                return "Gold";
                break;
            case (3):
                return "Silver";
                break;
            case (4):
                return "Free";
                break;
        }
        return "N/A";
    }
}

/**
 * Get escort profile detial
 */
if (!function_exists('getEscortDetail')) {
    function getEscortDetail($id)
    {
        $escort = Escort::where('id', $id)->first();
        return $escort;
    }
}

/**
 * Get country list
 */
if (!function_exists('getCountryList')) {
    function getCountryList()
    {
        return Country::select(['id', 'name', 'status'])->pluck('name', 'id');
    }
}

/**
 * Get up time without crashing website
 */
if (!function_exists('getAppUptime')) {
    function getAppUptime()
    {
        $startTime = Cache::get('app_start_time');
        $str = '';

        if (!$startTime) {
            return 'App start time not available.';
        }

        $start = \Carbon\Carbon::parse($startTime);
        $now = now();

        $diffInSeconds = $now->diffInSeconds($start);

        $days = floor($diffInSeconds / 86400);
        $hours = floor(($diffInSeconds % 86400) / 3600);
        $minutes = floor(($diffInSeconds % 3600) / 60);
        $str .= $days . ' days & ' . $hours . ' hours ' . $minutes . ' minutes';

        return $str;
    }
}

if (!function_exists('getServertime')) {
    function getServertime()
    {
        $serverTimeZone = Carbon::now(config('app.escort_server_timezone'))->format('h:i:s A');

        return $serverTimeZone;
    }
}

/**
 * Create a "Random" Strin
 *
 * @param string  type of random string.  basic, alpha, alnum, numeric, nozero, unique, md5, encrypt and sha1
 * @param int number of characters
 * @return string
 */
if (!function_exists('random_string')) {
    function random_string($type = 'nozero', $len = 8)
    {
        switch ($type) {
            case 'basic':
                return mt_rand();
            case 'alnum':
            case 'numeric':
            case 'nozero':
            case 'alpha':
                switch ($type) {
                    case 'alpha':
                        $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        break;
                    case 'alnum':
                        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        break;
                    case 'numeric':
                        $pool = '0123456789';
                        break;
                    case 'nozero':
                        $pool = '123456789';
                        break;
                }
                return substr(str_shuffle(str_repeat($pool, ceil($len / strlen($pool)))), 0, $len);
            case 'md5':
                return md5(uniqid(mt_rand()));
            case 'sha1':
                return sha1(uniqid(mt_rand(), TRUE));
        }
    }
}

if (!function_exists('calculateFee')) {

    function calculateFee($plan, $days)
    {
        # Note : The rates:  Platinum $8, Gold $6, Silver $4 and Massage Centre $30
        # calculateFee($listing['membership'], $daysDiff);

        $planInfo = [1 => "Platinum", 2 => "Gold", 3 => "Silver", 4 => "Free", 5 => "massage"];

        $dis_rate = 0;
        if ($plan == 1) {
            $actual_rate = 8;
            if ($days <= 21) {
                $rate = 8;
            } else {
                $rate = 7.5;
                $dis_rate = 0.5;
            }
        } else if ($plan == 2) {
            $actual_rate = 6;
            if ($days <= 21) {
                $rate = 6;
            } else {
                $rate = 5.7;
                $dis_rate = 0.3;
            }
        } else if ($plan == 3) {
            $actual_rate = 4;
            if ($days <= 21) {
                $rate = 4;
            } else {
                $rate = 3.8;
                $dis_rate = 0.2;
            }
        } else if ($plan == 5) {
            $actual_rate = 30;
            $rate = 0;
            $dis_rate = 0;
        } else {
            $actual_rate = 0;
            $rate = 0;
            $dis_rate = 0;
        }

        if ($days !== null && $days <= 21) {
            //$rate = $days*30/days;
            $total_rate = $days * $rate;
            $total_dis = 0;
        } else {
            $days_21 = 21 * $actual_rate;
            $above_day = $days - 21;
            $total_rate = ($above_day * $rate + $days_21);
            $total_dis = $above_day * $dis_rate;
        }

        return [$total_dis, $total_rate];
    }
}

if (!function_exists('getRatingLabel')) {

    function getRatingLabel($percentage)
    {
        if ($percentage >= 90) {
            return 'Excellent';
        } elseif ($percentage >= 75) {
            return 'Very Good';
        } elseif ($percentage >= 60) {
            return 'Good';
        } elseif ($percentage >= 40) {
            return 'Average';
        } elseif ($percentage >= 20) {
            return 'Poor';
        } else {
            return 'Very Poor';
        }
    }
}

if (!function_exists('getEscortTimezone')) {

    function getEscortTimezone($escort)
    {
        # get timezone of escort
        $escortTimezone = config('app.escort_server_timezone');
        if ($escort && $escort->state_id && $escort->city_id) {
            $escortTimezone = config('escorts.profile.states')[$escort->state_id]['cities'][$escort->city_id]['timeZone'];
        }

        return $escortTimezone;
    }
}


if (!function_exists('getMassageTimezone')) {

    function getMassageTimezone($massage_profile)
    {
        $massage  = User::where('id', $massage_profile->user_id)->first();
        $home_state = $massage->state_id;
        $profileTimezone = config("escorts.profile.states.$home_state.timeZone");
        return $profileTimezone;
    }
}

if (!function_exists('getMassageLocalTime')) {

    function getMassageLocalTime($utcTime, $localTimeZone)
    {
        return Carbon::parse($utcTime)->timezone($localTimeZone);
    }
}

if (!function_exists('getEscortLocalTime')) {

    function getEscortLocalTime($utcTime, $localTimeZone)
    {
        return Carbon::parse($utcTime)->timezone($localTimeZone);
    }
}


if (!function_exists('app_date_time_format')) {

    function app_date_time_format($datetime)
    {
        return \Carbon\Carbon::parse($datetime)->format('d M Y, h:i A');
    }
}

if (!function_exists('convert_aus_date_time_format')) {

    function convert_aus_date_time_format($datetime)
    {
        return \Carbon\Carbon::parse($datetime, 'UTC')
            ->setTimezone('Australia/Perth')
            ->format('d M Y, h:i A');
    }
}



if (!function_exists('getRealTimeGeolocationOfUsers')) {

    function getRealTimeGeolocationOfUsers($lat, $lng)
    {
        try {
            $apiKey = config('services.google_map.api_key'); // env('GOOGLE_MAPS_API_KEY');

            // Get location details from Google Maps Reverse Geocoding
            $geoUrl = "https://maps.googleapis.com/maps/api/geocode/json?latlng={$lat},{$lng}&key={$apiKey}";
            $response = Http::get($geoUrl);

            $state = 'Unknown';

            if ($response->successful()) {
                foreach ($response['results'][0]['address_components'] as $component) {
                    if (in_array('administrative_area_level_1', $component['types'])) {
                        $state = $component['long_name'];
                        break;
                    }
                }
            }

            $stateFromDb = State::where('name', $state)->first();

            $stateCapital = config('escorts.profile.states')[$stateFromDb->id] ?? null;

            $timezone = $stateCapital ? $stateCapital['timeZone'] : "UTC";

            $parms = [
                'geo_state' => $state,
                'state' => $stateFromDb ? $stateFromDb->id : null,
                'city' => $stateCapital ? array_key_first($stateCapital['cities']) : null,
                'home_state' => auth()->user() ? auth()->user()->home_state : null,
                'current_location' => $stateFromDb->iso2,
                'timezone' => $timezone,
                'current_time' => now($timezone)->format('h:i A')
            ];

            return $parms;
        } catch (\Exception $e) {
            $stateCapital = config('escorts.profile.states')[auth()->user()->state_id];
            $timezone = $stateCapital ? $stateCapital['timeZone'] : "UTC";

            $parms = [
                'geo_state' => $state,
                'state' => null,
                'city' => null,
                'home_state' => auth()->user()->home_state,
                'current_location' => auth()->user()->home_state,
                'timezone' => $timezone,
                'current_time' => now($timezone)->format('h:i A')
            ];

            return $parms;
        }
    }
}

if (!function_exists('getDefaultBannerTemplates')) {
    function getBannerTemplates($group = 0)
    {
        return EscortMedia::where(['type' => 0, 'banner_group' => strval($group), 'position' => 9])
            ->whereNull('user_id')
            ->get();
    }
}




if (!function_exists('isGalleryTemplate')) {
    function isGalleryTemplate($media_id = 0)
    {
        $media = EscortMedia::where(['id' => $media_id])->first();
        if ($media->template) {
            $template = EscortMedia::where(['user_id' => NULL, 'template' => '1', 'path' => $media->path])->first('id');
            return $template->id;
        } else {
            return $media_id;
        }
    }
}


if (!function_exists('getMassageBannerTemplates')) {
    function getMassageBannerTemplates($group = 0)
    {
        return MassageMedia::where(['type' => 0, 'banner_group' => strval($group), 'position' => 9])
            ->whereNull('user_id')
            ->get();
    }
}


if (!function_exists('isMasseursGalleryTemplate')) {
    function isMasseursGalleryTemplate($media_id = 0)
    {
        $media = MasseurMedia::where(['id' => $media_id])->first();
        if ($media->template) {
            $template = MasseurMedia::where(['user_id' => NULL, 'template' => '1', 'path' => $media->path])->first('id');
            return $template->id;
        } else {
            return $media_id;
        }
    }
}


if (!function_exists('isMassageGalleryTemplate')) {
    function isMassageGalleryTemplate($media_id = 0)
    {
        $media = MassageMedia::where(['id' => $media_id])->first();
        if ($media->template) {
            $template = MassageMedia::where(['user_id' => NULL, 'template' => '1', 'path' => $media->path])->first('id');
            return $template->id;
        } else {
            return $media_id;
        }
    }
}

if (!function_exists('logErrorLocal')) {
    function logErrorLocal($error)
    {
        if (app()->environment('local')) {
            if ($error instanceof \Exception) {
                Log::info($error->getMessage());
            } else {
                Log::info($error);
            }
        }
    }
}

if (!function_exists('log_info')) {
    function log_info($message)
    {
        if (is_array($message)) {
            Log::info(json_encode($message));
        } else {
            Log::info($message);
        }
    }
}

if (!function_exists('CheckExpireDate')) {
    function CheckExpireDate($data)
    {
        $map = [
            'never' => 'Never',
            30 => 'Renew every 30 days',
            60 => 'Renew every 60 days',
            90 => 'Renew every 90 days',
        ];

        return $map[$data] ?? null;
    }
}

if (!function_exists('success_response')) {
    /**
     * Unified success JSON response
     * @param mixed $data
     * @param string $message
     * @param int $statusCode
     * @param array $extra
     */
    function success_response($data = null, $message = 'OK', $statusCode = 200, array $extra = [])
    {
        $payload = array_merge([
            'status' => true,
            'message' => $message,
            'data' => $data,
        ], $extra);

        return response()->json($payload, $statusCode);
    }
}

if (!function_exists('error_response')) {
    /**
     * Unified error JSON response
     * @param string $message
     * @param int $statusCode
     * @param mixed $errors
     * @param array $extra
     */
    function error_response($message = 'Error', $statusCode = 400, $errors = null, array $extra = [])
    {
        $payload = array_merge([
            'status' => false,
            'message' => $message,
        ], $extra);

        if (!is_null($errors)) {
            $payload['errors'] = $errors;
        }

        return response()->json($payload, $statusCode);
    }
}

// if (!function_exists('get_user_ip_adrress')) {

//     function get_user_ip_adrress() {
//         if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
//             $ip = $_SERVER['HTTP_CLIENT_IP'];
//         } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
//             $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
//         } else {
//             $ip = $_SERVER['REMOTE_ADDR'];
//         }
//         return $ip;
//     }
// }

if (!function_exists('saving_escort_stats')) {

    function saving_escort_stats($userId, $escortId, $profileViewType)
    {
        $today     = now(config('app.escort_server_timezone'))->toDateString();
        $todayDateUnderscore = str_replace('-', '_', $today);

        # --- Clear yesterday's escort session keys ---
        if (Session::get('last_session_date') !== $today) {
            # Only clear escort-related session keys, keep other session data safe
            foreach (Session::all() as $key => $value) {
                if (str_starts_with($key, 'escort_stat_')) {
                    Session::forget($key);
                }
            }
            Session::put('last_session_date', $today);
            Session::save();
        }

        # --- Unique session key per escort per day ---
        $sessionKey = "escort_id_{$escortId}_date_{$todayDateUnderscore}_" . $profileViewType;

        # Already profile viewed today?
        if (Session::get($sessionKey) === $sessionKey) {
            return false; // Already counted
        }

        # Save session for this escort
        Session::put([$sessionKey => $sessionKey]);
        Session::save(); // media_views_count

        $field = [
            'profile_views_count' => $profileViewType == 'profile_views_count' ? 1 : 0,
            'media_views_count' => $profileViewType == 'media_views_count' ? 1 : 0,
            'playbox_views_count' => $profileViewType == 'playbox_views_count' ? 1 : 0,
            'reviews_count' => $profileViewType == 'reviews_count' ? 1 : 0,
            'recommendation_count' => $profileViewType == 'recommendation_count' ? 1 : 0,
        ];

        // --- Update statistics in DB ---
        $stat = EscortStatistics::where('user_id', $userId)
            ->where('escort_id', $escortId)
            ->where('date', $today)
            ->first();

        if ($stat) {
            $stat->profile_views_count  += $field['profile_views_count'] ?? 0;
            $stat->media_views_count    += $field['media_views_count'] ?? 0;
            $stat->playbox_views_count  += $field['playbox_views_count'] ?? 0;
            $stat->reviews_count        += $field['reviews_count'] ?? 0;
            $stat->recommendation_count += $field['recommendation_count'] ?? 0;
            $stat->save();
        } else {
            EscortStatistics::create([
                'user_id'               => $userId,
                'escort_id'             => $escortId,
                'date'                  => $today,
                'profile_views_count'   => $field['profile_views_count'] ?? 0,
                'media_views_count'     => $field['media_views_count'] ?? 0,
                'playbox_views_count'   => $field['playbox_views_count'] ?? 0,
                'reviews_count'         => $field['reviews_count'] ?? 0,
                'recommendation_count'  => $field['recommendation_count'] ?? 0,
            ]);
        }

        return true;
    }
}

if (!function_exists('saving_massage_stats')) {

    function saving_massage_stats($userId, $massage_id, $profileViewType)
    {
        $today     = now(config('app.escort_server_timezone'))->toDateString();
        $todayDateUnderscore = str_replace('-', '_', $today);

        # --- Clear yesterday's _massage session keys ---
        if (Session::get('last_session_date') !== $today) {
            # Only clear _massage-related session keys, keep other session data safe
            foreach (Session::all() as $key => $value) {
                if (str_starts_with($key, 'massage_stat_')) {
                    Session::forget($key);
                }
            }
            Session::put('last_session_date', $today);
            Session::save();
        }

        # --- Unique session key per _massage per day ---
        $sessionKey = "massage_id_{$massage_id}_date_{$todayDateUnderscore}_" . $profileViewType;

        # Already profile viewed today?
        if (Session::get($sessionKey) === $sessionKey) {
            return false; // Already counted
        }

        # Save session for this _massage
        Session::put([$sessionKey => $sessionKey]);
        Session::save(); // media_views_count

        $field = [
            'profile_views_count' => $profileViewType == 'profile_views_count' ? 1 : 0,
            'media_views_count' => $profileViewType == 'media_views_count' ? 1 : 0,
            'playbox_views_count' => $profileViewType == 'playbox_views_count' ? 1 : 0,
            'reviews_count' => $profileViewType == 'reviews_count' ? 1 : 0,
            'recommendation_count' => $profileViewType == 'recommendation_count' ? 1 : 0,
        ];

        // --- Update statistics in DB ---
        $stat = MassageStatistics::where('user_id', $userId)
            ->where('massage_id', $massage_id)
            ->where('date', $today)
            ->first();

        if ($stat) {
            $stat->profile_views_count  += $field['profile_views_count'] ?? 0;
            $stat->media_views_count    += $field['media_views_count'] ?? 0;
            $stat->playbox_views_count  += $field['playbox_views_count'] ?? 0;
            $stat->reviews_count        += $field['reviews_count'] ?? 0;
            $stat->recommendation_count += $field['recommendation_count'] ?? 0;
            $stat->save();
        } else {
            MassageStatistics::create([
                'user_id'               => $userId,
                'massage_id'             => $massage_id,
                'date'                  => $today,
                'profile_views_count'   => $field['profile_views_count'] ?? 0,
                'media_views_count'     => $field['media_views_count'] ?? 0,
                'playbox_views_count'   => $field['playbox_views_count'] ?? 0,
                'reviews_count'         => $field['reviews_count'] ?? 0,
                'recommendation_count'  => $field['recommendation_count'] ?? 0,
            ]);
        }

        return true;
    }
}


function print_this($array, $die = false)
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';
    if ($die) {
        die;
    }
}

if (!function_exists('showDateWithFormat')) {
    /**
     * Format the date as per supplied format to
     * display date in UI.
     * e.g. 10-23-2022
     *
     * @param string $date Date or datetime string
     * @param string $format Date format
     * @return string
     */
    function showDateWithFormat($date, $format = '')
    {
        if (empty($format)) {
            $format = "d-m-Y";
        }

        $formattedDate = '';
        try {
            if (empty($date) || strtotime($date) === false) {
                $formattedDate = '';
            } else {
                $formattedDate = Carbon::parse($date)->format($format);
            }
        } catch (\Exception $e) {
            //
        }
        return $formattedDate;
    }
}

function basicDateFormat($date)
{
    if ($date) {
        return \Carbon\Carbon::parse($date)->format('d-m-Y');
    } else {
        return '';
    }
}

function sqlDateFormat($date)
{
    if (!empty($date)) {
        return \Carbon\Carbon::parse($date)->format('Y-m-d');
    } else {
        return null;
    }
}


function formatLabelAttribute($label)
{
    if (empty($label)) {
        return $label;
    }

    // Replace underscores with spaces (if any)
    $label = str_replace('_', ' ', $label);

    // Convert to Title Case
    return Str::title(strtolower($label));
}



if (!function_exists('period_days')) {

    function period_days($day)
    {

        switch ($day) {
            case 1:
                return "Per Day";

            case 2:
                return "Per Week";

            default:
                return "Per Service";
        }
    }
}


if (!function_exists('last_updated_price')) {
    function last_updated_price($type)
    {
        switch ($type) {
            case 'pricing':
            case 'fees_concierge_services':
            case 'fees_support_services':
            case 'variabl_agent_operators':
            case 'variabl_loyalty_programs':

                $date = DB::table('pricing_fee_update_logs')
                    ->where('fee_type', $type)
                    ->value('last_updated_date');

                return $date ? \Carbon\Carbon::parse($date)->format('d-m-Y') : null;

            default:
                return null;
        }
    }
}



//need Agent ka total advartiser 
if (!function_exists('getAgentTotalAdvertisers')) {
    function getAgentTotalAdvertisers()
    {
        $total_advertisers = 0;
        try {
            $total_advertisers = User::where('assigned_agent_id', auth()->user()->id)->where('is_agent_assign', '1')->count();
        } catch (\Exception $e) {
        }

        return $total_advertisers;
    }
}


if (!function_exists('staffPageAccessPermission')) {
    /**
     * Type 1 for Admin, Type 9 for operator staff
     */
    function staffPageAccessPermission($securityLevel = "0", $pageKey = "sidebar", $type = 1)
    {

        if ($type == 9) {
            $pageAccess = config('operator_staff.page_access');
        } else {
            $pageAccess = config('staff.page_access');
        }
        if (isset($pageAccess[$securityLevel])) {
            $levelArray = $pageAccess[$securityLevel];
            if (isset($levelArray[$pageKey])) {
                return $levelArray[$pageKey];
            }
        }
        return [];
    }
}

if (!function_exists('accessDeniedMsg')) {
    function accessDeniedMsg()
    {
        return config('staff.access_denied_msg');
    }
}

if (!function_exists('getLoginRoute')) {
    function getLoginRoute($userType = -1)
    {
        $loginLInk = "home";
        if ($userType = 0) {
            $loginLInk = 'viewer.login';
        } else  if ($userType = 1) {
            $loginLInk = 'admin.login';
        } else  if ($userType = 2) {
            $loginLInk = 'home';
        } else  if ($userType = 3) {
            $loginLInk = 'advertiser.login';
        } else  if ($userType = 4) {
            $loginLInk = 'advertiser.login';
        } else  if ($userType = 5) {
            $loginLInk = 'agent.login';
        } else  if ($userType = 6) {
            $loginLInk = 'staff.login';
        } else  if ($userType = 7) {
            $loginLInk = 'operator.login';
        } else  if ($userType = 8) {
            $loginLInk = 'shareholder.login';
        }
        return $loginLInk;
    }
}

if (!function_exists('formatPhone')) {
    function formatPhone($number)
    {
        if ($number == null || empty($number)) {
            return $number;
        }
        // Remove anything that is not a digit
        $digits = preg_replace('/\D/', '', $number);

        // Format: 4 digits + space + 3 digits + space + 3 digits
        if (strlen($digits) === 10) {
            return substr($digits, 0, 4) . ' ' .
                substr($digits, 4, 3) . ' ' .
                substr($digits, 7, 3);
        }

        // If not 10 digits, return original number
        return $number;
    }
}


if (!function_exists('sendLoginOtpEmail')) {
    function sendLoginOtpEmail($otp, $user, $mailTemplate = 'emails.otp.login_otp', $mailSubject = 'Login Otp')
    {
        log_info('sendLoginOtpEmail');

        if (isset($user->email) && $user->email != "") {

            try {
                if ($user && $user->type == '5')
                    $username = $user->business_name;
                else
                    $username = $user->name;

                $data = [
                    'username' => $username,
                    'otp'      => $otp,
                    'member_id'      => $user->member_id,
                ];

                Mail::send($mailTemplate, $data, function ($message) use ($user, $mailSubject) {
                    $message->to($user->email)
                        ->subject($mailSubject);
                });

                return true;
            } catch (\Exception $e) {
                logErrorLocal($e);
            }
        }
    }
}


if (!function_exists('sendLoginOtpSms')) {
    function sendLoginOtpSms($otp, $user, $message = null)
    {
        log_info('sendLoginOtpSms');

        if (isset($user->phone) && $user->phone != "") {

            $username = ($user && $user->type == '5')
                ? $user->business_name
                : $user->name;

            // default message
            $message = $message ?? "Hello :username, your one-time login OTP is :otp. If you didn’t request this, please ignore this message.";

            // replace placeholders
            $message = str_replace(
                [':username', ':otp'],
                [$username, $otp],
                $message
            );

            $sendotp = new SendSms();
            $output = $sendotp->send_otp_sms($user->phone, $message);

            return $output;
        }

        return false;
    }
}


if (!function_exists('formatMobileNumber')) {
    function formatMobileNumber($number)
    {


        $number = preg_replace('/\D/', '', $number);
        $length = strlen($number);

        // If 4 or fewer digits → return as is
        if ($length <= 4) {
            return $number;
        }

        // First 4 digits
        $part1 = substr($number, 0, 4);
        $remaining = substr($number, 4);

        // Split remaining into groups of 3, last can be 1 or 2 digits
        $groups = [];

        while (strlen($remaining) > 3) {
            $groups[] = substr($remaining, 0, 3);
            $remaining = substr($remaining, 3);
        }

        // Add last 1–3 digit remainder
        if (strlen($remaining) > 0) {
            $groups[] = $remaining;
        }

        return $part1 . ' ' . implode(' ', $groups);
    }
}

if (!function_exists('removeSpaceFromString')) {
    function removeSpaceFromString($number)
    {
        $number = trim((string) $number);
        if ($number === '') {
            return null;
        }

        return preg_replace('/[^\p{N}]/u', '', $number);
    }
}

if (!function_exists('formatStringTitleCase')) {
    function formatStringTitleCase($string)
    {
        if (!$string) {
            return null;
        }

        // Replace underscores with spaces
        $string = str_replace('_', ' ', $string);

        // Remove extra spaces
        $string = trim(preg_replace('/\s+/', ' ', $string));

        // Convert to Title Case
        return ucwords(strtolower($string));
    }
}

if (!function_exists('getUserWiseLastLoginTime')) {
    function getUserWiseLastLoginTime($user)
    {
        $timeZone = config('app.escort_server_timezone');
        $stateId = $user->current_state_id ? $user->current_state_id : $user->state_id;
        if ($stateId) {
            $timeZone = config('escorts.profile.states')[$stateId]['timeZone'];
        }
        $lastLoginTime = $user->lastLoginTime->updated_at;
        if ($user->lastLoginTime) {
            $lastLoginTime = Carbon::parse($lastLoginTime, 'UTC')
                ->setTimezone($timeZone)
                ->format('d-m-Y h:i:s A');
        }
        return $lastLoginTime;
    }
}

if (!function_exists('formatAccountNumber')) {
    function formatAccountNumber($number, $type = null)
    {
        if (empty($number)) {
            return $number;
        }
        $digiType = '-';
        if ($type !=  null) {
            $digiType =  ' ';
        }

        // Remove non-digits
        $digits = preg_replace('/\D/', '', $number);
        $length = strlen($digits);

        //  Rule based on digit length
        switch ($length) {

            case 6:
                // 123456 → 123-456
                return substr($digits, 0, 3) . $digiType . substr($digits, 3, 3);

            case 7:
                // 1234567 → 123-4567
                return substr($digits, 0, 3) . $digiType . substr($digits, 3, 4);

            case 8:
                // 12345678 → 1234-5678
                return substr($digits, 0, 4) . $digiType . substr($digits, 4, 4);

            case 9:
                // 123456789 → 123-456-789
                return substr($digits, 0, 3) . $digiType .
                    substr($digits, 3, 3) . $digiType .
                    substr($digits, 6, 3);

            case 10:
                // 1234567890 → 1234-567-890
                return substr($digits, 0, 4) . $digiType .
                    substr($digits, 4, 3) . $digiType .
                    substr($digits, 7, 3);
            case 11:
                // 12345678901 → 123-456-789-01
                return substr($digits, 0, 3) . $digiType .
                    substr($digits, 3, 3) . $digiType .
                    substr($digits, 6, 3) . $digiType .
                    substr($digits, 9, 2);

            case 12:
                // 123456789012 → 1234-567-890-12
                return substr($digits, 0, 4) . $digiType .
                    substr($digits, 4, 3) . $digiType .
                    substr($digits, 7, 3) . $digiType .
                    substr($digits, 10, 2);

            case 16:
                // 1234567812345678 → 1234-5678-1234-5678 (Card format)
                return substr($digits, 0, 4) . $digiType .
                    substr($digits, 4, 4) . $digiType .
                    substr($digits, 8, 4) . $digiType .
                    substr($digits, 12, 4);

            default:
                // Fallback (return as-is)
                return $number;
        }
    }
}


if (!function_exists('global_notifications')) {
    function global_notifications()
    {
        $today = Carbon::today();
        $todayDate = $today->toDateString();
        $notifications = GlobalNotification::where('status', 'Published')->where(function ($query) use ($todayDate) {
            // Adhoc notifications valid for today
            $query->where('type', 'Ad hoc')
                ->where('start_date', '<=', $todayDate)
                ->where('end_date', '>=', $todayDate);

            // Notice notifications valid for today with matching member_id
            $query->orWhere(function ($q) use ($todayDate) {
                $q->where('type', 'Template')
                    ->where('start_date', '<=', $todayDate)
                    ->where('end_date', '>=', $todayDate);
            });
        })->orderBy('created_at', 'desc')
            ->select('id', 'heading', 'content', 'template_name')
            ->get();

        return $notifications;
    }
}

if (!function_exists('removeAnythingExceptNumber')) {
    function removeAnythingExceptNumber($number)
    {
        if ($number == null || empty($number)) {
            return $number;
        }
        // Remove anything that is not a digit
        return preg_replace('/\D/', '', $number);
    }
}

if (!function_exists('notic_alert')) {
    function notic_alert()
    {
        $content = AlertNotic::where('action', 'public')->first();
        return $content ??  null;
    }
}


//return html status spam tag according status
if (!function_exists('getStatusBadgeClass')) {
    function getStatusBadgeClass($status)
    {
        $statusMap = [
            'Published'         => 'badge_published',
            'Suspended'         => 'badge_suspended',
            'Removed'           => 'badge_suspended',
            'Active'            => 'badge_active',
            'Inactive'          => 'badge_inactive',
            'Pending'           => 'badge_pending',
            'Completed'         => 'badge_completed',
            'Accepted'          => 'badge_accepted',
            'Rejected'          => 'badge_rejected',
            'Available'         => 'badge_available',
            'Withdrow'          => 'badge_withdraw',
            'Resolved'          => 'badge_resolved',
            'Open'              => 'badge_open',
            'Registered'        => 'badge_registered',
            'Cancelled'         => 'badge_inactive',
            'In-progress'       => 'badge_inProgress',
            'Upcoming'          => 'badge_upcoming',
            'Withdrawn'         => 'badge_withdraw',
            'Verified'          => 'badge_accepted',
            'Current'          => 'badge_current',

        ];

        $status = trim(ucfirst(strtolower($status)));
        return isset($statusMap[$status]) ? $statusMap[$status] : 'badge_pending';
    }
}

if (!function_exists('formatAbnNumber')) {
    function formatAbnNumber($number)
    {
        $number = preg_replace('/\D/', '', $number);
        $length = strlen($number);

        // If 2 or fewer digits → return as is
        if ($length <= 2) {
            return $number;
        }

        // First 2 digits
        $part1 = substr($number, 0, 2);
        $remaining = substr($number, 2);

        // Split remaining into groups of 3, last can be 1 or 2 digits
        $groups = [];

        while (strlen($remaining) > 3) {
            $groups[] = substr($remaining, 0, 3);
            $remaining = substr($remaining, 3);
        }

        // Add last 1–3 digit remainder
        if (strlen($remaining) > 0) {
            $groups[] = $remaining;
        }

        return $part1 . ' ' . implode(' ', $groups);
    }
}

if (!function_exists('generate_masseur_member_id')) {
    function generate_masseur_member_id($masseur_profile_id)
    {
        if ($masseur_profile_id == "" || (!is_numeric($masseur_profile_id)))
            return false;

        return auth()->user()->member_id . '-00' . $masseur_profile_id;
    }
}


if (!function_exists('getListingRefundAmount')) {
    function getListingRefundAmount($profile)
    {
        $refundAmount = 0.00;
        $escortDetail = is_object($profile) ? $profile : getEscortDetail($profile);
        $purchase = $escortDetail->mainPurchase;
        if (!empty($purchase)) {
            $membership = $purchase->membership;
            $total_days = $purchase->days_number;
            $remaining_days = $purchase->left_listing_days;
            //$remaining_days = $escortDetail->left_listing_days;
            list($usedDicount, $usedAmount) = calculateTotalFee($membership, ($total_days - $remaining_days), $escortDetail->user, $purchase);
            $refundAmount = $purchase->paid_rate - $usedAmount;
            $gstAmount = getGSTAmount($refundAmount);
            $refundAmount = $refundAmount + $gstAmount;
        }
        return number_format($refundAmount, 2, '.', '');
    }
}

if (!function_exists('getSuspendRefundAmount')) {
    function getSuspendRefundAmount($profile, $startDate = null, $endDate = null)
    {
        $refundAmount = 0.00;
        if (!empty($startDate)  && !empty($endDate)) {
            $profileDetail = is_object($profile) ? $profile : getEscortDetail($profile);
            $purchase = $profileDetail->mainPurchase;
            $piadAmount = $purchase->paid_rate;

            $dayBeforeSuspendStart = Carbon::parse($purchase->start_date)->diffInDays(Carbon::parse($startDate));
            $dayTillSuspendEnd = Carbon::parse($purchase->start_date)->diffInDays(Carbon::parse($endDate)) + 1;
            /* In calculateTotalFee third param is optional , to ignore later paln price updates */
            [$discountOne, $costBeforeSuspendStart] = calculateTotalFee($purchase->membership, $dayBeforeSuspendStart, $profileDetail->user, $purchase);
            [$discountTwo, $costTillSuspendEnd] = calculateTotalFee($purchase->membership, $dayTillSuspendEnd, $profileDetail->user, $purchase);

            $netAmount = number_format($costTillSuspendEnd - $costBeforeSuspendStart, 2, '.', '');
            $refundAmount = min($piadAmount, $netAmount);
            $gstAmount = getGSTAmount($refundAmount);
            $refundAmount = $refundAmount + $gstAmount;
        }
        return number_format($refundAmount, 2, '.', '');
    }
}

if (!function_exists('getGSTAmount')) {
    function getGSTAmount($amount = 0.00)
    {
        $gstAmount = 0.00;
        if ($amount > 0) {
            $gstAmount = ($amount * config('app.payment.gst_percentage')) / 100;
        }
        return number_format($gstAmount, 2, '.', '');
    }
}

if (!function_exists('get_working_hours')) {
    function get_working_hours($listing)
    {
        if (isset($listing->availability->availability_time) && (!empty($listing->availability->availability_time))) {
            $availability = $listing->availability->availability_time ? json_decode($listing->availability->availability_time, true) : [];
            $current_day = strtolower(Carbon::now()->format('l'));
            $current_day_data = $availability[$current_day];

            if ($current_day_data['status'] == 'til_late') {
                return strtolower($current_day_data['from']) . '...' . ' Till late';
            } else if ($current_day_data['status'] == 'closed') {
                return 'Closed';
            } else if ($current_day_data['status'] == '24_hours') {
                return strtolower($current_day_data['from']) . ' to ' . $current_day_data['to'];
            } else if ($current_day_data['status'] == 'custom') {
                return strtolower($current_day_data['from']) . ' to ' . $current_day_data['to'];
            }
        }

        return 'NA';
    }
}


if (!function_exists('get_weakly_availibility')) {
    function get_weakly_availibility($listing)
    {
        if (isset($listing->availability->availability_time) && (!empty($listing->availability->availability_time))) {
            $availability = $listing->availability->availability_time ? json_decode($listing->availability->availability_time, true) : [];



            if (empty($availability))
                return '<tr><td colspan="2" style="background-color:#fff;border:none"><center>NA</center></td></tr>';

            else {
                $avail = '';
                foreach ($availability as $day => $data) {

                    $status = $data['status'];

                    if ($status == 'til_late')
                        $time =  strtolower($data['from']) . '...' . ' Till late';


                    else if ($data['status'] == '24_hours') {
                        $time = strtolower($data['from']) . ' to ' . strtolower($data['to']);
                    } else if ($data['status'] == 'custom') {
                        $time = strtolower($data['from']) . ' to ' . strtolower($data['to']);
                    } else if ($data['status'] == 'closed') {
                        $time = 'Closed';
                    }

                    $avail .= '<tr> <td>' . ucfirst($day) . '</td><td>' . $time  . '</td> </tr>';
                }

                return $avail;
            }
        }
    }
}

if (!function_exists('get_messure_weakly_availibility')) {
    function get_messure_weakly_availibility($messure)
    {
        if (isset($messure->availability) && (!empty($messure->availability))) {
            $availability = $messure->availability ? json_decode($messure->availability, true) : [];

            if (empty($availability))
                return '<tr><td colspan="7" style="background-color:#fff;border:none"><span class="na-label ">N/A</span></td></tr>';

            else {

                $avail = '<tr>';
                foreach ($availability as $day => $data) {

                    $status = $data['status'];

                    if ($status == 'til_late')
                        $time =  strtolower($data['from']) . '...' . ' Till late';


                    else if ($data['status'] == '24_hours') {
                        $time = strtolower($data['from']) . ' - ' . strtolower($data['to']);
                    } else if ($data['status'] == 'custom') {
                        $time = strtolower($data['from']) . ' - ' . strtolower($data['to']);
                    } else if ($data['status'] == 'closed') {
                        $time = '<span class="na-label ">N/A</span>';
                    }

                    $avail .= '<td>' . $time  . '</td>';
                }

                $avail .= '</tr>';

                return $avail;
            }
        }
    }
}


if (!function_exists('get_massage_home_city')) {
    function get_massage_home_city($user_id)
    {
        $user = User::select('state_id', 'subrub_city')->where('id', $user_id)->first();
        if ($user) {
            if ($user->subrub_city != "")
                return $user->subrub_city;
            else {
                if (isset(config('escorts.profile.states')[$user->state_id]['stateName'])) {
                    $city = reset(config('escorts.profile.states')[$user->state_id]['cities']);
                    $cityName = $city['cityName'] ?? null;
                    return $cityName;
                } else
                    return '';
            }
        } else
            return '';
    }
}

if (!function_exists('get_massage_member_id')) {
    function get_massage_member_id($user_id)
    {
        $user = User::select('member_id')->where('id', $user_id)->first();
        if ($user->member_id)
            return $user->member_id;
        else
            return 'NA';
    }
}


if (!function_exists('get_massage_images')) {
    function get_massage_images($listing, $position)
    {
        $image = "";

        if (!$listing || !$position)
            return false;

        $relativePath   =  $listing->imagePosition($position);
        $currentImage   = asset($relativePath);
        if (str_contains($currentImage, 'img-12.png')) {
            $image = false;
        } else {
            if ($currentImage != "" &&  is_file(public_path($relativePath)))
                $image  = $currentImage;
            else
                $image  = false;
        }
        return  $image;
    }
}


if (!function_exists('get_image_position_detail')) {
    function get_image_position_detail($listing, $position)
    {
        try {
            if (!$listing || $position === null) {
                return false;
            }

            return $listing->get_image_position_detail($position);
        } catch (\Throwable $e) {
            // Log error
            \Log::error('Helper get_image_position_detail error: ' . $e->getMessage());

            return false;
        }
    }
}


if (!function_exists('get_messure_images')) {
    function get_messure_images($masseur, $position)
    {
        $image = "";

        if (!$masseur || !$position)
            return false;

        $relativePath   =  $masseur->getImagePosition($position, $masseur->id);
        $currentImage   = asset($relativePath);

        if (str_contains($currentImage, 'mcc-default-thumbnail.png')) {
            $image = false;
        } else {
            if ($currentImage != "" && is_file(public_path($relativePath)))
                $image  = $currentImage;
            else
                $image  = false;
        }
        return  $image;
    }
}


function get_messure_images_details($masseur, $position)
{
    if (!$masseur || !$position) return false;

    return $masseur->getImageDetailsByPosition($position, $masseur->id);
}


if (!function_exists('getStateIdByCityId')) {
    function getStateIdByCityId($states, $cityId)
    {
        foreach ($states as $stateId => $stateData) {
            if (isset($stateData['cities'][$cityId])) {
                return $stateId;
            }
        }
        return null; // agar city na mile
    }
}


if (!function_exists('massage_profile_complete_status')) {
    function massage_profile_complete_status($massage_id)
    {

        try {
            $massage = MassageProfile::where([
                'id' => $massage_id,
                'default_setting' => '1'
            ])->first();

            if (!$massage) {
                return false;
            }

            $fields = [
                $massage->ambiance,
                $massage->parking,
                $massage->entry,
                $massage->building,
                $massage->furniture_types,
                $massage->shower,
                $massage->security,
                $massage->payment,
                $massage->loyalty,
                $massage->language,
                $massage->social_links
            ];

            $is_complete = 1;

            foreach ($fields as $field) {
                if (empty($field)) {
                    $is_complete = 0;
                    break;
                }
            }


            $rate_count = MassageRate::where('massage_profile_id', $massage_id)->count();
            $services_count =  MassageService::where('massage_profile_id', $massage_id)->count();
            $availability_count =  MassageAvailability::where('massage_profile_id', $massage_id)->count();

            if ($rate_count < 6   || !$services_count || !$availability_count) {
                Log::info('$is_complete=======' . $is_complete);
                $is_complete = 0;
            }

            $massage->is_profile_complete = $is_complete;
            $massage->save();
        } catch (Exception $e) {
            return false;
        }
    }
}

if (!function_exists('getUserTypeById')) {
    function getUserTypeById($value)
    {
        switch ($value) {
            case 0:
                return 'User';
                break;

            case 1:
                return "Admin";
                break;

            case 2:
                return "Sub-Admin";
                break;

            case 3:
                return "Escort";
                break;

            case 4:
                return "Massage-Center";
                break;

            case 5:
                return "Agents";
                break;
            case 6:
                return "Staff";
                break;
            case 7:
                return "Operator";
                break;
            case 9:
                return "Operator-Staff";
                break;
        }
    }
}


if (!function_exists('get_social_links')) {
    function get_social_links($user_id)
    {
        $user = MassageProfile::where('user_id', $user_id)->where('default_setting', 1)->first();
        if ($user) {
            if ($user->social_links != "")
                return $user->social_links;
        } else
            return [];
    }
}


if (!function_exists('find_massage_default_duration')) {
    function find_massage_default_duration($massage_id)
    {

        $massage = MassageProfile::where('user_id', $massage_id)
            ->where('default_setting', 1)
            ->first();

        $durations = optional($massage)->durations ?? collect();

        $result = [
            'massage_price' => $durations->map(function ($item) {
                return data_get($item, 'pivot.massage_price');
            })->filter()->values()->toArray(),

            'incall_price' => $durations->map(function ($item) {
                return data_get($item, 'pivot.incall_price');
            })->filter()->values()->toArray(),

            'outcall_price' => $durations->map(function ($item) {
                return data_get($item, 'pivot.outcall_price');
            })->filter()->values()->toArray(),
        ];

        return $result;
    }
}

if (!function_exists('isPriceValid')) {
    function isPriceValid($array)
    {
        // check empty array
        if (empty($array)) {
            return false;
        }

        foreach ($array as $value) {
            if ($value === 0 || $value === null) {
                return false;
            }
        }

        return true;
    }
}

if (!function_exists('getPurchaseNetAmount')) {
    function getPurchaseNetAmount($id, &$total = 0)
    {
        $purchase = Purchase::find($id);

        if (!$purchase) return;

        $total += $purchase->paid_rate;

        if ($purchase->parent_id) {
            getPurchaseNetAmount($purchase->parent_id, $total);
        }

        return formatCurrency($total);
    }
}


if (!function_exists('make_time_availability')) {
    function make_time_availability($request_data)
    {

        $time = $request_data['time'] ?? [];
        $availability = $request_data['availability_time'] ?? [];

        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

        $result = [];

        foreach ($days as $day) {

            $status = $availability[$day] ?? 'closed';

            $from = $time[$day]['hh_from'] ?? null;
            $to   = $time[$day]['hh_to'] ?? null;


            if ($status === 'closed') {
                $from = null;
                $to   = null;
            }

            if ($status === 'til_late') {
                $to = null;
            }

            if ($status === 'custom') {
                $from = $from ?: null;
                $to   = $to ?: null;
            }

            $result[$day] = [
                'status' => $status,
                'from'   => $from,
                'to'     => $to,
            ];
        }

        return $result;
    }
}



if (!function_exists('get_massage_listed_profile')) {
    function get_massage_listed_profile()
    {
        $isImpersonated = request('isImpersonated');
        $impersonatedId = request('impersonatedId');

        $massage_live_ids  = MassagePurchase::where('status', 'listed')->where('massage_centre_id', auth()->user()->id)->pluck('massage_profile_id');
        if (!empty($massage_live_ids)) {
            $profile = MassageProfile::select('id', 'purchase_id', 'name', 'profile_name', 'business_name')->with('state', 'latestPurchase','latestExtend')->whereIn('id',  $massage_live_ids)->get();
            if ($profile->isNotEmpty()) 
                return $profile;
        }
    }
}


if (!function_exists('getMassageDetail')) {
    function getMassageDetail($id)
    {
        $massage = MassageProfile::where('id', $id)->first();
        return $massage;
    }
}


if (!function_exists('getMassageSuspendRefundAmount')) {
    function getMassageSuspendRefundAmount($profile, $refundStartDate = null, $refundEndDate = null)
    {
        $refundAmount = 0.00;
        $discountDay = 21;
        $discountPercentage = 6;

        $purchase  = MassagePurchase::where('status', 'listed')->where('massage_profile_id', $profile)->first();
        

        $normalRate   = $purchase->rate;
        $discountRate = $purchase->paid_rate;

        $purchaseStart = Carbon::parse($purchase->start_date);
        $purchaseEnd   = Carbon::parse($purchase->end_date);

        $refundStart = Carbon::parse($refundStartDate);
        $refundEnd   = Carbon::parse($refundEndDate);

        // Refund dates should be within purchase dates
        if ($refundStart->lt($purchaseStart) || $refundEnd->gt($purchaseEnd)) {
            return 0;
        }

        $refundAmount = 0;
        $startDayNumber = $purchaseStart->diffInDays($refundStart) + 1;

      
        $refundDays = $refundStart->diffInDays($refundEnd) + 1;

        for ($i = 0; $i < $refundDays; $i++) {

            $currentDay = $startDayNumber + $i;

            if ($currentDay <= $discountDay) {
                $refundAmount += $normalRate;
            } else {
                $discountedRate = $purchase->discount_rate;
                $refundAmount += $discountedRate;
            }
        }

        
        return number_format((float) $refundAmount, 2, '.', '');
       
    }
}


if (!function_exists('getRefundAmountForCancelProfile')) {
    function getRefundAmountForCancelProfile($purchase, $refundStartDate = null, $refundEndDate = null)
    {
        $refundAmount = 0.00;
        $discountDay = 21;
        $discountPercentage = 6;
        

        $normalRate   = $purchase->rate;
        $discountRate = $purchase->paid_rate;

        $purchaseStart = Carbon::parse($purchase->start_date);
        $purchaseEnd   = Carbon::parse($purchase->end_date);

        $refundStart = Carbon::parse($refundStartDate);
        $refundEnd   = Carbon::parse($refundEndDate);

        // Refund dates should be within purchase dates
        if ($refundStart->lt($purchaseStart) || $refundEnd->gt($purchaseEnd)) {
            return 0;
        }

        $refundAmount = 0;
        $startDayNumber = $purchaseStart->diffInDays($refundStart) + 1;

      
        $refundDays = $refundStart->diffInDays($refundEnd) + 1;

        for ($i = 0; $i < $refundDays; $i++) {

            $currentDay = $startDayNumber + $i;

            if ($currentDay <= $discountDay) {
                $refundAmount += $normalRate;
            } else {
                $discountedRate = $purchase->discount_rate;
                $refundAmount += $discountedRate;
            }
        }

        
        return number_format((float) $refundAmount, 2, '.', '');
       
    }
}




if (!function_exists('get_media_by_id')) {
    function get_media_by_id($media_id, $type = 'escort')
    {
        $models = [
            'escort' => \App\Models\EscortMedia::class,
            'center' => \App\Models\MassageMedia::class,
        ];

        if (!isset($models[$type])) {
            return null;
        }

        return $models[$type]::find($media_id);
    }
}

if (!function_exists('get_massage_media_id_by_path')) {

    function get_massage_media_id_by_path($pathOrUrl)
    {
        $media = MassageMedia::where('path', $pathOrUrl)->first();
        return $media ?? null;
    }
}

if (!function_exists('get_escort_media_id_by_path')) {

    function get_escort_media_id_by_path($pathOrUrl)
    {
        $media = EscortMedia::where('path', $pathOrUrl)->first();
        return $media ?? null;
    }
}

if (!function_exists('is_domain_localhost')) {
    function is_domain_localhost()
    {
        if ($_SERVER['SERVER_NAME'] == 'localhost' || $_SERVER['SERVER_NAME'] == '127.0.0.1' || $_SERVER['SERVER_NAME'] == 'e4u.local')
            return true;
        else
            return false;
    }
}


if (!function_exists('account_complete_status')) {
    function account_complete_status()
    {

        try {
            $user = User::where([
                'id' => auth()->user()->id,
            ])->first();

            if (!$user) {
                return false;
            }

            $fields = [
                $user->name,
                $user->business_address,
                $user->business_number,
                $user->phone,
            ];

            $is_complete = 1;

            foreach ($fields as $field) {
                if (empty($field)) {
                    $is_complete = 0;
                    break;
                }
            }

            $user->is_account_completed = $is_complete;
            $user->save();
        } catch (Exception $e) {
            return false;
        }
    }
}


if (!function_exists('update_messure_for_active_listing')) {

    function update_messure_for_active_listing($purchase_id)
    {
        try {

            $purchase  = MassagePurchase::where('status', 'listed')->where('id', $purchase_id)->first();
            $massage  = MassageProfile::where('id', $purchase->massage_profile_id)->first();
            $massagers = $massage->availability->availability_time ? json_decode($massage->availability->availability_time, true) : [];

            $massures_data = Masseur::whereIn('id', function ($query) use ($purchase) {
                $query->select('masseur_profile_id')->from('massager_masseurs')->where('massage_profile_id', $purchase->massage_profile_id);
            })->get();


            $massures = [];
            foreach ($massures_data as $mass) {
                $massures[] = json_decode($mass->availability, true);
                $massures_id[] = $mass->id;
            }

            Log::info('input  massured');
            Log::info($massures);
            // exit;

            if ($massures_data->isNotEmpty()) {

                foreach ($massagers as $day => $info) {

                    if ($info['status'] === 'closed') {

                        foreach ($massures as $index => $schedule) {

                            foreach ($schedule as $mDay => $mInfo) {

                                // match day (case-insensitive)
                                if (strtolower($mDay) === strtolower($day)) {

                                    $massures[$index][$mDay] = [
                                        "status" => "closed",
                                        "from" => null,
                                        "to" => null
                                    ];
                                }
                            }
                        }
                    }

                    if ($info['status'] === 'til_late') {

                        foreach ($massures as $index => $schedule) {
                            foreach ($schedule as $mDay => $mInfo) {
                                if (strtolower($mDay) === strtolower($day)) {
                                    if (isset($massures[$index][$mDay]['status']) && $massures[$index][$mDay]['status'] != "closed") {
                                        $newFromTime =  isset($info['from']) ? strtotime($info['from']) : "";
                                        $oldFromTime =  isset($massures[$index][$mDay]['from']) ? strtotime($massures[$index][$mDay]['from']) : "";

                                        if ($newFromTime && (!$oldFromTime || $newFromTime > $oldFromTime))
                                            $massures[$index][$mDay]['from'] = $info['from'];
                                    }
                                }
                            }
                        }
                    }

                    if ($info['status'] === 'custom') {
                        foreach ($massures as $index => $schedule) {
                            foreach ($schedule as $mDay => $mInfo) {
                                if (strtolower($mDay) === strtolower($day)) {

                                    $newfrom  = isset($info['from']) ? $info['from'] : "";
                                    $newto  = isset($info['to']) ? $info['to'] : "";

                                    $newFromTime =  isset($info['from']) ? strtotime($info['from']) : "";
                                    $oldFromTime =  isset($massures[$index][$mDay]['from']) ? strtotime($massures[$index][$mDay]['from']) : "";

                                    $newToTime =  isset($info['to']) ? strtotime($info['to']) : "";
                                    $oldToTime =  isset($massures[$index][$mDay]['to']) ? strtotime($massures[$index][$mDay]['to']) : "";

                                    if ($newFromTime && (!$oldFromTime || $newFromTime > $oldFromTime))
                                        $massures[$index][$mDay]['from'] = $newfrom;

                                    if ($newToTime && (!$oldToTime || $newToTime < $oldToTime))
                                        $massures[$index][$mDay]['to'] = $newto;
                                }
                            }
                        }
                    }
                }

                Log::Info('updated massures');
                Log::Info($massures);
                //  $mass->availability  = json_encode($massures);
                //  $mass->save();

                for ($i = 0; $i < count($massures_id); $i++) {
                    $availability  = json_encode($massures[$i]);
                    Masseur::where('id', $massures_id[$i])->update(['availability' => $availability]);
                }
            }



            //  Log::info('massage========>');
            //  Log::info($massage);


            //  Log::info('massures========>');
            //  Log::info($massures);


            // if(empty($massage) || (empty($massures))) 
            // return false;


            // foreach ($massagers as $day => $info) 
            // {

            //     if ($info['status'] === 'closed') 
            //     {

            //         foreach ($massures as $index => $schedule) {

            //             foreach ($schedule as $mDay => $mInfo) {

            //                 // match day (case-insensitive)
            //                 if (strtolower($mDay) === strtolower($day)) {

            //                     $massures[$index][$mDay] = [
            //                         "status" => "closed",
            //                         "from" => null,
            //                         "to" => null
            //                     ];
            //                 }
            //             }
            //         }
            //     }

            //     if ($info['status'] === 'til_late') 
            //     {

            //         foreach ($massures as $index => $schedule) {
            //             foreach ($schedule as $mDay => $mInfo) {
            //                 if (strtolower($mDay) === strtolower($day)) 
            //                 {
            //                     if(isset($massures[$index][$mDay]['status']) && $massures[$index][$mDay]['status']!="closed")
            //                     {
            //                         $newFromTime =  isset($info['from']) ? strtotime($info['from']) : "";
            //                         $oldFromTime =  isset($massures[$index][$mDay]['from']) ? strtotime($massures[$index][$mDay]['from']) : "";

            //                             if ($newFromTime && (!$oldFromTime || $newFromTime > $oldFromTime)) 
            //                             $massures[$index][$mDay]['from'] = $info['from'];

            //                     }
            //                 }
            //             }
            //         }
            //     }

            //     if ($info['status'] === 'custom') 
            //     {
            //         foreach ($massures as $index => $schedule) {
            //             foreach ($schedule as $mDay => $mInfo) {
            //                 if (strtolower($mDay) === strtolower($day)) 
            //                 {

            //                     $newfrom  = isset($info['from']) ? $info['from'] : "";
            //                     $newto  = isset($info['to']) ? $info['to'] : "";

            //                     $newFromTime =  isset($info['from']) ? strtotime($info['from']) : "";
            //                     $oldFromTime =  isset($massures[$index][$mDay]['from']) ? strtotime($massures[$index][$mDay]['from']) : "";

            //                     $newToTime =  isset($info['to']) ? strtotime($info['to']) : "";
            //                     $oldToTime =  isset($massures[$index][$mDay]['to']) ? strtotime($massures[$index][$mDay]['to']) : "";

            //                     if ($newFromTime && (!$oldFromTime || $newFromTime > $oldFromTime)) 
            //                     $massures[$index][$mDay]['from'] = $newfrom;

            //                     if ($newToTime && (!$oldToTime || $newToTime < $oldToTime)) 
            //                     $massures[$index][$mDay]['to'] = $newto;

            //                 }
            //             }
            //         }
            //     }

            // }

            Log::info('update_messure_for_active_listing_called');
        } catch (Exception $e) {
            Log::info($e->getMessage());
        }
    }
}


if (!function_exists('update_all_default_massures')) {
    function update_all_default_massures($massagers, $massures)
    {

        foreach ($massagers as $day => $info) {

            if ($info['status'] === 'closed') {
                foreach ($massures as $mDay => $mInfo) {
                    if (strtolower($mDay) === strtolower($day)) {
                        $massures[$mDay] = [
                            "status" => "closed",
                            "from" => null,
                            "to" => null
                        ];
                    }
                }
            }


            if ($info['status'] === 'til_late') {
                foreach ($massures as $mDay => $mInfo) {
                    if (strtolower($mDay) === strtolower($day)) {
                        if (isset($massures[$mDay]['status']) && $massures[$mDay]['status'] != "closed") {
                            $newFromTime =  isset($info['from']) ? strtotime($info['from']) : "";
                            $oldFromTime =  isset($massures[$mDay]['from']) ? strtotime($massures[$mDay]['from']) : "";

                            if ($newFromTime && (!$oldFromTime || $newFromTime > $oldFromTime))
                                $massures[$mDay]['from'] = $info['from'];
                        }
                    }
                }
            }

            if ($info['status'] === 'custom') {

                foreach ($massures as $mDay => $mInfo) {
                    if (strtolower($mDay) === strtolower($day)) {

                        $newfrom  = isset($info['from']) ? $info['from'] : "";
                        $newto  = isset($info['to']) ? $info['to'] : "";

                        $newFromTime =  isset($info['from']) ? strtotime($info['from']) : "";
                        $oldFromTime =  isset($massures[$mDay]['from']) ? strtotime($massures[$mDay]['from']) : "";

                        $newToTime =  isset($info['to']) ? strtotime($info['to']) : "";
                        $oldToTime =  isset($massures[$mDay]['to']) ? strtotime($massures[$mDay]['to']) : "";

                        if ($newFromTime && (!$oldFromTime || $newFromTime > $oldFromTime))
                            $massures[$mDay]['from'] = $newfrom;

                        if ($newToTime && (!$oldToTime || $newToTime < $oldToTime))
                            $massures[$mDay]['to'] = $newto;
                    }
                }
            }
        }

        return $massures;
    }
}


if (!function_exists('update_profile_massure')) {
    function update_profile_massure($massage_profile_id, $masseurIds)
    {

        ################# Update All Massures ################
        $massage_profile = MassageProfile::where('id', $massage_profile_id)->first();
        $massagers_open_time = $massage_profile->availability ? json_decode($massage_profile->availability->availability_time, true) : [];
        $masseurs = Masseur::whereIn('id', $masseurIds)->get();
        foreach ($masseurs as  $masseur) {
            $masseur_availability = json_decode($masseur->availability, true);
            if (!empty($masseur_availability)) {
                $updated_avail = update_all_default_massures($massagers_open_time, $masseur_availability);
                if (!empty($updated_avail)) {
                    $new_availability_Json = json_encode($updated_avail);
                    $masseur->availability = $new_availability_Json;
                    $masseur->save();
                }
            }
        }
        ################## End Update All Massures ##################

    }



    function getMediaVerificationDataSmallIcon( $status)
    {
        switch ($status) {
            case 0:
                $icon  = asset('assets/app/img/pending_icon/e4u_pending-icon_REV.png');
                $label = 'Media Pending';
                break;

            case 1:
                $icon  = asset('assets/app/img/verify/verified_icon.png');
                $label = 'Media Verified';
                break;

            case 2:
                $icon  = asset('assets/app/img/verify/unverified_icon.png');
                $label = 'Media Unverified';
                break;

            default:
                $icon  = '';
                $label = '';
        }

        return [
            'icon'          => $icon,
            'label'         => $label,
        ];
    }



    function getMediaVerificationDataBigIcon($status)
    {
        switch ($status) {
            case 0:
                $icon  = asset('assets/app/img/verify/pending-lg.png');
                $label = 'Media Pending';
                break;

            case 1:
                $icon  = asset('assets/app/img/verify/verified-lg.png');
                $label = 'Media Verified';
                break;

            case 2:
            default:
                $icon  = asset('assets/app/img/verify/unverified-lg.png');
                $label = 'Media Unverified';
                break;
        }

        return [
            'icon'  => $icon,
            'label' => $label,
        ];
    }
}


if (!function_exists('formatIndianNumber')) {
    function formatIndianNumber($value)
    {
        if (empty($value)) return '0.00';

        $value = str_replace(',', '', (string)$value);

        // Check if valid number
        if (!is_numeric($value)) return $value;

        $parts = explode('.', $value);
        $integerPart = $parts[0];
        $decimalPart = isset($parts[1]) ? '.' . $parts[1] : '';

        // Last 3 digits
        $lastThree = substr($integerPart, -3);
        $otherNumbers = substr($integerPart, 0, -3);

        if ($otherNumbers !== '') {
            $lastThree = ',' . $lastThree;
        }

        $formatted = preg_replace('/\B(?=(\d{2})+(?!\d))/', ',', $otherNumbers) . $lastThree;

        return $formatted . $decimalPart;
    }


    if (!function_exists('get_profile_verification_status')) {
        function get_profile_verification_status($profileId)
        {
            return DB::table('profile_verification_status')
                ->where('profile_id', $profileId)
                ->value('status') ?? '0'; // default Pending
        }
    }

    if (!function_exists('get_masseur_data_by_id')) {
        function get_masseur_data_by_id($masseur_id)
        {
            return Masseur::findOrFail($masseur_id);
        }
    }
}

function getPlaceId($address)
{
    $apiKey = config('services.google_map.api_key');

    $response = Http::get('https://maps.googleapis.com/maps/api/place/findplacefromtext/json', [
        'input' => $address,
        'inputtype' => 'textquery',
        'fields' => 'place_id',
        'key' => $apiKey,
    ]);

    if ($response->successful()) {
        return $response['candidates'][0]['place_id'] ?? null;
    }

    return null;
}


if (!function_exists('get_massage_parent_data')) {
    function get_massage_parent_data($user_id)
    {
        $user = User::where('id', $user_id)->first();
        if ($user)
            return $user;
        else
            return false;
    }
}


if (!function_exists('canManage')) {

    function canManage()
    {
        return auth()->check()
            && auth()->user()->can_manage();
    }
}


if (!function_exists('additional_information')) {
    function additional_information($user_id, $type, $value = null)
    {
        if ($value) {
            return EscortAdditionalInformation::where('user_id', $user_id)
                ->where('type', $type)
                ->where('make_default', 1)
                ->value('value') ?? '';
        } else {
            return EscortAdditionalInformation::where('user_id', $user_id)
                ->where('type', $type)
                ->where('make_default', 1)
                ->value('short_desc') ?? '';
        }
    }
}

if (!function_exists('is_parent_massage_user_switch')) {
    function is_parent_massage_user_switch()
    {
        if (session()->has('parent_massage_id') && session('switch_for') == 'massage_to_massage' && session('is_impersonated') === true) {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('canManageClass')) {
    function canManageClass()
    {
        return canManage() ? '' : 'hide_element';
    }
}

if (!function_exists('other_centre_support_notification_count'))
{
    function other_centre_support_notification_count()
    {
        $userIds = User::where('created_by', auth()->id())
                    ->where('type', '4')
                    ->pluck('id');
       
        if(!empty($userIds))  
        {
            return Notification::where('is_seen', 0)
            ->whereIn('to_user', $userIds)
            ->where('notification_listing_type', '1')
            ->count();
        }
       
        return 0;  
    }
}

if (!function_exists('formatToFloat'))
{
    function formatToFloat($value) {
    
        if (empty($value)) {
            return 0.00;
        }
        
        if (is_string($value)) {
            $value = str_replace(',', '', $value);
        }
        
        return number_format((float)$value, 2, '.', '');
    }
}
if (!function_exists('getStarRatingForEscort')) {
    function getStarRatingForEscort(int $escortId): int
    {
        $total = \App\Models\EscortLike::where('escort_id', $escortId)->count();

        if ($total === 0) {
            return 0;
        }

        $likeCount = \App\Models\EscortLike::where('escort_id', $escortId)
            ->where('like', 1)
            ->count();

        $lp = round(($likeCount / $total) * 100);

        if ($lp == 100) {
            return 5;
        } elseif ($lp > 80) {
            return 4;
        } elseif ($lp > 60) {
            return 3;
        } elseif ($lp > 40) {
            return 2;
        } elseif ($lp > 20) {
            return 1;
        }

        return 0;
    }
}

if (!function_exists('getDashboardUrl')) {
    function getDashboardUrl($userType = 0)
    {
        $url = "";
        $userType = (int)($userType);
        if($userType == 0) {
            $url = "user-dashboard";
        } else if($userType == 1) {
             $url = "admin-dashboard/dashboard";
        } else if($userType == 2) {
             $url = "admin-dashboard/dashboard";
        } else if($userType == 3) {
             $url = "escort-dashboard";
        } else if($userType == 4) {
             $url = "center-dashboard";
        } else if($userType == 5) {
             $url = "agent-dashboard";
        } else if($userType == 6) {
             $url = "staff-dashboard";
        } else if($userType == 7) {
             $url = "operator-dashboard";
        } else if($userType == 8) {
             $url = "shareholder-dashboard";
        } else if($userType == 9) {
             $url = "operator-dashboard";
        } else if($userType == 10) {
             $url = "supplier-dashboard";
        } else {
             $url = "user-dashboard";
        }

        return $url;
    }
}
