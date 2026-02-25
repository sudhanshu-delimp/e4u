<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\MassageProfile;
use App\Models\MassageReviews;
use App\Models\MassagerMasseur;
use App\Models\MassageService;
use App\Models\Masseur;
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

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\LengthAwarePaginator;


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
  

   

    public function __construct(MassageReviewInterface $reviews, MassageProfileInterface $massage_profile ,MessageInterface $massage, MessageMediaInterface $media, ThumbnailInterface $thumbnail,  ServiceInterface $service, MassageDurationInterface $duration,MassageAvailabilityInterface $massage_availability)
    {
        $this->massage = $massage;
        $this->massage_availability = $massage_availability;
        $this->service = $service;
        $this->duration = $duration;
        $this->media = $media;
        $this->massage_profile = $massage_profile;
        $this->reviews = $reviews;
      
    }


    public function  massageList()
    {
        return view('web.mc.massage-centre-list');
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
            //throw $th;
            $parms =[
                'state'=>null,
                'city'=>null,
            ];

            return $parms;
        }
        
    }

    public function mcAjaxList(Request $request)
    {
        $per_page = 5;
        $massage_centers_ids = [];


         $filter_by_location = $request->input('filter_by_location', []);
         $filter_by_feild    = $request->input('filter_by_feild', []);
         $massage_users = User::where('type', 5); 
         $massage = MassageProfile::query();
         //$massage = MassageProfile::where('default_setting', '!=', '1');

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
                    if (!empty($massage_centers_ids)) {

                        $massage->where(function ($query) use ($massage_centers_ids, $member) {

                            $query->whereIn('user_id', $massage_centers_ids)->where('default_setting', '!=', '1');

                            if (!empty($member)) {
                                $query->where('profile_name', 'like', "%{$member}%");
                            }

                        });

                    }
                    else
                    {
                    $massage->whereRaw('1 = 0');
                    }

                    $massage = $massage->inRandomOrder()->paginate($per_page)->onEachSide(1);

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

                    if (!empty($massage_centers_ids)) {

                        $massage->where(function ($query) use ($massage_centers_ids, $member) {

                            $query->whereIn('user_id', $massage_centers_ids)->where('default_setting', '!=', '1');

                            if (!empty($member)) {
                                $query->where('profile_name', 'like', "%{$member}%");
                            }

                        });

                    }
                    else
                    {
                    $massage->whereRaw('1 = 0');
                    }

                    $massage = $massage->inRandomOrder()->paginate($per_page)->onEachSide(1);
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


               if($profile_city!="")
               {
                    $state_id = getStateIdByCityId(config('escorts.profile.states'), $profile_city);
                    $massage_users = $massage_users->where('state_id', $state_id); 
                    $massage_users = $massage_users->pluck('id')->toArray(); 
                    $massage_centers_ids = $massage_users;

                    
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
                    $masseur_id = Masseur::whereBetween('age', [$min_age, $max_age])->distinct()->pluck('id')->toArray();


                    if(!empty($masseur_id))
                    $massage_id = MassagerMasseur::whereIn('masseur_profile_id', $masseur_id)->distinct()->pluck('massage_profile_id')->toArray();

                    if(!empty($massage_id))
                    $massage = $massage->whereIn('id', $massage_id);      
                } 
                
                if($massage_services!="")
                {
                    $massage_profile_id = MassageService::where('service_id',$massage_services)->distinct()->pluck('massage_profile_id')->toArray();
                    if(!empty($massage_profile_id))
                    $massage = $massage->whereIn('id', $massage_profile_id);      
                }  
                
                if($other_services!="")
                {
                    $massage_profile_id = MassageService::where('service_id',$other_services)->distinct()->pluck('massage_profile_id')->toArray();
                    if(!empty($massage_profile_id))
                    $massage = $massage->whereIn('id', $massage_profile_id);      
                }  
                

                $massage = $massage->where('default_setting', '!=', '1')->paginate($per_page)->onEachSide(1);

            }

        }
        else
        {
            $massage = $massage->where('default_setting', '!=', '1')->inRandomOrder()->paginate($per_page)->onEachSide(1);
        }
        ######### End Upper Filter ##################### 

     

       $listings = $massage;
       $media = $this->media;
      
                
        return response()->json([
            'grid' => view('web.mc.mc-grid-data', compact('listings','media'))->render(),
            'list' => view('web.mc.mc-list-data', compact('listings'))->render(),
            'pagination' => view('web.mc.mc-pagination', compact('listings'))->render(),
            'total_count' => $listings->total()
        ]);
    }
    


    public function massage_description(Request $request, $id)
    {
        if(!$id)
        {
            return redirect(route('find.massage.centre'));
        }

         $listing = MassageProfile::where('id','=',$id)->first();
         $reviews = $listing->reviews;
         $massage_durations = (isset($listing->durations) && count($listing->durations)>0) ? $listing->durations->toArray() : [];

    

         $durations = $this->duration->all();
        

         $galleryVideos = $listing->gallary()->wherePivot('type',1)->orderBy('position','asc')->get();

        return view('web.mc.massage-description',compact('listing','durations','massage_durations','reviews'));
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
    

    public function SaveReviewMassage(Request $request, $massage_id)
    {
        $error = true;
        if(auth()->user() && auth()->user()->type == 0) {
            $data = [
                'description' => $request->description,
                'star_rating' => $request->rating ? $request->rating : NULL,
                'user_id' => auth()->user()->id,
                'massage_id' => $massage_id,
                'status' => 'pending',  
            ];
            $id = null;
            $reviewExist = MassageReviews::where('user_id', auth()->user()->id)->where('massage_id',$massage_id)->first();
            if($reviewExist != null){
                MassageReviews::where('id',$reviewExist->id)->update($data);
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
        $userId = MassageReviews::where('id', $massage_id)->pluck('user_id');
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
        $per_page = 5;
        $massage_centers_ids = [];
        $mc_ids = session()->get('wishlist', []);




         $filter_by_location = $request->input('filter_by_location', []);
         $filter_by_feild    = $request->input('filter_by_feild', []);
         $massage_users = User::where('type', 5); 
         $massage = MassageProfile::query();
         
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
                    

                   

                    if (!empty($massage_centers_ids)) {

                        $massage->where(function ($query) use ($massage_centers_ids, $member) {

                            $query->whereIn('user_id', $massage_centers_ids)->where('default_setting', '!=', '1');

                            if (!empty($member)) {
                                $query->where('profile_name', 'like', "%{$member}%");
                            }

                        });

                    }
                    else
                    {
                         $massage->whereRaw('1 = 0');
                    }

                    $massage = $massage->inRandomOrder()->paginate($per_page)->onEachSide(1);
                    if(!empty($mc_ids) && ($massage->count()>0))
                    {
                         $filtered = $massage->getCollection()->whereIn('id', $mc_ids)->values();

                         $massage    = new LengthAwarePaginator(
                                        $filtered,                    
                                        $filtered->count(),            
                                        $per_page,                     
                                        request()->page ?? 1,          
                                        [
                                        'path' => request()->url(),
                                        'query' => request()->query(),
                                        ]
                                );
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

                    $massage = $massage->inRandomOrder()->paginate($per_page)->onEachSide(1);
                    if(!empty($mc_ids) && ($massage->count()>0))
                    {
                        $filtered   = $massage->getCollection()->whereIn('id', $mc_ids)->values();
                        $massage    = new LengthAwarePaginator(
                                        $filtered,                    
                                        $filtered->count(),            
                                        $per_page,                     
                                        request()->page ?? 1,          
                                        [
                                        'path' => request()->url(),
                                        'query' => request()->query(),
                                        ]
                                );

                        
                    }
                    else
                    {
                       $massage =  $massage->setCollection(collect());
                    }

                   
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


               if($profile_city!="")
               {
                    $state_id = getStateIdByCityId(config('escorts.profile.states'), $profile_city);
                    $massage_users = $massage_users->where('state_id', $state_id); 
                    $massage_users = $massage_users->pluck('id')->toArray(); 
                    $massage_centers_ids = $massage_users;

                    
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
                    $masseur_id = Masseur::whereBetween('age', [$min_age, $max_age])->distinct()->pluck('id')->toArray();


                    if(!empty($masseur_id))
                    $massage_id = MassagerMasseur::whereIn('masseur_profile_id', $masseur_id)->distinct()->pluck('massage_profile_id')->toArray();

                    if(!empty($massage_id))
                    $massage = $massage->whereIn('id', $massage_id);      
                } 
                
                if($massage_services!="")
                {
                    $massage_profile_id = MassageService::where('service_id',$massage_services)->distinct()->pluck('massage_profile_id')->toArray();
                    if(!empty($massage_profile_id))
                    $massage = $massage->whereIn('id', $massage_profile_id);      
                }  
                
                if($other_services!="")
                {
                    $massage_profile_id = MassageService::where('service_id',$other_services)->distinct()->pluck('massage_profile_id')->toArray();
                    if(!empty($massage_profile_id))
                    $massage = $massage->whereIn('id', $massage_profile_id);      
                }  
                

                $massage = $massage->where('default_setting', '!=', '1')->paginate($per_page)->onEachSide(1);

                if(!empty($mc_ids) && ($massage->count()>0))
                {
                        $filtered = $massage->getCollection()->whereIn('id', $mc_ids)->values();
                        $massage->setCollection($filtered);
                }
                else
                {
                        $massage->setCollection(collect());
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
