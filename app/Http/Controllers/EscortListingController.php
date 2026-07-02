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

class EscortListingController extends Controller
{


    protected $services;
    protected $escort;

    public function __construct(ServiceInterface $services, EscortInterface $escort,)
    {
        $this->services = $services;
        $this->escort = $escort;
    }


    public function allEscortListing(Request $request, $gender = null)
    {


        $array = config('escorts.profile.genders');

        $gender_one = array_flip($array);
        if ($gender != null) {
            $gen = $gender_one[$gender];
        } else {
            $gen = null;
        }

        $user_type = null;
        if (auth()->user() && auth()->user()->type == 0) {
            $user_type = auth()->user()->myLegBox->pluck('id')->toArray();
        }


        $userInterest = $this->getUserInterest();

        $userLocation = null;
        if ($request->lat != '' && $request->lng != '') {
            $userLocation = $this->getRealTimeGeolocationOfUsers($request->lat, $request->lng);
            $lat_state = $userLocation['state'];
            $lng_city = $userLocation['city'];
            session(['radio_location_filter' => true]);
        }

        $paramData = [];

        if (isset($userInterest['gender']) && (!empty($userInterest['gender']))) {
            $paramData['interest'] = $userInterest['gender'];
            $paramData['city_id'] = null;
            $paramData['gender'] = null;
        } else {
            $paramData['interest'] = null;
            $paramData['city_id'] = null;
            $paramData['gender'] = null;
        }


        $params = $str = [
            'string' => request()->get('name'),
            'city_id' => request()->get('city') ? request()->get('city') : ($userLocation ? $userLocation['city'] : null),
            'gender' => request()->get('gender') ? request()->get('gender') : $paramData['gender'],
            'age' => request()->get('age'),
            'price' => request()->get('price'),
            'duration_price' => request()->get('duration_price'),
            'services' => request()->get('services'),
            'enabled' => request()->get('enabled', 1),
            'state_id' => request()->get('state-id') ? request()->get('state-id') : ($userLocation ? $userLocation['state'] : null),
            'limit' => request()->get('limit') ? request()->get('limit') : 25,
            'interest' => $paramData['interest'],
            'view_type' => request()->get('view_type') ?? 'grid',
            'search_by_radio' => request()->get('search_by_radio'),
            'locationByRadio' => request()->get('locationByRadio'),
            'playmate_status' => request()->get('playmate_status'),
            'lat_state' => $lat_state ?? '',
            'lng_city' => $lng_city ?? '',
            'membership_type' => request()->get('membership_type') ?? null,
            'verification' => request()->get('verify_list') ?? null,
        ];


        if (isset($params['limit'])) {
            $limit = $params['limit'];
        } else {
            $limit = 25;
        }

        $location = request()->get('location');

        // un orgnise code only use for running project
        $radio_location_filter = session('radio_location_filter');
        $limit = $str['limit'];

        if ($request->get('filter_button_submit') == '1') {
            $params['city_id'] = $str['city_id'] = request()->get('city'); // city_id = 6839
        }

        $services = $this->services->all();


        // if no need then i remove below code.
        $escortId = [];
        if (session('cart') && session('is_shortlisted_profile')) {
            foreach (session('cart') as $id => $vlaue) {

                $escortId[] = $id;
            }
        }
        $viewerAuth = Auth::user();



        list($service_one, $service_two, $service_three) = $this->services->findByCategory([1, 2, 3]);
        //$escorts = $this->escort->findByPlan($limit, $params, $user_id = null, $escortId, $userId = null, $gen);
        $all_services_tag = $service_one->merge($service_two)->merge($service_three);



        session(['search_escort_filters' => $params]);
        session(['search_escort_filters_url' => url()->full()]);
        session(['is_shortlisted_profile' => false]);

        if ($params['city_id'] && $params['state_id']) {
            $filterStateExist = City::where('id', $params['city_id'])->where('state_id', $params['state_id'])->exists();
            $params['state_id'] = $filterStateExist ? $params['state_id'] : null;
            //$radio_location_filter = true;
        }

        $services = $this->services->all();


        $locationCityId = $params['city_id'];
        $filterGenderId = $params['gender'];

        // un orgnise code only use for running project
        $query = Escort::query()
            ->where('enabled', 1)
            ->select('escorts.*')
            ->with([
                'durations',
                'currentActivePinup',
                'activeBumpup'
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

        $query->orderByRaw("
            CASE escorts.membership
                WHEN 1 THEN 1
                WHEN 2 THEN 2
                WHEN 3 THEN 3
                WHEN 4 THEN 4
            END
        ");

        $query->orderBy('utc_start_time', 'desc');

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
   
        $page = request('page', 1);
        $perPage = $limit;

       $grouped =  $result->groupBy('membership'); // this value pass inside the blade template

        $currentItems = $result->forPage($page, $perPage)->pluck('id')->all();

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
            if($viewType == 'grid'){
                $data = view('web.escort.partials.grid-listing', compact('grouped', 'memberTotalCount', 'viewType', 'user_type','viewerAuth'))->render();
            }else{
                $data = view('web.escort.partials.list-listing', compact('grouped', 'memberTotalCount', 'viewType', 'user_type', 'viewerAuth'))->render();
            }
            return response()->json([
                'data' => $data,
                'view_type' => $viewType,
                'total_count' => count($currentItems ?? 0),
                'pagination' => view('web.escort.partials.pagination', compact('paginator'))->render()

            ]);
        }

        //*************************************End Pass ajax request blade data****************************/


        return view('web.escort-filter-profile', compact(
            'services',
            'service_one',
            'service_two',
            'service_three',
            'escorts',
            'locationCityId',
            'filterGenderId',
            'memberTotalCount',
            'radio_location_filter',
            'all_services_tag',
            'viewType'
        ));
    }

    public function applyFilterOnEscort(
        $query,
        $str,
        $gender = null,
        $age = null,
        $location = null
    ) {

        $query->whereHas('user', function ($q) {
            $q->where('status', 1);
        });
        $query->whereDoesntHave('activeSuspendProfile');

        // Playmate filter
        if (isset($str['playmate_status']) && $str['playmate_status'] == 'with_playmates') {
            $query = $query->whereHas('playmates');
        }


        // Verification filter

        if (!empty($str['verification'])) {
            $statusMap = [
                'pending' => 0,
                'verified' => 1,
                'unverified' => 2,
            ];

            if (isset($statusMap[$str['verification']])) {

                $query->join('profile_verification_status as pvs', function ($join) {
                    $join->on('pvs.profile_id', '=', 'escorts.id')
                        ->where('pvs.type', '3');
                });

                $query->where(
                    'pvs.status',
                    $statusMap[$str['verification']]
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

        if (isset($str['search_by_radio']) && ($str['search_by_radio'] == '1' || $str['search_by_radio'] == 1)) {

            // $query->where('escorts.enabled', $str['enabled'] ?? 1);

            $radioLocation = $str['locationByRadio'];

            if (!empty($str['string'])) {

                $uid = $str['string'];

                $query->where(function ($q) use ($uid) {
                    $q->where('escorts.name', 'like', '%' . $uid . '%');
                    $q->orWhere(function ($q) use ($uid) {
                        $q->whereHas('user', function ($q) use ($uid) {
                            $q->where('member_id', $uid);
                        });
                    });
                });

                if (!empty($str['lat_state']) && $radioLocation == 'your_location') {
                    $query->where('escorts.state_id', $str['lat_state']);
                }
            }

            if (!empty($str['lat_state']) && $radioLocation == 'your_location') {
                $query->where('escorts.state_id', $str['lat_state']);
            }

            return $query;
        }

        // Enabled
        $query->where('escorts.enabled', $str['enabled'] ?? 1);

        // City
        if (!empty($str['city_id'])) {
            $query->where('escorts.city_id', $str['city_id']);
        }

        /*
        |--------------------------------------------------------------------------
        | Gender / Interest Filter (Missing)
        |--------------------------------------------------------------------------
        */
        if (!empty($str['gender'])) {
            $query->where('escorts.gender', $str['gender']);
        } else {
            if (!empty($str['interest'])) {
                $interests = array_unique($str['interest']);
                if (is_array($interests)) {
                    $query->whereIn('escorts.gender', $interests);
                }
            }
        }

        // Age
        if (!empty($str['age'])) {
            [$min, $max] = explode('-', $str['age']);
            $query->whereBetween('escorts.age', [$min, $max]);
        }

        // Duration price
        if (!empty($str['duration_price'])) {
            $query->whereHas('durations', function ($q) use ($str) {
                if ($str['duration_price'] == 'incall_price') {
                    $q->whereNotNull('incall_price');
                }
                if ($str['duration_price'] == 'outcall_price') {
                    $q->whereNotNull('outcall_price');
                }
                if ($str['duration_price'] == 'massage_price') {
                    $q->whereNotNull('massage_price');
                }
            });
        }

        // Price filter
        if (!empty($str['price'])) {
            $price = $str['price'];
            $query->whereHas('services', function ($q) use ($price) {
                if ($price <= 500) {
                    $q->where('price', '<=', $price);
                } else {
                    $q->where('price', '>', 500);
                }
            });
        }

        // Services
        if (!empty($str['services'])) {
            $query->whereHas('services', function ($q) use ($str) {
                $q->whereIn('services.id', $str['services']);
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

    public function getMemberType()
    {
        $memberTypes = [
            1 => [
                'title' => 'Platinum',
                'icon' => asset('images/platinum_membership.png'),
                'class' => 'platinum'
            ],
            2 => [
                'title' => 'Gold',
                'icon' => asset('images/gold_membership.png'),
                'class' => 'gold'
            ],
            3 => [
                'title' => 'Sliver',
                'icon' => asset('images/silver_membership.png'),
                'class' => 'sliver'
            ],
            4 => [
                'title' => 'Free',
                'icon' => asset('assets/app/img/free.png'),
                'class' => 'free'
            ],
        ];
        return $memberTypes;
    }
}
