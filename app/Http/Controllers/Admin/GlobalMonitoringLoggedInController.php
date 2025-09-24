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
        # get users who are online but inactive for more than 6 hours
        $activeUsers = LoginAttempt::where('type', 1)
            ->where('online', 'yes')
            ->get();

        if ($activeUsers->count() > 0) {
            foreach ($activeUsers as $user) {
                $minutes = $user->idle_preference_time ?? 30;

                if ($user->updated_at < Carbon::now()->subMinutes($minutes)) {
                    $user->online = 'no';
                    $user->save();
                }
            }
        }

        return view('admin.logged-in-users');
    }

    public function getLoggedInUserDataTableListingAjax($type = NULL, $callbyFunc = false)
    {
        $search = request()->get('search')['value'];
        $dataTableData = [];

        $loggedInUsers = LoginAttempt::where('type', 1)
            ->where('online', 'yes')
            ->whereNotNull('user_id')
            ->with(['user:id,member_id,name,type,status,idle_preference_time'])
            ->select('id', 'user_id', 'ip_address', 'device', 'type', 'page','updated_at') // only columns from login_attempts table
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
            ->addColumn('idle_preference_time', function($row){
                if($row->user->type == 1){
                    return '-';
                }
                return $row->user->idle_preference_time ?? '30';
            })
            // ->addColumn('idle_time', function ($row) {
            //     if($row->user->type == 1){
            //         return '-- : --';
            //     }
            //     $idlePref = $row->user->idle_preference_time ?? 30;

            //     // difference in seconds from last activity
            //     $diffInSeconds = Carbon::now()->diffInSeconds($row->updated_at);

            //     //dd($row->updated_at, Carbon::now(), $diffInSeconds);

            //     if ($diffInSeconds > ($idlePref * 60)) {
            //         // how long user has been idle after preference time
            //         $idleSeconds = $diffInSeconds - ($idlePref * 60);

            //         // format into mm:ss
            //         $minutes = floor($idleSeconds / 60);
            //         $seconds = $idleSeconds % 60;

                    

            //         return sprintf("%02d:%02d", $minutes, $seconds);
            //     }

            //     return "00:00"; // not yet idle
            // })
            ->addColumn('page', fn($row) => $row->page ?? '-')
            ->addColumn('action', function ($row) {
                $status = $row->user->status == 'Suspended' ? 'Active' : 'Suspend';
                $icon = $row->user->status == 'Suspended' ? 'circle' : 'ban';

                $actionButtons = '<div class="dropdown no-arrow text-center">
                                    <a class="dropdown-toggle " href="#" role="button" id="dropdownMenuLink"
                                        data-toggle="dropdown" data-user-type="' . $row->user->type . '" data-user-id="' . $row->user_id . '" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>
                                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                        aria-labelledby="dropdownMenuLink" style="">
                                        <a class="viewLoggedUserDetails dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#" data-user-type="' . $row->user->type . '" data-user-id="' . $row->user_id . '"> <i class="fa fa-eye"></i> View Listing </a>
                                                <div class="dropdown-divider"></div>
                                        <a class="suspendLoggedUser dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#" data-user-id="' . $row->user_id . '" data-status="'.$row->user->status.'"> <i class="fa fa-'.$icon.'"></i> '.$status.' </a>
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
            'account_legbox_count'=> isset($specificUserData->account_legbox_count) ?  $specificUserData->account_legbox_count : '',
            'account_massage_legbox'=> isset($specificUserData->account_massage_legbox) ? $specificUserData->account_massage_legbox : '',
            // for type 3
            'account_list_adervtiser_count'=> isset($specificUserData->account_list_adervtiser_count) ? $specificUserData->account_list_adervtiser_count : '',
            'account_listed_profile_count'=> isset($specificUserData->account_listed_profile_count) ? $specificUserData->account_listed_profile_count : '',
            'account_escort_playmates'=> isset($specificUserData->account_escort_playmates) ? $specificUserData->account_escort_playmates : '',
            'account_legbox_count'=> isset($specificUserData->account_legbox_count) ? $specificUserData->account_legbox_count : '',
            // for type 4
            'account_masseurs_count'=> isset($specificUserData->account_masseurs_count) ? $specificUserData->account_masseurs_count : '',
            // for type 5
            'account_refer_by_advertiser_agent' => isset($specificUserData->account_refer_by_advertiser_agent) ? $specificUserData->account_refer_by_advertiser_agent : '',
            'account_refer_by_massage_center_agent' => isset($specificUserData->account_refer_by_massage_center_agent) ?  $specificUserData->account_refer_by_massage_center_agent : '',
            'account_idle_prefrence_time' => isset($specificUserData->account_idle_prefrence_time) ?  $specificUserData->account_idle_prefrence_time : '',
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
                case 1:
                    # Admin...
                    $userDetails = User::where('id', $userId)
                        ->with(['loginAttempts','playmates:id','escorts:id','myLegBox:id','massageCenterLegBox:id'])
                        ->first();
                    break;
                case 2:
                    # code...
                    $totalAgents = 0;
                    $toalMassageCenters = 0;
                    $totalEscort = 0;
                    $totalListedEscort = 0;
                    $totalViewers = 0;

                    $userDetails = User::where('id', $userId)
                        ->with('loginAttempts');
                        $userDetails->total_agents = $totalAgents;
                        $userDetails->toal_massage_centers = $toalMassageCenters;
                        $userDetails->total_escort = $totalEscort;
                        $userDetails->total_listed_escort = $totalListedEscort;
                        $userDetails->total_viewers = $totalViewers;

                    break;
                case 3:
                    # escort...

                    $userDetails = User::where('id', $userId)
                        ->with([
                            'loginAttempts',
                            'playmates:id',
                            'escorts:id,user_id',
                            'listedEscorts:id',
                            'agentEscorts:id',
                            'escortsAgents:id',
                            'shortList:id'
                        ])
                        ->withCount([
                            'escorts as viewerLegBoxCount' => function ($q) {
                                $q->whereHas('viewerLegBox');
                            },
                            'escorts as listedProfileCount' => function ($q) {
                                $q->where('enabled', 1);
                            },
                            'escorts as advertiserProfileCount' => function ($q) {
                                $q->whereIn('enabled', [0,1]);
                            }
                        ])
                        ->first();
                        dump($userDetails,$userDetails->escorts);
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

    public function loggedUserStatusUpdate($id)
    {
        $user = User::where('id',$id)->first();

        if ($user == null) {
            return response()->json(['status' => 'error', 'message' => 'User ID is required.'], 400);
        }
        

        $res = User::where('id',$id)->update([
            'status'=> $user->status == 'Suspended' ? 1 : 3, // its showing suspended profile
        ]);

        return response()->json([
            'status' => $res ? 'success' : 'error',
            'message'=> 'Profile suspended successfully.'
        ],200);

    }
}
