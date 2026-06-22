<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\EmailLog;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserInterface;
use Illuminate\Support\Facades\Cache;

class CommunicationController extends Controller
{

    protected $viewAccessEnabled;
    protected $editAccessEnabled;
    protected $addAccessEnabled;
    protected $sidebar;
    protected $user;
    protected $current_date_time;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
        $this->current_date_time = date('Y-m-d H:i:s');
        $this->middleware(function ($request, $next) {

            $user = auth()->user();   // works here

            // Now do everything that needs user data
            $securityLevel = isset($user->staff_detail->security_level) ? $user->staff_detail->security_level : 0;

            $viewAccess = staffPageAccessPermission($securityLevel, 'view');
            $editAccess = staffPageAccessPermission($securityLevel, 'edit');
            $addAccess = staffPageAccessPermission($securityLevel, 'add');

            $this->viewAccessEnabled  = isset($viewAccess['yesNo']) && $viewAccess['yesNo'] == 'yes';
            $this->editAccessEnabled  = isset($editAccess['yesNo']) && $editAccess['yesNo'] == 'yes';
            $this->addAccessEnabled  = isset($addAccess['yesNo']) && $addAccess['yesNo'] == 'yes';

            return $next($request);
        });
    }



    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = EmailLog::query()->select(['id','member_id', 'to','cc', 'bcc','subject', 'sent_at','created_at']);
            $clientOrder = $request->input('order');
            if (empty($clientOrder)) {
                $query->orderBy('created_at', 'DESC');
            }
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('ref', function ($row) {
                    return sprintf('#%05d', $row->id);
                })
                ->filterColumn('ref', function ($query, $keyword) {
                    $digit = ltrim($keyword, '#0');
                    if ($digit !== '') {
                        $query->where('id', 'like', "%{$digit}%");
                    }
                })
                ->editColumn('date_time', function ($row) {
                    $date = Carbon::parse($row->created_at)->toDayDateTimeString();
                    return $date ?? '-';
                })
                ->editColumn('to_email', function ($row) {
                    $emails = json_decode($row->to, true);
                    return is_array($emails) ? implode(', ', $emails) : '';
                })
                ->filterColumn('to_email', function ($query, $keyword) {
                    $query->whereRaw("JSON_CONTAINS(`to`, '\"{$keyword}\"') OR `to` LIKE ?", ["%{$keyword}%"]);
                })

                
                ->filterColumn('member_id', function ($query, $keyword) {
                     $query->where('member_id', 'like', "%{$keyword}%");
                })
                ->addColumn('action', function ($row) {
                    $actions = [];
                    $status = $row->status ?? null;

                    if ($this->editAccessEnabled) {
                        $actions[] = '<a href="#" class="dropdown-item d-flex align-items-center justify-content-start gap-10 js-view" data-id="' . $row->id . '"><i class="fa fa-eye"></i> View</a>';
                    }

                    $dropdown = '<div class="dropdown no-arrow">'
                        . '<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'
                        . '<i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>'
                        . '</a>'
                        . '<div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in">'
                        . implode('<div class="dropdown-divider"></div>', $actions)
                        . '</div>'
                        . '</div>';

                    return $dropdown;
                })
                ->rawColumns(['action', 'to_email', 'ref','date_time'])
                ->with([
                    'server_up_time' => $this->getAppUptime(),
                    'server_time' => Carbon::now(config('app.escort_server_timezone'))->format('h:i:s A'),
                ])
                ->make(true);
        }
        return view('admin.reports.communication.communications');
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

    public function show($id)
    {
        try {
            $data = EmailLog::findOrFail($id);
            return success_response($data, 'Communication template get Successfully.');
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch notification: ' . $e->getMessage(),
            ], 500);
        }
    }
}
