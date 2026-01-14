<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;

use Laravel\Ui\Presets\React;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Operator\AddNewOperator;
use App\Models\Operator;
use App\Repositories\Operator\OperatorInterface;
use PDF;

class OperatorController extends BaseController
{
    protected $current_date_time;
    protected $operatorRepo;
    protected $viewAccessEnabled;
    protected $editAccessEnabled;
    protected $addAccessEnabled;
    protected $sidebar;

    public function __construct(OperatorInterface $operatorRepo)
    {
        $this->current_date_time = date('Y-m-d H:i:s');
        $this->operatorRepo = $operatorRepo;
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
     * Add operator
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function add_operator(AddNewOperator $request)
    {
        $data = $request->all();
        $resposne = $this->operatorRepo->addUpdateOperator($data);
        if ($resposne['status'])
            return $this->successResponse($resposne['message']);
        else
            return $this->validationError($resposne['message']);
    }

    /**
     * Edit operator
     * 
     * @param integer $id
     */
    public function editOperator($id)
    {
        $operator = User::with('operator_detail', 'operator_setting')->where("id", $id)->first();
        if ($operator) {
            return view('admin.management.operator.operator-edit', compact('operator'));
        } else {
            return "";
        }
    }

    /**
     * Store operator
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function updateOperator(AddNewOperator $request)
    {
        $data = $request->all();
        $resposne = $this->operatorRepo->addUpdateOperator($data);
        if (isset($resposne['status']) && $resposne['status'])
            return $this->successResponse($resposne['message']);
        else
            return $this->validationError($resposne['message']);
    }
    /**
     * View operator
     * 
     * @param integer $id
     */
    public function viewOperator($id)
    {
        $operator = User::with('operator_detail')->where("id", $id)->first();
        if ($operator) {
            return view('admin.management.operator.operator-view', compact('operator'));
        } else {
            return "";
        }
    }
    /**
     * View operator list
     */
    public function operator_list()
    {
        return view('admin.management.operator.operator-manage');
    }

    /**
     * Get all operator list
     */
    public function operator_data_list()
    {
        list($result, $count) = $this->operator_data_pagination(
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
     *  Get all operator list with filter
     * 
     * @param integer $start
     * @param integer $limit
     * @param string $order_key
     * @param string $dir
     */
    public function operator_data_pagination($start, $limit, $order_key, $dir)
    {
        $operator = User::with('state', 'operator_detail', 'account_setting', 'LoginStatus')
            ->where('type', '7');

        $search = request()->input('search.value');

        if (!empty($search)) {
            $operator->where(function ($query) use ($search) {
                $query->where('member_id', 'like', "%{$search}%")
                    ->orWhere('company_name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhereHas('state', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            });
        }

        switch ($order_key) {
            case 0:
                $operator->orderBy('member_id', $dir);
                break;
            case 1:
                $operator->orderBy('id', $dir);
                break;
            case 2:
                $operator->orderBy('name', $dir);
                break;
            default:
                $operator->orderBy('id', 'DESC');
                break;
        }

       $total_operators = $operator->count();
        $operators = $operator->offset($start)->limit($limit)->get();
        $i = 1;
        foreach ($operators as $key => $item) {
        
            $logAndStatus = $item->LoginStatus;
            $item->last_login = ((isset($item->account_setting) && ($item->account_setting->last_login != NULL)) ? convert_aus_date_time_format($item->account_setting->last_login) : 'NA');
            $item->login_count = (isset($logAndStatus->login_count) && $logAndStatus->login_count > 0) ? $logAndStatus->login_count : 0;
            $item->operator_id = $item->id;
            $item->member_id = isset($item->member_id) ? $item->member_id : 'NA';
            $item->territory = isset($item->state->name) ? $item->state->name : 'NA';
            $item->email = isset($item->email) ? $item->email : 'NA';
            $item->totalAgents = 0;
            $item->company_name = isset($item->name) ? $item->name : 'NA';
            $item->point_of_contact = 'NA';
             $item->point_of_contact = isset($item->operator_detail->point_of_contact) ?$item->operator_detail->point_of_contact : 'NA';

            $suspend_html = "";
            $activate_html = "";
            $dropdownsub = "";
            $edit = "";

            $view = '<div class="dropdown-divider"></div><a class="dropdown-item view-account-btn view-operator-btn d-flex justify-content-start gap-10 align-items-center" href="javascript:void(0)" data-id=' . $item->id . '>  
                <i class="fa fa-eye "></i> View Account</a>';

            $dropdown = '<div class="dropdown no-arrow ml-3">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i></a><div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">';


            if ($this->editAccessEnabled) {
                if (auth()->user()->member_id != $item->member_id) {
                    $edit = '<a class="dropdown-item d-flex justify-content-start gap-10 align-items-center edit-operator-btn" href="javascript:void(0)" data-id=' . $item->id . '  data-toggle="modal"> <i class="fa fa-pen"></i> Edit </a>';
                }
            }

            if ($item->status == 'Pending') {
                $dropdownsub .= '<a class="dropdown-item d-flex justify-content-start gap-10 align-items-center approve_account" href="javascript:void(0)" data-id=' . $item->id . '> <i class="fa fa-check"></i>Approve</a><div class="dropdown-divider"></div>';
    
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
                $dropdownsub = '<div class="dropdown-divider"></div><a class="dropdown-item d-flex justify-content-start gap-10 align-items-center account-suspend-btn" href="javascript:void(0)" data-id=' . $item->id . '>   <i class="fa fa-ban"></i>Suspend</a>';
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
                $dropdownsub = '<a class="dropdown-item d-flex justify-content-start gap-10 align-items-center active-account-btn" href="javascript:void(0)" data-id=' . $item->id . '>   <i class="fa fa-check"></i>Activate</a><div class="dropdown-divider"></div>';

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

            $item->action = $dropdown;
            $i++;
        }
        return [$operators, $total_operators];
    }
    /**
     *  Suspent the access of operator dashboard
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function suspend_operator(Request $request)
    {
        if ($request->id && $request->request_type && $request->request_type == 'suspend') {
            $user = User::where('id', $request->id)->first();
            if ($user->status && $user->status == 'Suspended') {
                return $this->successResponse('This Account Already Suspended.');
            }
            $user->status = '3';
            $response = $user->save();

            if ($response) {
                $resposne = $this->operatorRepo->sendSuspendEmail($user);
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
    public function check_operator_email(Request $request)
    {
        $data = $request->all();
        $errors = $this->operatorRepo->check_operator_email($data);

        if (!empty($errors))
            return $this->validationError('Email Validation', $errors);
        else
            return $this->successResponse('Email(s) are available.');
    }

    /**
     *  Change the operator status
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function approve_operator_account(Request $request)
    {

        $data = $request->all();
        $resposne = $this->operatorRepo->change_user_status($data);
        if ($resposne['status'])
            return $this->successResponse($resposne['message']);
        else
            return $this->validationError($resposne['message']);
    }

    /**
     *  Approve the operator
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function activate_user(Request $request)
    {

        $data = $request->all();
        $resposne = $this->operatorRepo->activate_user($data);
        if ($resposne['status'])
            return $this->successResponse($resposne['message']);
        else
            return $this->validationError($resposne['message']);
    }

    public function printOperatorDetails(Request $request)
    {
        if (isset($this->sidebar['management']['yesNo']) && $this->sidebar['management']['yesNo'] == 'no') {
            return response()->redirectTo('/admin-dashboard/dashboard')->with('error', __(accessDeniedMsg()));
        }
        $userId  = $request->user_id;
        $operator = User::with('operator_detail')->where("id", $userId)->first();
        if ($operator) {
            $pdf = PDF::loadView(
                'admin.management.operator.operator_report_pdf',
                ['operator' => $operator]
            )->setOption(['isRemoteEnabled' => true]);
            return $pdf->stream('operator_report.pdf');
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operator ID is required.'], 400);
        }
    }
}
