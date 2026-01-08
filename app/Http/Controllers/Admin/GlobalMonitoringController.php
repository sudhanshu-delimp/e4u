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
use App\Repositories\User\UserInterface;

class GlobalMonitoringController extends Controller
{
    protected $escort;
    protected $massage_profile;
    protected $user;
    protected $viewAccessEnabled;
    protected $editAccessEnabled;
    protected $addAccessEnabled;
    protected $sidebar;

    public function __construct(MassageProfileInterface $massage_profile,  EscortInterface $escort, UserInterface $user)
    {
        $this->escort = $escort;
        $this->massage_profile = $massage_profile;
        $this->user = $user;
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

        return view('admin.massage-centre-listings', ['type' => 'current', 'uptimeString' => $uptimeString]);
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

        // center-profile/7
        $profileurl = route('center.profile.description', $id);

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
        $conditions[] = ['enabled', 1];
        list($result, $count) = $this->escort->paginatedList(
            request()->get('start'),
            request()->get('length'),
            request()->get('order')[0]['column'],
            request()->get('order')[0]['dir'],
            request()->get('columns'),
            request()->get('search')['value'],
            null,
            $conditions
        );

        $data = array(
            "draw"            => intval(request()->input('draw')),
            "other"            => request()->get('order')[0]['column'],
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $result,
            "membershipCounts" => $this->countEscortMembershipCategories(),
        );

        return response()->json($data);
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
                    'profileurl' => route('profile.description', $escort['id']),
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
            $orderDirection   = $request->get('order')[0]['dir'] ?? 'asc';

            // Columns mapping (order index -> DB column)
            $columns = [4 => 'start_date', 5 => 'end_date'];
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
            if (!empty($items)) {
                foreach ($items as $item) {
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
}
