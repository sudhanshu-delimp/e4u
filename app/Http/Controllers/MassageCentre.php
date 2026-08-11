<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\AttemptLogin;
use App\Models\MassageLike;
use App\Models\MassageMedia;
use App\Models\MassageProfile;
use App\Models\MassagePurchase;
use App\Models\MassageReviews;
use App\Models\MassagerMasseur;
use App\Models\MassageService;
use App\Models\Masseur;
use App\Models\ReportMassageProfile;
use App\Models\Reviews;
use App\Models\Service;
use App\Models\State;
use App\Models\User;
use App\Repositories\Duration\MassageDurationInterface;
use App\Repositories\MassageProfile\MassageAvailabilityInterface;
use App\Repositories\MassageProfile\MassageProfileInterface;
use App\Repositories\MassageReview\MassageReviewInterface;
use App\Repositories\Message\MessageInterface;
use App\Repositories\Message\MessageMediaInterface;
use App\Repositories\Service\ServiceInterface;
use App\Repositories\Thumbnail\ThumbnailInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\MassageViewerInteractions;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection;

class MassageCentre extends Controller
{

    protected $massage;
    protected $massage_availability;
    protected $service;
    protected $duration;
    protected $user;
    protected $media;
    protected $massage_media;
    protected $massage_profile;
    protected $reviews;
    protected $model_massage_profile;




    public function __construct(MassageReviewInterface $reviews, MassageProfileInterface $massage_profile, MessageInterface $massage, MessageMediaInterface $media, ThumbnailInterface $thumbnail,  ServiceInterface $service, MassageDurationInterface $duration, MassageAvailabilityInterface $massage_availability)
    {
        $this->massage = $massage;
        $this->massage_availability = $massage_availability;
        $this->service = $service;
        $this->duration = $duration;
        $this->media = $media;
        $this->massage_profile = $massage_profile;
        $this->reviews = $reviews;
        $this->model_massage_profile = new MassageProfile;
    }


    public function  massageList()
    {
        $clickTab = 0;
        if (Auth::user() && auth()->user()->type == 0) {
            $clickTab = 1;
        }
        return view('web.mc.massage-centre-list', compact('clickTab'));
    }


    public function get_user_location(Request $request)
    {

        try {
            return $this->getRealTimeGeolocationOfUsers($request->latitude, $request->longitude);
        } catch (Exception $e) {
            return false;
        }
    }

    public function getRealTimeGeolocationOfUsers($lat, $lng)
    {
        try {
            $apiKey = config('services.google_map.api_key');
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

            $stateFromDb = State::where('name', 'like', '%' . $state . '%')->first();
            $stateCapital = config('escorts.profile.states')[$stateFromDb->id] ?? null;

            $parms = [
                'state' => $stateFromDb ? $stateFromDb->id : null,
                'city' => $stateCapital ? array_key_first($stateCapital['cities']) : null,
            ];

            return $parms;
        } catch (\Exception $e) {
            $parms = [
                'state' => null,
                'city' => null,
            ];

            return $parms;
        }
    }



