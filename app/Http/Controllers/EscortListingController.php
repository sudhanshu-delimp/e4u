<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Escort;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Service\ServiceInterface;
use App\Repositories\Escort\EscortInterface;
use Illuminate\Support\Facades\Http;
use App\Models\State;
use Exception;
use Illuminate\Support\Facades\Log;

class EscortListingController extends Controller
{
    /**
     * if you want understand resffling rule then read the README.md file in the project root directory.
     * 
     * NSW → VIC → QLD → WA → SA → TAS → NT → ACT
     */
    private const PINUP_STATE_ORDER = [3909, 3903, 3905, 3906, 3904, 3908, 3910, 3907];


    protected $services;
    protected $escort;

    public function __construct(ServiceInterface $services, EscortInterface $escort,)
    {
        $this->services = $services;
        $this->escort = $escort;
    }

    private function getUserTypeIds()
    {
        $user = auth()->user();

        if (!$user || $user->type != 0) {
            return null;
        }
        return auth()->user()->myLegBox->pluck('id')->toArray();
    }

    private function getUserLocation(Request $request)
    {
        if (empty($request->lat) || empty($request->lng) || ($request->search_by_radio == 0 ) || ($request->locationByRadio == 'australia')) {
            return null;
        }

        return $this->getRealTimeGeolocationOfUsers($request->lat, $request->lng);
    }

    private function getRealTimeGeolocationOfUsers($lat, $lng)
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

            //    $stateFromDb = State::where('name','like','%'.'Tasmania'.'%')->first();
            $stateFromDb = State::where('name', 'like', '%' . $state . '%')->first();

            $stateCapital = config('escorts.profile.states')[$stateFromDb->id] ?? null;

            $parms = [
                'state' => $stateFromDb ? $stateFromDb->id : null,
                'city' => $stateCapital ? array_key_first($stateCapital['cities']) : null,
            ];

