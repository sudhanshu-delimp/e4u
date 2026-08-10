<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SuspendProfile;
use App\Models\MassageSuspendProfile;
use App\Models\Purchase;
use App\Models\MassagePurchase;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;

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
    public function index()
    {
        return view('admin.reports.advertiser-suspensions');
    }

    public function suspendedByAdmin()
    {
        return view('admin.reports.admin-advertiser-suspensions');
    }

    public function advertiserSuspensionDataTableListingAjax($advertiserType)
    {

        $search = request()->get('search')['value'];
        $today = Carbon::now();
        switch ($advertiserType) {
            case 'escort': {
                    $advertisers = SuspendProfile::where('status', 1)
                        ->whereRaw('? BETWEEN utc_start_date AND utc_end_date', [$today])
                        // ->with(['escort', 'user', 'escort.city'])
                        ->get();
                }
                break;
            case 'massage': {
                    $advertisers = MassageSuspendProfile::where('status', 1)
                        ->whereRaw('? BETWEEN utc_start_date AND utc_end_date', [$today])
                        //->with(['escort', 'user', 'escort.city'])
                        ->get();
                }
                break;
            default:
                # code...
                break;
        }


        if ($search) {
            $advertisers = $advertisers->filter(function ($item) use ($search) {
                $matchesMemberId = $item->user && stripos($item->user->member_id, $search) !== false;
                return $matchesMemberId;
            })->values(); // reset the keys
        }

        return DataTables::of($advertisers)
            ->addColumn('advertiser_id', fn($row) => $row->advertiser->id)
            ->addColumn('member_id', fn($row) => $row->user->member_id)
            ->addColumn('start_date', fn($row) =>  date('d-m-Y', strtotime($row->start_date)))
            ->addColumn('end_date', fn($row) => date('d-m-Y', strtotime($row->end_date)))
            ->addColumn('days', function ($row) {
                $startDate = Carbon::parse($row->utc_start_date);
                $endDate   = Carbon::parse($row->utc_end_date);
                return $startDate->diffInDays($endDate) + 1; // inclusive of first day
            })
            ->addColumn('location', function ($row) {
                // $location =  ($row->user->type == '4') ?  $row->advertiser->state_abbr : $row->advertiser->state_abbr;
                return $row->advertiser->state_abbr;
            })

            ->addColumn('action', function ($row) {
                $redirectUrl =  ($row->user->type == '4') ? route('preview.massage', ['id' => $row->advertiser->id, 'ids' => '[]']) : route('preview.escort', $row->advertiser->id);
                $actionBtn = '
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dot-dropdown dropdown-menu  dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                
                                
                                <a class="viewEscortSuspendedProfile dropdown-item d-flex align-items-center justify-content-start gap-10" href="' . $redirectUrl . '" target="_blank"> <i class="fa fa-eye"></i> View</a>
                                
                            </div>
                            </div>
                    ';

                return $actionBtn;
            })
            ->rawColumns(['action']) // if you're returning HTML
            ->with([
                'server_up_time' => $this->getAppUptime(),
                'server_time' => Carbon::now(config('app.escort_server_timezone'))->format('h:i:s A'),
            ])
            ->make(true);
    }

    public function adminSuspensionDataTableListingAjax($advertiserType)
    {

        $search = request()->get('search')['value'];
        $today = Carbon::now();
        switch ($advertiserType) {
            case 'escort': {
                    $advertisers = Purchase::where('status', 'suspend')
                        ->whereRaw('? BETWEEN suspended_at AND utc_end_time', [$today])
                        ->get();
                }
                break;
            case 'massage': {
                    $advertisers = MassagePurchase::where('status', 'suspend')
                        ->whereRaw('? BETWEEN suspended_at AND utc_end_time', [$today])
                        ->get();
                }
                break;
            default:
                # code...
                break;
        }


        if ($search) {
            $advertisers = $advertisers->filter(function ($item) use ($search) {
                $matchesMemberId = $item->advertiser->user && stripos($item->advertiser->user->member_id, $search) !== false;
                return $matchesMemberId;
            })->values(); // reset the keys
        }

        return DataTables::of($advertisers)
            ->addColumn('advertiser_id', fn($row) => $row->advertiser->id)
            ->addColumn('member_id', fn($row) => $row->advertiser->user->member_id)
            ->addColumn('start_date', fn($row) =>  date('d-m-Y', strtotime($row->start_date)))
            ->addColumn('end_date', fn($row) => date('d-m-Y', strtotime($row->end_date)))
            ->addColumn('suspended_at', fn($row) => date('d-m-Y', strtotime($row->suspended_at)))
            ->addColumn('days', function ($row) {
                $startDate = Carbon::parse($row->suspended_at);
                $endDate   = Carbon::parse($row->utc_end_time);
                return $startDate->diffInDays($endDate) + 1; // inclusive of first day
            })
            ->addColumn('location', function ($row) {
                return $row->advertiser->state_abbr;
            })

            ->addColumn('action', function ($row) {
                $redirectUrl =  ($row->advertiser->user->type == '4') ? route('preview.massage', ['id' => $row->advertiser->id, 'ids' => '[]']) : route('preview.escort', $row->advertiser->id);
                $actionBtn = '
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dot-dropdown dropdown-menu  dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                <a class="viewEscortSuspendedProfile dropdown-item d-flex align-items-center justify-content-start gap-10" href="' . $redirectUrl . '" target="_blank"> <i class="fa fa-eye"></i> View</a>
                                 <a class="reinstateEscortSuspendedProfile dropdown-item d-flex align-items-center justify-content-start gap-10 border-top" href="#" data-purchase-id=' . $row->id . '> <i class="fa fa-undo"></i> Reinstate</a>
                            </div>
                            </div>
                    ';

                return $actionBtn;
            })
            ->rawColumns(['action']) // if you're returning HTML
            ->with([
                'server_up_time' => $this->getAppUptime(),
                'server_time' => Carbon::now(config('app.escort_server_timezone'))->format('h:i:s A'),
            ])
            ->make(true);
    }

    public function getAppUptime()
    {
        $startTime = Cache::get('app_start_time');
        $str = '';

        if (!$startTime) {
            return 'App start time not available.';
        }

        $start = \Carbon\Carbon::parse($startTime);
        $now = now();

        $diffInSeconds = $now->diffInSeconds($start);

        $days = floor($diffInSeconds / 86400);
        $hours = floor(($diffInSeconds % 86400) / 3600);
        $minutes = floor(($diffInSeconds % 3600) / 60);
        $str .= $days . ' days & ' . $hours . ' hours ' . $minutes . ' minutes';

        return $str;
    }
}
