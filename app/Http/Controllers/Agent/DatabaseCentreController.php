<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\MassageCenterTerritory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MassageExcelExport;
use App\Models\MassageExcel;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;

class DatabaseCentreController extends Controller
{
    public function databaseCentres(Request $request)
    {
        if ($request->ajax()) {

            $query = MassageCenterTerritory::from('massage_center_territories as t')
                 ->leftJoin('massage_excels as m', function ($join) {
                        $join->on('m.territory_name', '=', 't.territory_name')
                            ->where('m.archive', 'false'); 
                })
                ->selectRaw('
                    DATE(t.created_at) as date,
                    t.territory_name,
                    COUNT(m.id) as centres,
                    COUNT(NULLIF(TRIM(m.mobile_number), "")) as mobile_numbers,
                    t.status,
                    t.id,
                    t.state_id
                ')
                ->where('t.state_id', auth()->user()->state_id) // Filter by the agent's state_id
                ->whereIn('t.status', ['Active', 'Suspended'])
                ->groupBy('t.id', 't.territory_name', 't.status', 't.state_id', 't.created_at')
                ->orderByRaw("FIELD(t.status, 'Pending', 'Suspended', 'Active')");

            return DataTables::of($query)
                ->addIndexColumn()
                ->filterColumn('territory_name', function ($query, $keyword) {
                    $query->where('t.territory_name', 'like', "%{$keyword}%");
                })

                ->filterColumn('status', function ($query, $keyword) {
                    $query->where('status', 'like', "%{$keyword}%");
                })
                ->editColumn('date', function ($row) {
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
                        $actions[] = '<a href="#" class="dropdown-item d-flex align-items-center justify-content-start gap-10 js-download" data-id="' . $row->state_id . '"><i class="fa fa-download"></i> Download</a>';
                        $actions[] = '<a href="#" class="dropdown-item d-flex align-items-center justify-content-start gap-10 js-summary" data-id="' . $row->id . '"><i class="fa fa-eye"></i> Summary</a>';
                    }

                    // If suspended -> offer Activate and Pending
                    if ($status === 'Suspended') {
                        $actions[] = '<span class="dropdown-item d-flex align-items-center justify-content-start gap-10 text-muted" style="pointer-events:none;opacity:.6;"><i class="fa fa-download"></i> Download</span>';
                        $actions[] = '<span class="dropdown-item d-flex align-items-center justify-content-start gap-10 text-muted" style="pointer-events:none;opacity:.6;"><i class="fa fa-eye"></i> Summary</span>';
                    }

                    $dropdown = '<div class="dropdown no-arrow">'
                        . '<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">'
                        . '<i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>'
                        . '</a>'
                        . '<div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in">'
                        . implode('<div class="dropdown-divider"></div>', $actions)
                        . '</div>'
                        . '</div>';

                    return $dropdown;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('agent.dashboard.Marketing.database-centers');
    }

    public function viewDataSummery($id)
    {

        try {
            $view = $this->querydata($id);
            return success_response([
                'Status' => $view->status,
                'Uploaded' => basicDateFormat($view->date),
                'Territory' => $view->territory_name,
                'Centres' => $view->centres,
                'Mobiles' => $view->mobile_numbers,
            ]);
        } catch (\Exception $e) {
            return error_response('Failed to fetch database (centres): ' . $e->getMessage(), 500);
        }
    }


    public function downloadExcel($id)
    {
        return Excel::download(new MassageExcelExport($id), 'massage_centres.xlsx');
    }

    public function countActivePostCode()
    {
        try {
            $data = MassageExcel::where('state_id', auth()->user()->state_id)->whereHas('territory', function ($query) {
                $query->where('status', 'Active')->where('archive', 'false');
            })->count();
            return success_response($data, "Ok", 200, []);
        } catch (\Exception $e) {
            return error_response('Failed to fetch database (centres): ' . $e->getMessage(), 500);
        }
    }

    public function downloadPdf($id)
    {

        $id = base64_decode($id);

        try {
            $queryData = $this->querydata($id);
            if ($queryData) {
                $pdf = PDF::loadView(
                    'agent.dashboard.Marketing.pdf-generate',
                    ['data' => $queryData]
                )->setOption(['isRemoteEnabled' => true]);
                return $pdf->stream('database_Centres.pdf');
            }
        } catch (\Exception $e) {
            return error_response('Failed to fetch database (centres): ' . $e->getMessage(), 500);
        }
    }

    public function querydata($id)
    {
        return MassageCenterTerritory::from('massage_center_territories as t')
           // ->leftJoin('massage_excels as m', 'm.territory_name', '=', 't.territory_name')
           ->leftJoin('massage_excels as m', function ($join) {
                        $join->on('m.territory_name', '=', 't.territory_name')
                            ->where('m.archive', 'false'); 
                })
            ->selectRaw('
                DATE(t.created_at) as date,
                t.territory_name,
                COUNT(m.id) as centres,
                COUNT(NULLIF(TRIM(m.mobile_number), "")) as mobile_numbers,
                t.status,
                t.id,
                t.state_id
            ')
            ->where('t.id', $id)
            ->whereIn('t.status', ['Active', 'Suspended'])
            ->groupBy('t.id', 't.territory_name', 't.status', 't.state_id', 't.created_at')
            ->first();
    }


}
