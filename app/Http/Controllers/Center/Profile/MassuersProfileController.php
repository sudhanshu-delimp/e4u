<?php

namespace App\Http\Controllers\Center\Profile;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Duration;
use App\Models\MassageGallery;
use App\Repositories\Escort\EscortInterface;
use App\Repositories\Escort\AvailabilityInterface;
use App\Repositories\Service\ServiceInterface;
use App\Repositories\User\UserInterface;
use App\Http\Requests\Escort\StoreRequest;
use App\Http\Requests\Escort\StoreServiceRequest;
use App\Http\Requests\UpdateEscortRequest;
use App\Http\Requests\MassageProfile\UpdateRequestAboutMe;
use App\Http\Requests\Escort\UpdateRequestPolicy;
use App\Http\Requests\Escort\UpdateRequestReadMore;
use App\Http\Requests\Escort\UpdateRequestAbout;
use App\Http\Requests\MassageProfile\StoreMasssageMediaRequest;
use App\Http\Requests\Escort\StoreRateRequest;
use App\Http\Requests\Escort\StoreAvailabilityRequest;
use App\Repositories\Duration\DurationInterface;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Traits\ResizeImage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Repositories\MassageProfile\MassageMediaInterface;
use App\Repositories\MassageProfile\MassageProfileInterface;
use App\Repositories\MassageProfile\MassageAvailabilityInterface;
use App\Models\EscortCovidReport;
use FFMpeg;
use File;
//use Illuminate\Http\Request;

class UpdateController extends Controller
{
    protected $escort;
    protected $massage_availability;
    protected $service;
    protected $duration;
    protected $user;
    protected $media;
    protected $massage_profile;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(MassageAvailabilityInterface $massage_availability, MassageProfileInterface $massage_profile, UserInterface $user, EscortInterface $escort, AvailabilityInterface $availability,  ServiceInterface $service, DurationInterface $duration, MassageMediaInterface $media)
    {
        $this->escort = $escort;
        $this->massage_availability = $massage_availability;
        $this->service = $service;
        $this->duration = $duration;
        $this->user = $user;
        $this->media = $media;
        $this->massage_profile = $massage_profile;
    }

    
}
