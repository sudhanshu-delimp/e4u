<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Escort\EscortMediaInterface;
use App\Repositories\Escort\EscortInterface;
use App\Repositories\Service\ServiceInterface;
use App\Repositories\Escort\AvailabilityInterface;
use App\Repositories\Page\PageInterface;
use App\Models\Add_to_list;
use App\Models\Add_to_massage_shortlist;
use App\Models\City;
use App\Models\Country;
use App\Models\Escort;
use App\Models\Payment;
use App\Models\EscortLike;
use App\Models\MassageLike;
use App\Models\EscortBrb;
use App\Models\Reviews;
use App\Models\State;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;
use App\Repositories\MassageProfile\MassageProfileInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class WebController extends Controller
{
    protected $escort;
    protected $availability;
    protected $services;
    protected $escortMedia;
    protected $page;
    protected $massage_profile;

    public function __construct(MassageProfileInterface $massage_profile, PageInterface $page, EscortInterface $escort, AvailabilityInterface $availability, ServiceInterface $services, EscortMediaInterface $escortMedia)
    {
        $this->escort = $escort;
        $this->availability = $availability;
        $this->services = $services;
        $this->escortMedia = $escortMedia;
        $this->page = $page;
        $this->massage_profile = $massage_profile;
    }

    public function filterLocation(Request $request)
    {
        session(['radio_location_filter' => true]);
        $query['lat'] = isset($request->data['lat']) ? $request->data['lat'] : '';
        $query['lng'] = isset($request->data['lng']) ? $request->data['lng'] : '';

        if($query['lat'] == ''){
            session()->forget('radio_location_filter'); 
        }

        $url = route('find.all', $query);
        return response()->json(['status' => true, 'location' => $url]);
    }

    public function applyFilterOnEscort($query,$str,$gender, $age, $location)
    {
        // $applyFilters = function ($query,$str) use ($gender, $age, $location) {
            $age = explode('-',$str['age']);
            if(!empty($str['age'])) {
                $age_min = $age[0];
                $age_max = $age[1];
            }

            $query->where('enabled', 1);
            if(!empty($gen))
            {
                $query->where('gender','=',$gen);
            }

            if(!empty($escort_id)) {
                $query->whereIn('id', $escort_id);
            }

            
            if(!empty($str['duration_price']))
            {

                $duration_price = $str['duration_price'];

                $query->where( function($q) use ($duration_price){
                    $q->whereHas('durations', function($q) use ($duration_price){

                        //$q->with('pivot');
                        if($duration_price == "incall_price"){
                            $q->Where('incall_price', '!=',null);

                        }
                        if($duration_price == "outcall_price"){
                            $q->Where('outcall_price', '!=',null);

                        }
                        if($duration_price == "massage_price"){
                            $q->Where('massage_price', '!=',null);

                        }


                    });
                });
            }
            
            if(!empty($str['string']))
            {
                $uid = $str['string'];
                $query->where(function($q) use ($uid){
                    $q->orWhere('name','like', '%'.$uid.'%');
                    $q->orWhere( function($q) use ($uid){
                        $q->whereHas('user', function($q) use ($uid){
                            $q->where('member_id', $uid);
                        });
                    });
                });

            }

            // if(!empty($str['state_id']))
            // {
            //     $query->where('state_id',$str['state_id']);
            // } 
            
            if(!empty($str['city_id']))
            {
                $radioLocation = request()->get('locationByRadio');  // australia
                if($radioLocation != 'australia'){
                    $query->where('city_id','=',$str['city_id']);
                }
                
                if($str['string'] == ''  && $radioLocation == 'australia'){
                    $query->where('city_id','=',$str['city_id']);
                }
            }

            if(isset($str['interest']) && $str['interest'] != null )
            {
                $query->whereIn('gender', json_decode($str['interest']));
            }
        
            if($str['gender'] != null)
            {
                $query->where('gender','=',$str['gender']);
            }

            if(!empty($str['age']) )
            {
                $query->whereBetween('age',[$age_min, $age_max]);
            }

            if(!empty($str['enabled'])) {
                $query->where('enabled', $str['enabled']);
            } 
            
            if($price = $str['price']) {
                $query->whereHas('services', function($q) use($price) {
                    if($price <= 500) {
                        $q->where('price','<=', $price);
                    } else {
                        $q->where('price','>', 500);
                    }
                });
            }

            if($services = $str['services'])
            {
                $query->whereHas('services', function($q) use($services) {
                    $q->whereIn('services.id', $services);
                });
            }
            return $query;
        // };
    }

    public function allEscortList(Request $request, $gender = null)
    {
        $user = 1;

        $array = config('escorts.profile.genders');
        
        $gender_one = array_flip($array);
        if($gender != null) {
            $gen = $gender_one[$gender];
        } else {
            $gen = null;
        }

        $user_type = null;
        $userInterest = null;
        if(auth()->user() && auth()->user()->type == 0) {
            $user_type = auth()->user();
            $userInterest = auth()->user()->interest;
        }

        $userLocation = null;
        if($request->lat != '' && $request->lng != ''){
           $userLocation = $this->getRealTimeGeolocationOfUsers($request->lat, $request->lng);
           session(['radio_location_filter'=> true]);
        }

        $paramData = [];
        if($userInterest && $userInterest->interests){
            //$cityParameterExist = request()->has('city');
            $genderParameterExist = request()->has('gender');
            $paramData['interest'] = $genderParameterExist ? null : $userInterest->interests;
            $paramData['gender'] = $genderParameterExist ? null : (($paramData['interest'] && count(json_decode($userInterest->interests)) == 1 ) ? json_decode($userInterest->interests)[0] : null);
            $stateCapital = config('escorts.profile.states')[$user_type->state_id] ?? null;
            
            $userLocation['city'] = $stateCapital ? array_key_first($stateCapital['cities']) : null;
            $userLocation['state'] = $user_type->state_id;
            
        }else{
            $paramData['interest'] = null;
            $paramData['city_id'] = null;
            $paramData['gender'] = null;
           // session(['radio_location_filter' => false]);
        }

        $params = $str  = [
            'string' => request()->get('name'),
            'city_id' => request()->get('city') ? request()->get('city') : ($userLocation ? $userLocation['city'] : null),
            'gender' => request()->get('gender') ? request()->get('gender') : $paramData['gender'],
            'age' => request()->get('age'),
            'price' => request()->get('price'),
            'duration_price' => request()->get('duration_price'),
            'services' => request()->get('services'),
            'enabled' => request()->get('enabled', 1),
            'state_id' => request()->get('state-id') ? request()->get('state-id') : ($userLocation ? $userLocation['state'] : null) ,
            //'limit'=> request()->get('limit'),
            'interest'=> $paramData['interest'] ,
            'view_type'=> request()->get('view_type')
        ];

        $radio_location_filter = session('radio_location_filter');

        if($request->get('filter_button_submit') == '1' ){
            $params['city_id'] = $str['city_id'] = request()->get('city'); // city_id = 6839
        }

        // echo '<pre>';
        // print_r($str);
        // echo '</pre>';
        session(['search_escort_filters' => $params]);
        session(['search_escort_filters_url' => url()->full()]);
        session(['is_shortlisted_profile' => false]);

        if($params['city_id'] && $params['state_id']){
            $filterStateExist = City::where('id',$params['city_id'])->where('state_id',$params['state_id'])->exists();
            $params['state_id'] = $filterStateExist ? $params['state_id'] : null;
            //$radio_location_filter = true;
        }

        if(request()->get('limit')) {
            $limit = request()->get('limit');
        } else {
            $limit = 25;
        }

        $services = $this->services->all();
        //dd($escorts->shortListed);
        //$addToList = Add_to_list::all();,'addToList'
        //dd($escorts);
        $escortId = [];
        if(session('cart') && session('is_shortlisted_profile')) {
            foreach(session('cart') as $id => $vlaue) {

                $escortId[] = $id;
            }

        }

        list($service_one, $service_two, $service_three) = $this->services->findByCategory([1,2,3]);
        $escorts = $this->escort->findByPlan($limit, $params, $user_id = null, $escortId, $userId = null ,$gen);

        //dd($escorts,$params, session('is_shortlisted_profile'));
        $locationCityId = $params['city_id'];
        $filterGenderId = $params['gender'];

        /**
         * Dummy testing
         */

        $gender   = request()->get('gender');
        $age      = request()->get('age');
        $location = request()->get('location');
        $page     = request()->get('page', 1);
        $perPage  = $limit;
        //$perPage  = 4;

        
        $platinum = $this->applyFilterOnEscort(Escort::with('durations')->where('membership', '1'),$str,$gender, $age, $location)->get();
        $gold = $this->applyFilterOnEscort(Escort::with('durations')->where('membership', '2'),$str,$gender, $age, $location)->get();
        $silver = $this->applyFilterOnEscort(Escort::with('durations')->where('membership', '3'),$str,$gender, $age, $location)->get();
        $free = $this->applyFilterOnEscort(Escort::with('durations')->where('membership', '4'),$str,$gender, $age, $location)->get();
        
        $merged = $platinum->concat($gold)->concat($silver);

        //dd($merged);
         $merged = $merged->map(function($item, $key) {
            //dd($item);
            # Add services with duration if exists
            if($item->durations){

                //dd( $item->durations()->where('duration_id','!=',1)->get());

                $item->massage_price = $item->durations()->where('name','=','1 Hour')->first() ? $item->durations()->where('name','=','1 Hour')->first()->pivot->massage_price : null;
                $item->incall_price = $item->durations()->where('name','=','1 Hour')->first() ? $item->durations()->where('name','=','1 Hour')->first()->pivot->incall_price : null;
                $item->outcall_price = $item->durations()->where('name','=','1 Hour')->first() ? $item->durations()->where('name','=','1 Hour')->first()->pivot->outcall_price : null;    

                

                $lowest_massage_price = $item->durations()->where('duration_id','!=',1)->min('massage_price') ? $item->durations()->where('duration_id','!=',1)->min('massage_price') : null;
                $lowest_incall_price = $item->durations()->where('duration_id','!=',1)->min('incall_price') ? $item->durations()->where('duration_id','!=',1)->min('incall_price') : null;
                $lowest_outcall_price = $item->durations()->where('duration_id','!=',1)->min('outcall_price') ? $item->durations()->where('duration_id','!=',1)->min('outcall_price') : null;

               $lowestPriceArray = [];

                if ($lowest_massage_price !== null) {
                    $lowestPriceArray[] = (float) $lowest_massage_price;
                }
                if ($lowest_incall_price !== null) {
                    $lowestPriceArray[] = (float) $lowest_incall_price;
                }
                if ($lowest_outcall_price !== null) {
                    $lowestPriceArray[] = (float) $lowest_outcall_price;
                }

                $lowest = !empty($lowestPriceArray) ? min($lowestPriceArray) : '';
                
                $item->lowest_rate_price = $lowest;
            }

            # get star rating on the bases on like and unlike
            $total = EscortLike::where('escort_id',$item->id)->count();
            if($total > 0) {
                $likeCount = EscortLike::where('like',1)->where('escort_id',$item->id)->count();
                $dislikeCount = EscortLike::where('like',0)->where('escort_id',$item->id)->count();
                $lp = round($likeCount/$total * 100);
                $dp = round($dislikeCount/$total * 100);
            } else {
                $lp = 0;
                $dp = 0;
            }

            if ($lp == 100) {
                $item->star_rating = 5;
            } elseif ($lp < 100 && $lp > 80) {
                $item->star_rating = 4;
            } elseif ($lp <= 80 && $lp > 60) {
                $item->star_rating = 3;
            } elseif ($lp <= 60 && $lp > 40) {
                $item->star_rating = 2;
            } elseif ($lp <= 40 && $lp > 20) {
                $item->star_rating = 1;
            } else {
                $item->star_rating = 0;
            }
            //$item->star_rating = $lp;
            return $item;
        })->collect();
        
        // $platinum = $applyFilters(Escort::where('membership', '1'),$str)->get();
        // $gold = $applyFilters(Escort::where('membership', '2'),$str)->get();
        // $silver = $applyFilters(Escort::where('membership', '3'),$str)->get();
        // $free = $applyFilters(Escort::where('membership', '4'),$str)->get();

        $memberTotalCount[1] =  $platinum->count();
        $memberTotalCount[2] =  $gold->count();
        $memberTotalCount[3] =  $silver->count();
        $memberTotalCount[4] =  $free->count();

        $merged = $platinum->concat($gold)->concat($silver)->concat($free);
       
        $sliced = $merged->slice(($page - 1) * $perPage, $perPage)->values();
        $paginator = new LengthAwarePaginator(
            $sliced,
            $merged->count(),
            $perPage,
            $page,
            [
                'path' => request()->url(),  // Only the base URL (without query)
                'query' => request()->except(['ipinfo']) // Exclude the 'ipinfo' query parameters
            ]
        );

        $all_services_tag = $service_one->merge($service_two)->merge($service_three);
        $viewType = 'grid';
        if(request()->get('view_type') == 'list'){
            $viewType = 'list';
        }

        return view('web.all-filter-profile', compact('paginator','user_type','escortId','user','services', 'service_one', 'service_two', 'service_three', 'escorts', 'locationCityId','filterGenderId','memberTotalCount','radio_location_filter','all_services_tag','viewType'));
    }

    public function getRealTimeGeolocationOfUsers($lat, $lng)
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
           $stateFromDb = State::where('name','like','%'.$state.'%')->first();

            $stateCapital = config('escorts.profile.states')[$stateFromDb->id] ?? null;

            $parms =[
                'state'=> $stateFromDb ? $stateFromDb->id : null,
                'city'=> $stateCapital ? array_key_first($stateCapital['cities']) : null,
            ];

            return $parms;
        } catch (\Exception $e) {
            //throw $th;
            $parms =[
                'state'=>null,
                'city'=>null,
            ];

            return $parms;
        }
        
    }

    public function shortList()
    {
        $user = auth()->user();

        $params  = [
            'string' => request()->get('name'),
            'city_id' => request()->get('city'),
            'gender' => request()->get('gender'),
            'age' => request()->get('age'),
            'price' => request()->get('price'),
            'services' => request()->get('services'),
        ];

        list($service_one, $service_two, $service_three) = $this->services->findByCategory([1,2,3]);

        $escorts = $this->escort->findByPlan(50, $params, $user->id);
        $services = $this->services->all();

        return view('web.all-filter-profile', compact('user','services', 'service_one', 'service_two', 'service_three', 'escorts'));
        //return view('web.gread-list-escorts', compact('services', 'service_one', 'service_two', 'service_three', 'escorts'));
    }
    public function showAddList(Request $request)
    {
        $escortId = [];
        if(session('cart')) {
            foreach(session('cart') as $id => $vlaue) {
                $escortId[] = $id;
            }
        }
        else {
            //dd('hefye');
            // return redirect()->route('find.all', $query);
            $escortId[] = null;
        }
        
        //$user = auth()->user();
        $user = null;
        $user_type = null;
        if(auth()->user() && auth()->user()->type == 0) {
            $user_type = auth()->user();
        }
        $userid = null;
        $params  = [
            'string' => request()->get('name'),
            'city_id' => request()->get('city'),
            'gender' => request()->get('gender'),
            'age' => request()->get('age'),
            'price' => request()->get('price'),
            'duration_price' => request()->get('duration_price'),
            'services' => request()->get('services'),
        ];

        session(['search_shorlisting_escort_filters' => $params]);
        session(['search_shorlisting_escort_filters_url' => url()->full()]);
        session(['is_shortlisted_profile' => true]);

        $escorts = $this->escort->findByMyShortlist(50, $params, $userid, $escortId);
        list($service_one, $service_two, $service_three) = $this->services->findByCategory([1,2,3]);

        $services = $this->services->all();

        $backToListing = session('search_escort_filters_url');
        
        $radio_location_filter = session('radio_location_filter');
        $all_services_tag = $service_one->merge($service_two)->merge($service_three);
        $defaultViewType = 'list';

        $backToListing = preg_replace('/view_type=(grid|list)/', 'view_type=list', $backToListing);

        $escorts = $escorts->map(function($item, $key) {
            # get star rating on the bases on like and unlike
            $total = EscortLike::where('escort_id',$item->id)->count();
            if($total > 0) {
                $likeCount = EscortLike::where('like',1)->where('escort_id',$item->id)->count();
                $dislikeCount = EscortLike::where('like',0)->where('escort_id',$item->id)->count();
                $lp = round($likeCount/$total * 100);
                $dp = round($dislikeCount/$total * 100);
            } else {
                $lp = 0;
                $dp = 0;
            }

            if ($lp == 100) {
                $item->star_rating = 5;
            } elseif ($lp < 100 && $lp > 80) {
                $item->star_rating = 4;
            } elseif ($lp <= 80 && $lp > 60) {
                $item->star_rating = 3;
            } elseif ($lp <= 60 && $lp > 40) {
                $item->star_rating = 2;
            } elseif ($lp <= 40 && $lp > 20) {
                $item->star_rating = 1;
            } else {
                $item->star_rating = 0;
            }
            //$item->star_rating = $lp;
            return $item;
        })->collect();

        // if(request()->has('list') || request()->get('view_type') == 'list'){
        //     $backToListing = preg_replace('/view_type=(grid|list)/', 'view_type=list', $backToListing);
        // }else{
        //     $backToListing = preg_replace('/view_type=(grid|list)/', 'view_type=grid', $backToListing);
        // }
        //dd($all_services_tag);
        // dd($escorts);
        //dd($escorts->items()[1]->where(8));
        return view('web.myShortlist.shortlist', compact('user_type','user','services', 'service_one', 'service_two', 'service_three', 'escorts','backToListing','radio_location_filter','all_services_tag','defaultViewType'));
        //return view('web.gread-list-escorts', compact('services', 'service_one', 'service_two', 'service_three', 'escorts'));
    }

    public function clearShortList(Request $request)
    {
        
        session()->forget('cart'); 
        $query = Arr::except(request()->query(), ['ipinfo']);

        // Redirect with preserved query parameters
        return redirect()->route('find.all', $query);
    }

    public function mcMyShortList()
    {

        $escortId = [];
        if(session('mc_cart')) {
            foreach(session('mc_cart') as $id => $vlaue) {

                $escortId[] = $id;
            }

        }
        else {
            $escortId[] = null;
        }
        //dd($escortId);

        //$user = auth()->user();
        $user = null;
        $user_type = null;
        if(auth()->user() && auth()->user()->type == 0) {
            $user_type = auth()->user();
        }
        $userid = null;
        $params  = [
            'string' => request()->get('name'),
            'city_id' => request()->get('city'),
            'premises' => request()->get('premises'),
            'masseur_types' => request()->get('masseur_types'),
            'age' => request()->get('age'),
            'prices' => request()->get('prices'),
            'massage_services' => request()->get('massage_services'),
            'other_services' => request()->get('other_services'),
        ];

       // $escorts = $this->escort->findByMyShortlist(50, $params, $userid, $escortId);
        //$escorts = $this->massage_profile->findByMassageCentre(50, $params ,$userid, $escortId);
        $escorts = $this->massage_profile->findByMyMassageShortListed(50, $params ,$userid, $escortId);
        //dd($escorts);
        list($service_one, $service_two, $service_three) = $this->services->findByCategory([1,2,3]);


        $services = $this->services->all();

       //dd($userid);
        //dd($escorts->items()[1]->where(8));
        //return view('web.myShortlist.shortlist', compact('user_type','user','services', 'service_one', 'service_two', 'service_three', 'escorts'));

        return view('web.massage-show-list', compact('escortId','user_type','user','services', 'service_one', 'service_two', 'service_three', 'escorts'));

        //return view('web.gread-list-escorts', compact('services', 'service_one', 'service_two', 'service_three', 'escorts'));
    }

    public function massageList()
    {
        $params  = [
            'string' => request()->get('name'),
            'city_id' => request()->get('city'),
            'premises' => request()->get('premises'),
            'masseur_types' => request()->get('masseur_types'),
            'age' => request()->get('age'),
            'prices' => request()->get('prices'),
            'massage_services' => request()->get('massage_services'),
            'other_services' => request()->get('other_services'),
        ];

        list($service_one, $service_two, $service_three) = $this->services->findByCategory([1,2,3]);
        $escorts = $this->massage_profile->findByMassageCentre(50, $params);
        $services = $this->services->all();
        //$availability = $escorts->availability;
        $escortId = [];
        if(session('mc_cart')) {
            foreach(session('mc_cart') as $id => $vlaue) {

                $escortId[] = $id;
            }

        }
        $user_type = null;
        if(auth()->user() && auth()->user()->type == 0) {
            $user_type = auth()->user();
        }

        // dd($user_type->myLegBox);
        //dd($user_type->myLegBox->pluck('id')->toArray());
        //dd($user_type->massageCenterLegBox->pluck('id')->toArray());
        return view('web.massage-centre-list', compact('user_type','escortId','services', 'service_one', 'service_two', 'service_three', 'escorts'));
        //return view('web.gread-list-escorts', compact('services', 'service_one', 'service_two', 'service_three', 'escorts'));
    }

    public function searchFilter(Request $request)
    {
        $string = $request->string;
        list($service_one, $service_two, $service_three) = $this->services->findByCategory([1,2,3]);
        $escorts = $this->escort->findByPlan(50, $string);
        $services = $this->services->all();
        //dd($escorts);
        return view('web.all-filter-profile', compact('services', 'service_one', 'service_two', 'service_three', 'escorts'));
        //return view('web.gread-list-escorts', compact('services', 'service_one', 'service_two', 'service_three', 'escorts'));
    }

    public function gridEscortList()
    {
        list($service_one, $service_two, $service_three) = $this->services->findByCategory([1,2,3]);
        $escorts = $this->escort->findByPlan(50);
        $services = $this->services->all();


        //dd($escorts);
        $template = view('web.grid-list-escorts', compact('services', 'service_one', 'service_two', 'service_three', 'escorts'))->render();
        return response()->json(compact('template'));

    }

    public function addToMcCart($escort_id)
    {
        //dd($escort_id);
        $userId = auth()->user() ? auth()->user()->id : null; //request()->post('userId');
        if( count((array) session('mc_cart')) > 0) {
            $mc_cart = session()->get('mc_cart');
        }
        else {
            $mc_cart = session()->get('mc_cart', []);
        }

        if(isset($mc_cart[$escort_id])) {
            $mc_cart[$escort_id]['quantity']++;
            $error = 0;
        } else {
            $mc_cart[$escort_id] = [
                "user_id" => $userId,
                "quantity" => 1,
            ];
            $error = 1;
        }

        session()->put('mc_cart', $mc_cart);
        $count_session = count(session('mc_cart'));
        return response()->json(compact('error','mc_cart','count_session'));
        //return redirect()->back()->with('success', 'Product added to cart successfully!');


    }
    public function removeToMcCart()
    {

        $escort_id = request()->post('escortId');
        //dd($escort_id);
        // $userId = auth()->user() ? auth()->user()->id : null; //request()->post('userId');
        // $index = [
        //         'user_id' => $userId,
        //         'escort_id' => $escort_id,
        //         ];
        $error = 0;
        if($escort_id) {
            $mc_cart = session()->get('mc_cart');
            if(isset($mc_cart[$escort_id])) {
                unset($mc_cart[$escort_id]);
                session()->put('mc_cart', $mc_cart);
                $count_session = count(session('mc_cart'));
                $error = 1;
            }
        }
                // if(!empty($userId)) {

                //     if(Add_to_list::where('escort_id',$escort_id)->where('user_id', $userId)->delete())
                //     {
                //         $error = 1;
                //     } else {
                //         $error = 0;
                //     }
                // }


        return response()->json(compact('error','count_session'));

    }
    public function addtocart($escort_id)
    {
        //dd($escort_id);
        $userId = auth()->user() ? auth()->user()->id : null; //request()->post('userId');
        if( count((array) session('cart')) > 0) {
            $cart = session()->get('cart');
        }
        else {
            $cart = session()->get('cart', []);
        }

        if(isset($cart[$escort_id])) {
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
        return response()->json(compact('error','cart','count_session'));
        //return redirect()->back()->with('success', 'Product added to cart successfully!');


    }
    public function saveShortList()
    {

        $escort_id = request()->post('escortId');
        $userId = auth()->user() ? auth()->user()->id : null; //request()->post('userId');
        $index = [
                'user_id' => $userId,
                'escort_id' => $escort_id,
                ];
                $error = 0;
                if(!empty($userId)) {
                    $result = Add_to_list::where('escort_id',$escort_id)->where('user_id', $userId)->first();
                    if(!empty($result))
                    {
                        $error = 0;
                    } else {
                        $data = Add_to_list::create($index);
                        $error = 1;
                    }
                }


        return response()->json(compact('error'));

    }
    public function saveMcShortList()
    {

        $massage_id = request()->post('escortId');
        $userId = auth()->user() ? auth()->user()->id : null; //request()->post('userId');
        $index = [
                'user_id' => $userId,
                'massage_id' => $massage_id,
                ];
                $error = 0;
                if(!empty($userId)) {
                    $result = Add_to_massage_shortlist::where('massage_id',$escort_id)->where('user_id', $userId)->first();
                    if(!empty($result))
                    {
                        $error = 0;
                    } else {
                        $data = Add_to_massage_shortlist::create($index);
                        $error = 1;
                    }
                }


        return response()->json(compact('error'));

    }

    public function removeShortList()
    {

        $escort_id = request()->post('escortId');
        //dd($escort_id);
        // $userId = auth()->user() ? auth()->user()->id : null; //request()->post('userId');
        // $index = [
        //         'user_id' => $userId,
        //         'escort_id' => $escort_id,
        //         ];
                $error = 0;
                if($escort_id) {
                    $cart = session()->get('cart');
                    if(isset($cart[$escort_id])) {
                        unset($cart[$escort_id]);
                        session()->put('cart', $cart);
                        $count_session = count(session('cart'));
                        $error = 1;
                    }
                }
                // if(!empty($userId)) {

                //     if(Add_to_list::where('escort_id',$escort_id)->where('user_id', $userId)->delete())
                //     {
                //         $error = 1;
                //     } else {
                //         $error = 0;
                //     }
                // }


        return response()->json(compact('error','count_session'));

    }


    public function profileDescriptionBKP($id)
    {
        $escort = $this->escort->find($id);
        $availability = $escort->availability;
        $services = $this->services->all();
        $count = round(count($this->services->all())/3);
        $services_one = $this->services->limit(0,$count);

        $services_two = $this->services->limit($count, $count);
        $services_three = $this->services->limit($count*2, $count);
        $escort_id =  $escort->id;
        $services_one->map(function($service, $key) use($escort) {
            $service->services_price = null;
            if($escort_service = $escort->services()->where('services.id', $service->id)->first()) {
                $service->services_price = $escort_service->pivot->price;
            }
            return $service;
        });
        $user_type = null;
        if(auth()->user() && auth()->user()->type == 0) {
          $user_type = auth()->user();
        }

        //dd($user_type->myLegBox->pluck('id')->toArray());
       // dd($services_one);
        return view('web.description',compact('user_type','escort','availability','services_one','services_two','services_three'));
    }
    public function servicesById($escort_id, $cat_id)
    {
        $escort = $this->escort->find($escort_id);

        $services = [];

        if(!empty($escort) && $escort->services->isNotEmpty()) {


            $rows = count($escort->services()->where('category_id', 3)->get());


            if($rows == 1) {
                $services[] = $escort->services()->where('category_id', $cat_id)->get();
            } elseif($rows == 2) {
                $services[] = $escort->services()->where('category_id', $cat_id)->offset(0)->limit(1)->get();
                $services[] = $escort->services()->where('category_id', $cat_id)->offset(1)->limit($rows)->get();
            } else {
                $count1 = round($rows/3);

                $services[] = $escort->services()->where('category_id', $cat_id)->offset(0)->limit($count1)->get();
                $services[] = $escort->services()->where('category_id', $cat_id)->offset($count1)->limit($count1)->get();
                $services[] = $escort->services()->where('category_id', $cat_id)->offset($count1*2)->limit($count1*10)->get();


            }
        }




        return $services;
    }
    public function profileDescription(Request $request, $id, $city=null, $membershipId =null, $viewType='grid')
    {
        $escort = Escort::where('id',$id)->with('reviews','reviews.user')->first();
        //dd($escort);
        $media = $this->escortMedia->get_videos($escort->user_id);
        $path = $this->escortMedia->findByVideoposition($escort->user_id,1)['path'];
        if(! $escort) {
            //list($next, $previous) = $this->escort->getlinks($id);
            //dd($escort);
        }
        //dd($escort);
        //'enabled'=>0,'membership'

        if(!empty($escort) && $escort->enabled == 0 && $escort->membership == null) {
           // dd($escort);
        }
        // $mytime = Carbon::now()->format('Y-m-d');
        // $escort = Escort::whereDate('end_date','<',$mytime)->where('id',$id)->update(['enabled'=>0]);
        //
        $escortId =[];

        $filterEscortsParams = session('search_escort_filters');

        if($filterEscortsParams == null){
            $filterEscortsParams  = [
                'string' => request()->get('name'),
                'city_id' => request()->get('city'),
                'gender' => request()->get('gender'),
                'age' => request()->get('age'),
                'price' => request()->get('price'),
                'duration_price' => request()->get('duration_price'),
                'services' => request()->get('services'),
                'enabled' => request()->get('enabled', 1),
                'state_id' => request()->get('state-id') ? request()->get('state-id') : Session::get('session_state_id'),
                'limit'=> request()->get('limit'),
                'view_type'=> request()->get('view_type'),
            ];
        }

        if(isset($filterEscortsParams['limit'])) {
            $limit = $filterEscortsParams['limit'];
        } else {
            $limit = 25;
        }

        $backToSearchButton = session('search_escort_filters_url');

        if(session('is_shortlisted_profile') == true){
            $cartKeys = array_keys(session('cart'));
            if (count($cartKeys) > 0) {
                sort($cartKeys); // Sort the array in ascending order
                $escortId = $cartKeys;
            } else {
                $escortId = [];
            }

            $filterEscortsParams = session('search_shorlisting_escort_filters');
            $backToSearchButton = session('search_shorlisting_escort_filters_url');
        }

        // $filterEscorts = $this->escort->findByPlan($limit, $filterEscortsParams, $user_id = null, $escortId, $userId = null , 'profile_details');

        $location = request()->get('location');

        $platinum = $this->applyFilterOnEscort(Escort::with('durations')->where('membership', '1'),$filterEscortsParams,$filterEscortsParams['gender'], $filterEscortsParams['age'], $location)->get();
        $gold = $this->applyFilterOnEscort(Escort::with('durations')->where('membership', '2'),$filterEscortsParams,$filterEscortsParams['gender'], $filterEscortsParams['age'], $location)->get();
        $silver = $this->applyFilterOnEscort(Escort::with('durations')->where('membership', '3'),$filterEscortsParams,$filterEscortsParams['gender'], $filterEscortsParams['age'], $location)->get();
        $free = $this->applyFilterOnEscort(Escort::with('durations')->where('membership', '4'),$filterEscortsParams,$filterEscortsParams['gender'], $filterEscortsParams['age'], $location)->get();
        
        $filterEscorts = $platinum->concat($gold)->concat($silver);

        if(session('is_shortlisted_profile') == true){
            $filterEscorts = $filterEscorts->sortBy('id')->values();
        }
        
        list($next, $previous) = $this->escort->getlinks($id, $city, $membershipId, $filterEscorts);
        $availability = $escort ? $escort->availability : null;

        /*new functionality*/
        if(request()->has('list') || request()->get('view_type') == 'list'){
            $viewType = 'list';
            $next = $next. '?'.$viewType;
            $previous = $previous. '?'.$viewType;

            $backToSearchButton = preg_replace('/view_type=(grid|list)/', 'view_type=list', $backToSearchButton);
        }else{
            $viewType = 'grid';
            $next = $next. '?'.$viewType;
            $previous = $previous. '?'.$viewType;

            $backToSearchButton = preg_replace('/view_type=(grid|list)/', 'view_type=grid', $backToSearchButton);
        }

        // dd($backToSearchButton);

        // if($filterEscortsParams['view_type'] == 'list'){
        //     $viewType = 'list';
        //     $next = $next. '?'.$viewType;
        //     $previous = $previous. '?'.$viewType;
        // }

        $services1 = $this->servicesById($id, 1);

        $cat1_services_one = null;
        $cat1_services_two = null;
        $cat1_services_three = null;


        if(isset($services1[0])) {
            $cat1_services_one = $services1[0];
        }
        if(isset($services1[1])) {
            $cat1_services_two = $services1[1];
        }
        if(isset($services1[2])) {
            $cat1_services_three = $services1[2];
        }
        $services2 = $this->servicesById($id, 2);

        $cat2_services_one = null;
        $cat2_services_two = null;
        $cat2_services_three = null;
        if(isset($services2[0])) {
            $cat2_services_one = $services2[0];
        }
        if(isset($services2[1])) {
            $cat2_services_two = $services2[1];
        }
        if(isset($services2[2])) {
            $cat2_services_three = $services2[2];
        }
        // $cat2_services_one = $services2[0];
        // $cat2_services_two = $services2[1];
        // $cat2_services_three = $services2[2];
        $eid = $id;
        $services3 = $this->servicesById($id, 3);

        $cat3_services_one = null;
        $cat3_services_two = null;
        $cat3_services_three = null;
        if(isset($services3[0])) {
            $cat3_services_one = $services3[0];
        }
        if(isset($services3[1])) {
            $cat3_services_two = $services3[1];
        }
        if(isset($services3[2])) {
            $cat3_services_three = $services3[2];
        }

        //dd($cat1_services_one->pivot->price);

        /*end functionality*/


        //$escort->services()->where('category_id', 1)->get() as $value
        // $cid1 = 1;
        // $servicesByCategory1 = $this->services->CategoryByServices($cid1,$escort);

        // $cat1_services_one = $servicesByCategory1[0];
        // $cat1_services_two = $servicesByCategory1[1];
        // $cat1_services_three = $servicesByCategory1[2];
        // $cid2 = 2;
        // $servicesByCategory2 = $this->services->CategoryByServices($cid2,$escort);

        // $cat2_services_one = $servicesByCategory2[0];
        // $cat2_services_two = $servicesByCategory2[1];
        // $cat2_services_three = $servicesByCategory2[2];
        // $cid3 = 3;
        // $servicesByCategory3 = $this->services->CategoryByServices($cid3,$escort);

        // $cat3_services_one = $servicesByCategory3[0];
        // $cat3_services_two = $servicesByCategory3[1];
        // $cat3_services_three = $servicesByCategory3[2];



      //  dd($services_one);
        $user_type = null;
        $escortLike = null;
        $userId = !empty(auth()->user()) ? auth()->user()->id : NULL;
        $escortLike = $this->_getUserLikeDislike($id, $request->ip(), $userId);
        //dd($escortLike);
        if(auth()->user() && auth()->user()->type == 0) {
          $user_type = auth()->user();

        }
        $total = EscortLike::where('escort_id',$id)->count();
        if($total > 0) {
            $likeCount = EscortLike::where('like',1)->where('escort_id',$id)->count();
            $dislikeCount = EscortLike::where('like',0)->where('escort_id',$id)->count();
            $lp = round($likeCount/$total * 100);
            $dp = round($dislikeCount/$total * 100);
        } else {
            $lp = 0;
            $dp = 0;
        }

        // dd($lp, $dp); lp-67 dp-33

        $brb = new EscortBrb();
        $brb = $brb->where('profile_id', $id)->where('brb_time', '>', date('Y-m-d H:i:s'))->where('active', 'Y')->orderBy('brb_time', 'desc')->first();
        if($brb) {
            $brb = $brb->toArray(); 
        }

        // return view('web.description',compact('escortLike','lp','dp','user_type','next','previous','escort','availability','cat1_services_one','cat1_services_two','cat1_services_three','cat2_services_one','cat2_services_two','cat2_services_three','cat3_services_one','cat3_services_two','cat3_services_three'));

        $reviews = Reviews::where('escort_id',$id)->where('status','approved')->with('user')->get()->unique('user_id');
        //dd($viewType);
        $user = DB::table('users')->where('id',(int)$escort->user_id)->select('contact_type')->first();
        //dd($user, $escort->user_id);
        return view('web.description',compact('brb', 'path','media','escortLike','lp','dp','user_type','next','previous','escort','availability','cat1_services_one','cat1_services_two','cat1_services_three','cat2_services_one','cat2_services_two','cat2_services_three','cat3_services_one','cat3_services_two','cat3_services_three','backToSearchButton','user','viewType','reviews'));
    }
    public function centerProfileDescription($id)
    {

        $escort = $this->massage_profile->find($id);
        //dd($escort->gallary[0]->path);
        list($next, $previous) = $this->massage_profile->getlinks($id);
        $availability = $escort->availability;
        /*new functionality*/

        $services1 = [];//$this->servicesById($id, 1);
        $cat1_services_three = null;
        $cat1_services_two = null;
        $cat1_services_three = null;


        if(isset($services1[0])) {
            $cat1_services_one = $services1[0];
        }
        if(isset($services1[1])) {
            $cat1_services_two = $services1[1];
        }
        if(isset($services1[2])) {
            $cat1_services_three = $services1[2];
        }
        $services2 = [];//$this->servicesById($id, 2);
        $cat2_services_three = null;
        $cat2_services_two = null;
        $cat2_services_three = null;
        if(isset($services2[0])) {
            $cat2_services_one = $services2[0];
        }
        if(isset($services2[1])) {
            $cat2_services_two = $services2[1];
        }
        if(isset($services2[2])) {
            $cat2_services_three = $services2[2];
        }
        // $cat2_services_one = $services2[0];
        // $cat2_services_two = $services2[1];
        // $cat2_services_three = $services2[2];
        $services3 = [];//$this->servicesById($id, 3);
        $cat3_services_three = null;
        $cat3_services_two = null;
        $cat3_services_three = null;
        if(isset($services3[0])) {
            $cat3_services_one = $services3[0];
        }
        if(isset($services3[1])) {
            $cat3_services_two = $services3[1];
        }
        if(isset($services3[2])) {
            $cat3_services_three = $services3[2];
        }


        $user_type = null;
        if(auth()->user() && auth()->user()->type == 0) {
          $user_type = auth()->user();
        }


        $massageLike = null;
        if(auth()->user()) {
                $massageLike = MassageLike::where('massage_id',$id)->where('user_id',auth()->user()->id)->first();
        }

        $total = MassageLike::where('massage_id',$id)->count();
        if($total > 0) {
            $likeCount = MassageLike::where('like',1)->where('massage_id',$id)->count();
            $dislikeCount = MassageLike::where('like',0)->where('massage_id',$id)->count();
            $lp = round($likeCount/$total * 100);
            $dp = round($dislikeCount/$total * 100);
        } else {
            $lp = 0;
            $dp = 0;
        }

        //dd($user_type->myLegBox);
        return view('web.massage-description',compact('massageLike','lp','dp','user_type','next','previous','escort','availability'));
    }

    public function showFooterLink($slug)
    {

        $page = $this->page->viewPage($slug);

		return view('admin.pages.view', compact('page'));
    }
    public function usagePolicy(Request $request)
    {

        //dd( $request->cookie());
    return view('web.pages.acceptable-use-policy');
    }
    public function likeDislike(Request $request)
    {
        $userId = !empty(auth()->user()) ? auth()->user()->id : NULL;
        $escort_id = $request->escortId;
        $like = $request->vote;
        //request()->post('userId');
        $votingData = [
            'user_id' => $userId,
            'escort_id' => $escort_id,
            'like' => $like,
            'ip_address' => $request->ipinfo->ip,
        ];
        $todayVote = $this->_getUserLikeDislike($escort_id, $request->ipinfo->ip, $userId);

        $error = 0;
        if($todayVote) {
            $todayVote->like = $like;
            if(!$todayVote->save()) {
                $error = 1;
            }
        } else {
            $votingData = EscortLike::create($votingData);
            if(!$votingData) {
                $error = 1;
            }
        }

        $total = EscortLike::where('escort_id', $escort_id)->count();
        if($total > 0) {
            $likeCount = EscortLike::where('like',1)->where('escort_id',$escort_id)->count();
            $dislikeCount = EscortLike::where('like',0)->where('escort_id',$escort_id)->count();
            $lp = round($likeCount/$total * 100);
            $dp = round($dislikeCount/$total * 100);
        } else {
            $lp = 0;
            $dp = 0;
        }

        return response()->json(compact('error','lp','dp', 'like'));
    }


    private function _getUserLikeDislike($escort_id, $ip, $userId)
    {
        $result = EscortLike::where('escort_id', $escort_id)
            ->whereBetween('created_at', [date('Y-m-d') . ' 00:00:00', date('Y-m-d') . ' 23:59:59']);
        $conditions = [
            ['ip_address', $ip]
        ];
        if($userId) {
            $conditions[] = ['user_id', $userId];
        }
        $result = $result->where(function($q) use ($ip, $userId) {
            $q->where('ip_address', $ip);
            if($userId) {
                $q->orWhere('user_id', $userId);
            }
        })->first();

        return $result;
    }


    public function massageLikeDislike(Request $request)
    {
        $userId = auth()->user()->id;
        $massage_id = $request->massageId;
        $like = $request->like;
        //request()->post('userId');
        $index = [
                'user_id' => $userId,
                'massage_id' => $massage_id,
                'like' => $like,
                ];
                $error = 0;
                if(!empty($userId)) {
                    $result = MassageLike::where('massage_id',$massage_id)->where('user_id', $userId)->first();
                    if(!empty($result))
                    {
                        if($result->like == $like) {
                            $result->delete();
                            $error = 2;
                        } else {
                            $result->like = $like;
                            $result->save();
                            $error = 0;
                        }


                    } else {
                        $data = MassageLike::create($index);
                        $error = 1;
                    }
                }
                $total = MassageLike::where('massage_id',$massage_id)->count();
                if($total > 0) {
                    $likeCount = MassageLike::where('like',1)->where('massage_id',$massage_id)->count();
                    $dislikeCount = MassageLike::where('like',0)->where('massage_id',$massage_id)->count();
                    $lp = round($likeCount/$total * 100);
                    $dp = round($dislikeCount/$total * 100);
                } else {
                    $lp = 0;
                    $dp = 0; 

                }

        return response()->json(compact('error','lp','dp'));

    }

}
