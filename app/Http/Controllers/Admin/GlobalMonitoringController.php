<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Escort;
use App\Models\MassageProfile;
use App\Models\EscortPinup;
use App\Models\EscortViewerInteractions;
use App\Models\SuspendProfile;
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

class GlobalMonitoringController extends Controller
{
    protected $escort;
    protected $massage_profile;

    public function __construct(MassageProfileInterface $massage_profile,  EscortInterface $escort)
    {
        $this->escort = $escort;
        $this->massage_profile = $massage_profile;
    }

    # Massage centre listing start here

    public function massageCenterListing()
    {
        $uptimeString = $this->getAppUptime();

        return view('admin.massage-centre-listings', ['type' => 'current','uptimeString'=>$uptimeString]);
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
        $str .= $days. ' days & '.$hours .' hours ' .$minutes. ' minutes';

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
        
        $escorts = collect($escorts->items())->where('end_date','>=', Carbon::now()->startOfDay());

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
        
        if(count($escorts->toArray()) > 0){
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
            ->addColumn('member', fn($row) => $row['name'] )
            ->addColumn('listing', fn($row) => config(
                            "escorts.profile.states.$row[state_id].cities.$row[city_id].cityName",
                        ) ?? '-')
            ->addColumn('profile_name', fn($row) => $row['profile_name'] )
            ->addColumn('masseurs', fn($row) => $masseurs)
            ->addColumn('start_date', fn($row) =>  date('d-m-Y', strtotime($row['start_date'])))
            ->addColumn('end_date', fn($row) => date('d-m-Y', strtotime($row['end_date'])))
            ->addColumn('days', function($row){

                $startDate = Carbon::parse(date('d-m-Y', strtotime($row['start_date'])))->startOfDay();
                $endDate = Carbon::parse(date('d-m-Y', strtotime($row['end_date'])))->startOfDay();

                if ($startDate && $endDate) {
                    // If end_date is after or equal to start_date, calculate days (inclusive)
                    if ($endDate->gte($startDate)) {
                        return $startDate->diffInDays($endDate) + 1 ;
                    }
                }

                return  0; // Invalid date range
                
            })
            ->addColumn('left_days', function ($row) {
                $startDate = Carbon::parse(date('d-m-Y', strtotime($row['start_date'])))->startOfDay();
                $endDate = Carbon::parse(date('d-m-Y', strtotime($row['end_date'])))->startOfDay();
                $now = Carbon::now()->startOfDay();
                $left = $endDate->diffInDays($now) + 1;                

                if($startDate > $now){
                    return '-';
                }else if($endDate < $now){
                   return '0';
                }else{
                    return $left ;
                }
                
            })
            ->addColumn('action', fn($row) => $actionButtons)
            ->rawColumns(['action']) // if you're returning HTML
            ->make(true);
    }

    // public function dataTableListingAjaxMassage($type = NULL, $callbyFunc = false)
    // {

    //     $search = request()->get('search')['value'];
    //     // $user_id = auth()->user()->id;
    //     $ascDesc = 'DESC';
    //     $recordTotal = 0;
    //     $dataTableData = [];

    //     $result = Escort::with([
    //         'user',
    //         'purchase' => function ($query) use ($type, $ascDesc) {
    //             if ($type == 'past') {
    //                 $query->where('end_date', '<', date('Y-m-d'));
    //                 $ascDesc = 'DESC';
    //             } else {
    //                 $query->where('end_date', '>=', date('Y-m-d'));
    //             }

    //             $query->orderBy('start_date', $ascDesc);
    //         },
    //         'Brb' => function ($query) {
    //             $query->where('brb_time', '>', date('Y-m-d H:i:s'))
    //                 ->where('active', 'Y')
    //                 ->orderBy('brb_time', 'desc');
    //         }
    //     ])
    //         ->whereHas('purchase')
    //         ->where('profile_name', '!=', null);

    //         //dd($result);

    //     if ($search) {
    //         $result = $result->where(function ($query) use ($search) {
    //             $query->where('profile_name', 'LIKE', "%{$search}%")
    //                 ->orWhereHas('user', function ($q) use ($search) {
    //                     $q->where('member_id', 'LIKE', "%{$search}%");
    //                 });
    //         });
    //     }

    //     $result = $result->get()->toArray();

    //     // For count
    //     $resultNoLImit = Escort::with(['user', 'purchase' => function ($query2) use ($type, $ascDesc) {
    //         if ($type == 'past') {
    //             $query2->where('end_date', '<', date('Y-m-d'));
    //             $ascDesc = 'DESC';
    //         } else {
    //             $query2->where('end_date', '>=', date('Y-m-d'));
    //         }
    //         $query2->orderBy('start_date', $ascDesc);
    //     }])
    //         ->whereHas('purchase')
    //         ->with([
    //             'Brb' => function ($query2) {
    //                 $query2->where('brb_time', '>', date('Y-m-d H:i:s'))->where('active', 'Y')->orderBy('brb_time', 'desc');
    //             }
    //         ])
    //         ->where('profile_name', '!=', null);

    //     if ($search) {
    //         $resultNoLImit = $resultNoLImit->where(function ($query2) use ($search) {
    //             $query2->where('id', 'like', "%{$search}%")
    //                 ->orWhere('profile_name', 'LIKE', "%{$search}%")
    //                 ->orWhere('name', 'LIKE', "%{$search}%");
    //         });
    //     }
    //     $resultNoLImit = $resultNoLImit->get();
    //     foreach ($resultNoLImit as $escort2) {
    //         if ($escort2['purchase']) {

    //             foreach ($escort2['purchase'] as $purchase2) {
    //                 $recordTotal++;
    //             }
    //         }
    //     }

    //     $i = 1;

    //     foreach ($result as $escort) {
    //         if ($escort['purchase']) {
    //             // $recordTotal++;
    //             foreach ($escort['purchase'] as $purchase) {
    //                 $daysDiff = 0;
    //                 $brb = $escort['profile_name'];
    //                 $totalAmount = 0;
    //                 if (isset($escort['brb'][0]['brb_time'])) {
    //                     $brb =
    //                         '<span id="brb_' .
    //                         $escort['id'] .
    //                         '" >' .
    //                         $escort['profile_name'] .
    //                         ' <sup
    //                                         title="Brb at ' .
    //                         date(
    //                             'd-m-Y h:i A',
    //                             strtotime($escort['brb'][0]['brb_time']),
    //                         ) .
    //                         '"
    //                                         class="brb_icon">BRB</sup></span>';
    //                 }
    //                 if (!empty($purchase['start_date'])) {
    //                     $daysDiff = Carbon::parse(
    //                         $purchase['end_date'],
    //                     )->diffInDays(Carbon::parse($purchase['start_date']));
    //                     if ($purchase['start_date'] == $purchase['end_date']) {
    //                         $daysDiff = 1;
    //                     }
    //                     [$discount, $rate] = calculateTatalFee(
    //                         $purchase['membership'],
    //                         $daysDiff,
    //                     );
    //                     $totalAmount = $rate;
    //                     $totalAmount -= $discount;
    //                     $totalAmount = formatIndianCurrency($totalAmount);
    //                 }
    //                 //dd($escort['user']['member_id']);
    //                 $memberId = isset($escort['user']['member_id']) ? $escort['user']['member_id'] : '';
    //                 $dataTableData[] = [
    //                     //'sl_no' => $i++,

    //                     'id' => $escort['id'],
    //                     'total_record' => intval($recordTotal),
    //                     'server_time' => now()->format('h:i:s A'),
    //                     'member_id' => $memberId,
    //                     'member' => '-',
    //                     //  'city' => config(
    //                     //     "escorts.profile.states.$escort[state_id].stateName",
    //                     // ),
    //                     'city' =>
    //                     config(
    //                         "escorts.profile.states.$escort[state_id].cities.$escort[city_id].cityName",
    //                     ),
    //                     'profile_name' => $escort['profile_name'] ? $brb : 'NA',
    //                     //'city' =>
    //                     // config(
    //                     //     "escorts.profile.states.$escort[state_id].cities.$escort[city_id].cityName",
    //                     // ) .
    //                     //     '<br>' .
    //                     //     config("escorts.profile.states.$escort[state_id].stateName"),

    //                     'masseurs' => '-',
    //                     'start_date' => date(
    //                         'd-m-Y',
    //                         strtotime($purchase['start_date']),
    //                     ),
    //                     'end_date' => date('d-m-Y', strtotime($purchase['end_date'])),
    //                     'days' => $daysDiff,
    //                     // 'membership' => $purchase['membership'] ? getMembershipType($purchase['membership']) : "NA",
    //                     // 'fee' => $totalAmount,
    //                     'left_days' => Carbon::parse($purchase['end_date'])->diffInDays(Carbon::now()),
    //                     'fee' => $totalAmount,

    //                 ];
    //             }
    //         }
    //     }
    //     // print_r($dataTableData);die;
    //     $data = array(
    //         "draw"            => intval(request()->input('draw')),
    //         "recordsTotal"    => intval($recordTotal),
    //         "recordsFiltered" => intval($recordTotal),
    //         "data"            => $dataTableData
    //     );

    //     $actionButtons = `<div class="dropdown no-arrow ml-3">
    //                                 <input type="hidden" class="tortalRecords" value="` . $recordTotal . `">
    //                                 <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
    //                                     data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    //                                     <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
    //                                 </a>
    //                                 <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
    //                                     aria-labelledby="dropdownMenuLink" style="">
    //                                     <a class="dropdown-item d-flex justify-content-between align-items-center" data-toggle="modal" data-target="#view-listing" href="#">View Listing <i class="fa fa-eye text-dark"
    //                                             style="color: var(--peach);" ></i></a>
    //                                 </div>
    //                             </div>`;

    //     return DataTables::of($dataTableData)
    //         ->addColumn('member_id', fn($row) => $row['member_id'])
    //         ->addColumn('member', fn($row) => $row['member'])
    //         ->addColumn('listing', fn($row) => $row['city'])
    //         ->addColumn('profile_name', fn($row) => $row['profile_name'])
    //         ->addColumn('masseurs', fn($row) => $row['masseurs'])
    //         ->addColumn('start_date', fn($row) => $row['start_date'])
    //         ->addColumn('end_date', fn($row) => $row['end_date'])
    //         ->addColumn('days', fn($row) => $row['days'])
    //         ->addColumn('left_days', fn($row) => Carbon::parse($row['end_date'])->diffInDays(Carbon::now()))
    //         ->addColumn('action', fn($row) => $actionButtons)
    //         ->rawColumns(['action']) // if you're returning HTML
    //         ->make(true);
    // }

    public function dataTableSingleListingAjax($id)
    {
        $escorts = MassageProfile::where('id', $id)->with('user')->first();

        // center-profile/7
        $profileurl = route('center.profile.description',$id);

        $dataTableData = [];

        if ($escorts) {
                $escort = $escorts->toArray();

                $startDate = Carbon::parse(date('d-m-Y', strtotime($escort['start_date'])))->startOfDay();
                $endDate = Carbon::parse(date('d-m-Y', strtotime($escort['end_date'])))->startOfDay();
                $now = Carbon::now()->startOfDay();
                $left = $endDate->diffInDays($now) + 1;   
                $days = 0;

                if($startDate > $now){
                    $left = '-';
                }
                
                if($endDate < $now){
                   $left = 0;
                }

                if ($startDate && $endDate) {
                    // If end_date is after or equal to start_date, calculate days (inclusive)
                    if ($endDate->gte($startDate)) {
                        $days = $startDate->diffInDays($endDate) + 1 ;
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

        return view('admin.escort-listings', ['type' => 'current','uptimeString'=>$uptimeString]);
    }

    public function dataTableEscortListingAjax($type = NULL)
    {
        $search = request()->get('search')['value'];
        // $user_id = auth()->user()->id;
        $ascDesc = 'DESC';
        $recordTotal = 0;
        $dataTableData = [];

        $result = $this->escortListedProfile(null);

        if ($search) {
            $result = $result->where(function ($query) use ($search) {
                $query->where('profile_name', 'LIKE', "%{$search}%")
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('member_id', 'LIKE', "%{$search}%");
                    });
            });
        }

        $result = $result->get()->toArray();

        foreach ($result as $index=>$escort) {
            if (!empty($escort['purchase'])) {
                $days = 0;
                $left = 0;
                $totalAmount = 0;

                foreach ($escort['purchase'] as $purchase) {
                    # Dates calculation
                    $startDate = Carbon::parse($purchase['utc_start_time']);
                    $endDate   = Carbon::parse($purchase['utc_end_time']);
                    $now       = Carbon::now();

                    $days += $endDate->gte($startDate) ? $startDate->diffInDays($endDate) + 1 : 0;

                    if ($startDate > $now) {
                        $left = '-';
                    } elseif ($endDate < $now) {
                        $left = 0;
                    } else {
                        $left = $endDate->diffInDays($now) + 1;
                    }

                    // Add fee if exists (assuming purchase has 'amount')
                    $totalAmount += $purchase['amount'] ?? 0;
                }

                $badgeEscort = Escort::where('id', $escort['id'])->first();

                # BRB badge
                $brbBadge = '';
                if (!empty($escort['brb'][0]['selected_time'])) {
                    $brbBadge = "<sup class='brb_icon listing-tag-tooltip ml-1'>BRB <small class='listing-tag-tooltip-desc'>Brb  " . date('d-m-Y h:i A', strtotime($escort['brb'][0]['selected_time']))."</small></sup>";
                }

                # Suspension badge
                $suspensionBadge = '';
                if (!empty($badgeEscort->activeUpcomingSuspend)) {
                    $suspensionBadge = '<sup class="suspend_icon listing-tag-tooltip ml-1">SUS
                    <small class="listing-tag-tooltip-desc">Suspend from ' . date("d-m-Y", strtotime($badgeEscort->activeUpcomingSuspend->start_date)) . " to ".date("d-m-Y", strtotime($badgeEscort->activeUpcomingSuspend->end_date)).'</small>
                    </sup>';
                }

                # Extended badge
                $extendBadge = '';
                
                if (!empty($badgeEscort->isListingExtended()) && $badgeEscort->isListingExtended()->count > 0) {
                    $extendBadge = '<sup class="extend_icon listing-tag-tooltip ml-1">Extend
                <small class="listing-tag-tooltip-desc">Extended from ' . date("d-m-Y", strtotime($badgeEscort->start_date)) . " to ".date("d-m-Y", strtotime($badgeEscort->end_date)).'</small>
                </sup>';
                }

                # Pinup badge
                $pinupBadge = '';
                if($badgeEscort->latestActivePinup){
                    $pinupBadge = '<sup class="pinup_icon listing-tag-tooltip ml-1">Pin Up
                    <small class="listing-tag-tooltip-desc">Pinup from ' . date("d-m-Y", strtotime($badgeEscort->latestActivePinup->start_date)) . " to ".date("d-m-Y", strtotime($badgeEscort->latestActivePinup->end_date)).'</small>
                    </sup>';
                }

                # Member Id
                $memberId = $escort['user']['member_id'] ?? '';

                # Add row to DataTable once per escort
                $dataTableData[] = [
                    'id'           => $escort['id'],
                    'total_record' => intval($recordTotal),
                    'server_time'  => Carbon::now(config('app.escort_server_timezone'))->format('h:i:s A'),
                    'member_id'    => $memberId,
                    'member'       => $escort['name'],
                    'city'         => config("escorts.profile.states.$escort[state_id].cities.$escort[city_id].cityName"),
                    'profile_name' => $escort['profile_name'] ? $escort['profile_name'] . $brbBadge. $suspensionBadge . $extendBadge . $pinupBadge : 'NA',
                    'type'         => !empty($escort['purchase'][0]['membership'])
                                        ? getMembershipType($escort['purchase'][0]['membership'])
                                        : "NA",
                    'start_date'   => date('d-m-Y', strtotime($escort['purchase'][0]['start_date'])),
                    'end_date'     => date('d-m-Y', strtotime($escort['purchase'][0]['end_date'])),
                    'days'         => $days,
                    'left_days'    => $left,
                    'fee'          => $totalAmount,
                    'upTime'       => $this->getAppUptime(),
                ];
            }
        }

        $actionButtons = `<div class="dropdown no-arrow ml-3">
                                    <input type="hidden" class="tortalRecords" value="` . $recordTotal . `">
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

        return DataTables::of($dataTableData)
            ->addColumn('member_id', fn($row) => $row['member_id'])
            ->addColumn('member', fn($row) => $row['member'])
            ->addColumn('listing', fn($row) => $row['city'])
            ->addColumn('profile_name', fn($row) => $row['profile_name'])
            ->addColumn('type', fn($row) => $row['type'])
            ->addColumn('start_date', fn($row) => $row['start_date'])
            ->addColumn('end_date', fn($row) => $row['end_date'])
            ->addColumn('days', fn($row) => $row['days'])
            ->addColumn('left_days', fn($row) => $row['left_days'])
            ->addColumn('action', fn($row) => $actionButtons)
            ->rawColumns(['action']) // if you're returning HTML
            ->rawColumns(['profile_name'])
            ->make(true);
    }

    public function escortListedProfile($escortId)
    {
        if($escortId != null){
            $escorts = Escort::where('id',$escortId)->with(['durations','purchase','user','brb' => function ($query) {
                    $query->where('brb_time', '>', Carbon::now('UTC'))->where('active', 'Y')->orderBy('brb_time', 'desc');
                },'pinup','suspendProfile'])->whereIn('membership', ['1','2','3']);
            
        }else{
            $escorts = Escort::with(['durations','purchase','user','brb' => function ($query) {
                    $query->where('brb_time', '>', Carbon::now('UTC'))->where('active', 'Y')->orderBy('brb_time', 'desc');
                },'pinup','suspendProfile'])->whereIn('membership', ['1','2','3']);
        }
        
        
        // # Get suspended escort profile only
        // $suspendProfileIds = SuspendProfile::where('utc_start_date', '<=', Carbon::now('UTC'))
        // ->where('utc_end_date', '>=', Carbon::now('UTC'))
        // ->pluck('escort_profile_id')
        // ->unique();

        // # Suspend by admin console through report by viewers
        // $query = $escorts
        //         ->with('suspendProfile')
        //         ->whereHas('user', function($q) {
        //             $q->where('status', 1);
        //         })
        //     ->whereNotIn('id', $suspendProfileIds);  

            $escorts->where('enabled', 1);
    
        return $escorts;
    }
    
    public function dataTableEscortSingleListingAjax($id)
    {
        $result = $this->escortListedProfile($id);

        $escort = $result->first()->toArray();
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

                if($startDate > $now){
                    $left = '-';
                }
                
                if($endDate < $now){
                $left = 0;
                }

                if ($startDate && $endDate) {
                    // If end_date is after or equal to start_date, calculate days (inclusive)
                    if ($endDate->gte($startDate)) {
                        $days = $startDate->diffInDays($endDate) + 1 ;
                    }
                }


                $memberId = isset($escort['user']['member_id']) ? $escort['user']['member_id'] : '';
                $dataTableData = [
                    'profileurl' => route('profile.description',$escort['id']),
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

    public function getPinupListing(Request $request){
        try{
            $draw   = intval($request->get('draw'));
            $start  = intval($request->get('start'));
            $length = intval($request->get('length'));
            $search = $request->get('search')['value'] ?? '';
            $orderColumnIndex = $request->get('order')[0]['column'] ?? 0;
            $orderDirection   = $request->get('order')[0]['dir'] ?? 'asc';

            // Columns mapping (order index -> DB column)
            $columns = [4=>'start_date', 5=>'end_date'];
            $orderColumn = $columns[$orderColumnIndex] ?? 'id';

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
            if(!empty($items)){
                foreach($items as $item){
                    $nestedData['member_id'] = $item->user->member_id;
                    $nestedData['escort_name'] = $item->escort->profile_name;
                    $nestedData['location'] = config("escorts.profile.states.$item->state_id.stateName");;
                    $nestedData['profile_id'] = $item->escort->id;
                    $nestedData['start_date'] = $item->start_date;
                    $nestedData['end_date'] = $item->end_date;
                    $nestedData['status'] = $item->status;
                    $nestedData['option'] = '<div class="dropdown no-arrow text-center">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                    aria-labelledby="dropdownMenuLink" style="">
                        <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" target="_blank" href="'.route('profile.description',$item->escort_id).'"> <i class="fa fa-eye"></i> View Listing </a>
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

        }
        catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }

    }
}
