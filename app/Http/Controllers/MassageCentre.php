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
  

   

    public function __construct(MassageReviewInterface $reviews, MassageProfileInterface $massage_profile ,MessageInterface $massage, MessageMediaInterface $media, ThumbnailInterface $thumbnail,  ServiceInterface $service, MassageDurationInterface $duration,MassageAvailabilityInterface $massage_availability)
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
        return view('web.mc.massage-centre-list');
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

            $stateFromDb = State::where('name','like','%'.$state.'%')->first();
            $stateCapital = config('escorts.profile.states')[$stateFromDb->id] ?? null;

            $parms =[
                'state'=> $stateFromDb ? $stateFromDb->id : null,
                'city'=> $stateCapital ? array_key_first($stateCapital['cities']) : null,
            ];

            return $parms;
        } catch (\Exception $e) {
            $parms =[
                'state'=>null,
                'city'=>null,
            ];

            return $parms;
        }
        
    }

   

    public function mcAjaxList(Request $request)
    {
        $per_page = 25;
        $logedInUpser = auth()->user();
        // $massage_live_ids =   MassagePurchase::where('status', 'listed')
        //     ->whereHas('user', function ($q) {
        //         $q->where('status', 1);
        //     })->pluck('massage_profile_id');

            $massage_live_ids = MassagePurchase::where('status', 'listed')
            ->whereHas('user', function ($q) {
                $q->where('status', 1);
            })
            ->whereDoesntHave('activeSuspendProfile')
            ->pluck('massage_profile_id');


     

        //$mc_live_list = [153, 154, 156, 157, 159, 162, 161, 164];
        $mc_live_list = $massage_live_ids;
        $mc_user_id = [];
        if(!empty($mc_live_list))
        $mc_user_id   = MassageProfile::whereIn('id',$mc_live_list)->distinct()->pluck('user_id')->toArray();


         $filter_by_location = $request->input('filter_by_location', []);
         $filter_by_feild    = $request->input('filter_by_feild', []);
         
         $massage_users = User::where('type', '4'); 
         if(!empty($mc_user_id))
         $massage_users = $massage_users->whereIn('id',$mc_user_id);
            

         $massage = MassageProfile::with('latest_active_brb','activeBumpup');
         if(!empty($mc_live_list))
         $massage = $massage->whereIn('id',$mc_live_list);

        
      

        ######### Upper Filter ##################### 
        if ((!empty($filter_by_location)) || (!empty($filter_by_feild))) 
        {

            if(!empty($mc_live_list))
            {
                
                if(!empty($filter_by_location))
                {
                    $location   = $filter_by_location['locationByRadio'] ?? null;
                    $member     = $filter_by_location['by_name_member'] ?? null;
                    $set_lat    = $filter_by_location['set_lat'] ?? null;
                    $set_lng    = $filter_by_location['set_lng'] ?? null;
                    $per_page   = $filter_by_location['per_page'] ?? null;

                    $external_search_ids = [];
                    $massage_centers_ids = [];
                    $matched_ids = [];
                    

                
                    if($location=='your_location' &&  $set_lat!="" &&  $set_lng!="")
                    {
                        $userLocation = $this->getRealTimeGeolocationOfUsers($set_lat, $set_lng);
                        $lat_state = $userLocation['state'];
                        $lng_city = $userLocation['city'];

                        //$lat_state = 4021; // Testing
                        $massage_users = $massage_users->where('state_id', $lat_state); 
                        $massage_users = $massage_users->distinct()->pluck('id')->toArray();
                        $external_search = User::where('type', '4');
                        if(!empty($mc_user_id))
                        $external_search = $external_search->whereIn('id',$mc_user_id);

                    
                        if (!empty($member)) 
                        {

                            $external_search->where(function ($query) use ($member) {
                                $query->where('member_id', 'like', "%{$member}%");
                            });

                            $external_search_ids = $external_search->distinct()->pluck('id')->toArray();
                            
                            if (!empty($external_search_ids)) {
                                $matched_ids = array_values(array_intersect($external_search_ids, $massage_users));
                            }

                            if(!empty($matched_ids))
                            {
                                $massage =  $massage->where(function ($query) use ($matched_ids, $member) {
                                    $query->whereIn('user_id', $matched_ids)->where('default_setting', '!=', '1');
                                }); 
                            }
                            else
                            {
                                $massage =  $massage->where(function ($query) use ($massage_users, $member) {
                                    $query->whereIn('user_id', $massage_users)->where('default_setting', '!=', '1')
                                            ->where('business_name', 'like', "%{$member}%");
                                }); 
                            }

                        }
                        else
                        {
                            $external_search_ids = $external_search->distinct()->pluck('id')->toArray();
                            if (!empty($external_search_ids)) {
                                    $matched_ids = array_values(array_intersect($external_search_ids, $massage_users));
                            }

                           
                            if(!empty($matched_ids))
                            {
                                $massage =  $massage->where(function ($query) use ($matched_ids, $member) {
                                    $query->whereIn('user_id', $matched_ids)->where('default_setting', '!=', '1');
                                }); 
                            }
                            else
                            {
                               $massage = $massage->whereRaw('1 = 0'); 
                            }
                        }
                    }

                    else if($location=='australia')
                    {
                        
                        if (!empty($member)) 
                        {
                            $massage_users = $massage_users->distinct()->pluck('id')->toArray();
                            $external_search = User::where('type', 5);
                            if(!empty($mc_user_id))
                            $external_search = $external_search->whereIn('id',$mc_user_id);

                            $external_search->where(function ($query) use ($member) {
                                $query->where('member_id', 'like', "%{$member}%");
                            });

                            $external_search_ids = $external_search->distinct()->pluck('id')->toArray();
                            
                            if (!empty($external_search_ids)) {
                                $matched_ids = array_values(array_intersect($external_search_ids, $massage_users));
                            }

                            if(!empty($matched_ids))
                            {
                                $massage =  $massage->where(function ($query) use ($matched_ids, $member) {
                                    $query->whereIn('user_id', $matched_ids)->where('default_setting', '!=', '1');
                                }); 
                            }
                            else
                            {
                                 $massage =  $massage->where(function ($query) use ($massage_users, $member) {
                                    $query->whereIn('user_id', $massage_users)->where('default_setting', '!=', '1')
                                            ->where('business_name', 'like', "%{$member}%");
                                }); 
                            }

                        }
                        else
                        {
                           $massage = $massage->where('default_setting', '!=', '1');
                        }

                    }
                    else
                    {
                        $massage = $massage->whereRaw('1 = 0'); 
                    }
                }

                if(!empty($filter_by_feild))
                {

                    $profile_state      = $filter_by_feild['profile_state'] ?? null;
                    $profile_city       = $filter_by_feild['profile_city'] ?? null;
                    $masseur_types      = $filter_by_feild['masseur_types'] ?? null;
                    $profile_price      = $filter_by_feild['profile_price'] ?? null;
                    $profile_age        = $filter_by_feild['profile_age'] ?? null;
                    $massage_services   = $filter_by_feild['massage_services'] ?? null;
                    $other_services     = $filter_by_feild['other_services'] ?? null;
                    $verification       = $filter_by_feild['verification'] ?? null;

                    if(!empty($mc_live_list))
                    $massage = $massage->where('default_setting', '!=', '1');
                    
                    if($profile_city!="")
                    {
                            $state_id = getStateIdByCityId(config('escorts.profile.states'), $profile_city);
                            $massage_users = $massage_users->where('state_id', $state_id); 
                            $massage_users = $massage_users->pluck('id')->toArray(); 
                            $massage_centers_ids = $massage_users;

                            if(empty($massage_centers_ids))
                            $massage = $massage->whereRaw('1 = 0');  
        
                    }
                    
                    if(!empty($massage_centers_ids))
                    {
                        $massage = $massage->whereIn('user_id', $massage_centers_ids);
                    }


                    if($profile_age!="")
                    {
                        $masseur_id = [];
                        $massage_id = [];

                        $ages = explode('-', $profile_age);
                        list($min_age, $max_age) = array_map('intval', explode('-', $profile_age));

                
                        $masseur_id = Masseur::where('age', '>=', $min_age)->where('age', '<=', $max_age)->distinct()->pluck('id')->toArray();

            
                        if(!empty($masseur_id))
                        $massage_id = MassagerMasseur::whereIn('masseur_profile_id', $masseur_id)->distinct()->pluck('massage_profile_id')->toArray();
    
                    
                        if(!empty($massage_id))
                        $massage = $massage->whereIn('id', $massage_id); 
                        else
                        $massage = $massage->whereRaw('1 = 0');   


                    } 
                    
                    if($massage_services!="")
                    {
                        $massage_profile_id = MassageService::where('service_id',$massage_services)->distinct()->pluck('massage_profile_id')->toArray();
                        if(!empty($massage_profile_id))
                        $massage = $massage->whereIn('id', $massage_profile_id);  
                        else
                        $massage = $massage->whereRaw('1 = 0');    
                    }  
                    
                    if($other_services!="")
                    {
                        $massage_profile_id = MassageService::where('service_id',$other_services)->distinct()->pluck('massage_profile_id')->toArray();
                        if(!empty($massage_profile_id))
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
                                $q->select(\DB::raw(1))
                                    ->from('profile_verification_status as pvs')
                                    ->whereColumn('pvs.profile_id', 'massage_profiles.id')
                                    ->where('pvs.type', '4')
                                    ->where('pvs.status', $status);
                            });
                        }
                    }
                    
                    
                    if(empty($mc_live_list))
                    $massage = $massage->whereRaw('1 = 0');

                }
            
            }
            else
            {
            $massage = $massage->whereRaw('1 = 0'); 
            }

            $massage = $massage->paginate($per_page)->onEachSide(1);
           
        }
        else
        {
            $massage = $massage->where('default_setting', '!=', '1');

            if(empty($mc_live_list))
            $massage = $massage->whereIn('id', $mc_live_list);   
            else
            $massage = $massage->whereRaw('1 = 0'); 

            $massage = $massage->paginate($per_page)->onEachSide(1);
        }
        ######### End Upper Filter ##################### 

     
      
        $media = $this->media;
        $collection = $massage->getCollection();
        $bumpProfiles = $collection->filter(fn($row) => !empty($row->activeBumpup));
        $normalProfiles = $collection->filter(fn($row) => empty($row->activeBumpup));
       

        if ((int)$request->is_page_reload === 0) 
        {
            if ($bumpProfiles->count() > 0) 
            {
                $bumpProfiles = $bumpProfiles->sortByDesc(function ($row) {
                return $row->activeBumpup?->utc_start_time;
                });

                $normalProfiles = $normalProfiles->sortByDesc('purchase_id');
                $final = $bumpProfiles->values()->merge($normalProfiles->values());
            } 
            else 
            {
            $final = $collection->sortByDesc('purchase_id')->values();
            }
            
        }
        else
        {
            if ($bumpProfiles->count() > 0) 
            {
                $bumpProfiles = $bumpProfiles->sortByDesc(function ($row) {
                return $row->activeBumpup?->utc_start_time;
                });

                $normalProfiles = $normalProfiles->shuffle();
                $final = $bumpProfiles->values()->merge($normalProfiles->values());
            } 
            else 
            {
            $final = $collection->shuffle();
            }  
        }

        $listings =  $massage->setCollection($final); 

        $listings->getCollection()->transform(function ($item) {

            $total = MassageLike::where('massage_id',$item->id)->count();
            if($total > 0) {
                $likeCount = MassageLike::where('like',1)->where('massage_id',$item->id)->count();
                $dislikeCount = MassageLike::where('like',0)->where('massage_id',$item->id)->count();
                $lp = round($likeCount/$total * 100);
                $dp = round($dislikeCount/$total * 100);
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
                $item->star_rating= 2;
            } elseif ($lp > 20) {
                $item->star_rating = 1;
            } else {
                $item->star_rating = 0;
            }
        return $item;
        });


        
        
        
        return response()->json([
            'grid' => view('web.mc.mc-grid-data', compact('listings','media','logedInUpser'))->render(),
            'list' => view('web.mc.mc-list-data', compact('listings','logedInUpser'))->render(),
            'pagination' => view('web.mc.mc-pagination', compact('listings'))->render(),
            'total_count' => $listings->total()
        ]);
    }
    


    public function massage_description(Request $request, $id)
    {
        if(!$id || !$request->ids)
        {
            return redirect(route('find.massage.centre'));
        }

         $listing = MassageProfile::where('id',$id)->with(['reviews' => function($q){
            $q->where('status','published');
        },'reviews.user'])->first();
        

        $ids = $request->ids ? json_decode($request->ids, true) : [];
       

        $currentIndex = array_search($id, $ids);
        $prevId = $ids[$currentIndex - 1] ?? null;
        $nextId = $ids[$currentIndex + 1] ?? null;

    

         //$listing = MassageProfile::where('id','=',$id)->first();
         $reviews = $listing->reviews;

        

         $massage_durations = (isset($listing->durations) && count($listing->durations)>0) ? $listing->durations->toArray() : [];

    

         $durations = $this->duration->all();
        

         $galleryVideos = $listing->gallary()->wherePivot('type',1)->orderBy('position','asc')->get();

        $spamReportAdvertiser = collect();

        if(Auth::user() && Auth::user()->type == 0){
            $spamReportAdvertiser = ReportMassageProfile::where('viewer_id',Auth::user()->id)->first();
        }

        $massageLike = null;
        $userId = !empty(auth()->user()) ? auth()->user()->id : NULL;
        $massageLike = $this->model_massage_profile->getUserLikeDislike($id, $request->ip(), $userId);

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


        return view('web.mc.massage-description',compact('listing','durations','massage_durations','reviews','spamReportAdvertiser','lp','dp','massageLike','nextId','prevId','ids','star_rating'));
    }


    public function storeShortList(Request $request)
    {
        $wishlist = session()->get('wishlist', []);

        if (!in_array($request->wishlist_id, $wishlist)) {
            $wishlist[] = $request->wishlist_id;
        }

        $profile = MassageProfile::where('id','=',$request->wishlist_id)->first();
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

            $profile = MassageProfile::where('id','=',$request->wishlist_id)->first();
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
        if(auth()->user() && auth()->user()->type == 0) {
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
                                    'user_id'=> auth()->user()->id,
                                    'advertiser_type'=>'massage',
                                    'advertiser_id'=>$massage_id])
                                    ->first();
            if($reviewExist != null){
                Reviews::where('id',$reviewExist->id)->update($data);
                $error = false;
            }else{
                if($this->reviews->store($data, $id))
                {
                    $error = false;
                }
            }
            
        } else {
            $data = 'You are not allowed to give review';
        }

        # add statistics for escort profile view and added stats for reviews and recommendation
        $userId = MassageProfile::where('id', $massage_id)->pluck('user_id');
        saving_massage_stats($userId, $massage_id,'reviews_count');
        saving_massage_stats($userId, $massage_id,'recommendation_count');

        return response()->json(compact('data','error'));
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
        if ((!empty($filter_by_location)) || (!empty($filter_by_feild))) 
        {
            if(!empty($filter_by_location))
            {
                
                $location   = $filter_by_location['locationByRadio'] ?? null;
                $member     = $filter_by_location['by_name_member'] ?? null;
                $set_lat    = $filter_by_location['set_lat'] ?? null;
                $set_lng    = $filter_by_location['set_lng'] ?? null;
                $per_page   = $filter_by_location['per_page'] ?? null;
                
                if($location=='your_location' &&  $set_lat!="" &&  $set_lng!="")
                {
                    $userLocation = $this->getRealTimeGeolocationOfUsers($set_lat, $set_lng);
                    $lat_state = $userLocation['state'];
                    $lng_city = $userLocation['city'];

                   

                    $massage_users = $massage_users->where('state_id', $lat_state); 

                    if($member!="")
                    {
                         $massage_users = $massage_users->where(function ($query) use ($member) {
                            $query->where('member_id', 'LIKE', "%{$member}%")
                                ->orWhere('name', 'LIKE', "%{$member}%");
                        });
                    }

                    $massage_centers_ids = $massage_users->pluck('id')->toArray(); 
                    

                   

                    if (!empty($massage_centers_ids)) 
                    {

                       $massage = $massage->where(function ($query) use ($massage_centers_ids, $member) {

                            $query->whereIn('user_id', $massage_centers_ids)->where('default_setting', '!=', '1');

                            if (!empty($member)) {
                                $query->where('profile_name', 'like', "%{$member}%");
                            }

                        });

                    }
                    else
                    {
                       $massage =  $massage->whereRaw('1 = 0');
                    }

                    $massage = $massage->inRandomOrder()->get();

                    if(!empty($mc_ids) && ($massage->count()>0))
                    {
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
                    }
                    else
                    {
                         $massage->whereRaw('1 = 0');
                    }

                }

                if($location=='australia' &&  $set_lat=="" &&  $set_lng=="")
                {
                    $external_search_ids = [];
                    $massage_centers_ids = [];

                    if (!empty($member)) 
                    {

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

                    if (!empty($massage_centers_ids)) 
                    {
                        $massage =  $massage->where(function ($query) use ($massage_centers_ids, $member) {

                            $query->whereIn('user_id', $massage_centers_ids)->where('default_setting', '!=', '1');

                            if (!empty($member)) {
                                $query->where('profile_name', 'like', "%{$member}%");
                            }

                        });

                    }
                    else
                    {
                     $massage =  $massage->whereRaw('1 = 0');
                    }

                   
                    $massage = $massage->inRandomOrder()->get();
                    if(!empty($mc_ids) && ($massage->count()>0))
                    {
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
                    }
                    else
                    {
                        $massage = new LengthAwarePaginator([],
                        0,$per_page,request()->get('page', 1),
                        ['path' => request()->url(),
                        'query' => request()->query()]);
                    }

                   
                }

                  
            }

            if(!empty($filter_by_feild))
            {   
                $is_found           = false;
                $profile_state      = $filter_by_feild['profile_state'] ?? null;
                $profile_city       = $filter_by_feild['profile_city'] ?? null;
                $masseur_types      = $filter_by_feild['masseur_types'] ?? null;
                $profile_price      = $filter_by_feild['profile_price'] ?? null;
                $profile_age        = $filter_by_feild['profile_age'] ?? null;
                $massage_services   = $filter_by_feild['massage_services'] ?? null;
                $other_services     = $filter_by_feild['other_services'] ?? null;
                $verification       = $filter_by_feild['verification'] ?? null;


               if($profile_city!="")
               {

                    $state_id = getStateIdByCityId(config('escorts.profile.states'), $profile_city);
                    $massage_users = $massage_users->where('state_id', $state_id); 
                    $massage_users = $massage_users->pluck('id')->toArray(); 
                    $massage_centers_ids = $massage_users;
                    $massage->when(empty($massage_centers_ids),function ($query) {$query->whereRaw('1 = 0');},
                        function ($query) use ($massage_centers_ids) {
                            $query->whereIn('user_id', $massage_centers_ids);
                        }
                    );

                    
                    
               }
               
                

                if($profile_age!="")
                {
                    $masseur_id = [];
                    $massage_id = [];

                    $ages = explode('-', $profile_age);
                    list($min_age, $max_age) = array_map('intval', explode('-', $profile_age));
                    $masseur_id = Masseur::whereBetween('age', [$min_age, $max_age])->distinct()->pluck('id')->toArray();


                    if(!empty($masseur_id))
                    $massage_id = MassagerMasseur::whereIn('masseur_profile_id', $masseur_id)->distinct()->pluck('massage_profile_id')->toArray();

                    if(!empty($massage_id))
                    $massage = $massage->whereIn('id', $massage_id);   
                    else
                    $massage =  $massage->whereRaw('1 = 0');
                    
                } 
                
                if($massage_services!="")
                {
                    $massage_profile_id = MassageService::where('service_id',$massage_services)->distinct()->pluck('massage_profile_id')->toArray();
                    if(!empty($massage_profile_id))
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
                                $q->select(\DB::raw(1))
                                    ->from('profile_verification_status as pvs')
                                    ->whereColumn('pvs.profile_id', 'massage_profiles.id')
                                    ->where('pvs.type', '4')
                                    ->where('pvs.status', $status);
                            });
                        }
                    }
                
                if($other_services!="")
                {
                    $massage_profile_id = MassageService::where('service_id',$other_services)->distinct()->pluck('massage_profile_id')->toArray();
                    if(!empty($massage_profile_id))
                    $massage = $massage->whereIn('id', $massage_profile_id);  
                    else
                    $massage =  $massage->whereRaw('1 = 0');    
                }  
                

                $massage = $massage->inRandomOrder()->get();

                if(!empty($mc_ids) && ($massage->count()>0))
                {
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

                                
                }
                else
                {
                       $massage = new LengthAwarePaginator([],
                                    0,$per_page,request()->get('page', 1),
                                    ['path' => request()->url(),
                                    'query' => request()->query()]);
                }
            }

        }
        else
        {
            $massage = $massage->whereIn('id', $mc_ids)
                        ->where('default_setting', '!=', '1')
                        ->inRandomOrder()->paginate($per_page)
                        ->onEachSide(1);

        }
        ######### End Upper Filter ##################### 

     
        
      
       $media = $this->media;
       $listings = $massage;
                
        return response()->json([
            'grid' => view('web.mc-shortlist.mc-grid-data', compact('listings','media'))->render(),
            'list' => view('web.mc-shortlist.mc-list-data', compact('listings'))->render(),
            'pagination' => view('web.mc-shortlist.mc-pagination', compact('listings'))->render(),
            'total_count' => $listings->total()
        ]);
    }
    

}
