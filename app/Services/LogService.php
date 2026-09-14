<?php

namespace App\Services;

use App\Models\Visitor;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class LogService
{

    public function getUserIp()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            // IP from shared internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            // IP passed from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            // Sometimes multiple IPs are returned, get the first one
            $ip = explode(',', $ip)[0];
        } else {
            // Remote IP
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }


    public function getVisitorCountry()
    {
        $ip = $this->getUserIp();

        // Check if IP and Country are already stored in session
        if (Session::has('visitor_ip') && Session::get('visitor_ip') === $ip && Session::has('visitor_country') && Session::has('visitor_city') && Session::has('visitor_region')) {
            return [Session::get('visitor_country'), Session::get('visitor_state'), Session::get('visitor_city'), Session::get('visitor_region')];
        }
        // If not in session, fetch from API
        $response = Http::get("http://ip-api.com/json/{$ip}");

        $data = $response->json();
        $visitorState = null;
        $visitorCountry = null;
        $visitorCity = null;
        $visitorRegion = null;
        if ($data && isset($data['status']) && $data['status'] === 'success') {
            $visitorCountry = $data['country'];
            $visitorState   = $data['regionName'];
            $visitorCity   = $data['city'];
            $visitorRegion   = $data['region'];

            // Store in session for later use
            Session::put('visitor_ip', $ip);
            Session::put('visitor_country', $visitorCountry);
            Session::put('visitor_state', $visitorState);
            Session::put('visitor_city', $visitorCity);
            Session::put('visitor_region', $visitorRegion);
        }

        return [$visitorCountry, $visitorState, $visitorCity, $visitorRegion];
    }


    public function getBrowser()
    {
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        $browser = "Unknown Browser";

        if (preg_match('/MSIE (\\d+\\.\\d+)/i', $userAgent, $matches)) {
            $browser = "Internet Explorer";
        } elseif (preg_match('/Trident.*rv:(\\d+\\.\\d+)/i', $userAgent, $matches)) {
            $browser = "Internet Explorer";
        } elseif (preg_match('/Edg\\/([0-9\\.]+)/i', $userAgent, $matches)) {
            $browser = "Microsoft Edge";
        } elseif (preg_match('/OPR\\/([0-9\\.]+)/i', $userAgent, $matches)) {
            $browser = "Opera";
        } elseif (preg_match('/Chrome\\/([0-9\\.]+)/i', $userAgent, $matches)) {
            $browser = "Google Chrome";
        } elseif (preg_match('/Safari\\/([0-9\\.]+)/i', $userAgent, $matches)) {
            $browser = "Apple Safari";
        } elseif (preg_match('/Firefox\\/([0-9\\.]+)/i', $userAgent, $matches)) {
            $browser = "Mozilla Firefox";
        }

        return $browser;
    }


    public function getMassageProfileViews()
    {
        
        $baseQuery = Visitor::whereNotNull('massage_profile_id')
            ->where('page', 'massage-detail-page');

        $thisWeekQuery = (clone $baseQuery)
            ->whereBetween('created_at', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek(),
            ]);

        $ytdQuery = (clone $baseQuery)
            ->whereBetween('created_at', [
                Carbon::now()->startOfYear(),
                Carbon::now()->endOfDay(),
            ]);

        return [
            'this_week' => [
                'profile_views' => (clone $thisWeekQuery)
                    ->where('is_massage_profile_media_visit', '0')
                    ->count(),

                'media_views' => (clone $thisWeekQuery)
                    ->where('is_massage_profile_media_visit', '1')
                    ->count(),
            ],

            'year_to_date' => [
                'profile_views' => (clone $ytdQuery)
                    ->where('is_massage_profile_media_visit', '0')
                    ->count(),

                'media_views' => (clone $ytdQuery)
                    ->where('is_massage_profile_media_visit', '1')
                    ->count(),
            ],
        ];
    
    }


    public  function make_massage_profile_visit_log($request)
    {
         try 
         {
            $data = $this->getVisitorCountry();
            $massage_profile_id = isset($request['massage_profile_id']) ? $request['massage_profile_id'] : '';
            $visitorUuid = isset($request['visitorUuid']) ? $request['visitorUuid'] : '';
            $is_massage_profile_media_visit = isset($request['is_massage_profile_media_visit']) ? $request['is_massage_profile_media_visit'] : '0';

            $page = 'massage-detail-page';

            if ($data && $massage_profile_id!="" && $visitorUuid!="") 
            {
                $now = Carbon::now(config('app.escort_server_timezone'));

                if($massage_profile_id!="" && $is_massage_profile_media_visit=='0')
                {
                    $query = Visitor::where('page', $page)
                    ->where('massage_profile_id', $massage_profile_id)
                    ->where('visitorUuid', $visitorUuid)
                    ->where('created_at', '>=', $now->copy()->subDay());
                }

                if($massage_profile_id!="" && $is_massage_profile_media_visit=='1')
                {
                    $query = Visitor::where('page', $page)
                    ->where('massage_profile_id', $massage_profile_id)
                    ->where('is_massage_profile_media_visit', $is_massage_profile_media_visit)
                    ->where('visitorUuid', $visitorUuid)
                    ->where('created_at', '>=', $now->copy()->subDay());
                }
               

                if (auth()->check()) {
                    $query->where('user_id', auth()->id());
                } else {
                    $query->whereNull('user_id');
                }

                $visitor =     $query->latest('created_at')->first();

                $datas = [
                    'page'       => $page,
                    'ip_address' => $this->getUserIp(),
                    'device'     => $this->getBrowser(),
                    'platform'   => $this->getBrowser(),
                    'country'    => $data[0],
                    'city'       => $data[2],
                    'state'      => $data[1],
                    'user_type'  => auth()->check() ? 'user' : 'guest',
                    'user_id'    => auth()->id(),
                    'idle'       => $now->format('Y-m-d h:i:s a'),
                    'origin'     => $this->getVisitorCountry()[0],
                    'date'       => $now,
                    'massage_profile_id' => $massage_profile_id,
                ];

                if($is_massage_profile_media_visit=='1')
                $datas['is_massage_profile_media_visit'] = '1';

                if ($visitor) {
                    $visitor->update($datas);
                } else {
                   $visitor =  Visitor::create(array_merge($datas, [
                        'landed' => $now->format('Y-m-d h:i:s a'),
                        'visitorUuid' => $visitorUuid,
                    ]));
                }

                return $visitor;
            }
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return false;
        }
    }

    
}