<?php

namespace App\Http\Controllers;

use App\Models\Escort;
use App\Models\MassagePurchase;
use App\Models\PinUps;
use App\Models\Pricing;
use App\Repositories\State\StateInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $state;
    public function __construct(StateInterface $state)
    {
        $this->state = $state;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function getGioLocation(Request $request)
    {
        // dd($request->all());
        $stateName = null;
        $error = false;
        if(!empty($request->ipinfo->region)) {
            $stateName = $request->ipinfo->region;
            $error = true;
        }
        return response()->json(compact('stateName','error'));


    }

    public function noticeDmca(Request $request)
    {
        return view('web.dmca');
    }

    public function thankyou(Request $request)
    {
        return view('web.pages.thankyou');
    }

    public function index(Request $request)
    {
        Session::put('session_state_id', $request->query('location_state'));
        $pricing = Pricing::all()->toArray();

        if($stateId = $request->query('location_state')) {
            $lastMonday = date('Y-m-d', strtotime('last monday', strtotime('next monday')));;
            $pinUp = PinUps::where('state_id', $stateId)
                ->where('week_start', $lastMonday)
                ->where('payment_status', 'Success')->get()->toArray();
        }
        $state = $this->state->allByCountryId();
        $query = Escort::query()
            ->where('enabled', 1)
           
               ->with([
                'purchase' => function ($q) {
                    $q->where('status', 'listed');
                },
            ]);

        // Membership categories count (Result: 4)
        $memberTotalCount = (clone $query)
            ->select('membership')
            ->distinct()
            ->count('membership');
// dd($memberTotalCount);
        $massageLiveCount = MassagePurchase::where('status', 'listed')
        ->whereHas('user', function ($q) {
            $q->where('status', 1);
        })
        // ->whereNotIn('massage_profile_id', $blockedProfileForViewersIds)
        ->whereDoesntHave('activeSuspendProfile')
        ->count();

        return view('home',compact('state','pricing','memberTotalCount','massageLiveCount'));
    }
    // public function ipTrack(Request $request)
    // {

    //     //dd($request->ipinfo);
    //     $error = 1;
    //     return response()->json(compact('error'))
    // }
    public function intendedRedirect()
    {
        if(!$user = auth()->user()) {
            return back();
        }
        switch ($user->type) {

            case 0:
                //dd('createUserDashboard');
                return redirect()->route('user.dashboard');
                break;

            case 1:
                return redirect()->route('admin.index');
                break;

            case 2:
                return redirect()->route('admin.index');
                break;

            case 3:
                return redirect()->route('escort.dashboard');
                break;

            case 4:
                //dd('createCenterDashboard');

                return redirect()->route('center.dashboard');
                break;

            case 5:
            return redirect()->route('agent.dashboard');
            break;
            
            case 6:
                return redirect()->route('staff.dashboard');
                break;
             case 9:
                return redirect()->route('operator.index');
                break;    

            default:
                return back();
                $route = 0;
                break;
        }
        return redirect()->route('escort.dashboard');
    }
}
