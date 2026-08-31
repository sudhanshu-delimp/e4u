<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Escort;
use App\Models\MassageProfile;
use App\Models\EscortPinup;
use App\Models\EscortViewerInteractions;
use App\Models\SuspendProfile;
use App\Models\MassageSuspendProfile;
use App\Repositories\Escort\EscortInterface;
use App\Repositories\MassageProfile\MassageProfileInterface;
use App\Repositories\Service\ServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Exception;
// use Yajra\DataTables\Facades\DataTables;
use DataTables;
use Illuminate\Support\Facades\Auth;
use App\Repositories\User\UserInterface;
use App\Models\MassagePurchase;
use App\Models\Purchase;
use App\Models\User;
use App\Repositories\Purchase\PurchaseInterface;
use App\Repositories\Playmate\PlaymateInterface;
use App\Traits\DataTablePagination;
use Illuminate\Support\Facades\Mail;
use App\Mail\Admin\ListingSuspendedMail;
use App\Mail\Admin\ListingReinstateMail;
use Illuminate\Support\Facades\Log;

class GlobalMonitoringController extends Controller
{
    use DataTablePagination;
    protected $escort;
    protected $massage_profile;
    protected $user;
    protected $viewAccessEnabled;
    protected $editAccessEnabled;
    protected $addAccessEnabled;
    protected $sidebar;
    protected $purchase;
    protected $playmateHistory;