    public function mcAjaxList(Request $request)
    {
       // dd($request->all());
        $per_page = 2;
        $logedInUpser = auth()->user();


        # Not show specific profile to viewer if specific viewer is blocked by Massage
        $blockedProfileForViewersIds = [0];
        if (Auth::user() && auth()->user()->type == 0) {
            $blockedProfileForViewersIds = MassageViewerInteractions::where('viewer_id', Auth::user()->id)->where('massage_blocked_viewer', true)->pluck('massage_id');
            if ($blockedProfileForViewersIds && count($blockedProfileForViewersIds) > 0) {
                //$query = $query->whereNotIn('id', $blockedProfileForViewersIds);
            }
        }


        $massage_live_ids = MassagePurchase::where('status', 'listed')
            ->whereHas('user', function ($q) {
                $q->where('status', 1);
            })
            ->whereNotIn('massage_profile_id', $blockedProfileForViewersIds)
            ->whereDoesntHave('activeSuspendProfile')
            ->pluck('massage_profile_id');




        //$mc_live_list = [153, 154, 156, 157, 159, 162, 161, 164];
        $mc_live_list = $massage_live_ids;
        $mc_user_id = [];
        if (!empty($mc_live_list))
            $mc_user_id   = MassageProfile::whereIn('id', $mc_live_list)->distinct()->pluck('user_id')->toArray();


        $filter_by_location = $request->input('filter_by_location', []);
        $filter_by_feild    = $request->input('filter_by_feild', []);

    
        $massage_users = User::where('type', '4');
        if (!empty($mc_user_id))
            $massage_users = $massage_users->whereIn('id', $mc_user_id);


        $massage = MassageProfile::with('latest_active_brb', 'activeBumpup');
        if (!empty($mc_live_list))
            $massage = $massage->whereIn('id', $mc_live_list);

  

        ######### Upper Filter ##################### 
        if ((!empty($filter_by_location)) || (!empty($filter_by_feild))) {

            if (!empty($mc_live_list)) {

                if (!empty($filter_by_location)) {
                    $location   = $filter_by_location['locationByRadio'] ?? null;
                    $member     = $filter_by_location['by_name_member'] ?? null;
                    $set_lat    = $filter_by_location['set_lat'] ?? null;
                    $set_lng    = $filter_by_location['set_lng'] ?? null;
                    $per_page   = $filter_by_location['per_page'] ?? null;

                    $external_search_ids = [];
                    $massage_centers_ids = [];
                    $matched_ids = [];



                    if ($location == 'your_location' &&  $set_lat != "" &&  $set_lng != "") {
                        $userLocation = $this->getRealTimeGeolocationOfUsers($set_lat, $set_lng);
                        $lat_state = $userLocation['state'];
                        $lng_city = $userLocation['city'];

                        //$lat_state = 4021; // Testing
                        $massage_users = $massage_users->where('state_id', $lat_state);
                        $massage_users = $massage_users->distinct()->pluck('id')->toArray();
                        $external_search = User::where('type', '4');
                        if (!empty($mc_user_id))
                            $external_search = $external_search->whereIn('id', $mc_user_id);


                        if (!empty($member)) {

                            $external_search->where(function ($query) use ($member) {
                                $query->where('member_id', 'like', "%{$member}%");
                            });

                            $external_search_ids = $external_search->distinct()->pluck('id')->toArray();

                            if (!empty($external_search_ids)) {
                                $matched_ids = array_values(array_intersect($external_search_ids, $massage_users));
                            }

                            if (!empty($matched_ids)) {
                                $massage =  $massage->where(function ($query) use ($matched_ids, $member) {
                                    $query->whereIn('user_id', $matched_ids)->where('default_setting', '!=', '1');
                                });
                            } else {
                                $massage =  $massage->where(function ($query) use ($massage_users, $member) {
                                    $query->whereIn('user_id', $massage_users)->where('default_setting', '!=', '1')
                                        ->where('business_name', 'like', "%{$member}%");
                                });
                            }
                        } else {
                            $external_search_ids = $external_search->distinct()->pluck('id')->toArray();
                            if (!empty($external_search_ids)) {
                                $matched_ids = array_values(array_intersect($external_search_ids, $massage_users));
                            }


                            if (!empty($matched_ids)) {
                                $massage =  $massage->where(function ($query) use ($matched_ids, $member) {
                                    $query->whereIn('user_id', $matched_ids)->where('default_setting', '!=', '1');
                                });
                            } else {
                                $massage = $massage->whereRaw('1 = 0');
                            }
                        }
                        
                        } else if ($location == 'australia') {
                        if (!empty($member)) {
                            $massage_users = $massage_users->distinct()->pluck('id')->toArray();
                            $external_search = User::where('type', 5);
                            if (!empty($mc_user_id))
                                $external_search = $external_search->whereIn('id', $mc_user_id);

                            $external_search->where(function ($query) use ($member) {
                                $query->where('member_id', 'like', "%{$member}%");
                            });

                            $external_search_ids = $external_search->distinct()->pluck('id')->toArray();

                            if (!empty($external_search_ids)) {
                                $matched_ids = array_values(array_intersect($external_search_ids, $massage_users));
                            }

                            if (!empty($matched_ids)) {
                                $massage =  $massage->where(function ($query) use ($matched_ids, $member) {
                                    $query->whereIn('user_id', $matched_ids)->where('default_setting', '!=', '1');
                                });
                            } else {
                                $massage =  $massage->where(function ($query) use ($massage_users, $member) {
                                    $query->whereIn('user_id', $massage_users)->where('default_setting', '!=', '1')
                                        ->where('business_name', 'like', "%{$member}%");
                                });
                            }
                        } else {
                            $massage = $massage->where('default_setting', '!=', '1');
                        }
                    } else {
                        $massage = $massage->whereRaw('1 = 0');
                    }
                }

              
                if (!empty($filter_by_feild)) {

                    $profile_state      = $filter_by_feild['profile_state'] ?? null;
                    $profile_city       = $filter_by_feild['profile_city'] ?? null;
                    $masseur_types      = $filter_by_feild['masseur_types'] ?? null;
                    $profile_price      = $filter_by_feild['profile_price'] ?? null;
                    $profile_age        = $filter_by_feild['profile_age'] ?? null;
                    $massage_services   = $filter_by_feild['massage_services'] ?? null;
                    $other_services     = $filter_by_feild['other_services'] ?? null;
                    $verification       = $filter_by_feild['verification'] ?? null;

                    if (!empty($mc_live_list))
                        $massage = $massage->where('default_setting', '!=', '1');

                    if ($profile_city != "") {
                        $state_id = getStateIdByCityId(config('escorts.profile.states'), $profile_city);
                        $massage_users = $massage_users->where('state_id', $state_id);
                        $massage_users = $massage_users->pluck('id')->toArray();
                        $massage_centers_ids = $massage_users;

                        if (empty($massage_centers_ids))
                            $massage = $massage->whereRaw('1 = 0');
                    }

                    if (!empty($massage_centers_ids)) {
                        $massage = $massage->whereIn('user_id', $massage_centers_ids);
                    }


                    if ($profile_age != "") {
                        $masseur_id = [];
                        $massage_id = [];

                        $ages = explode('-', $profile_age);
                        list($min_age, $max_age) = array_map('intval', explode('-', $profile_age));


                        $masseur_id = Masseur::where('age', '>=', $min_age)->where('age', '<=', $max_age)->distinct()->pluck('id')->toArray();


                        if (!empty($masseur_id))
                            $massage_id = MassagerMasseur::whereIn('masseur_profile_id', $masseur_id)->distinct()->pluck('massage_profile_id')->toArray();


                        if (!empty($massage_id))
                            $massage = $massage->whereIn('id', $massage_id);
                        else
                            $massage = $massage->whereRaw('1 = 0');
                    }

                    if ($massage_services != "") {
                        $massage_profile_id = MassageService::where('service_id', $massage_services)->distinct()->pluck('massage_profile_id')->toArray();
                        if (!empty($massage_profile_id))
                            $massage = $massage->whereIn('id', $massage_profile_id);
                        else
                            $massage = $massage->whereRaw('1 = 0');
                    }

                    if ($other_services != "") {
                        $massage_profile_id = MassageService::where('service_id', $other_services)->distinct()->pluck('massage_profile_id')->toArray();
                        if (!empty($massage_profile_id))
                            $massage = $massage->whereIn('id', $massage_profile_id);
                        else
                            $massage = $massage->whereRaw('1 = 0');
                    }

                    // Verification Filter (Massage)
                    if ($verification != "") {
                        $statusMap = [
                            'verified'   => '1',
                            'unverified' => '2',
                        ];

                        if (isset($statusMap[$verification])) {

                            $status = $statusMap[$verification];

                            $massage = $massage->whereExists(function ($q) use ($status) {
                                $q->select(DB::raw(1))
                                    ->from('profile_verification_status as pvs')
                                    ->whereColumn('pvs.profile_id', 'massage_profiles.id')
                                    ->where('pvs.type', '4')
                                    ->where('pvs.status', $status);
                            });
                        }
                    }


                    if (empty($mc_live_list))
                        $massage = $massage->whereRaw('1 = 0');
                }
            } else {
                $massage = $massage->whereRaw('1 = 0');
            }

            //$massage = $massage->paginate($per_page)->onEachSide(1);
        } else {
            $massage = $massage->where('default_setting', '!=', '1');
           
            // if (empty($mc_live_list))
            //     $massage = $massage->whereIn('id', $mc_live_list);
            // else
            //     $massage = $massage->whereRaw('1 = 0');

              if (!empty($mc_live_list)){
                $massage = $massage->whereIn('id', $mc_live_list);
              }else{
                $massage = $massage->whereRaw('1 = 0');
              }
               
    
            //$massage = $massage->paginate($per_page)->onEachSide(1);
        }
        ######### End Upper Filter ##################### 

        $media = $this->media;
        $collection = $massage->get();
        $bumpProfiles = $collection->filter(fn($row) => !empty($row->activeBumpup));
        $normalProfiles = $collection->filter(fn($row) => empty($row->activeBumpup));


        // BumpUp shoring create data wise.
        $bumpProfiles = $bumpProfiles->sortByDesc(function ($row) {
            return $row->activeBumpup?->utc_start_time;
        });
        // return suffle listing
        $general = $this->weightedRandomReshuffle($normalProfiles);

        //merge bumpup and general listing
        $final = $bumpProfiles->values()->merge($general)->values();


        $final = $final->map(function ($item) {
            $total = MassageLike::where('massage_id', $item->id)->count();
            if ($total > 0) {
                $likeCount = MassageLike::where('like', 1)->where('massage_id', $item->id)->count();
                $dislikeCount = MassageLike::where('like', 0)->where('massage_id', $item->id)->count();
                $lp = round($likeCount / $total * 100);
                $dp = round($dislikeCount / $total * 100);
            } else {
                $lp = 0;
                $dp = 0;
            }
            if ($lp == 100) {
                $item->star_rating = 5;
            } elseif ($lp > 80) {
                $item->star_rating = 4;
            } elseif ($lp > 60) {
                $item->star_rating = 3;
            } elseif ($lp > 40) {
                $item->star_rating = 2;
            } elseif ($lp > 20) {
                $item->star_rating = 1;
            } else {
                $item->star_rating = 0;
            }
            return $item;
        });

        $page = $request->page ?? 1;

        $currentItems = $final->forPage($page, $per_page)->values();


        $listings = new LengthAwarePaginator(
            $currentItems,
            $final->count(),
            $per_page,
            $page,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );


        return response()->json([
            'grid' => view('web.mc.mc-grid-data', compact('listings', 'media', 'logedInUpser'))->render(),
            'list' => view('web.mc.mc-list-data', compact('listings', 'logedInUpser'))->render(),
            'pagination' => view('web.mc.mc-pagination', compact('listings'))->render(),
            'total_count' => $listings->total()
        ]);
    }


