<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\MassageProfile;
use App\Http\Controllers\Controller;
use App\Repositories\Service\ServiceInterface;
use App\Repositories\MassageProfile\MassageProfileInterface;
use App\Repositories\Message\MessageMediaInterface;
use App\Repositories\Thumbnail\ThumbnailInterface;
use App\Repositories\Duration\MassageDurationInterface;
use App\Repositories\MassageProfile\MassageAvailabilityInterface;
use App\Repositories\Message\MessageInterface;


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

    public function __construct(MassageProfileInterface $massage_profile ,MessageInterface $massage, MessageMediaInterface $media, ThumbnailInterface $thumbnail,  ServiceInterface $service, MassageDurationInterface $duration,MassageAvailabilityInterface $massage_availability)
    {
        $this->massage = $massage;
        $this->massage_availability = $massage_availability;
        $this->service = $service;
        $this->duration = $duration;
        $this->media = $media;
        $this->massage_profile = $massage_profile;
      
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
        
        return view('web.massage-description',compact('listing'));
    }

    

}
