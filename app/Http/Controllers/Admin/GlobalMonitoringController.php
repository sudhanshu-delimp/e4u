<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Escort;
use App\Models\MassageProfile;
use App\Repositories\Escort\EscortInterface;
use App\Repositories\MassageProfile\MassageProfileInterface;
use App\Repositories\Service\ServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\Facades\DataTables;

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
        //dd($escorts);
        //dd($escorts->toArray());
       $dataTableData = [];
        if ($search) {
            $esc = collect($escorts->items());
            $dataTableData = $esc->filter(function ($item) use ($search) {
                // Match profile_name
                $matchesProfile = stripos($item->profile_name, $search) !== false;

                // Match user->member_id (check if user relation exists)
                $matchesMemberId = $item->user && stripos($item->user->member_id, $search) !== false;

                return $matchesProfile || $matchesMemberId;
            })->values(); // reset the keys
        }
        
        if(count($escorts->toArray()) > 0){
            $dataTableData = $escorts->toArray()['data'];
            //$dataTableData['recordTotal'] = count($dataTableData);
            foreach ($dataTableData as $key => $item) {
                $dataTableData[$key]['upTime'] = $this->getAppUptime();
                $dataTableData[$key]['server_time'] = now()->format('h:i:s A');
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
            ->addColumn('days', fn($row) => Carbon::parse(
                            $row['end_date'],
                        )->diffInDays(Carbon::parse($row['start_date'])) ) 
            ->addColumn('left_days', function ($row) {
                $endDate = Carbon::parse($row['end_date']);
                $now = Carbon::now();

                return $now->gt($endDate) ? 0 : $now->diffInDays($endDate);
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
        //$escorts = $this->massage_profile->findByMassageCentre(50, $params);

        $escorts = MassageProfile::where('id', $id)->with('user')->first();

        //dd($escorts->toArray());
        $dataTableData = [];
        
        if(count($escorts->toArray()) > 0){
            $dataTableData = $escorts->toArray();
            foreach ($dataTableData as $key => $item) {
                $dataTableData[$key]['upTime'] = $this->getAppUptime();
                $dataTableData[$key]['server_time'] = now()->format('h:i:s A');
            }
        }


        $dataTableData = [];

        if ($escorts) {
                $escort = $escorts->toArray();
                $dataTableData = [
                    'id' => $escort['id'],
                    'member_id' => $escort['user']['member_id'],
                    'member' => '-',
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
                    'days' => Carbon::parse(
                            $escort['end_date'],
                        )->diffInDays(Carbon::parse($escort['start_date'])),
                    'left_days' => Carbon::now()->gt(Carbon::parse($escort['end_date']))
                        ? 0
                        : Carbon::now()->diffInDays(Carbon::parse($escort['end_date'])),

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

        $result = Escort::with([
            'user',
            'purchase' => function ($query) use ($type, $ascDesc) {
                if ($type == 'past') {
                    $query->where('end_date', '<', date('Y-m-d'));
                    $ascDesc = 'DESC';
                } else {
                    $query->where('end_date', '>=', date('Y-m-d'));
                }

                $query->orderBy('start_date', $ascDesc);
            },
            'Brb' => function ($query) {
                $query->where('brb_time', '>', date('Y-m-d H:i:s'))
                    ->where('active', 'Y')
                    ->orderBy('brb_time', 'desc');
            }
        ])
            ->whereHas('purchase')
            ->where('profile_name', '!=', null);

        if ($search) {
            $result = $result->where(function ($query) use ($search) {
                $query->where('profile_name', 'LIKE', "%{$search}%")
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('member_id', 'LIKE', "%{$search}%");
                    });
            });
        }

        $result = $result->get()->toArray();

        // For count
        $resultNoLImit = Escort::with(['user', 'purchase' => function ($query2) use ($type, $ascDesc) {
            if ($type == 'past') {
                $query2->where('end_date', '<', date('Y-m-d'));
                $ascDesc = 'DESC';
            } else {
                $query2->where('end_date', '>=', date('Y-m-d'));
            }
            $query2->orderBy('start_date', $ascDesc);
        }])
            ->whereHas('purchase')
            ->with([
                'Brb' => function ($query2) {
                    $query2->where('brb_time', '>', date('Y-m-d H:i:s'))->where('active', 'Y')->orderBy('brb_time', 'desc');
                }
            ])
            ->where('profile_name', '!=', null);

        if ($search) {
            $resultNoLImit = $resultNoLImit->where(function ($query2) use ($search) {
                $query2->where('id', 'like', "%{$search}%")
                    ->orWhere('profile_name', 'LIKE', "%{$search}%")
                    ->orWhere('name', 'LIKE', "%{$search}%");
            });
        }
        $resultNoLImit = $resultNoLImit->get();
        foreach ($resultNoLImit as $escort2) {
            if ($escort2['purchase']) {

                foreach ($escort2['purchase'] as $purchase2) {
                    $recordTotal++;
                }
            }
        }

        $i = 1;

        foreach ($result as $escort) {
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
                    if (!empty($purchase['start_date'])) {
                        $daysDiff = Carbon::parse(
                            $purchase['end_date'],
                        )->diffInDays(Carbon::parse($purchase['start_date']));
                        if ($purchase['start_date'] == $purchase['end_date']) {
                            $daysDiff = 1;
                        }
                        [$discount, $rate] = calculateTatalFee(
                            $purchase['membership'],
                            $daysDiff,
                        );
                        $totalAmount = $rate;
                        $totalAmount -= $discount;
                        $totalAmount = formatIndianCurrency($totalAmount);
                    }
                    //dd($escort['user']['member_id']);
                    $memberId = isset($escort['user']['member_id']) ? $escort['user']['member_id'] : '';
                    $dataTableData[] = [
                        //'sl_no' => $i++,

                        'id' => $escort['id'],
                        'total_record' => intval($recordTotal),
                        'server_time' => now()->format('h:i:s A'),
                        'member_id' => $memberId,
                        'member' => $escort['name'],
                        //  'city' => config(
                        //     "escorts.profile.states.$escort[state_id].stateName",
                        // ),
                        'city' =>
                        config(
                            "escorts.profile.states.$escort[state_id].cities.$escort[city_id].cityName",
                        ),
                        'profile_name' => $escort['profile_name'] ? $brb : 'NA',
                        //'city' =>
                        // config(
                        //     "escorts.profile.states.$escort[state_id].cities.$escort[city_id].cityName",
                        // ) .
                        //     '<br>' .
                        //     config("escorts.profile.states.$escort[state_id].stateName"),

                        'type' => $purchase['membership'] ? getMembershipType($purchase['membership']) : "NA",
                        'start_date' => date(
                            'd-m-Y',
                            strtotime($purchase['start_date']),
                        ),
                        'end_date' => date('d-m-Y', strtotime($purchase['end_date'])),
                        'days' => $daysDiff,
                        // 'membership' => $purchase['membership'] ? getMembershipType($purchase['membership']) : "NA",
                        // 'fee' => $totalAmount,
                        'left_days' => Carbon::parse($purchase['end_date'])->diffInDays(Carbon::now()),
                        'fee' => $totalAmount,
                        'upTime' => $this->getAppUptime(),

                    ];
                }
            }
        }
        // print_r($dataTableData);die;
        $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($recordTotal),
            "recordsFiltered" => intval($recordTotal),
            "data"            => $dataTableData
        );

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
            ->addColumn('left_days', fn($row) => Carbon::parse($row['end_date'])->diffInDays(Carbon::now()))
            ->addColumn('action', fn($row) => $actionButtons)
            ->rawColumns(['action']) // if you're returning HTML
            ->make(true);
    }
    
    public function dataTableEscortSingleListingAjax($id)
    {
        $type = 'current';
        $ascDesc = 'DESC';

        $result = Escort::with([
            'user',
            'purchase' => function ($query) use ($type, $ascDesc) {
                if ($type == 'past') {
                    $query->where('end_date', '<', date('Y-m-d'));
                    $ascDesc = 'DESC';
                } else {
                    $query->where('end_date', '>=', date('Y-m-d'));
                }

                $query->orderBy('start_date', $ascDesc);
            },
            'Brb' => function ($query) {
                $query->where('brb_time', '>', date('Y-m-d H:i:s'))
                    ->where('active', 'Y')
                    ->orderBy('brb_time', 'desc');
            }
        ])
            ->whereHas('purchase')
            ->where('profile_name', '!=', null)
            ->where('id', $id);

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
                if (!empty($purchase['start_date'])) {
                    $daysDiff = Carbon::parse(
                        $purchase['end_date'],
                    )->diffInDays(Carbon::parse($purchase['start_date']));
                    if ($purchase['start_date'] == $purchase['end_date']) {
                        $daysDiff = 1;
                    }
                    [$discount, $rate] = calculateTatalFee(
                        $purchase['membership'],
                        $daysDiff,
                    );
                    $totalAmount = $rate;
                    $totalAmount -= $discount;
                    $totalAmount = formatIndianCurrency($totalAmount);
                }
                $memberId = isset($escort['user']['member_id']) ? $escort['user']['member_id'] : '';
                $dataTableData = [
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
                    'days' => $daysDiff,
                    'left_days' => Carbon::parse($purchase['end_date'])->diffInDays(Carbon::now()),
                    'fee' => $totalAmount,
                    'upTime' => $this->getAppUptime(),
                ];
            }
        }

        return response()->json($dataTableData);

    }
}