    public function __construct(MassageProfileInterface $massage_profile,  EscortInterface $escort, UserInterface $user, PurchaseInterface $purchase, PlaymateInterface $playmateHistory)
    {
        $this->escort = $escort;
        $this->massage_profile = $massage_profile;
        $this->user = $user;
        $this->purchase = $purchase;
        $this->playmateHistory = $playmateHistory;
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

    # Massage centre listing start here

    public function massageCenterListing()
    {
        $uptimeString = $this->getAppUptime();

        return view('admin.massage-centre-listings-new', ['type' => 'current', 'uptimeString' => $uptimeString]);
    }

    public function massageCenterListingAjaxBackup($type = NULL, $callbyFunc = false)
    {
        $today = Carbon::today();
        $search = request()->input('search.value');
        //$search = "";

        $massagers = MassageProfile::with([
            'mainPurchase',
            'brb' => function ($query) {
                $query->where('brb_time', '>', Carbon::now('UTC'))
                    ->where('active', 'Y')
                    ->orderBy('brb_time', 'desc');
            },
            'activeBumpup',
            'user:id,status,member_id,name,email,phone,status,state_id',
            'activeUpcomingSuspend'
        ])
            //->where('user_id', auth()->user()->id)
            ->where('default_setting', 0)
            ->withCount(['mainPurchase as is_active'])
            ->where(function ($q) use ($search) {
                if (!empty($search)) {

                    $q->orWhere(function ($q) use ($search) {
                        $q->where('profile_name', $search);
                    });
                    $q->orWhere(function ($q) use ($search) {
                        $q->whereHas('user', function ($q) use ($search) {
                            $q->where('member_id', $search);
                        });
                    });
                }
            })
            ->orderByDesc('is_active')
            ->orderBy('id', 'desc')
            ->get();

        /*   echo '<pre>';
         print_r($massagers->toArray());
        echo '</pre>';
         exit; */

        $result = $massagers->map(function ($row) use ($today) {

            $homeStateId = $row->user->state_id;
            $isLive = 0;
            $localTimeZone  = config("escorts.profile.states.$homeStateId.timeZone");
            $homeStateName  = config("escorts.profile.states.$homeStateId.stateAbbr");
            if (!empty($row->is_active))
                $is_live = true;
            else
                $is_live = false;


            $brb = [];
            if (isset($row->brb) && (count($row->brb) > 0))
                $brb = json_decode(json_encode($row->brb), true);

            $activeUpcomingSuspend = [];
            if (isset($row->activeUpcomingSuspend) && (!empty($row->activeUpcomingSuspend)))
                $activeUpcomingSuspend = json_decode(json_encode($row->activeUpcomingSuspend), true);

            $isBumpUped = $row->activeBumpup;
            $row->is_bumpup = !empty($isBumpUped) ? true : false;


            $isExtended = $row->isListingExtended();


            $start_date = "";
            $end_date = "";
            $days = "";
            $start = "";
            $end = "";
            if (isset($row->mainPurchase->start_date) && isset($row->mainPurchase->end_date)) {
                $start = Carbon::parse($row->mainPurchase->start_date);
                $end   = Carbon::parse($row->mainPurchase->end_date);
                $days = $start->diffInDays($end) + 1;

                $start_date = date('d M Y', strtotime($start));
                $end_date = date('d M Y', strtotime($end));
            }
            $profile_name = "";

            if (!empty($brb))
                $profile_name = '<span id="brb_' . $row->id . '"> ' . $row->profile_name . ' <br/><sup class="brb_icon listing-tag-tooltip">Closed <small class="listing-tag-tooltip-desc">Closed  ' . date('d-m-Y h:i A', strtotime($brb[0]['selected_time'])) . '</small></sup></span>';
            else
                $profile_name = '<span id="brb_' . $row->id . '"> ' . $row->profile_name . '</span><br/>';

            if (!empty($activeUpcomingSuspend) || $row->user->status == "Suspended") {
                if ($row->user->status == "Suspended")
                    $profile_name .= '<sup class="suspend_icon listing-tag-tooltip ml-1">Suspended
                    <small class="listing-tag-tooltip-desc">Your membership has been Suspended due to a Report</small>
                    </sup>';
                else
                    $profile_name .= '<sup class="suspend_icon listing-tag-tooltip ml-1">Suspended
                    <small class="listing-tag-tooltip-desc">Suspend from ' . date("d-m-Y", strtotime($activeUpcomingSuspend['start_date'])) . " to " . date("d-m-Y", strtotime($activeUpcomingSuspend['end_date'])) . '</small>
                    </sup>';
            }

            if ($is_live && $isBumpUped  && (!empty($isBumpUped))) {
                $profile_name .= '<sup class="bumpup_icon listing-tag-tooltip ml-1">Bumped Up
                <small class="listing-tag-tooltip-desc">From ' . getMassageLocalTime($isBumpUped->utc_start_time, $localTimeZone)->format('d-m-Y h:i A') . " to " . getMassageLocalTime($isBumpUped->utc_end_time, $localTimeZone)->format('d-m-Y h:i A') . '</small>
                </sup>';
            }

            if (isset($isExtended->count) && $isExtended->count && $is_live) {
                $profile_name  .= '<sup class="brb_icon listing-tag-tooltip ml-1" style="background-color:#1CC88A">Extended <small class="listing-tag-tooltip-desc">Extended  ' . date('d-m-Y h:i A', strtotime($isExtended->data->start_date)) . '</small></sup>';
            }
            $actionBtn = "";
            $profile_url = ['id' => $row->id, 'ids' => '[]'];
            if (!$is_live)
                $actionBtn = '<a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"  
                href="javascript:void(0)" 
                onclick="openModal(\'' . route('web.massage-description', $profile_url) . '\')"> 
                <i class="fa fa-eye"></i> View
                </a>';
            else
                $actionBtn = '<a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"  
                href="' . route('web.massage-description', $profile_url) . '"> 
                <i class="fa fa-eye "></i> View
                </a>';

            $actionButtons = '<div class="dropdown no-arrow ml-3">
                                    
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>
                                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                        aria-labelledby="dropdownMenuLink" style="">' . $actionBtn . '
                                        
                                    </div>
                                </div>';

            $days = "-";
            $leftDays = '-';
            $statusBtn = "";
            if (!empty($start) && !empty($start)) {
                $startDate = Carbon::parse(date('d-m-Y', strtotime($row->mainPurchase->start_date)))->startOfDay();
                $endDate = Carbon::parse(date('d-m-Y', strtotime($row->mainPurchase->end_date)))->startOfDay();

                $now = Carbon::now()->startOfDay();
                $leftDays = $endDate->diffInDays($now) + 1;
                $status = $row->mainPurchase->status;
                $statusBtn = '<span class="custom_badge badge_current">Current</span>';



                if ($startDate > $now) {
                    $leftDays = '-';
                    $statusBtn = '<span class="custom_badge badge_upcoming">Upcoming</span>';
                } else if ($endDate < $now) {
                    $leftDays = '0';
                    $statusBtn = '<span class="custom_badge badge_suspended">Inactive</span>';
                } else {
                    $leftDays = $leftDays;
                }

                if ($startDate && $endDate) {
                    // If end_date is after or equal to start_date, calculate days (inclusive)
                    if ($endDate->gte($startDate)) {
                        $days = $startDate->diffInDays($endDate) + 1;
                    }
                }
            }

            return [
                'id' => $row->id,
                'member_id' => $row->user->member_id,
                'member' => $row->user->name,
                'listing' => $homeStateName,
                'profile_name' => $profile_name,
                'pro_name' => $profile_name,
                'address' => 'Home State', //auth()->user()->home_state,
                'business_name' => $row->business_name,
                'start_date' => $start_date,
                'end_date' =>  $end_date,
                'fee_paid' => '$ ' . formatIndianNumber($row->paid_rate),
                'status' => ($is_live) ? '<span class="custom_badge badge_active">Active</span>' : '<span class="custom_badge badge_inactive">Inactive</span>',
                'masseurs' => isset($row->massagerMasseurs) ? $row->massagerMasseurs->count() : 0,
                'days' => $days,
                'left_days' => $leftDays,
                'action' => $actionButtons,

            ];
        });

        $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => count($result),
            "recordsFiltered" => count($result),
            "data"            => $result
        );

        return response()->json($data);
    }


