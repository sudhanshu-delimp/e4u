<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Operator;
use Illuminate\Http\Request;

use Laravel\Ui\Presets\React;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use App\Http\Requests\OperatorStaff\AddNewStaff;
use App\Models\OperatorStaff;
use App\Repositories\OperatorStaff\OperatorStaffInterface;
use PDF;

class OperatorstaffController extends BaseController
{
    protected $current_date_time;
    protected $staffRepo;
    protected $viewAccessEnabled;
    protected $editAccessEnabled;
    protected $addAccessEnabled;
    protected $sidebar;

    public function __construct(OperatorStaffInterface $staffRepo)
    {
        $this->current_date_time = date('Y-m-d H:i:s');
        $this->staffRepo = $staffRepo;
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
     * View operator staff list
     */
    public function staff_list()
    {
        $operatorObj = (new Operator);
        $operators = $operatorObj->getDropdownList();
      
        return view('admin.management.operator_staff.staff', compact('operators'));
    }

    /**
     * Add operator staff
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function add_sfaff(AddNewStaff $request)
    {
        $data = $request->all();
        $resposne = $this->staffRepo->addUpdateStaff($data);
        if ($resposne['status'])
            return $this->successResponse($resposne['message']);
        else
            return $this->validationError($resposne['message']);
    }

    /**
     * Edit operator staff
     * 
     * @param integer $id
     */
    public function editStaff($id)
    {
        $operatorObj = (new Operator);
        $operators = $operatorObj->getDropdownList();
        $staff = User::with('operator_staff_detail', 'operator_staff_setting')->where("id", $id)->first();
        if ($staff) {
            return view('admin.management.operator_staff.staff-edit', compact('staff', 'operators'));
        } else {
            return "";
        }
    }

    /**
     * Store operator staff
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function update_staff(Request $request)
    {
        $data = $request->all();
        $resposne = $this->staffRepo->addUpdateStaff($data);
        if (isset($resposne['status']) && $resposne['status'])
            return $this->successResponse($resposne['message']);
        else
            return $this->validationError($resposne['message']);
    }
    /**
     * View operator staff
     * 
     * @param integer $id
     */
    public function viewStaff($id)
    {
        $staff = User::with('operator_staff_detail', 'operator_staff_setting', 'operator')->where("id", $id)->first();
        if ($staff) {
            return view('admin.management.operator_staff.staff-view', compact('staff'));
        } else {
            return "";
        }
    }

    /**
     * Get all operator staff list
     */
    public function staff_data_list()
    {
        list($result, $count) = $this->staff_data_pagination(
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
     *  Get all operator staff list with filter
     * 
     * @param integer $start
     * @param integer $limit
     * @param string $order_key
     * @param string $dir
     */
    public function staff_data_pagination($start, $limit, $order_key, $dir)
    {
        $staff = User::with('operator', 'operator_staff_detail', 'createddBy', 'account_setting', 'LoginStatus')
            ->where('type', config('operator_staff.staff_role_type')); //Type = 9 

        $search = request()->input('search.value');

        if (!empty($search)) {
            $staff->where(function ($query) use ($search) {
                $query->where('member_id', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
                    /* ->orWhereHas('state', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    }) */
            });
        }

        switch ($order_key) {
            case 0:
                $staff->orderBy('member_id', $dir);
                break;
            case 1:
                $staff->orderBy('name', $dir);
                break;
            case 4:
                $staff->orderBy('phone', $dir);
                break; 
            case 5:
                $staff->orderBy('email', $dir);
                break;  
             case 10:
                $staff->orderBy('status', $dir);
                break; 
              case 11:
                $staff->orderBy('id', 'DESC');
                break;           
            default:
                $staff->orderBy('id', 'DESC');
                break;
        }

        $total_staffs = $staff->count();
        $staffs = $staff->offset($start)->limit($limit)->get();
        $i = 1;
        foreach ($staffs as $key => $item) {
            //$item->no_of_client = (isset($item->referrals_count) && $item->referrals_count > 0) ? $item->referrals_count : '0';
            $logAndStatus = $item->LoginStatus;
            $item->last_login = ((isset($item->account_setting) && ($item->account_setting->last_login != NULL)) ? convert_aus_date_time_format($item->account_setting->last_login) : 'NA');
            $item->login_count = (isset($logAndStatus->login_count) && $logAndStatus->login_count > 0) ? $logAndStatus->login_count : 0;
            $item->sfaff_id = $item->id;
            $item->territory = isset($item->state->name) ? $item->state->name : 'NA';
            $item->security_level = isset($item->operator_staff_detail->security_level) ? $item->operator_staff_detail->securityLevel($item->operator_staff_detail->security_level) : 'NA';
            $item->position = isset($item->operator_staff_detail->position) ? $item->operator_staff_detail->position($item->operator_staff_detail->position) : 'NA';
            $item->operator_name = isset($item->operator->name) ? $item->operator->name."(".$item->operator->member_id.")" : 'NA';
            $item->created_by = isset($item->createddBy->name) ? $item->createddBy->name."(".$item->createddBy->member_id.")" :'NA';
            $suspend_html = "";
            $activate_html = "";
            $dropdownsub = "";
            
            //
            $edit = "";
            /*  if ($item->status != 'Suspended') {
                $suspend_html = '<a class="dropdown-item d-flex justify-content-start gap-10 align-items-center account-suspend-btn" href="javascript:void(0)" data-id=' . $item->id . '>   <i class="fa fa-ban"></i> Suspend</a><div class="dropdown-divider"></div>';
            }
            if ($item->status == 'Suspended') {
                $activate_html = '<a class="dropdown-item d-flex justify-content-start gap-10 align-items-center active-account-btn" href="javascript:void(0)" data-id=' . $item->id . '>   <i class="fa fa-check"></i> Activate</a><div class="dropdown-divider"></div>';
            } */
            $view = '<div class="dropdown-divider"></div><a class="dropdown-item view-account-btn view-staff-btn d-flex justify-content-start gap-10 align-items-center" href="javascript:void(0)" data-id=' . $item->id . '>  
                <i class="fa fa-eye "></i> View Account</a>';

            $dropdown = '<div class="dropdown no-arrow ml-3">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i></a><div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">';


            if ($this->editAccessEnabled) {
                if (auth()->user()->member_id != $item->member_id) {
                    $edit = '<a class="dropdown-item d-flex justify-content-start gap-10 align-items-center edit-staff-btn" href="javascript:void(0)" data-id=' . $item->id . '  data-toggle="modal"> <i class="fa fa-pen"></i> Edit </a>';
                }
            }    

            if ($item->status == 'Pending') {
                $dropdownsub .= '<a class="dropdown-item d-flex justify-content-start gap-10 align-items-center approve_account" href="javascript:void(0)" data-id=' . $item->id . '> <i class="fa fa-check"></i>Approve</a><div class="dropdown-divider"></div>';
                /* 
                $dropdownsub .= '<div class="dropdown-divider"></div><a class="dropdown-item d-flex justify-content-start gap-10 align-items-center account-suspend-btn" href="javascript:void(0)" data-id=' . $item->id . '>   <i class="fa fa-ban"></i>Suspend</a><div class="dropdown-divider"></div>'; */
                 if (auth()->user()->member_id == $item->member_id) {
                    $dropdown .= $view;
                 } else {
                     if ($this->editAccessEnabled) {
                    $dropdown .= $dropdownsub. $edit.  $view;
                    } else {
                        $dropdown .= $view;
                    }
                 }
            }

            if ($item->status == 'Active') {
                $dropdownsub = '<div class="dropdown-divider"></div><a class="dropdown-item d-flex justify-content-start gap-10 align-items-center account-suspend-btn" href="javascript:void(0)" data-id=' . $item->id . '>   <i class="fa fa-ban"></i>Suspend</a>';
                if (auth()->user()->member_id == $item->member_id) {
                    $dropdown .= $view;
                 } else {
                    if ($this->editAccessEnabled) {
                     $dropdown .= $edit . $dropdownsub.  $view;
                     } else {
                        $dropdown .= $view;
                    }
                 }
            }

            if ($item->status == 'Suspended') {
                $dropdownsub = '<a class="dropdown-item d-flex justify-content-start gap-10 align-items-center active-account-btn" href="javascript:void(0)" data-id=' . $item->id . '>   <i class="fa fa-check"></i>Activate</a><div class="dropdown-divider"></div>';
               
                if (auth()->user()->member_id == $item->member_id) {
                    $dropdown .= $view;
                 } else {
                    if ($this->editAccessEnabled) {
                      $dropdown .= $dropdownsub. $edit.  $view;
                    } else {
                        $dropdown .= $view;
                    }
                 }
            }
            
            $dropdown .= '</div></div>';

            $item->status_name = '<span class="custom_badge '.getStatusBadgeClass($item->status).'">'.$item->status.' </span>';

            $item->action = $dropdown;
            $i++;
        }
        return [$staffs, $total_staffs];
    }
    /**
     *  Suspent the access of operator staff dashboard
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function suspend_staff(Request $request)
    {
        if ($request->id && $request->request_type && $request->request_type == 'suspend') {
            $user = User::where('id', $request->id)->first();
            if ($user->status && $user->status == 'Suspended') {
                return $this->successResponse('This Account Already Suspended.');
            }
            $user->status = '3';
            $response = $user->save();

            if ($response){
                 $resposne = $this->staffRepo->sendSuspendEmail($user);
                return $this->successResponse('Account Suspended Successfully.');
            } else
                return $this->successResponse('Error Occurred while Account Suspending.');
        } else {
            return $this->successResponse('Unknown Input Found.');
        }
    }

    /**
     * Check email
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function check_staff_email(Request $request)
    {
        $data = $request->all();
        $errors = $this->staffRepo->check_staff_email($data);

        if (!empty($errors))
            return $this->validationError('Email Validation', $errors);
        else
            return $this->successResponse('Email(s) are available.');
    }

    /**
     *  Change the staff status
     * 
     * @param \Illuminate\Http\Request $requestoperator
     */
    public function approve_staff_account(Request $request)
    {

        $data = $request->all();
        $resposne = $this->staffRepo->change_user_status($data);
        if ($resposne['status'])
            return $this->successResponse($resposne['message']);
        else
            return $this->validationError($resposne['message']);
    }

    /**
     *  Approve the operator staff
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function activate_user(Request $request)
    {

        $data = $request->all();
        $resposne = $this->staffRepo->activate_user($data);
        if ($resposne['status'])
            return $this->successResponse($resposne['message']);
        else
            return $this->validationError($resposne['message']);
    }

    public function printStaffDetails(Request $request)
    {
        if (isset($this->sidebar['management']['yesNo']) && $this->sidebar['management']['yesNo'] == 'no') {
            return response()->redirectTo('/admin-dashboard/dashboard')->with('error', __(accessDeniedMsg()));
        }
        $userId  = $request->user_id;
      
          $staff = User::with('operator_staff_detail', 'operator_staff_setting', 'operator')->where("id", $userId)->first();
        if ($staff) {
            //return view('admin.management.operator_staff.staff_report', ['staff' => $staff]);
            $pdf = PDF::loadView(
                'admin.management.operator_staff.staff_report_pdf',
                ['staff' => $staff]
            )->setOption(['isRemoteEnabled' => true]);
            return $pdf->stream('staff_report.pdf');
        } else {
            return response()->json(['status' => 'error', 'message' => 'Staff ID is required.'], 400);
        }
    }
}
