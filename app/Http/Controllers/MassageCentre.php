<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\MassageProfile;
use App\Models\MassageReviews;
use App\Repositories\Duration\MassageDurationInterface;
use App\Repositories\MassageProfile\MassageAvailabilityInterface;
use App\Repositories\MassageProfile\MassageProfileInterface;
use App\Repositories\MassageReview\MassageReviewInterface;
use App\Repositories\Message\MessageInterface;
use App\Repositories\Message\MessageMediaInterface;
use App\Repositories\Service\ServiceInterface;
use App\Repositories\Thumbnail\ThumbnailInterface;
use Illuminate\Http\Request;


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
        
        
        return view('web.massage-centre-list');
    }


    public function mcAjaxList(Request $request)
    {
       
       $media = $this->media;
       $listings = MassageProfile::where('default_setting','!=','1')
                ->paginate(5)
                ->onEachSide(1);

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

        return view('web.massage-description',compact('listing','durations','massage_durations','reviews'));
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
    
    

}
