<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserStatusUpdatedMail;
use Barryvdh\Debugbar\Controllers\BaseController;

class ReportingController extends BaseController
{


     public function userRegistrationReport(Request $request)
    {
        $todayCount = User::whereDate('created_at', Carbon::today())->count();
        $thisMonthCount = User::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
        $thisYearCount = User::whereYear('created_at', Carbon::now()->year)->count();
        $allTimeCount = User::count();
        return view('admin.reporting.registrations', compact('todayCount', 'thisMonthCount', 'thisYearCount', 'allTimeCount'));
    }


    public function getRegistrationReport(Request $request)
    {
       
        list($result, $count) = $this->registration_data_pagination(
            request()->get('start'),
            request()->get('length'),
            (request()->get('order')[0]['column']),
            request()->get('order')[0]['dir']
        );
        $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $result
        );

        return response()->json($data);
    }


    public function registration_data_pagination($start, $limit, $order_key, $dir)
    {
        $agent = User::query();

        $search = request()->input('search.value');

           if (!empty($search)) {
            $agent->where(function ($query) use ($search) {
                $query->where('id', 'like', "%{$search}%")
                ->orWhere('name', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhereHas('state', function ($q) use ($search) {
                  $q->where('name', 'like', "%{$search}%");
              });
            });
            }

             switch ($order_key) {
            case 0:
                $agent->orderBy('id', $dir);
                break;

            case 1:
                $agent->orderBy('member_id', $dir);
                break;

            case 2:
                $agent->orderBy('phone', $dir);
                break;

            case 3:
                $agent->orderBy('state_id', $dir);
                break;

            case 4:
                $agent->orderBy('referred_by_agent_id', $dir);
                break;

            case 5:
                $agent->orderBy('status', $dir);
                break;

            default:
                $agent->orderBy('id', 'DESC');
                break;
        }

      

        $total_agents = $agent->count();
        $agents = $agent->offset($start)->limit($limit)->get();
        $i = 1;
               
        foreach($agents as $key => $item) {
            $item->territory = isset($item->state->iso2) ? $item->state->iso2 :  '---';
            $dropdown = '<div class="dropdown no-arrow" data-current-status="'.(int) $item->getRawOriginal('status').'">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                </a>
                                                <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                             <a class="dropdown-item d-flex align-items-center gap-10" data-status-num="1" data-toggle="modal"data-user-id="' . $item->id . '"
                                                data-target="#confirm-popup" href="#">
                                                <i class="fa fa-user-check"></i> Active
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            
                                                <a class="dropdown-item d-flex align-items-center gap-10" data-toggle="modal" data-status-num="6" data-user-id="' . $item->id . '"
                                                data-target="#confirm-popup" href="#">
                                                <i class="fa fa-pause-circle"></i> On Hold
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item d-flex align-items-center gap-10" data-toggle="modal" data-status-num="5" data-user-id="' . $item->id . '"
                                                data-target="#confirm-popup" href="#">
                                                <i class="fa fa-check-circle "></i> Registered
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item d-flex align-items-center gap-10 reject-registration-btn"  data-status-num="7" data-toggle="modal" data-user-id="' . $item->id . '"
                                                 href="#">
                                                <i class="fa fa-times-circle "></i> Rejected
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item d-flex align-items-center gap-10" data-status-num="8" data-toggle="modal"data-user-id="' . $item->id . '"
                                                data-target="#confirm-popup" href="#">
                                                <i class="fa fa-ban "></i> Cancelled
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item d-flex align-items-center gap-10" data-status-num="3" data-toggle="modal"data-user-id="' . $item->id . '"
                                                data-target="#confirm-popup" href="#">
                                                <i class="fa fa-user-slash"></i> Suspended
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="view_member_report dropdown-item d-flex align-items-center gap-10 toggle-report" data-toggle="modal" data-target="#account-row-"' . $item->id . '" data-id="' . $item->id . '"
                                                href="#" data-id="1435">
                                                <i class="fa fa-eye mr-2"></i> View
                                            </a>
                                        </div>
                                    </div>';


            $item->action = $dropdown;
            $i++;
        }

        return [$agents, $total_agents];
    }


        public function changeUserStatus(Request $request)
{
    try {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'status'  => 'required|in:1,3,4,5,6,7,8',
            'reject_reason' => 'nullable|string'
        ]);

        $user = User::findOrFail($request->user_id);
        $oldStatus = (int) $user->getRawOriginal('status');
        $newStatus = (int) $request->status;

        // Skip if no change (and no reason)
        if ($oldStatus == $request->status && !$request->filled('reject_reason')) {
            return response()->json(['success' => true]);
        }

        // Update status
        $user->status = $request->status;

        // Handle rejection reason
        if ($request->status == 7) {
            $user->rejection_reason = $request->filled('reject_reason')
                ? $request->reject_reason
                : null;
        } else {
            $user->rejection_reason = null;
        }

        $user->save();

        // Status messages
        $statusInfo = [
            1 => ['Active', 'Your account has been activated successfully.'],
            3 => ['Suspended', 'Your account has been suspended.'],
            4 => ['Blocked', 'Your account is blocked.'],
            5 => ['Registered', 'Your registration is completed successfully.'],
            6 => ['On Hold', 'Your membership has been placed on hold.'],
            7 => ['Rejected', 'Your registration has been rejected.'],
            8 => ['Cancelled', 'Your membership has been cancelled.']
        ];

        [$statusName, $statusMessage] = $statusInfo[$request->status];

        // -------------------------
        //  EMAIL TYPE LOGIC
        // -------------------------
        $emailType = null;
    
        if ($oldStatus === 6 && $newStatus === 7) {
            $emailType = 'hold-to-reject';
        
        } elseif ($newStatus === 7 && $oldStatus !== 6) {
            $emailType = 'direct-reject';
        }

        // Send mail if not blocked
        if ($request->status != 4) {
            Mail::to($user->email)
                ->queue(new UserStatusUpdatedMail($user, $statusName, $statusMessage, $emailType));
        }

        return response()->json(['success' => true]);

    } catch (\Exception $e) {
        Log::error('User status update error: '.$e->getMessage(), [
            'user_id' => $request->user_id,
            'status'  => $request->status
        ]);

        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}
    
}
