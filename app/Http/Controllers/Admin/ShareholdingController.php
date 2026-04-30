<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Shareholding\AddNewShareholding;
use App\Models\Shareholder;
use App\Models\Shareholding;

use App\Repositories\Shareholding\ShareholdingInterface;
use PDF;

class ShareholdingController extends BaseController
{
    protected $current_date_time;
    protected $shareholderRepo;
    protected $viewAccessEnabled;
    protected $editAccessEnabled;
    protected $addAccessEnabled;
    protected $sidebar;

    public function __construct(ShareholdingInterface $shareholderRepo)
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
     * Add shareholding
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function addShareholding(AddNewShareholding $request)
    {
        $data = $request->all();
        $resposne = $this->shareholderRepo->addUpdate($data);
        if ($resposne['status'])
            return $this->successResponse($resposne['message']);
        else
            return $this->validationError($resposne['message']);
    }

    /**
     * Get shareholding data by Id
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function getShareholding($id)
    {
        $user = Shareholding::with('shareholder')->where("id", $id)->first();
        if ($user) {
            return view('admin.management.shareholders.edit_shareholding', compact('user'));
        } else {
            return "";
        }
    }

    
    /**
     * Store shareholding
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function updateShareholding(AddNewShareholding $request)
    {
        $data = $request->all();
        $resposne = $this->shareholderRepo->addUpdate($data);
        if (isset($resposne['status']) && $resposne['status'])
            return $this->successResponse($resposne['message']);
        else
            return $this->validationError($resposne['message']);
    }
    /**
     * View shareholding
     * 
     * @param integer $id
     */
    public function viewShareholding($id)
    {
        $user = Shareholding::with('shareholder')->where("id", $id)->first();
        if ($user) {
            return view('admin.management.shareholders.view_shareholding', compact('user'));
        } else {
            return "";
        }
    }
    /**
     * View shareholding list
     */
    public function shareholdingList()
    {
        return view('admin.management.shareholders.shareholder');
    }

    /**
     * Get all shareholding list
     */
    public function ShareholdingDataList()
    {
        list($result, $count) = $this->ShareholdingDataPagination(
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
    public function ShareholdingDataPagination($start, $limit, $order_key, $dir)
    {
       
        $shareholder = Shareholding::with('shareholder');

        $search = request()->input('search.value');

        if (!empty($search)) {
            $shareholder->where(function ($query) use ($search) {
                $query->where('member_id', 'like', "%{$search}%")
                    ->orWhere('member_type', 'like', "%{$search}%");
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
                $shareholder->orderBy('member_type', $dir);
                break;
            default:
                $shareholder->orderBy('id', 'DESC');
                break;
        }

        $total_shareholders = $shareholder->count();
        $shareholders = $shareholder->offset($start)->limit($limit)->get();
        $i = 1;
        foreach ($shareholders as $key => $item) {
            $item->shareholder_id = $item->id;
            $item->businessName = isset($item->shareholder->business_name) ? $item->shareholder->business_name: 'NA';
            $item->member_id = isset($item->member_id) ? $item->member_id : 'NA';
            $item->dateOfEntry = isset($item->date_of_entry) ? showDateWithFormat($item->date_of_entry, 'd-m-Y') : 'NA';
            $item->memberType = isset($item->member_type) ? ucfirst($item->member_type) : 'NA';
            $item->threshold = isset($item->threshold) ? ucfirst($item->threshold) : 'No';
            $item->number_of_shares = isset($item->number_of_shares) ? $item->number_of_shares : 'NA';
            $item->shareholding = isset($item->shareholding) ? $item->shareholding : 'NA';
             $item->held_on_trust = isset($item->held_on_trust) ? ucfirst($item->held_on_trust) : 'NO';

            $suspend_html = "";
            $activate_html = "";
            $dropdownsub = "";
            $edit = "";

            $view = '<div class="dropdown-divider"></div><a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="javascript:void(0)" data-id=' . $item->id . '  data-toggle="modal" id="viewShareholderBtn" > <i class="fa fa-eye"></i>View</a>';

            $dropdown = '<div class="dropdown no-arrow ml-3">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i></a><div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">';

            if ($this->editAccessEnabled) {
                 $edit = '<a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"href="javascript:void(0)" data-id=' . $item->id . '  data-toggle="modal" id="getShareholder"> <i class="fa fa-pen"></i>Edit</a>';
            }
            $dropdown .= $edit . $view;
            $dropdown .= '</div></div>';
            

            $item->action = $dropdown;
            $i++;
        }
        return [$shareholders, $total_shareholders];
    }

    
    public function printShareholdingDetails(Request $request)
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
}