    public function massageCenterListingAjax($type = NULL, $callbyFunc = false)
    {
        $today = Carbon::today();
        $search = request()->input('search.value');
        $order_key = request()->get('order')[0]['column'];
        $dir = request()->get('order')[0]['dir'];
        // ✅ Yeh 3 lines add karo
        $start  = request()->input('start', 0);
        $length = request()->input('length', 10);
        $draw   = intval(request()->input('draw'));
        $massagePurchaseTableName = (new MassagePurchase)->getTable();
        $userTableName = (new User())->getTable();
        $massagers = MassagePurchase::whereDoesntHave('activeSuspendProfile')
            ->with([
                'brb' => function ($query) {
                    $query->where('brb_time', '>', Carbon::now('UTC'))
                        ->where('active', 'Y')
                        ->orderBy('brb_time', 'desc');
                },
                'massageprofile',
                'user:id,status,member_id,name,email,phone,status,state_id',
                'activeUpcomingSuspend',
            ])
            ->leftJoin($userTableName, $userTableName . '.id', '=', $massagePurchaseTableName . '.massage_centre_id')
            ->select($massagePurchaseTableName . '.*')
            ->whereIn($massagePurchaseTableName . '.status', ['listed', 'expire'])
            ->where(
                function ($q) use ($search) {
                    if (!empty($search)) {
                        $q->orWhere(function ($q) use ($search) {
                            $q->whereHas('massageprofile', function ($q) use ($search) {
                                $q->where('profile_name', $search);
                            });
                        });
                        $q->orWhere(function ($q) use ($search) {
                            $q->whereHas('user', function ($q) use ($search) {
                                $q->where('member_id', $search);
                            });
                        });
                    }
                }
            );

        /* listed first, expire second */
        //echo $order_key; die;
        // $massagers = $massagers->orderByRaw("
        //     CASE 
        //         WHEN $massagePurchaseTableName.status = 'listed' THEN 1
        //         WHEN $massagePurchaseTableName.status = 'expire' THEN 2
        //         ELSE 3
        //     END
        // ");

        $massagers = $massagers->orderByRaw("
            CASE 
                WHEN $massagePurchaseTableName.status = 'listed' THEN 1
                WHEN $massagePurchaseTableName.status = 'expire' THEN 2
                ELSE 3
            END ASC,
            end_date ASC
        ");

        switch ($order_key) {

            case 0:
                $massagers = $massagers->orderBy($userTableName . '.member_id', $dir);
                break;

            case 1:
                $massagers = $massagers->orderBy($userTableName . '.name', $dir);
                break;

            case 7:
                //$massagers = $massagers->orderByRaw("DATEDIFF(end_date, NOW()) DESC");
                $massagers = $massagers->selectRaw("
                    massage_purchases.*,
                    DATEDIFF(end_date,start_date) as days
                ")
                    ->orderBy('days', $dir);
                break;

            case 8:
                //$massagers = $massagers->orderByRaw("DATEDIFF(end_date, NOW()) DESC");
                $massagers = $massagers->selectRaw("
                    massage_purchases.*,
                    DATEDIFF(end_date, NOW()) as days_left
                ")
                    ->orderBy('days_left', $dir);
                break;


            default:
                //$massagers = $massagers->orderBy('massage_purchases.id', 'DESC');
                break;
        }

        $recordsTotal = (clone $massagers)->count();
        $massagers = $massagers->skip($start)->take($length)->get();

        $result = $massagers->map(function ($row) use ($today) {

            $homeStateId = $row->user->state_id;
            $isLive = 0;
            $localTimeZone  = config("escorts.profile.states.$homeStateId.timeZone");
            $homeStateName  = config("escorts.profile.states.$homeStateId.stateAbbr");
            if (!empty($row->massageprofile)) {
                $is_live = true;
                $isLive = 1;
            } else {
                $is_live = false;
            }

            $brb = [];
            if (isset($row->brb) && (count($row->brb) > 0))
                $brb = json_decode(json_encode($row->brb), true);

            $activeUpcomingSuspend = [];
            if (isset($row->activeUpcomingSuspend) && (!empty($row->activeUpcomingSuspend)))
                $activeUpcomingSuspend = json_decode(json_encode($row->activeUpcomingSuspend), true);

            $isBumpUped = $row->massageprofile->activeBumpup;
            $row->is_bumpup = !empty($isBumpUped) ? true : false;
            $isExtended = $row->massageprofile->isListingExtended();

            $start = Carbon::parse($row->start_date);
            $end   = Carbon::parse($row->end_date);
            $days = $start->diffInDays($end) + 1;

            $start_date = date('d-m-Y', strtotime($row->start_date));
            $end_date = date('d-m-Y', strtotime($row->end_date));
            $profile_name = "";

            if (!empty($brb))
                $profile_name = '<span id="brb_' . $row->massageprofile->id . '"> ' . $row->massageprofile->profile_name . ' <br/><sup class="brb_icon listing-tag-tooltip">Closed <small class="listing-tag-tooltip-desc">Closed  ' . date('d-m-Y h:i A', strtotime($brb[0]['selected_time'])) . '</small></sup></span>';
            else
                $profile_name = '<span id="brb_' . $row->massageprofile->id . '"> ' . $row->massageprofile->profile_name . '</span><br/>';

            if (!empty($activeUpcomingSuspend) || $row->user->status == "Suspended") {
                if ($row->user->status == "Suspended")
                    $profile_name .= '<sup class="suspend_icon listing-tag-tooltip ml-1">Suspended
                    <small class="listing-tag-tooltip-desc">Your membership has been Suspended due to a Report</small>
                    </sup>';
                else
                    $profile_name .= '<sup class="suspend_icon listing-tag-tooltip ml-1">Suspended
                    <small class="listing-tag-tooltip-desc">Suspend from ' . date("d-m-Y", strtotime($activeUpcomingSuspend['start_date'])) . " to " . date("d-m-Y", strtotime($activeUpcomingSuspend['end_date'])) . '</small>
                    </sup>';
            }

            if ($is_live && $isBumpUped  && (!empty($isBumpUped))) {
                $profile_name .= '<sup class="bumpup_icon listing-tag-tooltip ml-1">Bumped Up
                <small class="listing-tag-tooltip-desc">From ' . getMassageLocalTime($isBumpUped->utc_start_time, $localTimeZone)->format('d-m-Y h:i A') . " to " . getMassageLocalTime($isBumpUped->utc_end_time, $localTimeZone)->format('d-m-Y h:i A') . '</small>
                </sup>';
            }

            if (isset($isExtended->count) && $isExtended->count && $is_live) {
                $profile_name  .= '<sup class="brb_icon listing-tag-tooltip ml-1" style="background-color:#1CC88A">Extended <small class="listing-tag-tooltip-desc">Extended  ' . date('d-m-Y h:i A', strtotime($isExtended->data->start_date)) . '</small></sup>';
            }
            $actionBtn = "";
            // $profile_url = ['id' => $row->massageprofile->id, 'ids' => '[]'];
            $profile_url = ['profile' => $row->massageprofile->slug];
            $actionBtn .= '<a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"  
                href="' .  getEscortMassageDetailUrl($row->massageprofile, 'massage') . '" target="_blank"> 
                <i class="fa fa-eye "></i> View</a>';
            if ($row->status == 'listed') {
                $actionBtn .= '<a class="dropdown-item d-flex justify-content-start gap-10 align-items-center border-top" href="#" data-toggle="modal" data-target="#SetPinModal" data-purchase-id="' . $row->id . '"><i class="fa fa-ban "></i> Suspend 
                                    </a>';
            }

            /*    $actionButtons = '<div class="dropdown no-arrow ml-3">
                                    
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>
                                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                        aria-labelledby="dropdownMenuLink" style="">' . $actionBtn . '
                                        
                                    </div>
                                </div>'; */
            $actionButtons = '<div class="dropdown no-arrow ml-3">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink">' . $actionBtn . '
                                    
                                </div>
                            </div>';

            $days = 0;
            $startDate = Carbon::parse(date('d-m-Y', strtotime($row->start_date)))->startOfDay();
            $endDate = Carbon::parse(date('d-m-Y', strtotime($row->end_date)))->startOfDay();

            $now = Carbon::now()->startOfDay();
            $leftDays = $endDate->diffInDays($now) + 1;
            $status = $row->status;
            $statusBtn = '<span class="custom_badge badge_current">Current</span>';

            $statusText = $row->status ?? 'NA';
            $badgeClass = getStatusBadgeClass($statusText);
            //$statusBtn = "<span class='custom_badge {$badgeClass}'>{$statusText}</span>";

            if ($startDate > $now) {
                $leftDays = '-';
                $statusBtn = '<span class="custom_badge badge_upcoming">Upcoming</span>';
            } else if ($endDate < $now) {
                $leftDays = '0';
                $statusBtn = '<span class="custom_badge badge_suspended">Expired</span>';
            } else {
                $leftDays = $leftDays;
            }

            if ($startDate && $endDate) {
                // If end_date is after or equal to start_date, calculate days (inclusive)
                if ($endDate->gte($startDate)) {
                    $days = $startDate->diffInDays($endDate) + 1;
                }
            }

            return [
                'id' => $row->id,
                'member_id' => $row->user->member_id,
                'member' => $row->user->name,
                'listing' => $homeStateName,
                'profile_name' => $profile_name,
                'pro_name' => $profile_name,
                'address' => 'Home State', //auth()->user()->home_state,
                'business_name' => $row->massageprofile->business_name,
                'start_date' => $start_date,
                'end_date' =>  $end_date,
                'fee_paid' => '$ ' . formatIndianNumber($row->paid_rate),
                'status' =>  $statusBtn,
                'masseurs' => isset($row->massageprofile->massagerMasseurs) ? $row->massageprofile->massagerMasseurs->count() : 0,
                'days' => $days,
                'left_days' => $leftDays,
                'action' => $actionButtons,

            ];
        });

        $listedCount = $massagers->where('status', 'listed')->count();
        $data = array(
            "draw"            => $draw,
            "recordsTotal"    => $recordsTotal,
            "recordsFiltered" => $recordsTotal,
            "current_listing_count" => $listedCount,
            "data"            => $result,
            'server_up_time'  => $this->getAppUptime(),
            'server_time'     => Carbon::now(config('app.escort_server_timezone'))->format('h:i:s A'),
        );

        return response()->json($data);
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



    public function dataTableListingAjax($type = NULL, $callbyFunc = false)
    {

        $search = request()->get('search')['value'];
        // $user_id = auth()->user()->id;
        $ascDesc = 'DESC';
        $recordTotal = 0;
        $dataTableData = [];

        $params  = [
            'string' => request()->get('name'),
            'city_id' => request()->get('city'),
            'premises' => request()->get('premises'),
            'masseur_types' => request()->get('masseur_types'),
            'age' => request()->get('age'),
            'prices' => request()->get('prices'),
            'massage_services' => request()->get('massage_services'),
            'other_services' => request()->get('other_services'),
        ];


        //list($service_one, $service_two, $service_three) = $this->services->findByCategory([1,2,3]);
        $escorts = $this->massage_profile->findByMassageCentre(50, $params);

        $escorts = collect($escorts->items())->where('end_date', '>=', Carbon::now()->startOfDay());

        $dataTableData = [];
        if ($search) {
            $dataTableData = $escorts->filter(function ($item) use ($search) {
                // Match profile_name
                $matchesProfile = stripos($item->profile_name, $search) !== false;

                // Match user->member_id (check if user relation exists)
                $matchesMemberId = $item->user && stripos($item->user->member_id, $search) !== false;

                return $matchesProfile || $matchesMemberId;
            })->values(); // reset the keys
        }

        if (count($escorts->toArray()) > 0) {
            $dataTableData = $escorts->toArray();
            foreach ($dataTableData as $key => $item) {
                $dataTableData[$key]['upTime'] = $this->getAppUptime();
                $dataTableData[$key]['server_time'] = Carbon::now(config('app.escort_server_timezone'))->format('h:i:s A');
            }
        }

        $actionButtons = `<div class="dropdown no-arrow ml-3">
                                    <input type="hidden" class="tortalRecords" value="` . count($dataTableData) . `">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>
                                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                        aria-labelledby="dropdownMenuLink" style="">
                                        <a class="dropdown-item d-flex justify-content-between align-items-center" data-toggle="modal" data-target="#view-listing" href="#">View Listing <i class="fa fa-eye text-dark"
                                                style="color: var(--peach);" ></i></a>
                                    </div>
                                </div>`;

        $masseurs = 5;
        return DataTables::of($dataTableData)
            ->addColumn('member_id', fn($row) => $row['user']['member_id'])
            ->addColumn('member', fn($row) => $row['name'])
            ->addColumn('listing', fn($row) => config(
                "escorts.profile.states.$row[state_id].cities.$row[city_id].cityName",
            ) ?? '-')
            ->addColumn('profile_name', fn($row) => $row['profile_name'])
            ->addColumn('masseurs', fn($row) => $masseurs)
            ->addColumn('start_date', fn($row) =>  date('d-m-Y', strtotime($row['start_date'])))
            ->addColumn('end_date', fn($row) => date('d-m-Y', strtotime($row['end_date'])))
            ->addColumn('days', function ($row) {

                $startDate = Carbon::parse(date('d-m-Y', strtotime($row['start_date'])))->startOfDay();
                $endDate = Carbon::parse(date('d-m-Y', strtotime($row['end_date'])))->startOfDay();

                if ($startDate && $endDate) {
                    // If end_date is after or equal to start_date, calculate days (inclusive)
                    if ($endDate->gte($startDate)) {
                        return $startDate->diffInDays($endDate) + 1;
                    }
                }

                return  0; // Invalid date range

            })
            ->addColumn('left_days', function ($row) {
                $startDate = Carbon::parse(date('d-m-Y', strtotime($row['start_date'])))->startOfDay();
                $endDate = Carbon::parse(date('d-m-Y', strtotime($row['end_date'])))->startOfDay();
                $now = Carbon::now()->startOfDay();
                $left = $endDate->diffInDays($now) + 1;

                if ($startDate > $now) {
                    return '-';
                } else if ($endDate < $now) {
                    return '0';
                } else {
                    return $left;
                }
            })
            ->addColumn('action', fn($row) => $actionButtons)
            ->rawColumns(['action']) // if you're returning HTML
            ->make(true);
    }

    public function dataTableSingleListingAjax($id)
    {
        $escorts = MassageProfile::where('id', $id)->with('user')->first();

        $profile_url = ['id' => $id, 'ids' => '[]'];
        $profileurl = route('web.massage-description',  $profile_url);

        $dataTableData = [];

        if ($escorts) {
            $escort = $escorts->toArray();

            $startDate = Carbon::parse(date('d-m-Y', strtotime($escort['start_date'])))->startOfDay();
            $endDate = Carbon::parse(date('d-m-Y', strtotime($escort['end_date'])))->startOfDay();
            $now = Carbon::now()->startOfDay();
            $left = $endDate->diffInDays($now) + 1;
            $days = 0;

            if ($startDate > $now) {
                $left = '-';
            }

            if ($endDate < $now) {
                $left = 0;
            }

            if ($startDate && $endDate) {
                // If end_date is after or equal to start_date, calculate days (inclusive)
                if ($endDate->gte($startDate)) {
                    $days = $startDate->diffInDays($endDate) + 1;
                }
            }

            $dataTableData = [
                'profileurl' => $profileurl,
                'id' => $escort['id'],
                'upTime' => $this->getAppUptime(),
                'server_time' => Carbon::now(config('app.escort_server_timezone'))->format('h:i:s A'),
                'member_id' => $escort['user']['member_id'],
                'member' => $escort['name'],
                'city' =>
                config(
                    "escorts.profile.states.$escort[state_id].cities.$escort[city_id].cityName",
                ),
                'profile_name' => $escort['profile_name'] ?? '-',

                'masseurs' => '-',
                'start_date' => date(
                    'd-m-Y',
                    strtotime($escort['start_date']),
                ),
                'end_date' => date('d-m-Y', strtotime($escort['end_date'])),
                'days' => $days,
                'left_days' => $left,

            ];
        }

        return response()->json($dataTableData);
    }

    # Escort listing start here
    public function escortListing()
    {
        $uptimeString = $this->getAppUptime();

        return view('admin.escort-listings', ['type' => 'current', 'uptimeString' => $uptimeString]);
    }

    public function dataTableEscortListingAjax($type = NULL)
    {
        $conditions = [];
        $conditionsIn = [];
        $conditionsIn['column'] = 'status';
        $conditionsIn['condition'] = ['listed', 'pending', 'expire'];
        $userId = null;
        //list($result, $count) = $this->escort->paginatedList(
        list($result, $count) = $this->purchase->paginatedList(
            request()->get('start'),
            request()->get('length'),
            request()->get('order')[0]['column'],
            request()->get('order')[0]['dir'],
            request()->get('columns'),
            request()->get('search')['value'],
            $userId,
            $conditions,
            $conditionsIn
        );
        $search = request()->input('search.value');
        $data = array(
            "draw"            => intval(request()->input('draw')),
            "other"            => request()->get('order')[0]['column'],
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $result,
            "membershipCounts" => $this->countEscortPurchaseMembershipCategories($search, $userId),
            'server_up_time' => $this->getAppUptime(),
            'server_time' => Carbon::now(config('app.escort_server_timezone'))->format('h:i:s A'),
        );

        return response()->json($data);
    }

    public function countEscortPurchaseMembershipCategories($search, $user_id = 0)
    {
        $escorts = Purchase::whereIn('status', ['listed'])
            ->whereHas('escort', function ($sub_query) use ($user_id, $search) {
                if ($user_id > 0) {
                    $sub_query = $sub_query->where('user_id', $user_id);
                }
                $sub_query->whereNotNull('profile_name');
                if ($search) {
                    $sub_query->where(function ($q) use ($search) {
                        $q->where('profile_name', 'LIKE', "%{$search}%")
                            ->orWhereHas('user', function ($q) use ($search) {
                                $q->where('member_id', 'LIKE', "%{$search}%");
                            });
                    });
                }
            });

        return [
            'silver'   => (clone $escorts)->whereIn('membership', ['3'])->whereDoesntHave('activeSuspendProfile')->count() ?? 0,
            'gold'     => (clone $escorts)->whereIn('membership', ['2'])->whereDoesntHave('activeSuspendProfile')->count() ?? 0,
            'platinum' => (clone $escorts)->whereIn('membership', ['1'])->whereDoesntHave('activeSuspendProfile')->count() ?? 0,
            'current_suspend' => (clone $escorts)->whereHas('activeSuspendProfile')->count(),
            'total' => (clone $escorts)->whereIn('membership', ['1', '2', '3'])->count() ?? 0,
        ];
    }

    public function countEscortMembershipCategories()
    {
        $escorts = Escort::where('default_setting', '!=', 1)
            ->where('enabled', 1)
            ->where('profile_name', '!=', null);

        return [
            'silver'   => (clone $escorts)->whereIn('membership', ['3'])->count() ?? 0,
            'gold'     => (clone $escorts)->whereIn('membership', ['2'])->count() ?? 0,
            'platinum' => (clone $escorts)->whereIn('membership', ['1'])->count() ?? 0,
            'total' => (clone $escorts)->whereIn('membership', ['1', '2', '3'])->count() ?? 0,
        ];
    }

    public function escortListedProfile($escortId)
    {
        if ($escortId != null) {
            $escorts = Escort::where('id', $escortId)->with(['durations', 'purchase', 'user', 'brb' => function ($query) {
                $query->where('brb_time', '>', Carbon::now('UTC'))->where('active', 'Y')->orderBy('brb_time', 'desc');
            }, 'pinup', 'suspendProfile'])->whereIn('membership', ['1', '2', '3']);
        } else {
            $escorts = Escort::with(['durations', 'purchase', 'user', 'brb' => function ($query) {
                $query->where('brb_time', '>', Carbon::now('UTC'))->where('active', 'Y')->orderBy('brb_time', 'desc');
            }, 'pinup', 'suspendProfile'])->whereIn('membership', ['1', '2', '3']);
        }

        $escorts->where('enabled', 1);

        return $escorts;
    }

    public function dataTableEscortSingleListingAjax($id)
    {
        //$result = $this->escortListedProfile($id);

        $escortProfile = Escort::where('id', $id)->with(['durations', 'purchase', 'user', 'brb' => function ($query) {
            $query->where('brb_time', '>', Carbon::now('UTC'))->where('active', 'Y')->orderBy('brb_time', 'desc');
        }, 'pinup', 'suspendProfile'])->first();

    $escort = $escortProfile->toArray();


        $dataTableData = [];

        if ($escort['purchase']) {
            foreach ($escort['purchase'] as $purchase) {
                $daysDiff = 0;
                $brb = $escort['profile_name'];
                $totalAmount = 0;
                if (isset($escort['brb'][0]['brb_time'])) {
                    $brb =
                        '<span id="brb_' .
                        $escort['id'] .
                        '" >' .
                        $escort['profile_name'] .
                        ' <sup
                                            title="Brb at ' .
                        date(
                            'd-m-Y h:i A',
                            strtotime($escort['brb'][0]['brb_time']),
                        ) .
                        '"
                                            class="brb_icon">BRB</sup></span>';
                }

                # date calucaltion 
                $startDate = Carbon::parse(date('d-m-Y', strtotime($purchase['start_date'])))->startOfDay();
                $endDate = Carbon::parse(date('d-m-Y', strtotime($purchase['end_date'])))->startOfDay();
                $now = Carbon::now()->startOfDay();
                $left = $endDate->diffInDays($now) + 1;
                $days = 0;

                if ($startDate > $now) {
                    $left = '-';
                }

                if ($endDate < $now) {
                    $left = 0;
                }

                if ($startDate && $endDate) {
                    # If end_date is after or equal to start_date, calculate days (inclusive)
                    if ($endDate->gte($startDate)) {
                        $days = $startDate->diffInDays($endDate) + 1;
                    }
                }


                $memberId = isset($escort['user']['member_id']) ? $escort['user']['member_id'] : '';
                $dataTableData = [
                    //'profileurl' => route('profile.description', $escort['id']),
                    'profileurl' => getEscortMassageDetailUrl($escortProfile),
                    'id' => $escort['id'],
                    'member_id' => $memberId,
                    'member' => $escort['name'],
                    'city' =>
                    config(
                        "escorts.profile.states.$escort[state_id].cities.$escort[city_id].cityName",
                    ),
                    'profile_name' => $escort['profile_name'] ? $brb : 'NA',

                    'type' => $purchase['membership'] ? getMembershipType($purchase['membership']) : "NA",
                    'start_date' => date(
                        'd-m-Y',
                        strtotime($purchase['start_date']),
                    ),
                    'end_date' => date('d-m-Y', strtotime($purchase['end_date'])),
                    'days' => $days,
                    'left_days' => $left,
                    'fee' => $totalAmount,
                    'upTime' => $this->getAppUptime(),
                ];
            }
        }

        return response()->json($dataTableData);
    }

    public function getPinupListing(Request $request)
    {
        try {
            $draw   = intval($request->get('draw'));
            $start  = intval($request->get('start'));
            $length = intval($request->get('length'));
            $search = $request->get('search')['value'] ?? '';
            $orderColumnIndex = $request->get('order')[0]['column'] ?? 0;
            $orderDirection   = $request->get('order')[0]['dir'] ?? 'desc';

            // Columns mapping (order index -> DB column)
            $columns = [4 => 'start_date', 5 => 'end_date'];
            $orderColumn = $columns[$orderColumnIndex] ?? 'start_date';

            $listing = EscortPinup::query();
            $listing->where('utc_end_time', '>=', Carbon::now('UTC'));
            if (!empty($search)) {
                $listing->where(function ($q) use ($search) {
                    $q->whereHas('user', function ($uq) use ($search) {
                        $uq->where('member_id', 'like', "%{$search}%");
                    })

                        ->orWhereHas('state', function ($sq) use ($search) {
                            $sq->where('name', 'like', "%{$search}%");
                        });
                });
            }
            $recordsTotal = $listing->count();
            $listing->orderBy($orderColumn, $orderDirection);
            $listing->offset($start);
            $listing->limit($length);
            $recordsFiltered = $listing->count();
            $items = $listing->get();
            $data = [];
            if (!empty($items)) {
                foreach ($items as $item) {
                    $nestedData['member_id'] = $item->user->member_id;
                    $nestedData['escort_name'] = $item->escort->profile_name;
                    $nestedData['location'] = config("escorts.profile.states.$item->state_id.stateAbbr");;
                    $nestedData['profile_id'] = $item->escort->id;
                    $nestedData['start_date'] = date('d-m-Y', strtotime($item->start_date));
                    $nestedData['end_date'] =   date('d-m-Y', strtotime($item->end_date));
                    $statusText = $item->status ?? 'NA';
                    $badgeClass = getStatusBadgeClass($statusText);
                    $nestedData['status'] = "<span class='custom_badge {$badgeClass}'>{$statusText}</span>";

                    $nestedData['option'] = '<div class="dropdown no-arrow text-center">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                    aria-labelledby="dropdownMenuLink" style="">
                        <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" target="_blank" href="' . route('profile.description', $item->escort_id) . '"> <i class="fa fa-eye"></i> View Listing </a>
                    </div>
                    </div>';
                    $data[] = $nestedData;
                }
            }
            return response()->json([
                'draw' => $draw,
                'recordsTotal' => $recordsTotal,
                'recordsFiltered' => $recordsFiltered,
                'data' => $data,
                'server_up_time' => $this->getAppUptime(),
                'server_time' => Carbon::now(config('app.escort_server_timezone'))->format('h:i:s A'),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function suspendListedProfile(Purchase $purchase)
    {
        try {

            $isExtended = $purchase->isListingExtended();
            $escort = $purchase->escort;
            $user = $escort->user;
            if ($escort) {

                $escortTimezone = $escort->time_zone;

                $suspendedAt = Carbon::createFromFormat('Y-m-d H:i:s', now(), $escortTimezone)->setTimezone('UTC');
                $purchase->update(['status' => 'suspend', 'suspended_at' => $suspendedAt]);


                if ($isExtended && $isExtended->count) {
                    $otherPurchase = $isExtended->data;
                    $otherPurchase->update(['status' => 'suspend', 'suspended_at' => $suspendedAt]);
                }

                foreach ($escort->playmates as $playmate) {
                    $this->playmateHistory->trashPlaymateHistory($escort->id, $playmate->id);
                }
                /**
                 * Detach all playmates this escort added
                 */
                $escort->playmates()->detach();
                /**
                 * Detach this escort from other users who added them as a playmate
                 */
                $escort->addedBy()->detach();
                $escort->update([
                    'enabled' => 0,
                    'membership' => null,
                    'start_date' => null,
                    'end_date' => null,
                    'utc_start_time' => null,
                    'utc_end_time' => null,
                    'purchase_id' => null
                ]);
            }

            Mail::to($user->email)->send(new ListingSuspendedMail(compact('purchase')));
            return response()->json([
                'success' => true,
                'message' => "Escort profile has been suspended successfully.",
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function suspendCenterListedProfile(MassagePurchase $purchase)
    {
        try {
            Log::warning('suspendCenterListedProfile', ['purchase' => $purchase]);
            $purchase->update(['status' => 'suspend']);
            $isExtended = $purchase->isListingExtended();
            $profile = $purchase->massageprofile;
            $profileTimezone = $profile->time_zone;
            $suspendedAt = Carbon::createFromFormat('Y-m-d H:i:s', now(), $profileTimezone)->setTimezone('UTC');
            $purchase->update(['status' => 'suspend', 'suspended_at' => $suspendedAt]);

            if ($isExtended && $isExtended->count) {
                $otherPurchase = $isExtended->data;
                $otherPurchase->update(['status' => 'suspend', 'suspended_at' => $suspendedAt]);
            }
            $profile->update([
                'purchase_id' => null
            ]);
            Log::warning('suspendCenterListedProfile', ['profile' => $profile]);
            Mail::to($purchase->user->email)->send(new ListingSuspendedMail(compact('purchase')));
            return response()->json([
                'success' => true,
                'message' => "Massage Center profile has been suspended successfully.",
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function reinstateAdvertiserProfileListing(string $type, int $purchase)
    {
        try {
            $purchase = match ($type) {
                'escort' => Purchase::findOrFail($purchase),
                'massage' => MassagePurchase::findOrFail($purchase),
                default => abort(404),
            };

            $advertiser = $purchase->advertiser;

            $isExtended = $purchase->isListingExtended();

            $purchase->update([
                'status' => 'listed',
                'suspended_at' => NULL
            ]);

            if ($isExtended && $isExtended->count) {
                $otherPurchase = $isExtended->data;
                $otherPurchase->update([
                    'status' => 'listed',
                ]);
            }


            if ($type == 'escort') {
                $advertiser->update([
                    'enabled' => 1,
                    'membership' => $purchase->membership,
                    'start_date' => $purchase->start_date,
                    'end_date' => $purchase->end_date,
                    'utc_start_time' => $purchase->utc_start_time,
                    'utc_end_time' => $purchase->utc_end_time,
                    'purchase_id' => $purchase->id
                ]);

                $listedPlaymates = $advertiser->listedPlaymates;
                $advertiser->playmates()->syncWithoutDetaching($listedPlaymates);
                foreach ($listedPlaymates as $playmateId) {
                    $this->playmateHistory->savePlaymateHistory($advertiser->id, $playmateId, $advertiser->user->id);
                }
                foreach ($listedPlaymates as $playmateId) { //add profile to other escort profiles
                    $otherEscort = Escort::find($playmateId);
                    if ($otherEscort) {
                        $otherEscort->playmates()->syncWithoutDetaching($advertiser->id);
                        $this->playmateHistory->savePlaymateHistory($playmateId, $advertiser->id, $otherEscort->user->id);
                    }
                }
            } else {
                $advertiser->update([
                    'purchase_id' => $purchase->id
                ]);
            }

            Mail::to($purchase->advertiser->user->email)->send(new ListingReinstateMail(compact('purchase')));
            return response()->json([
                'success' => true,
                'message' => "Advertiser profile has been reinstated successfully.",
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
