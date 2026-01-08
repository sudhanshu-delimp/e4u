<?php

/**
 * Custom helper functions
 */

use Carbon\Carbon;
use App\Models\City;
use App\Models\User;
use App\Sms\SendSms;
use App\Models\State;
use App\Models\Escort;
use App\Models\Country;
use App\Mail\LoginOtpMail;
use App\Models\EscortMedia;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\Models\EscortStatistics;
use App\Models\GlobalNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

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
    function calculateTotalFee($membership_id, $days)
    {
        $discount_day = 21;
        $pricing = \App\Models\Pricing::where('membership_id', $membership_id)->first();
        if (!$pricing) {
            return [0, 0, 0];
        }

        $normalRate   = $pricing->price;
        $discountRate = $pricing->discount_amount ?: $normalRate;

        if ($days <= $discount_day) {
            $total_rate     = $days * $normalRate;
            $total_discount = 0;
            return [$total_discount, $total_rate, $total_rate];
        }


        $normalDays   = $discount_day;
        $discountDays = $days - $discount_day;

        if ($pricing->day == 1) {  // frequency 
            $total_rate  = ($normalDays * $normalRate) + ($discountDays * $discountRate);
        } elseif ($pricing->day == 2) {  // frequency 
            $normalWeeks   = ceil($normalDays / 7);
            $discountWeeks = ceil($discountDays / 7);

            $total_rate  = ($normalWeeks * $normalRate) + ($discountWeeks * $discountRate);
        } else {
            $total_rate = ($normalDays * $normalRate) + ($discountDays * $discountRate);
        }

        $total_discount = $discountDays * ($normalRate - $discountRate);

        return [$total_discount, $total_rate, $total_rate];
    }
}

if(!function_exists('getPinupFee')){
    function getPinupFee(){
        $pricing = \App\Models\Pricing::where('membership_id', 6)->first();
        return !empty($pricing) ? $pricing->price : 0;
    }
}

if(!function_exists('getBumpupFee')){
    function getBumpupFee(){
        $pricing = \App\Models\Pricing::where('membership_id', 7)->first();
        return !empty($pricing) ? $pricing->price : 0;
    }
}



if (!function_exists('formatCurrency')) {
    /**
     * Format the amount
     */
    function formatCurrency($amount)
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

        return '$' . $formatted . '.' . $decimalPart;
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
    function staffPageAccessPermission($securityLevel = "0", $pageKey = "sidebar")
    {
        $pageAccess = config('staff.page_access');
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
    function sendLoginOtpEmail($otp, $user)
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

                Mail::send('emails.login_otp', $data, function ($message) use ($user) {
                    $message->to($user->email)
                        ->subject('Login Otp');
                });

                return true;
            } catch (Exception $e) {
                logErrorLocal($e);
            }
        }
    }
}


if (!function_exists('sendLoginOtpSms')) {
    function sendLoginOtpSms($otp, $user)
    {
        log_info('sendLoginOtpSms');
        if (isset($user->phone) && $user->phone != "") {

            if ($user && $user->type == '5')
                $username = $user->business_name;
            else
                $username = $user->name;

            $msg = "Hello " . $username . ", your one-time login OTP is " . $otp . ".If you didn’t request this, please ignore this message.";
            $sendotp = new SendSms();
            $output = $sendotp->send_otp_sms($user->phone, $msg);
        }
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
        if($type !=  null){
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


if(!function_exists('global_notifications')){
    function global_notifications(){
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
