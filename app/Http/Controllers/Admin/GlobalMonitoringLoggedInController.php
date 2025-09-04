<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
                                        data-toggle="dropdown" data-user-id="' . $row->user_id . '" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>
                                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                        aria-labelledby="dropdownMenuLink" style="">
                                        <a class="viewLoggedUserDetails dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#" data-user-id="' . $row->user_id . '"> <i class="fa fa-eye"></i> View Listing </a>
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

    public function getLoggedInSingleUserDetailsAjax($id)
    {
        $userId = $id;

        if (!$userId) {
            return response()->json(['status' => 'error', 'message' => 'User ID is required.'], 400);
        }

        $userDetails = User::where('id', $userId)
        ->with('loginAttempts','playmates','escorts','agentEscorts','escortsAgents','myLegBox','massageCenterLegBox','my_agent')
        ->first();

        if (!$userDetails) {
            return response()->json(['status' => 'error', 'message' => 'No details found for the specified user.','userDetails'=>null], 404);
        }

        return response()->json(['status' => 'success', 'userDetails' => $userDetails], 200);
    }
}
