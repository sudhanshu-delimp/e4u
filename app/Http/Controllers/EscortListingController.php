<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Escort;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Service\ServiceInterface;
use App\Repositories\Escort\EscortInterface;
use Illuminate\Support\Facades\Http;
use App\Models\State;
use Exception;

class EscortListingController extends Controller
{


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
        if (empty($request->lat) || empty($request->lng) || ($request->search_by_radio == 0)) {
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
            'state_id'          => $request->{'state-id'} ?? ($userLocation['state'] ?? null),
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

    private function getShortList()
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
        //get selected short list ids
        $escortId = $this->getShortList();
        //get Lagbox ids
        $user_type = $this->getUserTypeIds();
        $userInterest = $this->getUserInterest();
        $userLocation = $this->getUserLocation($request);
        $params = $this->getSearchParams($request, $userLocation, $userInterest);;

        $location = request()->get('location');

        // un orgnise code only use for running project
        if (isset($params['limit'])) {
            $limit = $params['limit'];
        } else {
            $limit = 25;
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
            'escorts.age',
            'escorts.star_rating',
            'escorts.massage_price',
            'escorts.incall_price',
            'escorts.outcall_amount',
            'escorts.availability_time',

        ];

        // un orgnise code only use for running project
        $query = Escort::query()
            ->where('enabled', 1)
            ->select($escortSelectColumns)
            ->with([
                'currentActivePinup',
                'activeBumpup',
                'latestActiveBrb:selected_time',
                'gallary' => function ($q) {
                    $q->wherePivot('position', 1)
                        ->select('escorts_medias.id', 'path');
                },
                'escort_videos',
                'city:id,name',
                'oneHourDuration',
                'user:id,profile_creator',
                'durations:id,name'
            ]);
        $query->withMax([
            'currentActivePinup as pinup_start' => function ($q) {
                $q->select('created_at');
            }
        ], 'created_at')
            ->orderByRaw('pinup_start IS NULL')
            ->orderByDesc('pinup_start');

        $query->withMax([
            'activeBumpup as bump_start' => function ($q) {
                $q->select('utc_start_time');
            }
        ], 'utc_start_time')
            ->orderByRaw('bump_start IS NULL')
            ->orderByDesc('bump_start');

        $query->orderBy('utc_start_time', 'desc');

        $query->orderByRaw("
            CASE escorts.membership
                WHEN 1 THEN 1
                WHEN 2 THEN 2
                WHEN 3 THEN 3
                WHEN 4 THEN 4
            END
        ");




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

        // this code for testing perpes

        $memberTotalCount = [
            1 => $platinum->count(),
            2 => $gold->count(),
            3 => $silver->count(),
            4 => $free->count(),
        ];

        // this code for testing perpes
        $result = collect();
        $result = $result->merge($this->prepareMembership($platinum))
            ->merge($this->prepareMembership($gold))
            ->merge($this->prepareMembership($silver))
            ->merge($this->prepareMembership($free));

        $page = $params['page'];
        $perPage = $limit;
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
                'pagination' => view('web.escort.partials.pagination', compact('paginator'))->render()

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
            'viewType'
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

            return $query;
        }

        // Enabled
        $query->where('escorts.enabled', $params['enabled'] ?? 1);

        // City
        if (!empty($params['city_id'])) {
            $query->where('escorts.city_id', $params['city_id']);
        }

        /*
        |--------------------------------------------------------------------------
        | Gender / Interest Filter (Missing)
        |--------------------------------------------------------------------------
        */
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

    private function prepareMembership($items)
    {
        // $bumpup = $items
        //     ->filter(function($escort){
        //       return !empty($escort->bump_start);
        //     });

        // $pinup = $items
        //     ->filter(function ($escort) {
        //         return empty($escort->bump_start) && !empty($escort->pinup_start);
        //     });

        // $remaining = $items
        //     ->filter(function ($escort) {
        //         return empty($escort->bump_start) && empty($escort->pinup_start);
        //     })
        //     ->shuffle();

        // return $bumpup
        //     ->merge($pinup)
        //     ->merge($remaining);

        return $items;
    }

    public function getUserInterest(): ?array
    {
        $user = auth()->user();

        if (
            !$user ||
            $user->type != 0 ||
            !$user->viewer_settings ||
            $user->state_id != $user->current_state_id
        ) {
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
