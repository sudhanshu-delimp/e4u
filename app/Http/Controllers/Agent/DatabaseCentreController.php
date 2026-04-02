<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\MassageCenterTerritory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DatabaseCentreController extends Controller
{
    public function databaseCentres(Request $request){

        if ($request->ajax()) {

        $query = MassageCenterTerritory::from('massage_center_territories as t')
                ->leftJoin('massage_excels as m', 'm.territory_name', '=', 't.territory_name')
                ->selectRaw('
                    DATE(t.created_at) as date,
                    t.territory_name,
                    COUNT(m.id) as centres,
                    COUNT(NULLIF(TRIM(m.mobile_number), "")) as mobile_numbers,
                    t.status,
                    t.id,
                    t.state_id
                ')
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
                            $actions[] = '<a href="#" class="dropdown-item d-flex align-items-center justify-content-start gap-10 js-suspend" data-id="' . $row->id . '"><i class="fa fa-download"></i> Download</a>';
                            $actions[] = '<a href="#" class="dropdown-item d-flex align-items-center justify-content-start gap-10 js-pending" data-id="' . $row->id . '"><i class="fa fa-eye"></i> Summary</a>';
                        
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
}
