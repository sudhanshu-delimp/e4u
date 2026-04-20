<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\MassageExcel;
use App\Models\ProspectReport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProspectListController extends Controller
{
    public function prospectList()
    {
        return view('agent.dashboard.marketing.prospect_list.create-prospect');
    }

    public function postcodes(Request $request)
    {
        $q = $request->q;
        try {
            $searchByPostCode = MassageExcel::select('post_code')
                ->where('post_code', 'LIKE', $q . '%')
                ->where('state_id', auth()->user()->state_id)
                ->distinct()->limit(10)->get();
            return success_response($searchByPostCode, "Ok", 200, []);
        } catch (\Exception $e) {
            return error_response('Failed to fetch postcodes: ' . $e->getMessage(), 500);
        }
    }


    public function showRecipients(Request $request)
    {
        try {
            $query = MassageExcel::where('state_id', auth()->user()->state_id)->where('archive', 'false')
                ->whereHas('territory', function ($q) {
                    $q->where('status', 'Active');
                });

            $type = $request->type;
            if ($type === 'single' && $request->post_code) {
                $query->where('post_code', $request->post_code);
            } elseif ($type === 'multiple' && $request->from && $request->to) {
                $query->whereBetween('post_code', [$request->from, $request->to]);
            }

            $data = $query->select('id', 'bussiness_name', 'address', 'post_code', 'mobile_number', 'business_number')
                ->get()
                ->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'bussiness_name' => $item->bussiness_name,
                        'address' => $item->address,
                        'post_code' => $item->post_code,
                        'mobile_number' => $item->mobile_number ?? 'NA',
                        'business_number' => $item->business_number ?? 'NA',
                    ];
                });

            return success_response($data, "Ok", 200, []);
        } catch (\Exception $e) {
            return error_response('Failed to fetch recipients: ' . $e->getMessage(), 500);
        }
    }

    public function getReports()
    {
        try {
            $reports = ProspectReport::where('agent_id', auth()->id())->where('status_type', 'Unsave')
                ->orderBy('id', 'desc')
                ->get()
                ->map(function ($report) {
                    return [
                        'id' => $report->id,
                        'date_generated' => $report->created_at->format('d/m/Y'),
                        'post_code' => $report->post_code_label,
                        'listings' => $report->listings_count,
                        'merged' => $report->merged,
                        'action' => view('agent.dashboard.marketing.prospect_list.report-table-action', ['report' => $report])->render(),
                    ];
                });

            return success_response($reports, "Ok", 200, []);
        } catch (\Exception $e) {
            return error_response('Failed to fetch reports: ' . $e->getMessage(), 500);
        }
    }

    public function storeReport(Request $request)
    {
        try {
            $type = $request->type;

            if ($type === 'single' && $request->post_code) {
                $postCodeLabel = $request->post_code;
            } elseif ($type === 'multiple' && $request->from && $request->to) {
                $postCodeLabel = $request->from . ' - ' . $request->to;
            } else {
                $postCodeLabel = 'All (' . (auth()->user()->state_abbr ?? 'State') . ')';
            }

            // Check if same filter already exists
            // $existing = ProspectReport::where('agent_id', auth()->id())
            //     ->where('type', $type)
            //     ->where('post_code_label', $postCodeLabel)
            //     ->first();

            // if ($existing) {
            //     return error_response('Report for this filter already exists.', 409);
            // }

            $query = MassageExcel::where('state_id', auth()->user()->state_id)->where('archive', 'false')
                ->whereHas('territory', function ($q) {
                    $q->where('status', 'Active');
                });

            if ($type === 'single' && $request->post_code) {
                $query->where('post_code', $request->post_code);
            } elseif ($type === 'multiple' && $request->from && $request->to) {
                $query->whereBetween('post_code', [$request->from, $request->to]);
            }

            $data = $query->select('id', 'bussiness_name', 'address', 'post_code', 'mobile_number', 'business_number')->get();

            $centerIds = $data->pluck('id')->toArray();

            $report = ProspectReport::create([
                'agent_id' => auth()->id(),
                'post_code_label' => $postCodeLabel,
                'type' => $type,
                'listings_count' => count($centerIds),
                'center_ids' => $centerIds,
                'status_type'  => 'Unsave',
            ]);

            $reportRow = [
                'id' => $report->id,
                'date_generated' => basicDateFormat($report->created_at),
                'post_code' => $postCodeLabel,
                'listings' => count($centerIds),
                'merged' => 'No',
                'status_type' => 'Unsave',
                'action' => view('agent.dashboard.marketing.prospect_list.report-table-action', ['report' => $report])->render(),
            ];

            $previewData = $data->map(function ($item) {
                return [
                    'id' => $item->id,
                    'bussiness_name' => $item->bussiness_name,
                    'address' => $item->address,
                    'post_code' => $item->post_code,
                    'mobile_number' => $item->mobile_number ?? 'NA',
                    'business_number' => $item->business_number ?? 'NA',
                ];
            });

            return success_response([
                'report' => $reportRow,
                'preview' => $previewData,
            ], "List generated successfully! " . count($centerIds) . " listings found.", 200, []);
        } catch (\Exception $e) {
            return error_response('Failed to store report: ' . $e->getMessage(), 500);
        }
    }

    public function clearReports()
    {
        try {
            ProspectReport::where('agent_id', auth()->id())->where('status_type', 'Unsave')->delete();
            return success_response([], 'All reports cleared successfully.', 200, []);
        } catch (\Exception $e) {
            return error_response('Failed to clear reports: ' . $e->getMessage(), 500);
        }
    }

    public function saveReport()
    {
        try {
            ProspectReport::where('agent_id', auth()->id())->where('status_type', 'Unsave')->update(['status_type' => 'Save']);
            return success_response([], 'All reports saved successfully.', 200, []);
        } catch (\Exception $e) {
            return error_response('Failed to save report: ' . $e->getMessage(), 500);
        }
    }

    // public function reportAction(Request $request)
    // {
    //     try {
    //         $report = ProspectReport::where('id', $request->report_id)
    //             ->where('agent_id', auth()->id())
    //             ->firstOrFail();


    //         $centers = MassageExcel::whereIn('id', $report->center_ids ?? [])
    //             ->select('id', 'bussiness_name', 'address', 'post_code', 'mobile_number', 'business_number')
    //             ->get();

    //         $action = $request->action;

    //         $html = view('agent.dashboard.marketing.partials.report-centers', [
    //             'centers' => $centers,
    //             'report' => $report,
    //             'action' => $action,
    //         ])->render();

    //         return success_response(['html' => $html], "Ok", 200, []);
    //     } catch (\Exception $e) {
    //         return error_response('Failed to perform action: ' . $e->getMessage(), 500);
    //     }
    // }


    //save report module for show
    public function saveReportList(Request $request)
    {

        if ($request->ajax()) {
            $query = ProspectReport::where('agent_id', auth()->id())->where('status_type', 'Save');
            return DataTables::of($query)
                ->addIndexColumn()
                ->filterColumn('post_code_label', function ($query, $keyword) {
                    $query->where('post_code_label', 'like', "%{$keyword}%");
                })
                ->editColumn('date', function ($row) {
                    return $row->created_at ? basicDateFormat($row->created_at) : 'NA';
                })

                ->addColumn('action', function ($row) {
                    $actions = [];
                    $actions[] = '<a href="#" class="dropdown-item d-flex align-items-center justify-content-start gap-10" data-id="' . $row->id . '"><i class="fa fa-bezier-curve"></i> Merge</a>';
                    $actions[] = '<a href="#" class="dropdown-item d-flex align-items-center justify-content-start gap-10" data-id="' . $row->id . '"><i class="fa fa-print"></i> Print</a>';
                    $actions[] = '<a href="#" class="dropdown-item d-flex align-items-center justify-content-start gap-10" data-id="' . $row->id . '"><i class="fa fa-eye"></i> View</a>';

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
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('agent.dashboard.marketing.saved-reports');
    }


    public function demoPdf()
    {
        return view('agent.dashboard.marketing.demo-pdf');
    }


    public function pdfGenerate(Request $request)
    {
        $request->validate([
            'html_content' => 'required|string',
        ]);

        // Take the raw HTML from the textarea and render it as PDF
        $pdf = Pdf::loadHTML($request->input('html_content'));
        $pdf->setPaper('A4', 'portrait');

        // Opens directly in browser
        return $pdf->stream('converted.pdf');
    }

    //Report List action 
    public function reportAction(Request $request)
    {
        $report_id = $request->report_id;
        $action_type = $request->action_type;

        switch ($action_type) {
            case 'Merge':
                return $this->mergeReport($report_id);

            case 'Print':
                return $this->printReport($report_id);

            case 'View':
                return $this->viewReport($report_id);

            default:
                return response()->json(['error' => 'Invalid action'], 400);
        }
    }

    private function mergeReport($id)
    {

        try {
            $massageCenterIds = ProspectReport::where('id', $id)
                ->where('agent_id', auth()->id())
                ->value('center_ids');

            if ($massageCenterIds) {
                $view = view('agent.dashboard.marketing.merge-preview', ['centerIds' => $massageCenterIds])->render();
                return success_response(['html' => $view], "Ok", 200, []);
            }
        } catch (\Exception $e) {
            return error_response('Failed to perform action: ' . $e->getMessage(), 500);
        }



        dd($massageCenterIds);
    }

    private function printReport($id)
    {
        dd('for print repot data');
    }

    private function viewReport($id)
    {
        dd('for view report data');
    }
}
