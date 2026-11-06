<?php

namespace App\Services;

use App\Models\Escort;
use App\Models\MassageProfile;
use App\Models\MyLegbox;
use App\Models\MyMassageLegbox;
use App\Models\ReportEscortProfile;
use App\Models\Reviews;
use App\Models\SocialMediaVisitor;
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


    public function getProfileViews($advertiserType, $profile_id)
    {

        if ($advertiserType == 'massage') {
            $page = 'massage-detail-page';
            $profile     = MassageProfile::where('id', $profile_id)->first();
            $legboxModel = MyMassageLegbox::where('massage_id', $profile_id);
            $socialMediaModel = SocialMediaVisitor::where('listing_profile_id', $profile_id)->where('page', $page);
            $reviewModel = Reviews::where('advertiser_id', $profile_id)->where('advertiser_type', 'massage');
            $reportModel = ReportEscortProfile::where('advertiser_id', $profile_id)->where('advertiser_type', 'massage');
        } else {
            $page = 'escort-detail-page';
            $profile     = Escort::where('id', $profile_id)->first();
            $legboxModel = MyLegbox::where('escort_id', $profile_id);
            $reviewModel = Reviews::where('advertiser_id', $profile_id)->where('advertiser_type', 'escort');
            $reportModel = ReportEscortProfile::where('advertiser_id', $profile_id)->where('advertiser_type', 'escort');
            $socialMediaModel = SocialMediaVisitor::where('listing_profile_id', $profile_id)->where('page', $page);
        }


        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek   = Carbon::now()->endOfWeek();
        $startOfYear = Carbon::now()->startOfYear();
        $endOfDay    = Carbon::now()->endOfDay();

        // Log::info($startOfYear);
        // Log::info($endOfDay);


        $thisWeekVisitor = Visitor::where('listing_profile_id', $profile_id)
            ->where('page', $page)
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek]);

        $ytdVisitor = Visitor::where('listing_profile_id', $profile_id)
            ->where('page', $page)
            ->whereBetween('created_at', [$startOfYear, $endOfDay]);


        return [
            'member_id' => ($profile->user->member_id) ? $profile->user->member_id : '',
            'this_week' => [
                'profile_views' => (clone $thisWeekVisitor)->where('is_profile_media_visit', '0')->count(),
                'media_views'   => (clone $thisWeekVisitor)->where('is_profile_media_visit', '1')->count(),
                'legbox_count'  => (clone $legboxModel)->whereBetween('created_at', [$startOfWeek, $endOfWeek])->count(),
                'review_count'  => (clone $reviewModel)->whereBetween('created_at', [$startOfWeek, $endOfWeek])->count(),
                'report_count'  => (clone $reportModel)->whereBetween('created_at', [$startOfWeek, $endOfWeek])->count(),
                'social_media_count'  => (clone $socialMediaModel)->whereBetween('created_at', [$startOfWeek, $endOfWeek])->count(),
            ],

            'year_to_date' => [
                'profile_views' => (clone $ytdVisitor)->where('is_profile_media_visit', '0')->count(),
                'media_views'   => (clone $ytdVisitor)->where('is_profile_media_visit', '1')->count(),
                'legbox_count'  => (clone $legboxModel)->whereBetween('created_at', [$startOfYear, $endOfDay])->count(),
                'review_count'  => (clone $reviewModel)->whereBetween('created_at', [$startOfYear, $endOfDay])->count(),
                'report_count'  => (clone $reportModel)->whereBetween('created_at', [$startOfYear, $endOfDay])->count(),
                'social_media_count'  => (clone $socialMediaModel)->whereBetween('created_at', [$startOfYear, $endOfDay])->count(),
            ],
        ];
    }


    public  function make_massage_profile_visit_log($request)
    {
        try {
            $data = $this->getVisitorCountry();
            $type = isset($request['type']) ? $request['type'] : '';
            $listing_profile_id = isset($request['profile_id']) ? $request['profile_id'] : '';
            $visitorUuid = isset($request['visitorUuid']) ? $request['visitorUuid'] : '';
            $is_profile_media_visit = isset($request['is_profile_media_visit']) ? $request['is_profile_media_visit'] : '0';

            if ($type == 'massage')
                $page = 'massage-detail-page';
            else
                $page = 'escort-detail-page';

            if ($data && $listing_profile_id != "" && $visitorUuid != "") {
                $now = Carbon::now(config('app.escort_server_timezone'));

                if ($listing_profile_id != "" && $is_profile_media_visit == '0') {
                    $query = Visitor::where('page', $page)
                        ->where('listing_profile_id', $listing_profile_id)
                        ->where('visitorUuid', $visitorUuid)
                        ->where('created_at', '>=', $now->copy()->subDay());
                }

                if ($listing_profile_id != "" && $is_profile_media_visit == '1') {
                    $query = Visitor::where('page', $page)
                        ->where('listing_profile_id', $listing_profile_id)
                        ->where('is_profile_media_visit', $is_profile_media_visit)
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
                    'listing_profile_id' => $listing_profile_id,
                    115
                ];

                if ($is_profile_media_visit == '1')
                    $datas['is_profile_media_visit'] = '1';

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


    public  function make_social_media_log($request)
    {
        try {
            $data = $this->getVisitorCountry();
            $type = isset($request['type']) ? $request['type'] : '';
            $listing_profile_id = isset($request['profile_id']) ? $request['profile_id'] : '';
            $visitorUuid = isset($request['visitorUuid']) ? $request['visitorUuid'] : '';
            $social_link = isset($request['social_link']) ? $request['social_link'] : '0';

            if ($type == 'massage')
                $page = 'massage-detail-page';
            else
                $page = 'escort-detail-page';

            if ($data && $listing_profile_id != "" && $visitorUuid != "") {
                $now = Carbon::now(config('app.escort_server_timezone'));
                $query = SocialMediaVisitor::where('page', $page)
                    ->where('listing_profile_id', $listing_profile_id)
                    ->where('visitorUuid', $visitorUuid)
                    ->where('social_link', $social_link)
                    ->where('created_at', '>=', $now->copy()->subDay());


                if (auth()->check()) {
                    $query->where('user_id', auth()->id());
                } else {
                    $query->whereNull('user_id');
                }

                $visitor =    $query->latest('created_at')->first();
                $socialMediaType = $this->getSocialMediaPlatform($social_link);

                $datas = [
                    'page'       => $page,
                    'social_link' => $social_link,
                    'social_media_type' => $socialMediaType,
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
                    'listing_profile_id' => $listing_profile_id,
                ];


                if ($visitor) {
                    $visitor->update($datas);
                } else {
                    $visitor =  SocialMediaVisitor::create(array_merge($datas, [
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

    function getSocialMediaPlatform($url)
    {
        $host = strtolower(parse_url($url, PHP_URL_HOST) ?? '');

        if (str_contains($host, 'facebook.com')) {
            return 'facebook';
        } elseif (str_contains($host, 'instagram.com')) {
            return 'instagram';
        } elseif (
            str_contains($host, 'twitter.com') ||
            str_contains($host, 'x.com')
        ) {
            return 'twitter';
        }

        return $host;
    }

    public function getSocialMediaViews($advertiserType, $adevertiserId)
    {
        if ($advertiserType == 'massage') {
            $page = 'massage-detail-page';
            ///$profile = MassageProfile::where('user_id', $adevertiserId);
            //$socialMediaModel = SocialMediaVisitor::where('listing_profile_id', $adevertiserId)->where('page', $page);
            $visitors = SocialMediaVisitor::whereHas('massgeSocialMediaViews', function ($query) use ($adevertiserId) {
                $query->where('user_id', $adevertiserId);
            })->get();
        } else {
            $page = 'escort-detail-page';
            //$profile = Escort::where('user_id', $adevertiserId);
            //$socialMediaModel = SocialMediaVisitor::where('listing_profile_id', $adevertiserId)->where('page', $page);
            $visitors = SocialMediaVisitor::whereHas('escortSocialMediaViews', function ($query) use ($adevertiserId) {
                $query->where('user_id', $adevertiserId);
            })->get();
        }

        $startOfToday = Carbon::today()->format("Y-m-d 00:00:00");
        $endOfToday = Carbon::today()->format("Y-m-d 23:59:59");
        $startOfWeek = Carbon::now()->startOfWeek()->format("Y-m-d 00:00:00");
        $endOfWeek = Carbon::now()->endOfWeek()->format("Y-m-d 23:59:59");
        $monthStart = Carbon::now()->startOfMonth()->format("Y-m-d 00:00:00");
        $monthEnd = Carbon::now()->endOfMonth()->format("Y-m-d 23:59:59");;
        $startOfYear = Carbon::now()->startOfYear()->format("Y-m-d 00:00:00");;
        $endOfDay = Carbon::now()->endOfYear()->format("Y-m-d 23:59:59");;

        return [
            'today' => [
                'social_media_twitter_count' => number_format((clone $visitors)->whereBetween('created_at', [$startOfToday, $endOfToday])->where('social_media_type', 'twitter')->count()),
                'social_media_facebook_count' => number_format((clone $visitors)->whereBetween('created_at', [$startOfToday, $endOfToday])->where('social_media_type', 'facebook')->count()),
                'social_media_instagram_count' => number_format((clone $visitors)->whereBetween('created_at', [$startOfToday, $endOfToday])->where('social_media_type', 'instagram')->count()),
                'social_media_count' => number_format((clone $visitors)->whereBetween('created_at', [$startOfToday, $endOfToday])->count()),
            ],
            'this_week' => [
                'social_media_twitter_count' => number_format((clone $visitors)->whereBetween('created_at', [$startOfWeek, $endOfWeek])->where('social_media_type', 'twitter')->count()),
                'social_media_facebook_count' => number_format((clone $visitors)->whereBetween('created_at', [$startOfWeek, $endOfWeek])->where('social_media_type', 'facebook')->count()),
                'social_media_instagram_count' => number_format((clone $visitors)->whereBetween('created_at', [$startOfWeek, $endOfWeek])->where('social_media_type', 'instagram')->count()),
                'social_media_count' => number_format((clone $visitors)->whereBetween('created_at', [$startOfWeek, $endOfWeek])->count()),
            ],
            'year_to_date' => [
                'social_media_twitter_count' => number_format((clone $visitors)->whereBetween('created_at', [$startOfYear, $endOfDay])->where('social_media_type', 'twitter')->count()),
                'social_media_facebook_count' => number_format((clone $visitors)->whereBetween('created_at', [$startOfYear, $endOfDay])->where('social_media_type', 'facebook')->count()),
                'social_media_instagram_count' => number_format((clone $visitors)->whereBetween('created_at', [$startOfYear, $endOfDay])->where('social_media_type', 'instagram')->count()),
                'social_media_count' => number_format((clone $visitors)->whereBetween('created_at', [$startOfYear, $endOfDay])->count()),
            ],
        ];
    }

    public function getReviewsrecommendationsCount($advertiserType, $advertiserId = 0)
    {
        if ($advertiserType == 'massage') {
            $reviewModel = Reviews::where('advertiser_type', 'massage')->whereHas('massage', function ($query) use ($advertiserId) {
                $query->where('user_id', $advertiserId);
            });
        } else {
            $reviewModel = Reviews::where('advertiser_type', 'escort')->whereHas('escort', function ($query) use ($advertiserId) {
                $query->where('user_id', $advertiserId);
            });
        }

        $startOfToday = Carbon::today()->format("Y-m-d 00:00:00");
        $endOfToday = Carbon::today()->format("Y-m-d 23:59:59");
        $startOfWeek = Carbon::now()->startOfWeek()->format("Y-m-d 00:00:00");
        $endOfWeek = Carbon::now()->endOfWeek()->format("Y-m-d 23:59:59");
        $monthStart = Carbon::now()->startOfMonth()->format("Y-m-d 00:00:00");
        $monthEnd = Carbon::now()->endOfMonth()->format("Y-m-d 23:59:59");;
        $startOfYear = Carbon::now()->startOfYear()->format("Y-m-d 00:00:00");
        $endOfDay = Carbon::now()->endOfYear()->format("Y-m-d 23:59:59");

        return [
            'today' => [
                'review_count'  => (clone $reviewModel)->whereBetween('created_at', [$startOfToday, $endOfToday])->count(),
                'recommendation_count'  => 0,
            ],
            'this_week' => [
                'review_count'  => (clone $reviewModel)->whereBetween('created_at', [$startOfWeek, $endOfWeek])->count(),
                'recommendation_count'  => 0,
            ],
            'year_to_date' => [
                'review_count'  => (clone $reviewModel)->whereBetween('created_at', [$startOfYear, $endOfDay])->count(),
                'recommendation_count'  => 0,
            ],
        ];
    }

    public function getCriticalInformation($advertiserType, $advertiserId = 0)
    {
        if ($advertiserType == 'massage') {
            $currentlyPostedProfilesCount = MassageProfile::where('user_id', $advertiserId)
                ->where('default_setting', 0)
                ->whereHas('purchase', fn($q) => $q->where('status', 'listed'))
                ->count();

            $upcomingProfilesCount = MassageProfile::where('user_id', $advertiserId)
                ->where('default_setting', 0)
                ->whereHas('purchase', fn($q) => $q->where('status', 'pending'))
                ->count();
        } else {
            $currentlyPostedProfilesCount = Escort::where('user_id', $advertiserId)
                ->where('default_setting', 0)
                ->whereHas('purchase', fn($q) => $q->where('status', 'listed'))
                ->count();

            $upcomingProfilesCount = Escort::where('user_id', $advertiserId)
                ->where('default_setting', 0)
                ->whereHas('purchase', fn($q) => $q->where('status', 'pending'))
                ->count();
        }
        $playboxSubscriptionsCount = 0;

        return [
            'currentlyPostedProfilesCount' => $currentlyPostedProfilesCount,
            'upcomingProfilesCount' =>  $upcomingProfilesCount,
            'playboxSubscriptionsCount' => $playboxSubscriptionsCount
        ];
    }
                                                
    public function getAdvertisersProfileViews($advertiserType, $advertiserId = 0)
    {
        if ($advertiserType == 'massage') {
            $page = 'massage-detail-page';
            $relationTo = 'massage';
        } else {
            $page = 'escort-detail-page';
            $relationTo = 'escorts';
        }
        $startOfToday = Carbon::today()->format("Y-m-d 00:00:00");
        $endOfToday = Carbon::today()->format("Y-m-d 23:59:59");
        $startOfWeek = Carbon::now()->startOfWeek()->format("Y-m-d 00:00:00");
        $endOfWeek = Carbon::now()->endOfWeek()->format("Y-m-d 23:59:59");
        $monthStart = Carbon::now()->startOfMonth()->format("Y-m-d 00:00:00");
        $monthEnd = Carbon::now()->endOfMonth()->format("Y-m-d 23:59:59");;
        $startOfYear = Carbon::now()->startOfYear()->format("Y-m-d 00:00:00");
        $endOfDay = Carbon::now()->endOfYear()->format("Y-m-d 23:59:59");

        $visitors = Visitor::whereHas($relationTo, function ($query) use ($advertiserId) {
            $query->where('user_id', $advertiserId);
        });

        $todayVisitor = $visitors->where('page', $page)->whereBetween('created_at', [$startOfToday, $endOfToday]);
        $thisWeekVisitor = $visitors->where('page', $page)->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
        $ytdVisitor = $visitors->where('page', $page)->whereBetween('created_at', [$startOfYear, $endOfDay]);

        return [
            'today' => [
                'profile_views' => (clone $thisWeekVisitor)->where('is_profile_media_visit', '0')->count(),
                'media_views'   => (clone $thisWeekVisitor)->where('is_profile_media_visit', '1')->count(),
            ],
            'this_week' => [
                'profile_views' => (clone $thisWeekVisitor)->where('is_profile_media_visit', '0')->count(),
                'media_views'   => (clone $thisWeekVisitor)->where('is_profile_media_visit', '1')->count(),
            ],
            'year_to_date' => [
                'profile_views' => (clone $ytdVisitor)->where('is_profile_media_visit', '0')->count(),
                'media_views'   => (clone $ytdVisitor)->where('is_profile_media_visit', '1')->count(),
            ],
        ];
    }
}