    private function weightedRandomReshuffle(Collection $massages): Collection
    {
        if ($massages->isEmpty()) {
            return $massages;
        }


        // 1) Sort listings by newest first (created_at)
        $sortedByNewest = $massages->sortByDesc('purchase_id')->values();

        //start if % wise reshuffing you want
        $totalCount = $sortedByNewest->count();

        // 2) Divide into 3 groups: Front (33%), Middle (33%), Back (34%)
        $frontCount = (int) round($totalCount * 0.33);
        $middleCount = (int) round($totalCount * 0.33);

        $front = $sortedByNewest->slice(0, $frontCount);
        $middle = $sortedByNewest->slice($frontCount, $middleCount);
        $back = $sortedByNewest->slice($frontCount + $middleCount);


        //end if % wise reshuffing you want

        $now = now();
        // Har 2 minute ka block banayega (0, 2, 4... 58)
        // $minuteBlock = floor($now->minute / 2) * 2;
        // $minuteBlock = str_pad($minuteBlock, 2, '0', STR_PAD_LEFT);

        $minuteBlock = $now->minute < 30 ? '00' : '30';
        $timeBlock = $now->format('Y-m-d-H-') . $minuteBlock;

        // if % wise reshuffing you want
        $shuffleChunk = function ($chunk) use ($timeBlock) {
            return $chunk->sortBy(function ($massage) use ($timeBlock) {
                return crc32($massage->id . '-' . $timeBlock);
            })->values();
        };

        return $shuffleChunk($front)
            ->merge($shuffleChunk($middle))
            ->merge($shuffleChunk($back))
            ->values();
        // if % wise reshuffing you want
    }



