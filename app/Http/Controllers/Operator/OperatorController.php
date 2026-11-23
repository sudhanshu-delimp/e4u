<?php

namespace App\Http\Controllers\Operator;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\Operator;
use App\Models\OperatorStaff;
use App\Http\Requests\Operator\UpdateStaffMyAccount;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\Operator\UpdateMyAccountOperator;
use App\Repositories\User\UserInterface;
use App\Http\Requests\StoreAvatarMediaRequest;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Repositories\OperatorBank\OperatorBankDetailInterface;
use App\Models\AgentCommission;
use App\Models\OperatorMonthlyReport;
use App\Models\OperatorMonthlyReportQuery;
use App\Models\PaymentHistory;
use App\Models\State;
use App\Models\User;
use App\Models\Country;
use App\Services\CalculateAgentFeeService;
use App\Services\CalculateOperatorFeeService;
use App\Models\VariablAgentOperator;
use App\Models\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PDF;
class OperatorController extends BaseController
{

    protected $current_date_time;
    protected $staffRepo;
    protected $viewAccessEnabled;
    protected $editAccessEnabled;
    protected $addAccessEnabled;
    protected $sidebar;
    protected $user;
    protected $operatorId;
    protected $operatorName;
    protected $operatorBankDetail;

    public function __construct(UserInterface $user, OperatorBankDetailInterface $operatorBankDetail)
    {
        $this->userInterface = $this->user = $user;
        $this->operatorBankDetail = $operatorBankDetail;
        $this->middleware(function ($request, $next) {

            $this->user = $user = auth()->user();   // works here
            $this->operatorId =  $user->operator->id;
            $this->operatorName = $user->operator->name;


            // Now do everything that needs user data
            $securityLevel = isset($user->operator_staff_detail->security_level) ? $user->operator_staff_detail->security_level : 0;

            $viewAccess = staffPageAccessPermission($securityLevel, 'view', 9);
            $editAccess = staffPageAccessPermission($securityLevel, 'edit', 9);
            $addAccess = staffPageAccessPermission($securityLevel, 'add', 9);
            $this->sidebar = staffPageAccessPermission($securityLevel, 'sidebar', 9);

            $this->viewAccessEnabled  = isset($viewAccess['yesNo']) && $viewAccess['yesNo'] == 'yes';
            $this->editAccessEnabled  = isset($editAccess['yesNo']) && $editAccess['yesNo'] == 'yes';
            $this->addAccessEnabled  = isset($addAccess['yesNo']) && $addAccess['yesNo'] == 'yes';

            if (isset($this->sidebar['management']['yesNo']) && $this->sidebar['management']['yesNo'] == 'no') {
                // return response()->redirectTo('/operator-dashboard')->with('error', __(accessDeniedMsg()));
            }

            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myOperator()
    {
        $staff = OperatorStaff::with('operator')->where("id", auth()->user()->id)->first();
        $operator = $staff->operator;
        return view('operator.dashboard.my-account.my-operator', compact('staff', 'operator'));
    }               


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('operator.dashboard.index');
    }


    /**
     * View my account
     * 
     *  @return \Illuminate\Http\Response
     */
    public function editMyaccount()
    {
        $staff = OperatorStaff::with('operator')->where("id", auth()->user()->id)->first();
        $operator = $staff->operator;
        return view('operator.dashboard.my-account.edit-my-account', compact('staff', 'operator'));
    }

    public function editPassword()
    {
        $user = $this->user->find(auth()->user()->id);
        return view('operator.dashboard.my-account.change-password', compact('user'));
    }

    /**
     * Update My Account
     *
     * @param  UpdateStaffMyAccount  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStaff(UpdateStaffMyAccount $request)
    {
        $data = [];
        $data = [
            //'name' => $request->name,
            //'gender' => $request->gender,
            'phone' =>  removeSpaceFromString($request->phone),
            //'city_id' =>  $request->location,
            //'gender' =>  $request->gender,
        ];

        $error = true;
        if ($this->user->where('id', auth()->user()->id)->update($data)) {
            $data = $request->all();
            $user = OperatorStaff::where('id', auth()->user()->id)->first();
            $staff = $user->operator_staff_detail;
            $staff->update([
                //'name' => $data['name'] ?? $staff->name,
                'address' => $data['address'] ?? $staff->address,
                'kin_name' => $data['kin_name'] ?? "",
                'kin_relationship' => $data['kin_relationship'] ?? "",
                'kin_mobile' => $data['kin_mobile'] ?? "",
                'kin_email' => $data['kin_email'] ?? "",
                //'location' => $data['location'] ?? $staff->location,
                //'security_level' => $data['security_level'] ?? 3,
                //'position' => $data['security_level'] ?? 3,
                //'commenced_date' => $data['commenced_date'] ?? $staff->commenced_date,
                //'employment_status' => $data['employment_status'] ?? $staff->employment_status,
                //'employment_agreement' => $data['employment_agreement'] ?? $staff->employment_agreement,
                //'building_access_code' => $data['building_access_code'] ?? $staff->building_access_code,
                //'keys_issued' => $data['keys_issued'] ?? $staff->keys_issued,
                //'car_parking' => $data['car_parking'] ?? $staff->car_parking,
            ]);
            $staffSetting = \App\Models\OperatorStaffSetting::firstOrNew(['user_id' => $user->id]);
            $staffSetting->idle_preference_time = $data['idle_preference_time'] ?? null;
            $staffSetting->twofa = $data['twofa'] ?? '2';
            $staffSetting->save();
            $error = false;
        }
        return response()->json(compact('error'));
    }

    /**
     * Update My Account
     *
     * @param  UpdateMyAccountOperator  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMyAccountOperator $request)
    {
        $data = [
            'name' => $request->company_name ?? null,
            'business_name' => $request->business_name ?? null,
            'business_number' => $request->business_number ?? null,
            'abn' => $request->abn ?? null,
            'business_address' => $request->business_address ?? null,
            'business_number' => $request->business_number ?? null,
            'contact_type' => isset($request->contact_type)  ? json_encode($request->contact_type) : null,
        ];

        $error = true;
        if ($this->user->store($data, auth()->user()->id)) {
            $data = $request->all();
            $user = Operator::where('id', $data['user_id'])->first();
            $operatorDetail = $user->operator_detail;
            $point_of_contact = $data['point_of_contact'];
            $operatorDetail->update([
                'point_of_contact' => $data['point_of_contact'] ?? $operatorDetail->point_of_contact,
            ]);
            $error = false;
        }
        return response()->json(compact('error'));
    }

    public function updatePassword(Request $request)
    {
        $error = true;
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|same:new_password_confirmation',
            'new_password_confirmation' => 'required|min:8',
        ], [
            'current_password.required' => 'Please enter your current password.',
            'new_password.required' => 'Please enter a new password.',
            'new_password.min' => 'New password must be at least 8 characters.',
            'new_password.same' => 'New password and confirmation do not match.',
            'new_password_confirmation.required' => 'Please confirm your new password.',
            'new_password_confirmation.min' => 'Password confirmation must be at least 8 characters.',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(["status" => false, "message" => 'Your current password is incorrect.']);
        }
        //$user->password = Hash::make($request->new_password);
        //$user->save();
        $data = $request->all();
        $this->userInterface->changeUserPassword($data);
        return response()->json(["status" => true, "message" => 'Your password has been updated successfully!']);
    }

    /**
     * Upload avtar for logged in user
     */
    public function uploadAvatar()
    {
        return response()->redirectTo('/operator-dashboard');
        return view('operator.dashboard.my-account.upload-avatar');
    }
    public function storeMyAvatar(StoreAvatarMediaRequest $request, $id)
    {
        try {
            if ((int) Auth::id() !== (int) $id) {
                return response()->json(['type' => 1, 'message' => 'Unauthorized'], 403);
            }

            $src = $request->input('src');

            $semicolonPos = strpos($src, ';');
            $mime = substr($src, 5, $semicolonPos - 5); // image/jpeg
            $extension = explode('/', $mime)[1] ?? 'png';
            $extension = strtolower($extension) === 'jpeg' ? 'jpg' : strtolower($extension);

            $commaPos = strpos($src, ',');
            $base64 = substr($src, $commaPos + 1);
            $binary = base64_decode($base64, true);

            $dir = public_path('avatars');
            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }

            $avatarOwner = Auth::id();
            $avatarName = time() . '-' . $avatarOwner . '.' . $extension;
            $fullPath = $dir . DIRECTORY_SEPARATOR . $avatarName;
            if (File::put($fullPath, $binary) === false) {
                throw new \RuntimeException('Failed to save avatar file');
            }

            $user = $this->user->find($id);
            if (!$user) {
                return response()->json(['type' => 1, 'message' => 'User not found'], 404);
            }
            /** @var \App\Models\User $user */
            if (!empty($user->avatar_img)) {
                $oldPath = $dir . DIRECTORY_SEPARATOR . $user->avatar_img;
                if (File::exists($oldPath)) {
                    @File::delete($oldPath);
                }
            }

            $user->avatar_img = $avatarName;
            $user->save();

            $type = 0;
            return response()->json(compact('type', 'avatarName'));
        } catch (\Throwable $e) {
            \Log::error('Error saving avatar for user ' . $id . ': ' . $e->getMessage());
            return response()->json(['type' => 1, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove saved avtar
     */
    public function removeMyAvatar()
    {
        try {
            /** @var \App\Models\User $user */
            $user = $this->user->find(auth()->user()->id);

            if (!$user) {
                return response()->json(['type' => 1, 'message' => 'User not found'], 404);
            }
            $path =  public_path('/avatars/' . $user->avatar_img);
            if (File::exists($path)) {
                File::delete($path);
                $user->avatar_img = null;
                $user->save();
            } else {
                return response()->json(['type' => 1, 'message' => 'Image not found!']);
            }
            $defaultImg = asset(config('constants.operator_default_icon'));
            return response()->json(['type' => 0, 'message' => 'Avatar removed successfully', 'img' => $defaultImg]);
        } catch (\Exception $e) {
            \Log::error('Error removing avatar: ' . $e->getMessage());
            return response()->json(['type' => 1, 'message' => 'An error occurred while removing avatar. Please try again.'], 500);
        }
    }

    /**
     * Update password
     * 
     * @param ChangePasswordRequest $request
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        $user = $this->user->find(auth()->user()->id);
        $data = $request->all();
        $resposne = $this->userInterface->changeUserPassword($data);

        if ($resposne['status'])
            return $this->successResponse($resposne['message']);
        else
            return $this->validationError($resposne['message']);
    }


    public function bankAccount()
    {
        return view('operator.dashboard.my-account.bank-account');
    }

    public function saveBankDetails(Request $request, $id = null)
    {
        if ($request->bankId == "") {
            $data = [
                'bank_name' => $request->bank_name,
                'bsb' => $request->bsb,
                'account_name' => $request->account_name,
                'account_number' => $request->account_number,
                'state' => $request->state,
                'user_id' => auth()->user()->id,
                'replace' => $request->replace,
            ];
            $resposne = $this->operatorBankDetail->saveOperatorBankDetails($data);
        } else {
            $data = [
                'bank_name' => $request->bank_name,
                'bsb' => $request->bsb,
                'account_name' => $request->account_name,
                'account_number' => $request->account_number,
                'state' => $request->state,
                'user_id' => auth()->user()->id,
                'bankId' => $request->bankId,
                'replace' => $request->replace,
            ];
            $resposne = $this->operatorBankDetail->updateOperatorBankDetails($data);
        }

        if ($resposne['status'])
            return $this->successResponse($resposne['message']);
        else
            return $this->validationError($resposne['message']);
    }

    public function BankDataTable()
    {
        list($operatorBankDetail, $count, $primary_account, $primary_bank_acc_id) = $this->operatorBankDetail->paginatedByOperatorBankDetail(
            request()->get('start'),
            request()->get('length'),
            request()->get('order')[0]['column'],
            request()->get('order')[0]['dir'],
            request()->get('columns'),
            request()->get('search')['value'],
            auth()->user()->id,
        );

        $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "primary_account" => intval($primary_account),
            "primary_bank_acc_id" => intval($primary_bank_acc_id),
            "data"            => $operatorBankDetail
        );

        return response()->json($data);
    }


    public function generateOTP()
    {
        $otp = mt_rand(1000, 9999);
        return $otp;
    }
    public function deleteOperatorBank(Request $request)
    {
        $deleted = $this->operatorBankDetail->deleteOperatorBankDetail($request->id);
        if ($deleted['status']) {
            return $this->successResponse($deleted['message']);
        } else {
            return $this->validationError($deleted['message']);
        }
    }
    public function agentMonthlyreport()
    {
        return view('operator.dashboard.reports.agents-monthly-report');
    }
    public function operatorMonthlyreport()
    {
        return  view('operator.management.reports.operators.fees.operator-monthly-report');
    }                 

    public function monthlyReportAjax()
    {
       // echo "mithu";die;
        $userId = auth()->user()->id;
        $reportObj = (new OperatorMonthlyReport);
        try {
            $order = request()->get('order');
            $order_column = null;
            $order_dir = null;

            if (!empty($order) && isset($order[0]['column']) && isset($order[0]['dir'])) {
                $order_column = $order[0]['column'];
                $order_dir    = $order[0]['dir'];
            }

            list($result, $count) = $this->reportDataPagination(
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
        } catch (Exception $e) {
            Log::info("Operator fee report erro: " . $e->getMessage());
            $data = array(
                "draw"            => intval(request()->input('draw')),
                "recordsTotal"    => 0,
                "recordsFiltered" => 0,
                "data"            => null
            );
        }
        return response()->json($data);
    }

    private function reportDataPagination($start, $limit, $order_key, $dir)
    {
        $user = auth()->user();
        $userId =$user->id;
        
        $operatorId = $user->operator->id;
        $reports = OperatorMonthlyReport::with('operator', 'operatorMonthlyReportQuery')
        ->where('operator_id',  $operatorId);

        $search = request()->input('search.value');

        if (!empty($search)) {
            $reports->where(function ($query) use ($search) {
                //$query->where('status', 'like', "%{$search}%");
                $query->orWhereHas('operator', function ($q) use ($search) {
                    $q->where('member_id', 'like', "%{$search}%");
                });
            });
        }

        switch ($order_key) {
            case 0:
                $reports->orderBy('billing_period_from', $dir);
                break;
            case 4:
                $reports->orderBy('status', $dir);
                break;
            default:
                $reports->orderBy('billing_period_from', 'DESC');
                break;
        }

        $totalReport = $reports->count();
        $reports = $reports->offset($start)->limit($limit)->get();

        foreach ($reports as $item) {
            $approvedDate = "";
            $queryCount = $item->operatorMonthlyReportQuery->where('status', 'query')->where('notes', '!=', "")->count();
            $item->reportDate = Carbon::parse($item->report_date)->format('d-m-Y');
            $fromDate = Carbon::parse($item->billing_period_from)->format('d-m-Y');
            $toDate = Carbon::parse($item->billing_period_to)->format('d-m-Y');

            $item->billing_period =  $fromDate . " to " . $toDate;
            $item->billing_period_to =  $item->billing_period_to;
            $item->operator_member_id =  $item->operator->member_id;
            $item->agent_name =  $item->operator->business_name;
            $item->territory =  $item->operator->country?->iso3 ?? '';
            $formattedSpend = '<div class="num_value"><span>$</span><span>' . number_format($item->spend, 2) . '</span></div>';
            $formattedFees = '<div class="num_value"><span>$</span><span>' . number_format($item->fees, 2) . '</span></div>';
            $item->total_spend =  $formattedSpend;
            $item->total_fees =   $formattedFees;
            $status = ucfirst($item->status);
            $statusName = str_replace('_', " ", $status);
            $item->status_name = '<span class="custom_badge_lg ' . getStatusBadgeClass($status) . '">' . ucwords($statusName) . ' </span>';

            $item->report_pproved_date = "N/A";
            $item->approved_by =  $item->approved_by;

            $dropDown = '<div class="dropdown no-arrow"><a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i></a><div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">';
            $divider = "";

            if (in_array($item->status, ['approved', 'paid'])) {
                $approvedDate = (!empty($item->report_approved)) ? Carbon::parse($item->report_approved)->format('d-m-Y') : null;
                $item->report_pproved_date =  $approvedDate;
            }

            if ($item->status == 'pending') {
                //Approve
                
                   /*  $dropDown .= '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="javascript:void(0)" data-id="' . $item->id . '" data-status="approved"  id="updateMonthlyReportStatus"><i class="fa fa-check-circle"></i>Approve</a>';
                    $divider = '<div class="dropdown-divider"></div>'; */


                    //Query
                   /*  $dropDown .= '<div class="dropdown-divider"></div><a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="javascript:void(0)" data-id="' . $item->id . '" data-status="query"  id="openQueryModel"><i class="fa fa-search-minus"></i>Query</a>';
                    $divider = '<div class="dropdown-divider"></div>'; */
                
            } else if ($item->status == 'approved') {
                //Query
              
                    /* $dropDown .= '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="javascript:void(0)" data-id="' . $item->id . '" data-status="paid"  id="viewPayOperatorRreport"><i class="fa fa-star"></i>Pay</a>';
                    $divider = '<div class="dropdown-divider"></div>'; */
/* 
                     $dropDown .= '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="javascript:void(0)" data-id="' . $item->id . '" data-status="pending"  id="updateMonthlyReportStatus"><i class="fa fa-search-minus"></i>Pending</a>';
                    $divider = '<div class="dropdown-divider"></div>'; */
                    //Query
                    $dropDown .= '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="javascript:void(0)" data-id="' . $item->id . '" data-status="query"  id="openQueryModel"><i class="fa fa-search-minus"></i>Query</a>';
                    $divider = '<div class="dropdown-divider"></div>';
                
            } else if ($item->status == 'paid') {
                //pending
               
                    /* $dropDown .= '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="javascript:void(0)" data-id="' . $item->id . '" data-status="pending"  id="updateMonthlyReportStatus"><i class="fa fa-search-minus"></i>Pending</a>';
                    $divider = '<div class="dropdown-divider"></div>'; */
                
            } else if ($item->status == 'query') {

              
                    $dropDown .= '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="javascript:void(0)" data-id="' . $item->id . '" data-status="query_resolved"  id="updateMonthlyReportStatus"><i class="fa fa-check-circle"></i>Query Resolve</a>';

                    $dropDown .= '<div class="dropdown-divider"></div><a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="javascript:void(0)" data-id="' . $item->id . '" data-status="query" id="openQueryModel"><i class="fa fa-search-minus"></i></i>Reply Query</a>';
                    $divider = '<div class="dropdown-divider"></div>';
                
            } else if ($item->status == 'query_resolved') {
                //query_resolved
               
                   /*  $dropDown .= '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="javascript:void(0)" data-id="' . $item->id . '" data-status="approved"  id="updateMonthlyReportStatus"><i class="fa fa-check-circle"></i>Approve</a><div class="dropdown-divider"></div>'; */
                
            }

            //View Query
            if ($queryCount > 0) {
                $divider2 = "";
                if (empty($divider)) {
                    $divider2 = '<div class="dropdown-divider"></div>';
                }
                $dropDown .= $divider . '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10 getSubmittedQuery" href="javascript:void(0)" data-id="' . $item->id . '" > <i class="fa fa-eye"></i> View Query</a>' . $divider2;
            }
            //  View Detail
            $dropDown .= $divider . '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="javascript:void(0)" data-id="' . $item->id . '" data-operator_id="' . $item->agent_id . '" id="getMontlyViewReportPage"> <i class="fa fa-eye"></i> View Report</a>';

            $dropDown .= '</div></div>';
            $item->action = $dropDown;
        }

        return [$reports, $totalReport];
    }

    /**
   * View the monthly fee detail
   * 
   * @param \Illuminate\Http\Request $request
   */
  public function viewMonthlyReport(Request $request)
  {
    $data = $request->all();
    if (isset($data['id']) && $data['id'] > 0) {
      $id = $data['id'];
      $calculateServiceObj = (new CalculateOperatorFeeService);
      //Prepare the operator monthly fee data for view detail
      $feeDatas = $calculateServiceObj->getOperatorFeeDetails($id);

      if (count($feeDatas) > 0) {
        return view('operator.management.reports.operators.fees.view_monthly_report', compact('feeDatas'));
                    
      }
    }
    return "";
  }

  /**
   * Update the status
   * 
   * @param \Illuminate\Http\Request $request
   */
  public function updateMonthlyReportStatus(Request $request)
  {
    $report = true;
    $data = $request->all();
    if ($data) {
      $id = $data['id'];
      $status = $data['status'];
      $note = $data['note'] ?? "";
      $report = OperatorMonthlyReport::where('id', $id)->first();
      if ($report) {
        $report->status = $status;
        if ($status == 'approved') {
          $report->report_approved = now();
        }
        if ($report->save()) {
          if ($status == 'query' || $status == 'query_resolved') {
            $userId = auth()->user()->id;
            $userType = auth()->user()->type;
            $reportQueryObj = (new OperatorMonthlyReportQuery);
            $reportQueryObj->fee_report_id = $id;
            $reportQueryObj->status = $status;
            $reportQueryObj->submitted_by = $userId;
            $reportQueryObj->user_type = $userType;
            $reportQueryObj->report_date = date('Y-m-d H:i:s');;
            $reportQueryObj->notes = $note;
            $reportQueryObj->save();
          }
          $msg = ($status == 'query') ? 'Query submitted successfully.' : 'Monthly fee report status successfully updated.';
          return $this->successResponse($msg);
        }
      } else {
        return $this->errorResponse('Monthly fee report data not found.');
      }
    }
    return $this->errorResponse('Error occurred while updating the status.');
  }

  public function printMonthlyFee(Request $request)
  {
    $reportId  = $request->fee_print_id;
    $report = OperatorMonthlyReport::where('id', $reportId)->first();
    if ($report) {
      $reportMonth = Carbon::parse($report->report_date)->format('F');
      $operatorMemberId = $report->operator->member_id;
      $calculateServiceObj = (new CalculateOperatorFeeService);
      $feeDatas = $calculateServiceObj->getOperatorFeeDetails($reportId);
      $reportEndDate = Carbon::parse($report->billing_period_to)->format('d-m-Y');
      //return view('admin.management.operator.fees.print_monthly_report', compact('feeDatas', 'operatorMemberId', 'reportEndDate'));
      if (count($feeDatas) > 0) {
        $pdf = PDF::loadView(
          'operator.management.reports.operators.fees.print_monthly_report',
          [
            'feeDatas' => $feeDatas,
            'operatorMemberId' => $operatorMemberId,
            'reportEndDate' => $reportEndDate
          ]
        )->setPaper('A4', 'portrait')
        ->setOption(['isRemoteEnabled' => true]);

        $fileName = 'operator_monthly_fee_report_' . $operatorMemberId . '-' . $reportMonth . '.pdf';
        return $pdf->stream($fileName);
      }
    }
    return response()->redirectTo('/operator-dashboard/management/reports/operator-monthly-report')->with('error', 'Monthly fee record not found.');
  }

  /**
   * View the monthly fee detail
   * 
   * @param \Illuminate\Http\Request $request
   */
  public function viewQuery(Request $request)
  {
    $data = $request->all();
    if (isset($data['id']) && $data['id'] > 0) {
      $id = $data['id'];
      $queryObj = (new OperatorMonthlyReportQuery);

      $queryData = $queryObj->with('submittedBy')
        ->where('fee_report_id', $id)
        ->where('status', 'query')
        ->where('notes', '!=', "")
        ->orderBy("created_at" , "DESC")
        ->get();

      if ($queryData->isNotEmpty()) {
        return view('operator.management.reports.operators.fees.view_query', compact('queryData'));
      }
    }
    return "";
  }
   /**
   * View the monthly pay fee detail
   * 
   * @param \Illuminate\Http\Request $request
   */
  public function viewPayOperatorRreport(Request $request)
  {
    $reportId  = $request->report_id;
    $response['error'] = 1;
    $response['data'] = [];

    if (!empty($reportId)) {

      $report = OperatorMonthlyReport::where('id', $reportId)->first();
      if ($report) {
        $reportDate = Carbon::parse($report->report_date)->format('d-m-Y');
        $reportMonth = Carbon::parse($report->report_date)->format('F');

        $reportStartDate = Carbon::parse($report->billing_period_from)->format('d-m-Y');
        $reportEndDate = Carbon::parse($report->billing_period_to)->format('d-m-Y');
        $reportPeriod = $reportStartDate." to ".$reportEndDate;

        $reportData['operatorId'] = $report->operator->member_id;
        $reportData['payMonthlyReportDate'] = $reportDate;
        $reportData['payMonthlyReportMonth'] = $reportPeriod;
        $reportData['payOperatorFee'] = number_format($report->fees, 2);


        $response['error'] = 0;
        $response['data'] = $reportData;
        return response()->json($response);
      }
    }
    return response()->json($response);
  }

  /**
   * Print the monthly pay fee detail
   * 
   * @param \Illuminate\Http\Request $request
   */
  public function printPayOperatorReport(Request $request)
  {
    try {
      $reportId  = $request->monthly_report_id;

      if (!empty($reportId)) {

        $report = OperatorMonthlyReport::where('id', $reportId)->first();
        if ($report) {
          $reportDate = Carbon::parse($report->report_date)->format('d-m-Y');
          $reportMonth = Carbon::parse($report->report_date)->format('F');

          $reportStartDate = Carbon::parse($report->billing_period_from)->format('d-m-Y');
          $reportEndDate = Carbon::parse($report->billing_period_to)->format('d-m-Y');
          $reportPeriod = $reportStartDate." to ".$reportEndDate;

          $reportData['payOperatorId'] = $report->operator->member_id;
          $reportData['payMonthlyReportDate'] = $reportDate;
          $reportData['payMonthlyReportMonth'] = $reportPeriod;
          $reportData['payOperatorFee'] = number_format($report->fees, 2);
          $operatorId = $report->operator_id;

          $pdf = PDF::loadView(
            'operator.management.reports.operators.fees.print_monthly_pay_report',
            ['reportData' => $reportData]
          )->setOption(['isRemoteEnabled' => true]);
          $fileName = 'operator_monthly_payment_authorisation_report_' . $report->operator->member_id . '-' . $reportMonth . '.pdf';
          $report->status = "paid";

          if ($report->save()) {

            $notification = (new Notification);
            $notificationTitle = 'Your<span style="color:#ff0505;"> Monthly Fee </span> has been paid for ' . $reportMonth . ' month. Please visit <a href="' . config('app.url') . '/operator-dashboard/management/reports/operator-monthly-report">Fee Report</a> to acknowledge.';

            $notificationIcon = $notification->notificationIcon('general');

            // Write code for email report
            $data = [];
            $data['to_user'] = $operatorId;
            $data['notification_type'] = 'general';
            $data['notification_icon'] = $notificationIcon;
            $data['notification_listing_type'] = 3;
            $data['title'] = $notificationTitle;
            $data['message'] = '';
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            $notification->create($data);
          }
          return $pdf->stream($fileName);
        }
      }
    } catch (Exception $e) {
      return response()->redirectTo('/operator-dashboard/management/reports/operator-monthly-report')->with('error', 'Error occurred while fetching the report data. Please try later.');
    }
    return response()->redirectTo('/operator-dashboard/management/reports/operator-monthly-report')->with('error', 'Monthly fee record not found.');
  }

}
