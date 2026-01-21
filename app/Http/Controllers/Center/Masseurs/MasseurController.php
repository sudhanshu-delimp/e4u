<?php

namespace App\Http\Controllers\Center\Masseurs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AppController;
use App\Repositories\Message\MessageInterface;
use App\Repositories\Service\ServiceInterface;
use App\Repositories\Duration\DurationInterface;
use App\Repositories\Thumbnail\ThumbnailInterface;
use App\Repositories\Message\MessageMediaInterface;
use App\Repositories\MassageProfile\MassageProfileInterface;
use App\Repositories\MassageProfile\MassageAvailabilityInterface;

class MasseurController extends AppController
{


    protected $escort;
   
    protected $service;
    protected $duration;
    protected $user;
    protected $media;
    protected $massage_media;
  
    


    public function __construct(MessageInterface $escort, MessageMediaInterface $media, ServiceInterface $service, DurationInterface $duration)
    {
        $this->escort = $escort;
        $this->service = $service;
        $this->duration = $duration;
        $this->media = $media;
    
    }


    public function index()
    {
        $durations = $this->duration->all();
        return view('center.dashboard.masseurs.new-listing',compact('durations'));
    }

    public function add_masseur()
    {
        $durations = $this->duration->all();
        return view('center.dashboard.masseurs.new-listing',compact('durations'));
    }



    

}