    public function massage_description(Request $request, $id)
    {
        if (!$id || !$request->ids) {
            return redirect(route('find.massage.centre'));
        }

        $listing = MassageProfile::where('id', $id)->with(['reviews' => function ($q) {
            $q->where('status', 'published');
        }, 'reviews.user'])->first();

        # Not show specific profile to viewer if specific viewer is blocked by Massage

        if (Auth::user() && auth()->user()->type == 0 &&  $listing) {
            $blockedProfileForViewers = MassageViewerInteractions::where('viewer_id', Auth::user()->id)->where('massage_blocked_viewer', true)->where('massage_id',  $listing->id)->first();
            if ($blockedProfileForViewers) {
                return redirect(route('find.massage.centre'));
            }
        }

        $ids = $request->ids ? json_decode($request->ids, true) : [];


        $currentIndex = array_search($id, $ids);
        $prevId = $ids[$currentIndex - 1] ?? null;
        $nextId = $ids[$currentIndex + 1] ?? null;



        //$listing = MassageProfile::where('id','=',$id)->first();
        $reviews = $listing->reviews;



        $massage_durations = (isset($listing->durations) && count($listing->durations) > 0) ? $listing->durations->toArray() : [];



        $durations = $this->duration->all();


        $galleryVideos = $listing->gallary()->wherePivot('type', 1)->orderBy('position', 'asc')->get();

        $spamReportAdvertiser = collect();

        if (Auth::user() && Auth::user()->type == 0) {
            $spamReportAdvertiser = ReportMassageProfile::where('viewer_id', Auth::user()->id)->first();
        }

        $massageLike = null;
        $userId = !empty(auth()->user()) ? auth()->user()->id : NULL;
        $massageLike = $this->model_massage_profile->getUserLikeDislike($id, $request->ip(), $userId);

        $total = MassageLike::where('massage_id', $id)->count();
        if ($total > 0) {
            $likeCount = MassageLike::where('like', 1)->where('massage_id', $id)->count();
            $dislikeCount = MassageLike::where('like', 0)->where('massage_id', $id)->count();
            $lp = round($likeCount / $total * 100);
            $dp = round($dislikeCount / $total * 100);
        } else {
            $lp = 0;
            $dp = 0;
        }



        if ($lp == 100) {
            $star_rating = 5;
        } elseif ($lp > 80) {
            $star_rating = 4;
        } elseif ($lp > 60) {
            $star_rating = 3;
        } elseif ($lp > 40) {
            $star_rating = 2;
        } elseif ($lp > 20) {
            $star_rating = 1;
        } else {
            $star_rating = 0;
        }


        return view('web.mc.massage-description', compact('listing', 'durations', 'massage_durations', 'reviews', 'spamReportAdvertiser', 'lp', 'dp', 'massageLike', 'nextId', 'prevId', 'ids', 'star_rating'));
    }


