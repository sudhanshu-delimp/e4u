<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Supplier\AddNewSupplier;
use App\Models\Supplier;
use App\Repositories\Supplier\SupplierInterface;
//use PDF;
class SupplierController extends BaseController
{
    protected $current_date_time;
    protected $supplierRepo;
    protected $viewAccessEnabled;
    protected $editAccessEnabled;
    protected $addAccessEnabled;
    protected $sidebar;

    public function __construct(SupplierInterface $supplierRepo)
    {
        $this->current_date_time = date('Y-m-d H:i:s');
        $this->supplierRepo = $supplierRepo;
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
     * Add Supplier
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function addSupplier(AddNewSupplier $request)
    {
        $data = $request->all();
        $resposne = $this->supplierRepo->addUpdate($data);
        if ($resposne['status'])
            return $this->successResponse($resposne['message']);
        else
            return $this->validationError($resposne['message']);
    }

    /**
     * Edit supplier
     * 
     * @param integer $id
     */
    public function editSupplier($id)
    {
        $supplier = Supplier::with('supplier_detail', 'supplier_setting')->where("id", $id)->first();
        if ($supplier) {
            
            return view('admin.management.Supplier.edit', compact('supplier'));
        } else {
            return "";
        }
    }

    /**
     * Store supplier
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function updateSupplier(AddNewSupplier $request)
    {
        $data = $request->all();
        $resposne = $this->supplierRepo->addUpdate($data);
        if (isset($resposne['status']) && $resposne['status'])
            return $this->successResponse($resposne['message']);
        else
            return $this->validationError($resposne['message']);
    }
    /**
     * View Supplier
     * 
     * @param integer $id
     */
    public function viewSupplier($id)
    {
        $Supplier = Supplier::with('supplier_detail')->where("id", $id)->first();
        if ($Supplier) {
            return view('admin.management.supplier.view', compact('supplier'));
        } else {
            return "";
        }
    }
    /**
     * View Supplier list
     */
    public function supplierList()
    {
       return view('admin.management.supplier.manage-suppliers');
    }

    /**
     * Get all Supplier list
     */
    public function supplierDataList()
    {
        list($result, $count) = $this->supplierDataPagination(
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
     *  Get all Supplier list with filter
     * 
     * @param integer $start
     * @param integer $limit
     * @param string $order_key
     * @param string $dir
     */
    public function supplierDataPagination($start, $limit, $order_key, $dir)
    {
        $supplier = Supplier::with('state', 'supplier_detail')
            ->where('type', '10');

        $search = request()->input('search.value');

        if (!empty($search)) {
            $supplier->where(function ($query) use ($search) {
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
                $supplier->orderBy('member_id', $dir);
                break;
            case 1:
                $supplier->orderBy('id', $dir);
                break;
            case 2:
                $supplier->orderBy('name', $dir);
                break;
            default:
                $supplier->orderBy('id', 'DESC');
                break;
        }

       $total_suppliers = $supplier->count();
        $suppliers = $supplier->offset($start)->limit($limit)->get();
        $i = 1;
        foreach ($suppliers as $key => $item) {
           
            $item->supplier_id = $item->id;
            $item->member_id = isset($item->member_id) ? $item->member_id : 'NA';
            $item->location = isset($item->state->name) ? $item->state->name : 'NA';
            $item->email = isset($item->email) ? $item->email : 'NA';
            $item->totalAgents = 0;
            $item->business_name = isset($item->business_name) ? $item->business_name : 'NA';
        
            $suspend_html = "";
            $activate_html = "";
            $dropdownsub = "";
            $edit = "";

            $view = '<div class="dropdown-divider"></div><a class="dropdown-item d-flex justify-content-start gap-10 align-items-center viewSupplierdata" href="javascript:void(0)" data-id=' . $item->id . '  data-toggle="modal"> <i class="fa fa-eye"></i> View Account</a>';

            $dropdown = '<div class="dropdown no-arrow ml-3">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i></a><div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">';

            if ($this->editAccessEnabled) {
                if (auth()->user()->member_id != $item->member_id) {
                    $edit = '<a class="dropdown-item d-flex justify-content-start gap-10 align-items-center editSupplierModel" href="javascript:void(0)" data-id=' . $item->id . '  data-toggle="modal"> <i class="fa fa-pen"></i> Edit </a>';
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
            $item->status_name = '<span class="custom_badge '.getStatusBadgeClass($item->status).'">'.$item->status.' </span>';

            $item->action = $dropdown;
            $i++;
        }
        return [$suppliers, $total_suppliers];
    }
    /**
     *  Suspent the access of supplier dashboard
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function suspendSupplier(Request $request)
    {
        if ($request->id && $request->request_type && $request->request_type == 'suspend') {
            $user = Supplier::where('id', $request->id)->first();
            if ($user->status && $user->status == 'Suspended') {
                return $this->successResponse('This Account Already Suspended.');
            }
            $user->status = '3';
            $response = $user->save();

            if ($response) {
                $resposne = $this->supplierRepo->sendSuspendEmail($user);
                return $this->successResponse('Account Suspended Successfully.');
            } else
                return $this->successResponse('Error Occurred while Account Suspending.');
        } else {
            return $this->successResponse('Unknown Input Found.');
        }
    }


}
