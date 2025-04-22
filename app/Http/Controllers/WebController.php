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
use App\Models\State;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;
use App\Repositories\MassageProfile\MassageProfileInterface;
use Illuminate\Support\Facades\Session;

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
    public function allEscortList($gender = null)
    {
        $user = 1;

        $array = config('escorts.profile.genders');
        

        $gender_one = array_flip($array);
        if($gender != null) {
            $gen = $gender_one[$gender];
        } else {
            $gen = null;
        }

        // dd($array, auth()->user(), $gender_one, $gen);


        //dd($gen[$gender]);
        // if(!$user_type = auth()->user()) {
        //     $user_type = auth()->user()->make();
        // }

        $user_type = null;
        if(auth()->user() && auth()->user()->type == 0) {
            $user_type = auth()->user();
        }
        // dd(request()->all(), auth()->user());

        $params  = [
            'string' => request()->get('name'),
            'city_id' => request()->get('city'),
            'gender' => request()->get('gender'),
            'age' => request()->get('age'),
            'price' => request()->get('price'),
            'duration_price' => request()->get('duration_price'),
            'services' => request()->get('services'),
            'enabled' => request()->get('enabled', 1),
            'state_id' => request()->get('state-id') ? request()->get('state-id') : Session::get('session_state_id'),
            'limit'=> request()->get('limit')
        ];

        session(['search_escort_filters' => $params]);
        session(['search_escort_filters_url' => url()->full()]);

        if($params['city_id'] && $params['state_id']){
            $filterStateExist = City::where('id',$params['city_id'])->where('state_id',$params['state_id'])->exists();
            $params['state_id'] = $filterStateExist ? $params['state_id'] : null;
        }

        if(request()->get('limit')) {
            $limit = request()->get('limit');
        } else {
            $limit = 25;
        }
        
        //dd($escorts);
        $services = $this->services->all();
        //dd($escorts->shortListed);
        //$addToList = Add_to_list::all();,'addToList'
        //dd($escorts);
        $escortId = [];
        if(session('cart')) {
            foreach(session('cart') as $id => $vlaue) {

                $escortId[] = $id;
            }

        }

        list($service_one, $service_two, $service_three) = $this->services->findByCategory([1,2,3]);
        $escorts = $this->escort->findByPlan($limit, $params, $user_id = null, $escortId, $userId = null ,$gen);

        return view('web.all-filter-profile', compact('user_type','escortId','user','services', 'service_one', 'service_two', 'service_three', 'escorts'));
        //return view('web.gread-list-escorts', compact('services', 'service_one', 'service_two', 'service_three', 'escorts'));
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


        //dd($escorts->items()[1]->where(8));
        return view('web.all-filter-profile', compact('user','services', 'service_one', 'service_two', 'service_three', 'escorts'));
        //return view('web.gread-list-escorts', compact('services', 'service_one', 'service_two', 'service_three', 'escorts'));
    }
    public function showAddList()
    {
        $escortId = [];
        if(session('cart')) {
            foreach(session('cart') as $id => $vlaue) {

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
            'gender' => request()->get('gender'),
            'age' => request()->get('age'),
            'price' => request()->get('price'),
            'duration_price' => request()->get('duration_price'),
            'services' => request()->get('services'),
        ];

        $escorts = $this->escort->findByMyShortlist(50, $params, $userid, $escortId);
        list($service_one, $service_two, $service_three) = $this->services->findByCategory([1,2,3]);


        $services = $this->services->all();

        //dd($escorts);
        //dd($escorts->items()[1]->where(8));
        return view('web.myShortlist.shortlist', compact('user_type','user','services', 'service_one', 'service_two', 'service_three', 'escorts'));
        //return view('web.gread-list-escorts', compact('services', 'service_one', 'service_two', 'service_three', 'escorts'));
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
        //dd($escorts);
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
    public function profileDescription(Request $request, $id, $city=null, $membershipId =null)
    {
        $escort = $this->escort->find($id);
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

        if(isset($filterEscortsParams['limit'])) {
            $limit = $filterEscortsParams['limit'];
        } else {
            $limit = 25;
        }

        $filterEscorts = $this->escort->findByPlan($limit, $filterEscortsParams, $user_id = null, $escortId, $userId = null , 'profile_details');
        $backToSearchButton = session('search_escort_filters_url');

        list($next, $previous) = $this->escort->getlinks($id, $city, $membershipId, $filterEscorts);
        $availability = $escort ? $escort->availability : null;

        /*new functionality*/

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

        $brb = new EscortBrb();
        $brb = $brb->where('profile_id', $id)->where('brb_time', '>', date('Y-m-d H:i:s'))->where('active', 'Y')->orderBy('brb_time', 'desc')->first();
        if($brb) {
            $brb = $brb->toArray();
        }

        // return view('web.description',compact('escortLike','lp','dp','user_type','next','previous','escort','availability','cat1_services_one','cat1_services_two','cat1_services_three','cat2_services_one','cat2_services_two','cat2_services_three','cat3_services_one','cat3_services_two','cat3_services_three'));

        return view('web.description',compact('brb', 'path','media','escortLike','lp','dp','user_type','next','previous','escort','availability','cat1_services_one','cat1_services_two','cat1_services_three','cat2_services_one','cat2_services_two','cat2_services_three','cat3_services_one','cat3_services_two','cat3_services_three','backToSearchButton'));
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
