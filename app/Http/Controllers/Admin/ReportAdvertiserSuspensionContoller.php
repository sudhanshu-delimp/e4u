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

    public function cancelledByAdvertiser()
    {
        return view('admin.reports.advertiser-cancellations');
    }

    public function suspendedByAdmin()
    {
        return view('admin.reports.admin-advertiser-suspensions');
    }

    public function advertiserSuspensionHistoryAjax($advertiserType, $profile_id){

        switch ($advertiserType) {
            case 'escort': {
                    $suspentions = SuspendProfile::with(['user','advertiser'])
                    ->where('escort_profile_id', $profile_id);
                }
                break;
            case 'massage': {
                    $suspentions = MassageSuspendProfile::with(['user','advertiser'])
                    ->where('massage_profile_id', $profile_id);
                }
                break;
        }

        return DataTables::of($suspentions)
            ->addColumn('created_at', fn($row) => $row->created_at->format('d-m-Y'))
            ->addColumn('start_date', fn($row) =>  date('d-m-Y', strtotime($row->start_date)))
            ->addColumn('end_date', fn($row) => date('d-m-Y', strtotime($row->end_date)))
            // ->addColumn('status', fn($row) => 'status')
            ->addColumn('status', function ($row) {
            $today = Carbon::today('UTC');

            $startDate = Carbon::parse($row->utc_start_date, 'UTC')->startOfDay();
            $endDate   = Carbon::parse($row->utc_end_date, 'UTC')->startOfDay();

            if ($today->lt($startDate)) {
            $listingStatus = 'Upcoming';
            } elseif ($today->gt($endDate)) {
            $listingStatus = 'Expired';
            }
            else{
                $listingStatus = 'Current';
            }
            $listingStatusClass = getStatusBadgeClass(strtolower($listingStatus));
            return "<span class='custom_badge {$listingStatusClass}'>{$listingStatus}</span>";
            
            })
            ->addColumn('status_order', function ($row) {
            $today = Carbon::today('UTC');

            $startDate = Carbon::parse($row->utc_start_date, 'UTC')->startOfDay();
            $endDate   = Carbon::parse($row->utc_end_date, 'UTC')->startOfDay();

            if ($today->lt($startDate)) {
            return 'Upcoming';
            } elseif ($today->gt($endDate)) {
            return 'Expired';
            }

            return 'Current';
            })
            ->orderColumn('status_order', function ($query, $order) {
            $today = Carbon::today('UTC')->toDateString();

            $query->orderByRaw("
            CASE
            WHEN utc_start_date <= ? AND utc_end_date >= ? THEN 1
            WHEN utc_start_date > ? THEN 2
            WHEN utc_end_date < ? THEN 3
            ELSE 4
            END {$order}
            ", [$today, $today, $today, $today]);
            })
            ->addColumn('days', function ($row) {
                $startDate = Carbon::parse($row->utc_start_date);
                $endDate   = Carbon::parse($row->utc_end_date);
                return $startDate->diffInDays($endDate) + 1; // inclusive of first day
            })
            ->rawColumns(['status'])
            ->make(true);

    }

    public function advertiserSuspensionDataTableListingAjax($advertiserType)
    {

        $search = request()->get('search')['value'];
        $today = Carbon::now();
        switch ($advertiserType) {
            case 'escort': {
                    $advertisers = SuspendProfile::with(['user','advertiser'])
                    ->where('utc_end_date', '>=', $today);
                }
                break;
            case 'massage': {
                    $advertisers = MassageSuspendProfile::with(['user','advertiser'])
                    ->where('utc_end_date', '>=', $today);
                }
                break;
        }

        return DataTables::of($advertisers)
            ->addColumn('profile_id', fn($row) => $row->advertiser->slug)
            ->addColumn('advertiser_id', fn($row) => $row->advertiser->id)
            ->addColumn('member_id', fn($row) => $row->advertiser->member_id)
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
                $redirectUrl =  ($row->user->type == '4') ? route('preview.massage', $row->advertiser->slug) : route('preview.escort', $row->advertiser->slug);
                $actionBtn = '
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dot-dropdown dropdown-menu  dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                
                                
                                <a class="viewEscortSuspendedProfile dropdown-item d-flex align-items-center justify-content-start gap-10" href="' . $redirectUrl . '" target="_blank"> <i class="fa fa-eye"></i> View Profile</a>
                                
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

    public function advertiserCancellationDataTableListingAjax($advertiserType)
    {

        $search = request()->get('search')['value'];
        $today = Carbon::now();
        switch ($advertiserType) {
            case 'escort': {
                    $purchases = Purchase::whereRaw('? BETWEEN utc_start_time AND utc_end_time', [$today])
                        ->where('status', 'cancel')
                        ->get();
                }
                break;
            case 'massage': {
                    $purchases = MassagePurchase::whereRaw('? BETWEEN utc_start_time AND utc_end_time', [$today])
                        ->where('status', 'cancel')
                        ->get();
                }
                break;
            default:
                # code...
                break;
        }


        if ($search) {
            $purchases = $purchases->filter(function ($item) use ($search) {
                $matchesMemberId = $item->advertiser->user && stripos($item->advertiser->user->member_id, $search) !== false;
                return $matchesMemberId;
            })->values(); // reset the keys
        }

        return DataTables::of($purchases)
            ->addColumn('profile_id', fn($row) => $row->advertiser->slug)
            ->addColumn('advertiser_id', fn($row) => $row->advertiser->id)
            ->addColumn('member_id', fn($row) => $row->advertiser->user->member_id)
            ->addColumn('start_date', fn($row) =>  date('d-m-Y', strtotime($row->start_date)))
            ->addColumn('end_date', fn($row) => date('d-m-Y', strtotime($row->end_date)))
            ->addColumn('location', function ($row) {
                return $row->advertiser->state_abbr;
            })
            ->addColumn('cancelled_at', function ($row) {
                return ($row->advertiser->user->type == '4') ? getAustraliaTime($row->utc_cancel_time, 'd-m-Y h:i A') : getAustraliaTime($row->cancelled_at, 'd-m-Y h:i A');
            })
            ->addColumn('action', function ($row) {
                $redirectUrl =  ($row->advertiser->user->type == '4') ? route('preview.massage', $row->advertiser->slug) : route('preview.escort', $row->advertiser->slug);
                $actionBtn = '
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dot-dropdown dropdown-menu  dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                <a class="viewEscortSuspendedProfile dropdown-item d-flex align-items-center justify-content-start gap-10" href="' . $redirectUrl . '" target="_blank"> <i class="fa fa-eye"></i> View Profile</a>
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
                    $advertisers = Purchase::with(['member','advertiser'])
                    ->where('status', 'suspend')
                        ->whereRaw('? BETWEEN suspended_at AND utc_end_time', [$today])
                        ->get();
                }
                break;
            case 'massage': {
                    $advertisers = MassagePurchase::with(['user','advertiser'])
                        ->where('status', 'suspend')
                        ->whereRaw('? BETWEEN suspended_at AND utc_end_time', [$today])
                        ->get();
                }
                break;
            default:
                # code...
                break;
        }

        return DataTables::of($advertisers)
            ->addColumn('profile_id', fn($row) => $row->advertiser->slug)
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
                $redirectUrl =  ($row->advertiser->user->type == '4') ? route('preview.massage', $row->advertiser->slug) : route('preview.escort', $row->advertiser->slug);
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
