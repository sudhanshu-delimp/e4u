<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\City;
use App\Models\State;
use App\Models\Escort;
use App\Models\Country;
use App\Models\Payment;
use App\Models\Pricing;
use App\Models\Reviews;
use App\Models\EscortBrb;
use App\Models\EscortLike;
use App\Models\Add_to_list;
use App\Models\MassageLike;
use Illuminate\Support\Arr;
use App\Models\AttemptLogin;
use App\Models\LoginAttempt;
use Illuminate\Http\Request;
use App\Models\SuspendProfile;
use App\Models\PublicationAlert;
use Illuminate\Support\Facades\DB;
use App\Models\ReportEscortProfile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use App\Models\Add_to_massage_shortlist;
use App\Models\EscortViewerInteractions;

use App\Repositories\Page\PageInterface;
use App\Repositories\Escort\EscortInterface;
use App\Repositories\Service\ServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Escort\EscortMediaInterface;
use App\Repositories\Escort\AvailabilityInterface;
use App\Repositories\MassageProfile\MassageProfileInterface;
use Illuminate\View\Component;

class PageController
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

    public function becomePinUp(Request $request)
    {
        $advertings = Pricing::with('memberships')->get();
       return view('web.pages.pinup', compact('advertings'));
    }

    public function agents(Request $request)
    {
       return view('web.pages.agents');
    }

    public function escorts4U(Request $request)
    {
       return view('web.pages.escorts4u');
    }

    public function e4uVerified(Request $request)
    {
       return view('web.pages.e4u-verified');
    }

    public function centres(Request $request)
    {
       return view('web.pages.centres');
    }

    public function playbox(Request $request)
    {
       return view('web.pages.playbox');
    }

    public function accommodation(Request $request)
    {
       return view('web.pages.accommodation');
    }

    public function emailHosting(Request $request)
    {
       return view('web.pages.email-hosting');
    }

    public function mobileReadSim(Request $request)
    {
        return view('web.pages.mobile-read-sim');
    }

    public function professionalProduct(Request $request)
    {
        return view('web.pages.professional-product');
    }

    public function travel(Request $request)
    {
        return view('web.pages.travel');
    }

    public function visaMigration(Request $request)
    {
        return view('web.pages.visa-migration');
    }

    public function termsConditions(Request $request)
    {
        return view('web.pages.terms-conditions');
    }
    
}