    /**
     * View masage profile
     */
    public function massageProfile(Request $request, $profile = "")
    {
        $previousUrl = url()->previous();
        $path = parse_url($previousUrl, PHP_URL_PATH);
        $previousSlug = trim($path, '/');

        $relatedIds = [];
        $relatedSlugs = [];
        $escort = MassageProfile::where('slug', $profile)->first();
          if(!$escort){
             return redirect(route('find.massage.centre'));
          } else {
           $id = $escort->id;
           $city = $escort->city_id;
           $membershipId = $escort->membership;
          }

          $stateId = $escort->user->state_id;

        $logedInUpser = auth()->user();
        # Not show specific profile to viewer if specific viewer is blocked by Massage
        $blockedProfileForViewersIds = [0];
        if (Auth::user() && auth()->user()->type == 0) {
            $blockedProfileForViewersIds = MassageViewerInteractions::where('viewer_id', Auth::user()->id)->where('massage_blocked_viewer', true)->pluck('massage_id');
            if ($blockedProfileForViewersIds && count($blockedProfileForViewersIds) > 0) {
                //$query = $query->whereNotIn('id', $blockedProfileForViewersIds);
            }
        }

        if(in_array($previousSlug, ['massage-centres-list', 'massage-profile'])) {
            $relatedMassges = MassagePurchase::with('massageprofile')->where('status', 'listed')
                ->whereHas('user', function ($q) use($stateId) {
                    $q->where('status', 1)
                    ->where('state_id', $stateId);
                })
                ->whereNotIn('massage_profile_id', $blockedProfileForViewersIds)
                ->whereDoesntHave('activeSuspendProfile')->get();
        
            $relatedIds = $relatedMassges->pluck('massage_profile_id')->toArray();
            $relatedSlugs = $relatedMassges->pluck('massageprofile.slug')->filter()->toArray();
        }
         //$ids = $request->ids ? json_decode($request->ids, true) : [];
   
          $ids = $relatedIds;
        if (!$id) {
            return redirect(route('find.massage.centre'));
        }

        $listing = MassageProfile::where('id', $id)->with(['reviews' => function ($q) {
            $q->where('status', 'published');
        }, 'reviews.user'])->first();

        # Not show specific profile to viewer if specific viewer is blocked by Massage

        if (Auth::user() && auth()->user()->type == 0 &&  $listing) {
            $blockedProfileForViewers = MassageViewerInteractions::where('viewer_id', Auth::user()->id)->where('massage_blocked_viewer', true)->where('massage_id',  $listing->id)->first();
            if ($blockedProfileForViewers) {
                return redirect(route('find.massage.centre'));
            }
        }

        $currentIndex = array_search($id, $ids);
        $prevId = $ids[$currentIndex - 1] ?? null;
        $nextId = $ids[$currentIndex + 1] ?? null;

        $prevSlug = $relatedSlugs[$currentIndex - 1] ?? "";
        $nextSlug = $relatedSlugs[$currentIndex + 1] ?? "";
        $prevId = !empty($prevSlug) ?  $prevId : null;
        $nextId = !empty($nextSlug) ?  $nextId : null;

        //$listing = MassageProfile::where('id','=',$id)->first();
        $reviews = $listing->reviews;

        $massage_durations = (isset($listing->durations) && count($listing->durations) > 0) ? $listing->durations->toArray() : [];



        $durations = $this->duration->all();


        $galleryVideos = $listing->gallary()->wherePivot('type', 1)->orderBy('position', 'asc')->get();

        $spamReportAdvertiser = collect();

        if (Auth::user() && Auth::user()->type == 0) {
            $spamReportAdvertiser = ReportMassageProfile::where('viewer_id', Auth::user()->id)->first();
        }

        $massageLike = null;
        $userId = !empty(auth()->user()) ? auth()->user()->id : NULL;
        $massageLike = $this->model_massage_profile->getUserLikeDislike($id, $request->ip(), $userId);

        $total = MassageLike::where('massage_id', $id)->count();
        if ($total > 0) {
            $likeCount = MassageLike::where('like', 1)->where('massage_id', $id)->count();
            $dislikeCount = MassageLike::where('like', 0)->where('massage_id', $id)->count();
            $lp = round($likeCount / $total * 100);
            $dp = round($dislikeCount / $total * 100);
        } else {
            $lp = 0;
            $dp = 0;
        }



        if ($lp == 100) {
            $star_rating = 5;
        } elseif ($lp > 80) {
            $star_rating = 4;
        } elseif ($lp > 60) {
            $star_rating = 3;
        } elseif ($lp > 40) {
            $star_rating = 2;
        } elseif ($lp > 20) {
            $star_rating = 1;
        } else {
            $star_rating = 0;
        }

        return view('web.mc.massage-description', compact('listing', 'durations', 'massage_durations', 'reviews', 'spamReportAdvertiser', 'lp', 'dp', 'massageLike', 'nextId', 'prevId', 'ids', 'star_rating', 'prevSlug', 'nextSlug'));
    }


