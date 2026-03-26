<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\MassageExcelImport;
use App\Models\MassageCenterTerritory;
use App\Models\MassageExcel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\User\UserInterface;

class AgentExcelDataManageController extends Controller
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


    public function dataList(Request $request)
    {
        if ($request->ajax()) { 
            $query = MassageExcel::query()
                ->from('massage_excels as m')
                ->join('massage_center_territories as t', 'm.territory_name', '=', 't.territory_name')
                ->selectRaw('
                        MAX(DATE(t.created_at)) as date,
                        m.territory_name,
                        COUNT(*) as centres,
                        t.status,
                        t.id as id
                        ')
                ->groupBy('m.territory_name', 't.status')
                ->orderByRaw("FIELD(t.status, 'Pending', 'Suspended', 'Active')"); 

            return DataTables::of($query)
                ->addIndexColumn()
                ->filterColumn('territory_name', function ($query, $keyword) {
                    $query->where('m.territory_name', 'like', "%{$keyword}%");
                })
                ->filterColumn('status', function ($query, $keyword) {})
                ->filterColumn('centres', function ($query, $keyword) {})
                ->filterColumn('date', function ($query, $keyword) {})
                ->addColumn('date', function ($row) {
                    return $row->date ? basicDateFormat($row->date) : 'NA';
                })
                ->editColumn('status', function ($row) {
                    $statusText = $row->status;
                    $badgeClass = getStatusBadgeClass($statusText);
                    return "<span class='custom_badge {$badgeClass}'>{$statusText}</span>";
                })
                ->addColumn('action', function ($row) {
                    $actions = [];
                    $status = $row->status ?? null;
                    // If Active
                    if ($status === 'Active') {
                        if ($this->editAccessEnabled) {
                            $actions[] = '<a href="#" class="dropdown-item d-flex align-items-center justify-content-start gap-10 js-suspend" data-id="' . $row->id . '"><i class="fa fa-ban"></i> Suspend</a>';
                            $actions[] = '<a href="#" class="dropdown-item d-flex align-items-center justify-content-start gap-10 js-pending" data-id="' . $row->id . '"><i class="fa fa-clock"></i> Pending</a>';
                        }
                    }

                    // If suspended -> offer Activate and Pending
                    if ($status === 'Suspended') {
                        if ($this->editAccessEnabled) {
                            $actions[] = '<a href="#" class="dropdown-item d-flex align-items-center justify-content-start gap-10 js-active" data-id="' . $row->id . '"><i class="fa fa-fw fa-upload"></i> Activate</a>';
                            $actions[] = '<a href="#" class="dropdown-item d-flex align-items-center justify-content-start gap-10 js-pending" data-id="' . $row->id . '"><i class="fa fa-clock"></i> Pending</a>';
                        }
                    }

                    //If pending -> offer Active And Suspended

                    if($status == 'Pending'){
                        if($this->editAccessEnabled){
                            $actions[] = '<a href="#" class="dropdown-item d-flex align-items-center justify-content-start gap-10 js-active" data-id="' . $row->id . '"><i class="fa fa-fw fa-upload"></i> Activate</a>';
                            $actions[] = '<a href="#" class="dropdown-item d-flex align-items-center justify-content-start gap-10 js-suspend" data-id="' . $row->id . '"><i class="fa fa-ban"></i> Suspend</a>';
                        }
                    }

                    // Common actions
                    $actions[] = '<a href="#" class="dropdown-item d-flex align-items-center justify-content-start gap-10 js-summary" data-id="' . $row->id . '"><i class="fa fa-eye"></i> Summary</a>';


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
                ->rawColumns(['status', 'action','date','territory_name'])
                ->make(true);
        }
        return view('admin.management.data-list-centres.index');
    }

    public function massageCenterInport(Request $request)
    {

        $request->validate([
            'excelFile' => 'required|file|mimes:xlsx,xls,csv|max:2048'
        ]);


        if (!$request->hasFile('excelFile')) {
            return error_response('File not found', 400);
        }

        $file = $request->file('excelFile');
        $path = $file->store('uploads');

        try {

            DB::beginTransaction();
            //first delete all file
            if ($file) {
                MassageExcel::query()->delete();
                MassageCenterTerritory::query()->delete();
            }
            Excel::import(new MassageExcelImport, $path);
            $importedCount = MassageExcel::where('created_at', '>=', now()->subMinutes(2))->count();
            DB::commit();
            return success_response(true, "MassageExcel imported successfully! {$importedCount} records added.", 200, []);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            DB::rollBack();
            return error_response($e->getMessage(), 500, null, []);
        }
    }
}
