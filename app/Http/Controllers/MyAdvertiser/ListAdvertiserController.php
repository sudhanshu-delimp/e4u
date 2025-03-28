<?php

namespace App\Http\Controllers\MyAdvertiser;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Duration;
use App\Repositories\Agent\AgentEscortInterface;
use App\Repositories\Escort\EscortInterface;
use App\Repositories\Escort\AvailabilityInterface;
use App\Repositories\Service\ServiceInterface;
use App\Repositories\User\UserInterface;
use App\Http\Requests\Escort\StoreRequest;
use App\Http\Requests\Escort\StoreServiceRequest;
use App\Http\Requests\UpdateEscortRequest;
use App\Http\Requests\Escort\UpdateRequestAboutMe;
use App\Http\Requests\Escort\UpdateRequestPolicy;
use App\Http\Requests\Escort\UpdateRequestReadMore;
use App\Http\Requests\Escort\UpdateRequestAbout;
use App\Http\Requests\Escort\StoreRateRequest;
use App\Http\Requests\Escort\StoreAvailabilityRequest;
use App\Repositories\Duration\DurationInterface;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Traits\ResizeImage;
use Illuminate\Support\Str;
use App\Repositories\Tour\TourInterface;
use Illuminate\Support\Facades\Storage;

use App\Repositories\Escort\EscortMediaInterface;

class ListAdvertiserController extends Controller
{
    protected $escort;
    protected $agentEscort;
    protected $availability;
    protected $service;
    protected $duration;
    protected $user;
    protected $media;

    public function __construct(TourInterface $tour, UserInterface $user, DurationInterface $duration, EscortInterface $escort, AvailabilityInterface $availability, ServiceInterface $service, EscortMediaInterface $media, AgentEscortInterface $agentEscort)
    {
        $this->escort = $escort;
        $this->availability = $availability;
        $this->service = $service;
        $this->duration = $duration;
        $this->user = $user;
        $this->media = $media;
        $this->tour = $tour;
        $this->agentEscort = $agentEscort;
    }


    
    public function escortList()
    {
        $escorts = $this->escort->all();

        return view('agent.dashboard.list', compact('escorts'));
    }

    
    public function dataTable()
    {
        $usr_type = $this->user->find(auth()->user()->id);
        list($escort, $count) = $this->agentEscort->paginatedByEscortId(
            request()->get('start'),
            request()->get('length'),
            request()->get('order')[0]['column'],
            request()->get('order')[0]['dir'],
            request()->get('columns'),
            request()->get('search')['value'],
            $usr_type->agentEscorts->pluck("id")->toArray(),

        );

        $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $escort
        );

        return response()->json($data);
    }

    public function escortDataTable()
    {
        $user = auth()->user();
        $escorts = $user->agentEscorts();
        $usr_type = $this->user->find(auth()->user()->id);
        //dd($usr_type->agentEscorts);//$usr_type->agentEscorts->pluck("id")->toArray(),
        //list($user, $count) = $user->agentEscorts()->paginatedAgentTyeEscort(
        list($user, $count) = $this->user->paginatedAgentUserEscort(
            request()->get('start'),
            request()->get('length'),
            request()->get('order')[0]['column'],
            request()->get('order')[0]['dir'],
            request()->get('columns'),
            request()->get('search')['value'],
            $user,
        );

        $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $user
        );

        return response()->json($data);
    }

    // public function markDefault($id)
    // {
    //     $media = $this->media->find($id);
    //     $this->media->markDefault($media);

    //     $profile = $this->escort->find($media->escort_id);

    //     $template = view('escort.dashboard.profile.partials.escort-media-table', compact('profile'))->render();

    //     $status = true;

    //     return response()->json(compact('template', 'status'), 200);
    // }

    public function onlyDataTable(Request $request, $id)
    {
        
        $user = $this->user->find($id);
        list($user, $count) = $this->escort->paginatedList(
            request()->get('start'),
            request()->get('length'),
            request()->get('order')[0]['column'],
            request()->get('order')[0]['dir'],
            request()->get('columns'),
            request()->get('search')['value'],
            $user->id,
        );

        $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $user
        );

        return response()->json($data);
    }

    
    public function TourDataTable(Request $request, $id)
    {
        
        $user = $this->user->find($id);
        list($user, $count) = $this->tour->paginated(
            request()->get('start'),
            request()->get('length'),
            request()->get('order')[0]['column'],
            request()->get('order')[0]['dir'],
            request()->get('columns'),
            request()->get('search')['value'],
            $user->id,
        );

        $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $user
        );

        return response()->json($data);
    }

    
    ///////////////////
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Escort\UpdateRequestAboutMe  $request
     * @return \Illuminate\Http\Response
     */
   
   
   

   
    ////////////////////
}
