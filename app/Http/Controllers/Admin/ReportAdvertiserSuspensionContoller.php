<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SuspendProfile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;

class ReportAdvertiserSuspensionContoller extends Controller
{
    protected $viewAccessEnabled;
    protected $editAccessEnabled;
    protected $addAccessEnabled;
    protected $sidebar;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $user = auth()->user();   // works here

            // Now do everything that needs user data
            $securityLevel = isset($user->staff_detail->security_level) ? $user->staff_detail->security_level : 0;

            $viewAccess = staffPageAccessPermission($securityLevel, 'view');
            $editAccess = staffPageAccessPermission($securityLevel, 'edit');
            $addAccess = staffPageAccessPermission($securityLevel, 'add');
            $this->sidebar = staffPageAccessPermission($securityLevel, 'sidebar');

            $this->viewAccessEnabled  = isset($viewAccess['yesNo']) && $viewAccess['yesNo'] == 'yes';
            $this->editAccessEnabled  = isset($editAccess['yesNo']) && $editAccess['yesNo'] == 'yes';
            $this->addAccessEnabled  = isset($addAccess['yesNo']) && $addAccess['yesNo'] == 'yes';

            return $next($request);
        });
    }
    public function index(){
        return view('admin.reports.advertiser-suspensions');
    }

    public function advertiserSuspensionDataTableListingAjax()
    {

        $search = request()->get('search')['value'];
        $today = Carbon::now();
        
        $escorts = SuspendProfile::where('status', 1)
            ->where('utc_end_date','>=',$today)
            ->whereIn('id', function ($query) {
                $query->selectRaw('MIN(id)')
                    ->from('suspend_profiles')
                    ->where('status', 1)
                    ->groupBy('escort_profile_id');
            })
            ->with(['escort', 'user', 'escort.city'])
            ->get();
            
        if ($search) {
            $escorts = $escorts->filter(function ($item) use ($search) {
                // Match user->member_id (check if user relation exists)
                $matchesMemberId = $item->user && stripos($item->user->member_id, $search) !== false;

                return $matchesMemberId;
            })->values(); // reset the keys
        }

        return DataTables::of($escorts)
            ->addColumn('escort_id', fn($row) => $row->escort->id)
            ->addColumn('member_id', fn($row) => $row->user->member_id)
            ->addColumn('start_date', fn($row) =>  date('d-m-Y', strtotime($row->start_date)))
            ->addColumn('end_date', fn($row) => date('d-m-Y', strtotime($row->end_date)))
            ->addColumn('days', function($row){
                $startDate = Carbon::parse($row->utc_start_date);
                $endDate   = Carbon::parse($row->utc_end_date);
                return $startDate->diffInDays($endDate) + 1; // inclusive of first day
            })
            ->addColumn('location', function($row){
                $state = isset($row->escort->city->country_code) ? $row->escort->city->country_code : '-' ;
                return $state;
            })
            
            ->addColumn('action', function($row){
                $actionBtn = '
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dot-dropdown dropdown-menu  dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                
                                
                                <a class="viewEscortSuspendedProfile dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-escort-id='.$row->escort_profile_id.' data-toggle="modal" data-target="#view-profile" > <i class="fa fa-eye"></i> View</a>
                                
                            </div>
                            </div>
                    ';

                return $actionBtn;
            })
            ->rawColumns(['action']) // if you're returning HTML
            ->make(true);
    }
}
