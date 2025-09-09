<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Escort;
use App\Models\LoginAttempt;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;

class GlobalMonitoringLoggedInController extends Controller
{
    function index()
    {
        return view('admin.logged-in-users');
    }

    public function getLoggedInUserDataTableListingAjax($type = NULL, $callbyFunc = false)
    {

        $search = request()->get('search')['value'];
        $dataTableData = [];

        $loggedInUsers = LoginAttempt::where('type', 1)
            ->where('online', 'yes')
            ->whereNotNull('user_id')
            ->with(['user:id,member_id,name,type'])
            ->select('id', 'user_id', 'ip_address', 'device', 'type', 'page') // only columns from login_attempts table
            ->get()
            ->unique('user_id')
            ->values();


        $dataTableData = [];
        $serverTime = [
            'upTime' => 0,
            'server_time' => '',
            'total' => 0
        ];
        // if ($search && $search != '' ) {
        //     $dataTableData = $loggedInUsers->filter(function ($item) use ($search) {
        //         // Match profile_name
        //         $matchesUserName = $item->user && stripos($item->user->name, $search) !== false;

        //         // Match user->member_id (check if user relation exists)
        //         $matchesMemberId = $item->user && stripos($item->user->member_id, $search) !== false;

        //         return $matchesUserName || $matchesMemberId;
        //     })->values(); // reset the keys
        // }

        if ($loggedInUsers && count($loggedInUsers->toArray()) > 0) {
            $serverTime = [
                'upTime' => getAppUptime(),
                'server_time' => Carbon::now(config('app.escort_server_timezone'))->format('h:i:s A'),
                'total' => count($loggedInUsers->toArray())
            ];
        }

        return DataTables::of($loggedInUsers)
            ->addColumn('member_id', fn($row) => $row->user->member_id ?? '-')
            ->addColumn('member', fn($row) => $row->user->name ?? '-')
            ->addColumn('ip_adress', fn($row) => $row->ip_address ?? '-')
            ->addColumn('platform', fn($row) => $row->device ?? '-')
            ->addColumn('page', fn($row) => $row->page ?? '-')
            ->addColumn('action', function ($row) {
                $actionButtons = '<div class="dropdown no-arrow text-center">
                                    <a class="dropdown-toggle " href="#" role="button" id="dropdownMenuLink"
                                        data-toggle="dropdown" data-user-type="' . $row->user->type . '" data-user-id="' . $row->user_id . '" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>
                                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                        aria-labelledby="dropdownMenuLink" style="">
                                        <a class="viewLoggedUserDetails dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#" data-user-type="' . $row->user->type . '" data-user-id="' . $row->user_id . '"> <i class="fa fa-eye"></i> View Listing </a>
                                                <div class="dropdown-divider"></div>
                                        <a class="suspendLoggedUser dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#" data-user-id="' . $row->user_id . '"> <i class="fa fa-trash"></i> Suspend  </a>
                                    </div>
                                </div>';

                return $actionButtons;
            })
            // ->addColumn('action', fn($row) => $actionButtons)
            ->rawColumns(['action']) // if you're returning HTML
            ->with('serverTime', $serverTime)
            ->make(true);
    }

    public function printLoggedInUserSingleDetails(Request $request)
    {
        $userId  = $request->user_id;

        if (!$userId) {
            return response()->json(['status' => 'error', 'message' => 'User ID is required.'], 400);
        }

        $commonData = json_decode($request->common_print_data);
        $specificUserData = json_decode($request->user_data);

        $userData = [
            'account_member_id'=> $commonData->account_member_id ?? '-',
            'account_member_name'=> $commonData->account_member_name ?? '-',
            'account_ip_address'=> $commonData->account_ip_address ?? '-',
            'account_platform'=> $commonData->account_platform ?? '-',
            'account_visit_page'=> $commonData->account_visit_page ?? '-',

            // for type 0
            'account_legbox_count'=> isset($specificUserData->account_legbox_count) ?  $specificUserData->account_legbox_count : null,
            'account_massage_legbox'=> isset($specificUserData->account_massage_legbox) ? $specificUserData->account_massage_legbox : null,
            // for type 3
            'account_list_adervtiser_count'=> isset($specificUserData->account_list_adervtiser_count) ? $specificUserData->account_list_adervtiser_count : null,
            'account_listed_profile_count'=> isset($specificUserData->account_listed_profile_count) ? $specificUserData->account_listed_profile_count : null,
            'account_escort_playmates'=> isset($specificUserData->account_escort_playmates) ? $specificUserData->account_escort_playmates : null,
            'account_legbox_count'=> isset($specificUserData->account_legbox_count) ? $specificUserData->account_legbox_count : null,
            // for type 4
            'account_masseurs_count'=> isset($specificUserData->account_masseurs_count) ? $specificUserData->account_masseurs_count : null,
            // for type 5
            'account_refer_by_advertiser_agent' => isset($specificUserData->account_refer_by_advertiser_agent) ? $specificUserData->account_refer_by_advertiser_agent : null,
            'account_refer_by_massage_center_agent' => isset($specificUserData->account_refer_by_massage_center_agent) ?  $specificUserData->account_refer_by_massage_center_agent : null,
        ];
        

        return view('admin.prints_file.logged_in_user_report',['userData'=>$userData]);
        
    }

    public function retrievedUserDetails($id)
    {
        $userId = $id;

        $user = User::where('id', $userId)->select('id','type')->first();

        # get query according to user type avoid getting all data
        if($user){
            switch ($user->type) {
                case 0:
                    # viewer...
                    $userDetails = User::where('id', $userId)
                        ->with(['loginAttempts','playmates:id','escorts:id','myLegBox:id','massageCenterLegBox:id'])
                        ->first();
                    break;
                case 2:
                    # code...
                    $userDetails = User::where('id', $userId)
                        ->with('loginAttempts','playmates','escorts','agentEscorts','escortsAgents','myLegBox','massageCenterLegBox','my_agent');
                    break;
                case 3:
                    # escort...

                    $userDetails = User::where('id', $userId)
                        ->with([
                            'loginAttempts',
                            'playmates:id',
                            'escorts:id',
                            'listedEscorts:id',
                            'agentEscorts:id',
                            'escortsAgents:id',
                            'shortList:id'
                        ])
                        ->withCount([
                            'escorts as viewerLegBoxCount' => function ($q) {
                                $q->whereHas('viewerLegBox');
                            }
                        ])
                        ->first();
                    break;
                case 4:
                    # massage...
                    $userDetails = User::where('id', $userId)
                        ->with('loginAttempts','playmates','escorts','agentEscorts','escortsAgents','myLegBox','massageCenterLegBox','my_agent')->first();
                    break;
                case 5:
                    # agent...

                    $userDetails = User::where('id', $userId)
                        ->with(['loginAttempts','referByAgent','referByMassageCenter'])->first();
                    break;
                
                default:
                    # misslaneious...
                    $userDetails = User::where('id', $userId)
                        ->with('loginAttempts','playmates','escorts','agentEscorts','escortsAgents','myLegBox','massageCenterLegBox','my_agent');
                    break;
            }
        }

        return $userDetails;
    }

    public function getLoggedInSingleUserDetailsAjax($id)
    {
        if (!$id) {
            return response()->json(['status' => 'error', 'message' => 'User ID is required.'], 400);
        }

        $userDetails = $this->retrievedUserDetails($id);
        

        if (!$userDetails) {
            return response()->json(['status' => 'error', 'message' => 'No details found for the specified user.','userDetails'=>null], 404);
        }

        return response()->json(['status' => 'success', 'userDetails' => $userDetails], 200);
    }
}