    public function storeShortList(Request $request)
    {
        $wishlist = session()->get('wishlist', []);

        if (!in_array($request->wishlist_id, $wishlist)) {
            $wishlist[] = $request->wishlist_id;
        }

        $profile = MassageProfile::where('id', '=', $request->wishlist_id)->first();
        session(['wishlist' => $wishlist]);
        return response()->json([
            'status' => true,
            'session_count' => count($wishlist),
            'data' => $profile,
            'message' => 'Added to wishlist'
        ]);
    }

    public function removeShortList(Request $request)
    {
        $wishlist = session()->get('wishlist', []);
        if (($key = array_search($request->wishlist_id, $wishlist)) !== false) {
            unset($wishlist[$key]);
        }

        // Re-index array (important)
        $wishlist = array_values($wishlist);

        $profile = MassageProfile::where('id', '=', $request->wishlist_id)->first();
        session(['wishlist' => $wishlist]);
        return response()->json([
            'status' => true,
            'session_count' => count($wishlist),
            'data' => $profile,
            'message' => 'Added to wishlist'
        ]);
    }

    public function clearShortList(Request $request)
    {
        if (session()->has('wishlist')) {
            session()->forget('wishlist');
        }
        return response()->json([
            'status' => true,
            'message' => 'Shortlist has been cleared successfully.'
        ]);
    }

    public function SaveReviewMassage(Request $request, $massage_id)
    {
        $error = true;
        if (auth()->user() && auth()->user()->type == 0) {
            $data = [
                'description' => $request->description,
                'star_rating' => $request->rating ? $request->rating : NULL,
                'user_id' => auth()->user()->id,
                'advertiser_id' => $massage_id,
                'advertiser_type' => 'massage',
                'status' => 'pending',
            ];
            $id = null;

            $reviewExist = Reviews::where([
                'user_id' => auth()->user()->id,
                'advertiser_type' => 'massage',
                'advertiser_id' => $massage_id
            ])
                ->first();
            if ($reviewExist != null) {
                Reviews::where('id', $reviewExist->id)->update($data);
                $error = false;
            } else {
                if ($this->reviews->store($data, $id)) {
                    $error = false;
                }
            }
        } else {
            $data = 'You are not allowed to give review';
        }

        # add statistics for escort profile view and added stats for reviews and recommendation
        $userId = MassageProfile::where('id', $massage_id)->pluck('user_id');
        saving_massage_stats($userId, $massage_id, 'reviews_count');
        saving_massage_stats($userId, $massage_id, 'recommendation_count');

        return response()->json(compact('data', 'error'));
    }



    ############## Massage Short List #######################

    public function  shortlist_massageList()
    {

        return view('web.mc-shortlist.massage-centre-list');
    }

