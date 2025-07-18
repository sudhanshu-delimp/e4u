<?php

/**
 * Custom helper functions
 */

use App\Models\Escort;
use App\Models\Country;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

if (!function_exists('calculateTatalFee')) {
    /**
     * Calculate the fee
     * 
     * @param integer $plan
     * @param integer $days
     * @return array
     */
    function calculateTatalFee($plan, $days)
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
            //return redirect()->route('escort.setting.profile',$id);
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
if (!function_exists('formatIndianCurrency')) {
    /**
     * Format the amount
     */
    function formatIndianCurrency($amount)
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
        $str .= $days. ' days & '.$hours .' hours ' .$minutes. ' minutes';

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

        $planInfo = [1 => "Platinum", 2=>"Gold", 3=>"Silver", 4=>"Free",5=>"massage"];

        $dis_rate = 0;
        if($plan == 1 ) {
            $actual_rate = 8;
            if($days <= 21) {
                $rate = 8;
            } else {
                $rate = 7.5;
                $dis_rate = 0.5;
            }

        } else if($plan == 2) {
            $actual_rate = 6;
            if($days <= 21) {
                $rate = 6;
            } else {
                $rate = 5.7;
                $dis_rate = 0.3;
            }
        } else if($plan == 3) {
            $actual_rate = 4;
            if($days <= 21) {
                $rate = 4;
            } else {
                $rate = 3.8;
                $dis_rate = 0.2;
            }
        } else if($plan == 5) {
            $actual_rate = 30;
            $rate = 0;
            $dis_rate = 0;

        } else {
            $actual_rate = 0;
            $rate = 0;
            $dis_rate = 0;
        }

        if($days !== null && $days <= 21) {
            //$rate = $days*30/days;
            $total_rate = $days*$rate;
            $total_dis = 0;

        } else {
            $days_21 = 21*$actual_rate;
            $above_day = $days - 21;
            $total_rate = ($above_day*$rate + $days_21);
            $total_dis = $above_day*$dis_rate;
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
        if($escort && $escort->state_id && $escort->city_id){
            $escortTimezone = config('escorts.profile.states')[$escort->state_id]['cities'][$escort->city_id]['timeZone'];
        }

        return $escortTimezone;
    }
}

if (!function_exists('app_date_time_format')) {

     function app_date_time_format($datetime)
     {
        return \Carbon\Carbon::parse($datetime)->format('d M Y, h:i A');
            
     }
     
}

