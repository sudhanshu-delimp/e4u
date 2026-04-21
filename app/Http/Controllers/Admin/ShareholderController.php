<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Shareholder\AddNewShareholder;
use App\Models\Shareholder;
use App\Repositories\Shareholder\ShareholderInterface;
use PDF;

class ShareholderController extends BaseController
{
    protected $current_date_time;
    protected $shareholderRepo;
    protected $viewAccessEnabled;
    protected $editAccessEnabled;
    protected $addAccessEnabled;
    protected $sidebar;

    public function __construct(ShareholderInterface $shareholderRepo)
    {
        $this->current_date_time = date('Y-m-d H:i:s');
        $this->shareholderRepo = $shareholderRepo;
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

            if (isset($this->sidebar['management']['yesNo']) && $this->sidebar['management']['yesNo'] == 'no') {
                return response()->redirectTo('/admin-dashboard/dashboard')->with('error', __(accessDeniedMsg()));
            }

            return $next($request);
        });
    }

    /**
     * Add shareholder
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function addShareholder(AddNewShareholder $request)
    {
        $data = $request->all();
        $resposne = $this->shareholderRepo->addUpdate($data);
        if ($resposne['status'])
            return $this->successResponse($resposne['message']);
        else
            return $this->validationError($resposne['message']);
    }

    /**
     * Get Shareholder data by Id
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function getShareholder($id)
    {
        $shareholder = Shareholder::with('shareholder_setting')->where("id", $id)->first();
        return response()->json([
            'data' => $shareholder
        ]);
    }

    /**
     * Edit shareholder
     * 
     * @param integer $id
     */
    public function editShareholder($id)
    {
        $shareholder = Shareholder::with('shareholder_setting')->where("id", $id)->first();
        if ($shareholder) {

            return view('admin.management.shareholder.edit', compact('shareholder'));
        } else {
            return "";
        }
    }

    /**
     * Store Shareholder
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function updateShareholder(AddNewShareholder $request)
    {
        $data = $request->all();
        $resposne = $this->shareholderRepo->addUpdate($data);
        if (isset($resposne['status']) && $resposne['status'])
            return $this->successResponse($resposne['message']);
        else
            return $this->validationError($resposne['message']);
    }
    /**
     * View Shareholder
     * 
     * @param integer $id
     */
    public function viewShareholder($id)
    {
        $shareholder = Shareholder::with('shareholder_setting')->where("id", $id)->first();
        if ($shareholder) {
            return view('admin.management.shareholder.view_shareholder', compact('shareholder'));
        } else {
            return "";
        }
    }
    /**
     * View Shareholder list
     */
    public function shareholderList()
    {
        return view('admin.management.shareholder.manage-shareholders');
    }

    /**
     * Get all Shareholder list
     */
    public function ShareholderDataList()
    {
        list($result, $count) = $this->ShareholderDataPagination(
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

    /**
     *  Get all Shareholder list with filter
     * 
     * @param integer $start
     * @param integer $limit
     * @param string $order_key
     * @param string $dir
     */
    public function ShareholderDataPagination($start, $limit, $order_key, $dir)
    {
        $shareholder = Shareholder::with('shareholder_setting', 'state', 'account_setting', 'LoginStatus')
            ->where('type', '8');

        $search = request()->input('search.value');

        if (!empty($search)) {
            $shareholder->where(function ($query) use ($search) {
                $query->where('member_id', 'like', "%{$search}%")
                    ->orWhere('business_name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhereHas('state', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            });
        }

        switch ($order_key) {
            case 0:
                $shareholder->orderBy('member_id', $dir);
                break;
            case 1:
                $shareholder->orderBy('id', $dir);
                break;
            case 2:
                $shareholder->orderBy('name', $dir);
                break;
            default:
                $shareholder->orderBy('id', 'DESC');
                break;
        }

        $total_shareholders = $shareholder->count();
        $shareholders = $shareholder->offset($start)->limit($limit)->get();
        $i = 1;
        foreach ($shareholders as $key => $item) {

            $logAndStatus = $item->LoginStatus;
            $item->last_login = ((isset($item->account_setting) && ($item->account_setting->last_login != NULL)) ? convert_aus_date_time_format($item->account_setting->last_login) : 'NA');
            $item->login_count = (isset($logAndStatus->login_count) && $logAndStatus->login_count > 0) ? $logAndStatus->login_count : 0;

            $item->shareholder_id = $item->id;
            $item->member_id = isset($item->member_id) ? $item->member_id : 'NA';
            $item->location = isset($item->state->name) ? $item->state->name : 'NA';
            $item->email = isset($item->email) ? $item->email : 'NA';
            $item->totalAgents = 0;
            $item->business_name = isset($item->business_name) ? $item->business_name : 'NA';
            $item->name = isset($item->name) ? $item->name : 'NA';

            $suspend_html = "";
            $activate_html = "";
            $dropdownsub = "";
            $edit = "";

            $view = '<div class="dropdown-divider"></div><a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="javascript:void(0)" data-id=' . $item->id . '  data-toggle="modal" id="viewShareholderBtn" > <i class="fa fa-eye"></i>View</a>';

            $dropdown = '<div class="dropdown no-arrow ml-3">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i></a><div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">';

            if ($this->editAccessEnabled) {
                if (auth()->user()->member_id != $item->member_id) {
                    $edit = '<a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"href="javascript:void(0)" data-id=' . $item->id . '  data-toggle="modal" id="getShareholder"> <i class="fa fa-pen"></i>Edit</a>';
                }
            }

            if ($item->status == 'Pending') {
                $dropdownsub .= '<a class="dropdown-item d-flex justify-content-start gap-10 align-items-center approve_account" href="javascript:void(0)" data-id=' . $item->id . '> <i class="fa fa-check"></i>Approve</a><div class="dropdown-divider"></div>';
                $dropdownsub .= '<a class="dropdown-item d-flex justify-content-start gap-10 align-items-center delete_account" href="javascript:void(0)" data-id=' . $item->id . '> <i class="fa fa-trash"></i>Delete</a><div class="dropdown-divider"></div>';

                if (auth()->user()->member_id == $item->member_id) {
                    $dropdown .= $view;
                } else {
                    if ($this->editAccessEnabled) {
                        $dropdown .= $dropdownsub . $edit .  $view;
                    } else {
                        $dropdown .= $view;
                    }
                }
            }

            if ($item->status == 'Active') {
                $dropdownsub = '<div class="dropdown-divider"></div><a class="dropdown-item d-flex justify-content-start gap-10 align-items-center account-suspend-btn" href="javascript:void(0)" data-id=' . $item->id . '><i class="fa fa-ban"></i>Suspend</a>';
                if (auth()->user()->member_id == $item->member_id) {
                    $dropdown .= $view;
                } else {
                    if ($this->editAccessEnabled) {
                        $dropdown .= $edit . $dropdownsub .  $view;
                    } else {
                        $dropdown .= $view;
                    }
                }
            }

            if ($item->status == 'Suspended') {
                $dropdownsub = '<a class="dropdown-item d-flex justify-content-start gap-10 align-items-center active-account-btn" href="javascript:void(0)" data-id=' . $item->id . '><i class="fa fa-check"></i>Activate</a><div class="dropdown-divider"></div>';

                if (auth()->user()->member_id == $item->member_id) {
                    $dropdown .= $view;
                } else {
                    if ($this->editAccessEnabled) {
                        $dropdown .= $dropdownsub . $edit .  $view;
                    } else {
                        $dropdown .= $view;
                    }
                }
            }

            $dropdown .= '</div></div>';
            $item->status_name = '<span class="custom_badge ' . getStatusBadgeClass($item->status) . '">' . $item->status . ' </span>';

            $item->action = $dropdown;
            $i++;
        }
        return [$shareholders, $total_shareholders];
    }

    /**
     *  Approve the shareholder
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function approveShareholderAccount(Request $request)
    {

        $data = $request->all();
        $resposne = $this->shareholderRepo->change_user_status($data);
        if ($resposne['status'])
            return $this->successResponse($resposne['message']);
        else
            return $this->validationError($resposne['message']);
    }

    /**
     *  Acivate the Shareholder
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function activateUser(Request $request)
    {

        $data = $request->all();
        $resposne = $this->shareholderRepo->activate_user($data);
        if ($resposne['status'])
            return $this->successResponse($resposne['message']);
        else
            return $this->validationError($resposne['message']);
    }

    /**
     *  Suspent the access of Shareholder dashboard
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function suspendShareholder(Request $request)
    {
        if ($request->id && $request->request_type && $request->request_type == 'suspend') {
            $user = Shareholder::where('id', $request->id)->first();
            if ($user->status && $user->status == 'Suspended') {
                return $this->successResponse('Shareholder\'s already suspended.');
            }
            $user->status = '3';
            $response = $user->save();

            if ($response) {
                $resposne = $this->shareholderRepo->sendSuspendEmail($user);
                return $this->successResponse(' Shareholder\'s account has been suspended.');
            } else
                return $this->successResponse('Error occurred while Account Suspending.');
        } else {
            return $this->successResponse('Unknown Input Found.');
        }
    }

    public function printShareholderDetails(Request $request)
    {
        if (isset($this->sidebar['management']['yesNo']) && $this->sidebar['management']['yesNo'] == 'no') {
            return response()->redirectTo('/admin-dashboard/dashboard')->with('error', __(accessDeniedMsg()));
        }
        $userId  = $request->user_id;
        $shareholder = Shareholder::with('shareholder_setting')->where("id", $userId)->first();
        if ($shareholder) {
            $pdf = PDF::loadView(
                'admin.management.shareholder.print_shareholder_pdf',
                ['shareholder' => $shareholder]
            )->setOption(['isRemoteEnabled' => true]);
            return $pdf->stream('shareholder_report.pdf');
        } else {
            return response()->json(['status' => 'error', 'message' => 'Shareholder ID is required.'], 400);
        }
    }

    /**
     *  Delete the shareholder
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function deleteUser(Request $request)
    {
        try {
            if ($request->id && $request->request_type && $request->request_type == 'delete') {
                $user = Shareholder::where('id', $request->id)->first();
                if ($user->status && $user->status == 'Pending') {
                    $user->shareholder_setting()->delete();
                    $response = $user->delete();
                    if ($response) {
                        return $this->successResponse(' Shareholder\'s account has been deleted.');
                    } else
                        return $this->successResponse('Error occurred while Account deleting.');
                } else {
                    return $this->successResponse('You can delete a shareholder\'s account only if its status is pending.');
                }
            } else {
                return $this->successResponse('You have provided incorrect data.');
            }
        } catch (\Exception $e) {

            return $this->successResponse('Error occurred while Account deleting.');
        }
    }
}
