<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EmailLog;
use App\Repositories\User\UserInterface;
use Yajra\DataTables\DataTables;

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
            $query = EmailLog::query();
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
                ->editColumn('to_email', function ($row) {
                    $emails = json_decode($row->to, true);
                    return is_array($emails) ? implode(', ', $emails) : '';
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
                ->rawColumns(['action', 'to_email', 'ref'])
                ->make(true);
        }
        return view('admin.reports.communication.communications');
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
