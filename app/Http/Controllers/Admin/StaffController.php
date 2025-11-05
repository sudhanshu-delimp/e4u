<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;

use Laravel\Ui\Presets\React;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Staff\AddNewStaff;
use App\Repositories\Staff\StaffInterface;

class StaffController extends BaseController
{
    protected $current_date_time;
    protected $staffRepo;

    public function __construct(StaffInterface $staffRepo)
    {
        $this->current_date_time = date('Y-m-d H:i:s');
        $this->staffRepo = $staffRepo;
    }

    public function add_sfaff(AddNewStaff $request)
    {
        $data = $request->all();
        $resposne = $this->staffRepo->addUpdateStaff($data);
        if ($resposne['status'])
            return $this->successResponse($resposne['message']);
        else
            return $this->validationError($resposne['message']);
    }

    public function editStaff($id)
    {
        $staff = User::with('staff_detail')->where("id", $id)->first();
        if($staff) {
        return view('admin.management.staff-edit', compact('staff'));
        } else {
            return "";
        }
    }

    public function update_staff(Request $request)
    {
        $data = $request->all();
        $resposne = $this->staffRepo->addUpdateStaff($data);
        if (isset($resposne['status']) && $resposne['status'])
            return $this->successResponse($resposne['message']);
        else
            return $this->validationError($resposne['message']);
    }


    public function staff_list(Request $request)
    {
        //echo config('staff.staff_role_type');
        //$lists = User::where('type','6')->get();
        //dd($lists);
        return view('admin.management.staff');
    }


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


    public function staff_data_pagination($start, $limit, $order_key, $dir)
    {
        $staff = User::with('state', 'staff_detail', 'account_setting', 'LoginStatus')
            ->where('type', config('staff.staff_role_type')); //Type = 6 

        $search = request()->input('search.value');

        if (!empty($search)) {
            $staff->where(function ($query) use ($search) {
                $query->where('member_id', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhereHas('state', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            });
        }

        switch ($order_key) {
            case 1:
                $staff->orderBy('id', $dir);
                break;
            case 2:
                $staff->orderBy('name', $dir);
                break;

            default:
                $staff->orderBy('id', 'DESC')->orderBy('id', 'ASC');
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
            $item->security_level = isset($item->staff_detail->security_level) ? $item->staff_detail->securityLevel($item->staff_detail->security_level) : 'NA';
            $item->position = isset($item->staff_detail->position) ? $item->staff_detail->position : 'NA';
            $suspend_html = "";
            $activate_html = "";
            if ($item->status != 'Suspended')
                $suspend_html = '<a class="dropdown-item d-flex justify-content-start gap-10 align-items-center account-suspend-btn" href="javascript:void(0)" data-id=' . $item->id . '>   <i class="fa fa-ban"></i> Suspend</a><div class="dropdown-divider"></div>';
            if ($item->status == 'Suspended')
                $activate_html = '<a class="dropdown-item d-flex justify-content-start gap-10 align-items-center active-account-btn" href="javascript:void(0)" data-id=' . $item->id . '>   <i class="fa fa-check"></i> Activate</a><div class="dropdown-divider"></div>';
            $dropdown = '<div class="dropdown no-arrow ml-3">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i></a><div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style=""><a class="dropdown-item view-account-btn d-flex justify-content-start gap-10 align-items-center" href="javascript:void(0)" data-id=' . $item->id . '>  
                <i class="fa fa-eye "></i> View Account</a> <div class="dropdown-divider"></div>' . $activate_html . $suspend_html . ' <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center edit-staff-btn" href="javascript:void(0)" data-id=' . $item->id . '  data-toggle="modal"> <i class="fa fa-pen"></i> Edit </a></div></div>';
            $item->action = $dropdown;
            $i++;
        }
        return [$staffs, $total_staffs];
    }

    public function suspend_staff(Request $request)
    {
        if ($request->id && $request->request_type && $request->request_type == 'suspend') {

            $user = User::where('id', $request->id)->first();
            if ($user->status && $user->status == 'Suspended') {
                return $this->successResponse('This Account Already Suspended');
            }

            $user->status = '3';
            $response = $user->save();

            if ($response)
                return $this->successResponse('Account Suspended Successfully');
            else
                return $this->successResponse('Error Occurred while Account Suspending');
        } else {
            return $this->successResponse('Unknown Input Found');
        }
    }


    public function check_staff_email(Request $request)
    {
        $data = $request->all();
        $errors = $this->staffRepo->check_staff_email($data);

        if (!empty($errors))
            return $this->validationError('Email Validation', $errors);
        else
            return $this->successResponse('Email(s) are available');
    }

    public function approve_staff_account(Request $request)
    {

        $data = $request->all();
        $resposne = $this->staffRepo->change_user_status($data);
        if ($resposne['status'])
            return $this->successResponse($resposne['message']);
        else
            return $this->validationError($resposne['message']);
    }

    public function activate_user(Request $request)
    {

        $data = $request->all();
        $resposne = $this->staffRepo->activate_user($data);
        if ($resposne['status'])
            return $this->successResponse($resposne['message']);
        else
            return $this->validationError($resposne['message']);
    }
}