    public function shortlist_mcAjaxList(Request $request)
    {
        $per_page = 25;
        $massage_centers_ids = [];
        $mc_ids = session()->get('wishlist', []);


        $filter_by_location = $request->input('filter_by_location', []);
        $filter_by_feild    = $request->input('filter_by_feild', []);
        $massage_users = User::where('type', 5);
        $massage = MassageProfile::query()->where('default_setting', '!=', '1');


        ######### Upper Filter ##################### 
        if ((!empty($filter_by_location)) || (!empty($filter_by_feild))) {
            if (!empty($filter_by_location)) {

                $location   = $filter_by_location['locationByRadio'] ?? null;
                $member     = $filter_by_location['by_name_member'] ?? null;
                $set_lat    = $filter_by_location['set_lat'] ?? null;
                $set_lng    = $filter_by_location['set_lng'] ?? null;
                $per_page   = $filter_by_location['per_page'] ?? null;

                if ($location == 'your_location' &&  $set_lat != "" &&  $set_lng != "") {
                    $userLocation = $this->getRealTimeGeolocationOfUsers($set_lat, $set_lng);
                    $lat_state = $userLocation['state'];
                    $lng_city = $userLocation['city'];



                    $massage_users = $massage_users->where('state_id', $lat_state);

                    if ($member != "") {
                        $massage_users = $massage_users->where(function ($query) use ($member) {
                            $query->where('member_id', 'LIKE', "%{$member}%")
                                ->orWhere('name', 'LIKE', "%{$member}%");
                        });
                    }

                    $massage_centers_ids = $massage_users->pluck('id')->toArray();




                    if (!empty($massage_centers_ids)) {

                        $massage = $massage->where(function ($query) use ($massage_centers_ids, $member) {

                            $query->whereIn('user_id', $massage_centers_ids)->where('default_setting', '!=', '1');

                            if (!empty($member)) {
                                $query->where('profile_name', 'like', "%{$member}%");
                            }
                        });
                    } else {
                        $massage =  $massage->whereRaw('1 = 0');
                    }

                    $massage = $massage->inRandomOrder()->get();

                    if (!empty($mc_ids) && ($massage->count() > 0)) {
                        $massage = $massage->whereIn('id', $mc_ids)->values();
                        $page = request()->get('page', 1);
                        $total = $massage->count();

                        $results = $massage->forPage($page, $per_page)->values();
                        $massage = (new LengthAwarePaginator(
                            $results,
                            $total,
                            $per_page,
                            $page,
                            [
                                'path' => request()->url(),
                                'query' => request()->query()
                            ]
                        ))->onEachSide(1);
                    } else {
                        $massage->whereRaw('1 = 0');
                    }
                }

                if ($location == 'australia' &&  $set_lat == "" &&  $set_lng == "") {
                    $external_search_ids = [];
                    $massage_centers_ids = [];

                    if (!empty($member)) {

                        $external_search = User::where('type', 5);
                        if (!empty($member)) {
                            $external_search->where(function ($query) use ($member) {
                                $query->where('member_id', 'like', "%{$member}%");
                            });
                        }

                        $external_search_ids = $external_search->distinct()->pluck('id')->toArray();
                    }

                    $massage_users = $massage_users->distinct()->pluck('id')->toArray();
                    $massage_centers_ids = array_merge($external_search_ids, $massage_users);

                    if (!empty($massage_centers_ids)) {
                        $massage =  $massage->where(function ($query) use ($massage_centers_ids, $member) {

                            $query->whereIn('user_id', $massage_centers_ids)->where('default_setting', '!=', '1');

                            if (!empty($member)) {
                                $query->where('profile_name', 'like', "%{$member}%");
                            }
                        });
                    } else {
                        $massage =  $massage->whereRaw('1 = 0');
                    }


                    $massage = $massage->inRandomOrder()->get();
                    if (!empty($mc_ids) && ($massage->count() > 0)) {
                        $massage = $massage->whereIn('id', $mc_ids)->values();
                        $page = request()->get('page', 1);
                        $total = $massage->count();

                        $results = $massage->forPage($page, $per_page)->values();
                        $massage = (new LengthAwarePaginator(
                            $results,
                            $total,
                            $per_page,
                            $page,
                            [
                                'path' => request()->url(),
                                'query' => request()->query()
                            ]
                        ))->onEachSide(1);
                    } else {
                        $massage = new LengthAwarePaginator(
                            [],
                            0,
                            $per_page,
                            request()->get('page', 1),
                            [
                                'path' => request()->url(),
                                'query' => request()->query()
                            ]
                        );
                    }
                }
            }

            if (!empty($filter_by_feild)) {
                $is_found           = false;
                $profile_state      = $filter_by_feild['profile_state'] ?? null;
                $profile_city       = $filter_by_feild['profile_city'] ?? null;
                $masseur_types      = $filter_by_feild['masseur_types'] ?? null;
                $profile_price      = $filter_by_feild['profile_price'] ?? null;
                $profile_age        = $filter_by_feild['profile_age'] ?? null;
                $massage_services   = $filter_by_feild['massage_services'] ?? null;
                $other_services     = $filter_by_feild['other_services'] ?? null;
                $verification       = $filter_by_feild['verification'] ?? null;


                if ($profile_city != "") {

                    $state_id = getStateIdByCityId(config('escorts.profile.states'), $profile_city);
                    $massage_users = $massage_users->where('state_id', $state_id);
                    $massage_users = $massage_users->pluck('id')->toArray();
                    $massage_centers_ids = $massage_users;
                    $massage->when(
                        empty($massage_centers_ids),
                        function ($query) {
                            $query->whereRaw('1 = 0');
                        },
                        function ($query) use ($massage_centers_ids) {
                            $query->whereIn('user_id', $massage_centers_ids);
                        }
                    );
                }



                if ($profile_age != "") {
                    $masseur_id = [];
                    $massage_id = [];

                    $ages = explode('-', $profile_age);
                    list($min_age, $max_age) = array_map('intval', explode('-', $profile_age));
                    $masseur_id = Masseur::whereBetween('age', [$min_age, $max_age])->distinct()->pluck('id')->toArray();


                    if (!empty($masseur_id))
                        $massage_id = MassagerMasseur::whereIn('masseur_profile_id', $masseur_id)->distinct()->pluck('massage_profile_id')->toArray();

                    if (!empty($massage_id))
                        $massage = $massage->whereIn('id', $massage_id);
                    else
                        $massage =  $massage->whereRaw('1 = 0');
                }

                if ($massage_services != "") {
                    $massage_profile_id = MassageService::where('service_id', $massage_services)->distinct()->pluck('massage_profile_id')->toArray();
                    if (!empty($massage_profile_id))
                        $massage = $massage->whereIn('id', $massage_profile_id);
                    else
                        $massage =  $massage->whereRaw('1 = 0');
                }

                // Verification Filter (Massage)
                if ($verification != "") {
                    $statusMap = [
                        'verified'   => '1',
                        'unverified' => '2',
                    ];

                    if (isset($statusMap[$verification])) {

                        $status = $statusMap[$verification];

                        $massage = $massage->whereExists(function ($q) use ($status) {
                            $q->select(DB::raw(1))
                                ->from('profile_verification_status as pvs')
                                ->whereColumn('pvs.profile_id', 'massage_profiles.id')
                                ->where('pvs.type', '4')
                                ->where('pvs.status', $status);
                        });
                    }
                }

                if ($other_services != "") {
                    $massage_profile_id = MassageService::where('service_id', $other_services)->distinct()->pluck('massage_profile_id')->toArray();
                    if (!empty($massage_profile_id))
                        $massage = $massage->whereIn('id', $massage_profile_id);
                    else
                        $massage =  $massage->whereRaw('1 = 0');
                }


                $massage = $massage->inRandomOrder()->get();

                if (!empty($mc_ids) && ($massage->count() > 0)) {
                    $massage = $massage->whereIn('id', $mc_ids)->values();
                    $page = request()->get('page', 1);
                    $total = $massage->count();

                    $results = $massage->forPage($page, $per_page)->values();
                    $massage = (new LengthAwarePaginator(
                        $results,
                        $total,
                        $per_page,
                        $page,
                        [
                            'path' => request()->url(),
                            'query' => request()->query()
                        ]
                    ))->onEachSide(1);
                } else {
                    $massage = new LengthAwarePaginator(
                        [],
                        0,
                        $per_page,
                        request()->get('page', 1),
                        [
                            'path' => request()->url(),
                            'query' => request()->query()
                        ]
                    );
                }
            }
        } else {
            $massage = $massage->whereIn('id', $mc_ids)
                ->where('default_setting', '!=', '1')
                ->inRandomOrder()->paginate($per_page)
                ->onEachSide(1);
        }
        ######### End Upper Filter ##################### 

        $collection = method_exists($massage, 'getCollection')
            ? $massage->getCollection()
            : $massage->get();

        $page = method_exists($massage, 'currentPage') ? $massage->currentPage() : request()->get('page', 1);
        $perPage = method_exists($massage, 'perPage') ? $massage->perPage() : $per_page;
        $total = method_exists($massage, 'total') ? $massage->total() : $collection->count();

        $collection = $collection->map(function ($item) {
            $total = MassageLike::where('massage_id', $item->id)->count();
            if ($total > 0) {
                $likeCount = MassageLike::where('like', 1)->where('massage_id', $item->id)->count();
                $dislikeCount = MassageLike::where('like', 0)->where('massage_id', $item->id)->count();
                $lp = round($likeCount / $total * 100);
                $dp = round($dislikeCount / $total * 100);
            } else {
                $lp = 0;
                $dp = 0;
            }
            if ($lp == 100) {
                $item->star_rating = 5;
            } elseif ($lp > 80) {
                $item->star_rating = 4;
            } elseif ($lp > 60) {
                $item->star_rating = 3;
            } elseif ($lp > 40) {
                $item->star_rating = 2;
            } elseif ($lp > 20) {
                $item->star_rating = 1;
            } else {
                $item->star_rating = 0;
            }
            return $item;
        });

        $currentItems = $collection->forPage($page, $perPage)->values();

        $media = $this->media;
        $listings = new LengthAwarePaginator(
            $currentItems,
            $total,
            $perPage,
            $page,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );
     
        return response()->json([
            'grid' => view('web.mc-shortlist.mc-grid-data', compact('listings', 'media'))->render(),
            'list' => view('web.mc-shortlist.mc-list-data', compact('listings'))->render(),
            'pagination' => view('web.mc-shortlist.mc-pagination', compact('listings'))->render(),
            'total_count' => $listings->total()
        ]);
    }


  public function generateLog(Request $request)
  {

    try {

      $data = $this->getVisitorCountry();
      $masseur = $request->masseur_id;
      $page = $request->page;
      if ($data) {
        $now = Carbon::now(config('app.escort_server_timezone'));
        // $query = Visitor::where('page', $page)->where('masseur_id', $masseur)->where('visitorUuid', $request->visitorUuid)->where('created_at', '>=', $now->copy()->subDay());
        // $visitor = $query->latest('id')->first();


        $query = Visitor::where('page', $page)
          ->where('masseur_id', $masseur)
          ->where('visitorUuid', $request->visitorUuid)
          ->where('created_at', '>=', $now->copy()->subDay());

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
          'masseur_id' => $masseur,
        ];
        if ($visitor) {
          $visitor->update($datas);
        } else {
          Visitor::create(array_merge($datas, [
            'landed' => $now->format('Y-m-d h:i:s a'),
            'visitorUuid' => $request->visitorUuid,
          ]));
        }
      }
    } catch (Exception $e) {
      Log::info($e->getMessage());
    }
  }

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
}