            return $parms;
        } catch (\Exception $e) {
            //throw $th;
            $parms = [
                'state' => null,
                'city' => null,
            ];

            return $parms;
        }
    }

    private function getSearchParams(
        Request $request,
        $userLocation,
        $userInterest
    ) {


        return [
            'string'            => $request->by_name_member,
            'city_id'           => $request->city ?? ($userLocation['city'] ?? null),
            'gender'            => $request->gender,
            'age'               => $request->age,
            'price'             => $request->price,
            'duration_price'    => $request->duration_price,
            'services'          => $request->services,
            'enabled'           => $request->enabled ?? 1,
            'state_id'          => $request->state_id ?? ($userLocation['state'] ?? null),
            'limit'             => $request->limit ?? 25,
            'interest'          => $userInterest['gender'] ?? null,
            'view_type'         => $request->view_type ?? 'grid',
            'search_by_radio'   => $request->search_by_radio,
            'locationByRadio'   => $request->locationByRadio,
            'playmate_status'   => $request->playmate_status,
            'lat_state'         => $userLocation['state'] ?? '',
            'lng_city'          => $userLocation['city'] ?? '',
            'membership_type'   => $request->membership_type,
            'verification'      => $request->varify_list,
            'page'              => $request->page ?? 1,
        ];
    }

    private function getShortListIds()
    {
        $escortId = [];
        if (session('cart')) {
            foreach (session('cart') as $id => $vlaue) {
                $escortId[] = $id;
            }
        } else {
            $escortId[] = null;
        }
        return $escortId;
    }



    public function allEscortListing(Request $request, $gender = null)
    {
         // dd($request->all());
        // $request->merge([
        //     'page' => 1,
        //     'view_type' => 'grid',
        //     'locationByRadio' => 'your_location',
        //     'lat' => 28.583660987837543,
        //     'lng' => 77.31546432689107,
        //     'search_by_radio' => 1,
        //     'limit' => 25,
        // ]);


        //get shortlist ids
        $escortId = $this->getShortListIds();
        $count_session = count((array) session('cart'));
        //get Lagbox ids
        $user_type = $this->getUserTypeIds();
        // make sure user alwase same state me hona chaiye tab Backend se jo v gender select kiya hoga tab wo work karega.
        $userInterest = $this->getUserInterest();
        $userLocation = $this->getUserLocation($request);
       // dd($userLocation, $request->all());
        //dd($request->all());


        $params = $this->getSearchParams($request, $userLocation, $userInterest);

        $location = request()->get('location');


        // un orgnise code only use for running project
        if (isset($params['limit'])) {
            $perPage = $params['limit'];
        } else {
            $perPage = 25;
        }


        if ($request->get('filter_button_submit') == '1') {
            $params['city_id'] = request()->get('city'); // city_id = 6839
        }

        $viewerAuth = Auth::user();

        list($service_one, $service_two, $service_three) = $this->services->findByCategory([1, 2, 3]);
        $all_services_tag = $service_one->merge($service_two)->merge($service_three);


        $services = $this->services->all();


        $locationCityId = $params['city_id'];
        $filterGenderId = $params['gender'];

        $escortSelectColumns = [
            'escorts.id',
            'escorts.name',
            'escorts.city_id',
            'escorts.enabled',
            'escorts.purchase_id',
            'escorts.user_id',
            'escorts.gender',
            'escorts.city_id',
            'escorts.membership',
            //'escorts.membership_upgraded_at',
            'escorts.age',
            'escorts.star_rating',
            'escorts.massage_price',
            'escorts.incall_price',
            'escorts.outcall_amount',
            'escorts.availability_time',
            'escorts.state_id',
            'escorts.created_at',
            
        ];


        // Query without ordering — ordering is handled in-memory by prepareMembership()
        $query = Escort::query()
            ->where('enabled', 1)
            ->select($escortSelectColumns)
            ->with([
                'currentActivePinup',
                'activeBumpup',
                'latestActiveBrb:id,profile_id,selected_time',
                'gallary' => function ($q) {
                    $q->wherePivot('position', 1)
                        ->select('escorts_medias.id', 'path');
                },
                'escort_videos',
                'city:id,name',
                'oneHourDuration',
                'user:id,profile_creator',
                'durations:id,name',
                'purchase' => function ($q) {
                    $q->where('status', 'listed');
                },
            ]);


        $query = $this->applyFilterOnEscort(
            $query,
            $params,
            $params['gender'],
            $params['age'],
            $location
        );


        $escorts = $query->get();


        $groups = $escorts->groupBy('membership');

        $platinum = $groups->get(1, collect());
        $gold     = $groups->get(2, collect());
        $silver   = $groups->get(3, collect());
        $free     = $groups->get(4, collect());
        //return $platinum;


        // this code for testing perpes

        $memberTotalCount = [
            1 => $platinum->count(),
            2 => $gold->count(),
            3 => $silver->count(),
            4 => $free->count(),
        ];
       
        // Apply position rules: Pin Up → Bump Up → Upgrade → General (per membership group)
        $filterStateId = $params['state_id'];
        $result = collect();
        $result = $result->merge($this->prepareMembership($platinum, $filterStateId))
            ->merge($this->prepareMembership($gold, $filterStateId))
            ->merge($this->prepareMembership($silver, $filterStateId))
            ->merge($this->prepareMembership($free, $filterStateId));

        $page = $params['page'];
        // $perPage = $limit;
        //$grouped =  $result->groupBy('membership'); 
        $currentItems = $result->forPage($page, $perPage)->values();
        $grouped = $currentItems->groupBy('membership'); // this value pass inside the blade template

        $paginator = new LengthAwarePaginator(
            $currentItems,
            $result->count(),
            $perPage,
            $page,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );

        $viewType =  $params['view_type'];
        //$memberTypes  = $this->getMemberType();

        //*************************************Start Pass ajax request blade data****************************/
        if ($request->ajax()) {
            $data = '';
            if ($viewType == 'grid') {
                $data = view('web.escort.partials.grid-listing', compact('grouped', 'memberTotalCount', 'viewType', 'user_type', 'viewerAuth', 'escortId'))->render();
            } else {
                $data = view('web.escort.partials.list-listing', compact('grouped', 'memberTotalCount', 'viewType', 'user_type', 'viewerAuth', 'escortId'))->render();
            }
            return response()->json([
                'data' => $data,
                'view_type' => $viewType,
                'total_count' => count($currentItems ?? 0),
                'page' => $page,
                'pagination' => view('web.escort.partials.pagination', compact('paginator'))->render(),
                'memberTotalCount' => $memberTotalCount

            ]);
        }

        //*************************************End Pass ajax request blade data****************************/


        return view('web.escort-filter-profile', compact(
            'services',
            'service_one',
            'service_two',
            'service_three',
            'locationCityId',
            'filterGenderId',
            'memberTotalCount',
            'all_services_tag',
            'viewType',
            'count_session'
        ));
    }

    public function applyFilterOnEscort(
        $query,
        $params,
        $gender = null,
        $age = null,
        $location = null
    ) {
        $query->whereHas('user', function ($q) {
            $q->where('status', 1);
        });
        $query->whereDoesntHave('activeSuspendProfile');

        //filter membership type wise escort

        if (!empty($params['membership_type']) && ($params['membership_type'] != 'all')) {
            $query->where('escorts.membership', $params['membership_type']);
        }

        // Playmate filter
        if (isset($params['playmate_status']) && $params['playmate_status'] == 'with_playmates') {
            $query = $query->whereHas('playmates');
        }


        // Verification filter
        /**************************all query depending each other*******************************/
        $query->join('profile_verification_status as pvs', function ($join) {
            $join->on('pvs.profile_id', '=', 'escorts.id')
                ->where('pvs.type', '3');
        });

        $query->addSelect(DB::raw('COALESCE(pvs.status, 0) as verification_status'));

        /**************************all query depending each other*******************************/

        if (!empty($params['verification'])) {

            $statusMap = [
                'pending' => '0',
                'verified' => '1',
                'unverified' => '2',
            ];

            if (isset($statusMap[$params['verification']])) {
                $query->where(
                    'pvs.status',
                    $statusMap[$params['verification']]
                );
            }
        }



        // Blocked viewers
        if (Auth::check()) {

            $query->whereNotExists(function ($q) {

                $q->select(DB::raw(1))
                    ->from('escort_viewer_interactions as evi')
                    ->whereColumn('evi.escort_id', 'escorts.id')
                    ->where('evi.viewer_id', Auth::id())
                    ->where('evi.escort_blocked_viewer', true);
            });
        }

        //Search By Radio (Missing)
       // dd($params);

        if (isset($params['search_by_radio']) && ($params['search_by_radio'] == '1' || $params['search_by_radio'] == 1)) {

            $radioLocation = $params['locationByRadio'];
  
            if (!empty($params['string'])) {

                $uid = $params['string'];

                $query->where(function ($q) use ($uid) {
                    $q->where('escorts.name', 'like', '%' . $uid . '%');
                    $q->orWhere(function ($q) use ($uid) {
                        $q->whereHas('user', function ($q) use ($uid) {
                            $q->where('member_id', $uid);
                        });
                    });
                });

                if (!empty($params['lat_state']) && $radioLocation == 'your_location') {
                    $query->where('escorts.state_id', $params['lat_state']);
                }
            }

            if (!empty($params['lat_state']) && $radioLocation == 'your_location') {
                $query->where('escorts.state_id', $params['lat_state']);
            }

           // return $query;
        }


        // Enabled
        $query->where('escorts.enabled', $params['enabled'] ?? 1);

        // City
        if (!empty($params['city_id'])) {
            $query->where('escorts.city_id', $params['city_id']);
        }

        if (!empty($params['gender'])) {
            $query->where('escorts.gender', $params['gender']);
        } else {
            if (!empty($params['interest'])) {
                $interests = array_unique($params['interest']);
                if (is_array($interests)) {
                    $query->whereIn('escorts.gender', $interests);
                }
            }
        }

        // Age
        if (!empty($params['age'])) {
            [$min, $max] = explode('-', $params['age']);
            $query->whereBetween('escorts.age', [$min, $max]);
        }

        // Duration price
        if (!empty($params['duration_price'])) {
            $query->whereHas('durations', function ($q) use ($params) {
                if ($params['duration_price'] == 'incall_price') {
                    $q->whereNotNull('incall_price');
                }
                if ($params['duration_price'] == 'outcall_price') {
                    $q->whereNotNull('outcall_price');
                }
                if ($params['duration_price'] == 'massage_price') {
                    $q->whereNotNull('massage_price');
                }
            });
        }

        // Price filter
        if (!empty($params['price'])) {
            $price = $params['price'];
            $query->whereHas('services', function ($q) use ($price) {
                if ($price <= 500) {
                    $q->where('price', '<=', $price);
                } else {
                    $q->where('price', '>', 500);
                }
            });
        }
        // Services
        if (!empty($params['services'])) {
            $query->whereHas('services', function ($q) use ($params) {
                $q->whereIn('services.id', explode(',', $params['services']));
            });
        }

        return $query;
    }


    private function prepareMembership(Collection $items, $filterStateId = null): Collection
    {
        if ($items->isEmpty()) {
            return $items;
        }


        // 1️⃣ Pin Up: escort has an active pinup right now
        $pinUps = $items->filter(function ($escort) {
            return $escort->currentActivePinup !== null;
        });


        // 2️⃣ Bump Up: escort has an active bumpup but is NOT a pin up
        $bumpUps = $items->filter(function ($escort) {
            return $escort->activeBumpup !== null
                && $escort->currentActivePinup === null;
        });


        // 3️⃣ Upgrade: membership was upgraded within the last 24 hours (not pinup/bumpup)
        // $upgraded = $items->filter(function ($escort) {
        //     if ($escort->currentActivePinup !== null || $escort->activeBumpup !== null) {
        //         return false;
        //     }
        //     if (empty($escort->membership_upgraded_at)) {
        //         return false;
        //     }
        //     return Carbon::parse($escort->membership_upgraded_at)->gte(now()->subHours(24));
        // });

        // 4️⃣ General: everything else

        $pinUpIds    = $pinUps->pluck('id')->toArray();
        $bumpUpIds   = $bumpUps->pluck('id')->toArray();
        //$upgradedIds = $upgraded->pluck('id')->toArray();
        //$excludeIds  = array_merge($pinUpIds, $bumpUpIds, $upgradedIds);
        $excludeIds  = array_merge($pinUpIds, $bumpUpIds);
        $general = $items->filter(function ($escort) use ($excludeIds) {
            return !in_array($escort->id, $excludeIds);
        });


        if (!empty($filterStateId)) {
            // Same location (State) — sort by pinup start time DESC
            $pinUps = $pinUps->sortByDesc(function ($escort) {
                return $escort->currentActivePinup->utc_start_time ?? '';
            })->values();
        } else {
            // Australia-wide — sort by the fixed state display order
            $stateOrder = array_flip(self::PINUP_STATE_ORDER);
            $pinUps = $pinUps->sortByDesc(function ($escort) {
                return $escort->currentActivePinup->utc_start_time ?? '';
            })->sortBy(function ($escort) use ($stateOrder) {
                $stateId = optional($escort->currentActivePinup)->state_id ?? $escort->state_id;
                return $stateOrder[$stateId] ?? 999;
            })->values();
        }

        $bumpUps = $bumpUps->sortByDesc(function ($escort) {
            return $escort->activeBumpup->utc_start_time ?? '';
        })->values();
     
        // $upgraded = $upgraded->sortByDesc(function ($escort) {
        //     return $escort->membership_upgraded_at;
        // })->values();

        $general = $this->weightedRandomReshuffle($general);

        // Australia-wide: Sort Bump Ups and General (New/Listings) by the fixed state order
        if (empty($filterStateId)) {
            $stateOrder = array_flip(self::PINUP_STATE_ORDER);
            
            $bumpUps = $bumpUps->sortBy(function ($escort) use ($stateOrder) {
                return $stateOrder[$escort->state_id] ?? 999;
            })->values();

            $general = $general->sortBy(function ($escort) use ($stateOrder) {
                return $stateOrder[$escort->state_id] ?? 999;
            })->values();
        }

        return $pinUps
            ->merge($bumpUps)
            //->merge($upgraded)
            ->merge($general)
            ->values();
    }


    /**
     * Weighted random reshuffle for general (non-promoted) listings (every 2 mins).
     *
     * Divides the listings into 3 tiers based on recency (Front 33%, Middle 33%, Back 34%),
     * and reshuffles each tier deterministically.
     *
     */
    private function weightedRandomReshuffle(Collection $escorts): Collection
    {
        if ($escorts->isEmpty()) {
            return $escorts;
        }


        // 1) Sort listings by newest first (created_at)
        $sortedByNewest = $escorts->sortByDesc(function ($escort) {
            return optional($escort->purchase->sortByDesc('created_at')->first())->created_at;
        })
        ->values();

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
       // dd($timeBlock);

        // if % wise reshuffle no need then enable 
        //  return $sortedByNewest->sortBy(function ($escort) use ($timeBlock) {
        //     return crc32($escort->id . '-' . $timeBlock);
        // })->values();

        // if % wise reshuffing you want
        $shuffleChunk = function ($chunk) use ($timeBlock) {
            return $chunk->sortBy(function ($escort) use ($timeBlock) {
                // crc32 gives a deterministic integer from the string
                return crc32($escort->id . '-' . $timeBlock);
            })->values();
        };

        return $shuffleChunk($front)
            ->merge($shuffleChunk($middle))
            ->merge($shuffleChunk($back))
            ->values();
        // if % wise reshuffing you want
    }
    // make sure user alwase same state me hona chaiye tab Backend se jo v gender select kiya hoga tab wo work karega.
    public function getUserInterest(): ?array
    {
        $user = auth()->user();


        if (!$user || $user->type != '0' || !$user->viewer_settings || $user->state_id != $user->current_state_id) {
            return null;
        }

        $settings = $user->viewer_settings;

        $genderMap = [
            'interests_with_male'           => 1,
            'interests_with_female'         => 6,
            'interests_with_trans'          => 3,
            'interests_with_cross_dresser'  => 4,
            'interests_with_couples'        => 2,
        ];

        $userInterest = [];

        foreach ($genderMap as $field => $genderId) {
            if ($settings->$field) {
                $userInterest['gender'][] = $genderId;
            }
        }
        return $userInterest;
    }


    //Fetching Escorts Services list
    public function fetchEscortServices()
    {
        try {
            [$serviceOne, $serviceTwo, $serviceThree] = $this->services->findByCategory([1, 2, 3]);

            return success_response([
                'service_one'   => view('web.escort.partials.services-list', ['services' => $serviceOne, 'type' => 'one'])->render(),
                'service_two'   => view('web.escort.partials.services-list', ['services' => $serviceTwo, 'type' => 'two'])->render(),
                'service_three' => view('web.escort.partials.services-list', ['services' => $serviceThree, 'type' => 'three'])->render(),
            ], 'Ok', 200);
        } catch (Exception $e) {
            return error_response('Error', 500, null);
        }
    }

    //Make short list using the session
    // public function addRemoveCard($escort_id)
    // {

    //     $userId = auth()->user()->id ?? null;
    //     if (count((array) session('cart')) > 0) {
    //         $cart = session()->get('cart');
    //     } else {
    //         $cart = session()->get('cart', []);
    //     }

    //     if (isset($cart[$escort_id])) {
    //         $cart[$escort_id]['quantity']++;
    //         $error = 0;
    //     } else {
    //         $cart[$escort_id] = [
    //             "user_id" => $userId,
    //             "quantity" => 1,
    //         ];
    //         $error = 1;
    //     }

    //     session()->put('cart', $cart);
    //     $count_session = count(session('cart'));
    //     return response()->json(compact('error', 'cart', 'count_session'));
    // }

    public function clearShortList(Request $request)
    {
        $data = array_keys(session()->get('cart'));
        session()->forget('cart');
        return success_response($data, 'Ok', 200);
    }

    public function addtocart($escort_id)
    {

        $userId = auth()->user() ? auth()->user()->id : null; //request()->post('userId');
        if (count((array) session('cart')) > 0) {
            $cart = session()->get('cart');
        } else {
            $cart = session()->get('cart', []);
        }

        if (isset($cart[$escort_id])) {
            $cart[$escort_id]['quantity']++;
            $error = 0;
        } else {
            $cart[$escort_id] = [
                "user_id" => $userId,
                "quantity" => 1,
            ];
            $error = 1;
        }

        session()->put('cart', $cart);
        $count_session = count(session('cart'));
        return response()->json(compact('error', 'cart', 'count_session'));


    }

    public function removeShortList()
    {
        $escort_id = request()->post('escortId');

        $error = 0;
        if ($escort_id) {
            $cart = session()->get('cart');
            if (isset($cart[$escort_id])) {
                unset($cart[$escort_id]);
                session()->put('cart', $cart);
                $count_session = count(session('cart'));
                $error = 1;
            }
        }
        return response()->json(compact('error', 'count_session'));
    }
}
