<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\MassageExcel;
use App\Models\ProspectReport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use ZipArchive;

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
        $req = $request->only('report_id', 'mergeType');

        if ($req['mergeType'] == 'multiple') {
            return $this->mergeReport($req['report_id'], $req['mergeType']);
        } else {
            return $this->mergeReport($req['report_id'], $req['mergeType']); // same - single bhi same list dikhayega
        }
    }

    private function mergeReport($id, $mergeType)
    {

        try {
            $report = ProspectReport::where('id', $id)
                ->where('agent_id', auth()->id())
                ->value('center_ids');

            if (!$report) {
                return error_response('Report not found', 404);
            }

            // Fetch Massage Center
            $centers = MassageExcel::whereIn('id',  $report ?? [])
                ->get(['id', 'bussiness_name', 'address', 'email']);

            // pass proper blade template.
            $view = view('agent.dashboard.marketing.modal.centre-list', [
                'centres' => $centers,
                'reportId' => $id,
                'doc_type' => $this->returnMergeType($mergeType),
            ])->render();

            return success_response([
                'html' => $view,
                'total' =>  $centers->count(),
            ], 'OK', 200, []);
        } catch (\Exception $e) {
            return error_response('Failed to perform action: ' . $e->getMessage(), 500);
        }
    }

    private function returnMergeType($mergeType)
    {
        //$type  =  '';
        if ($mergeType == 'multiple') {
            return "2";
        } else {
            return "1";
        }
    }

    public function generatePDF(Request $request)
    {
        try {
            $centreIds = $request->centre_ids;
            $reportIds = $request->report_id;
            $docType   = $request->docType;
            $action    = $request->action;

            //View path according Merge Type
            $viewPath = $docType === '1' ? 'agent.dashboard.marketing.modal.doc1' : 'agent.dashboard.marketing.modal.doc2';

            $centres = MassageExcel::whereIn('id', $centreIds)
                ->get()
                ->keyBy('id');

            //Manage Order
            $orderedCentres  = collect($centreIds)
                ->map(fn($id)  => $centres->get($id))
                ->filter()
                ->values();


            if ($orderedCentres->count() === 1) {
                return $this->generateSinglePDF(  // return add karo
                    $orderedCentres->first(),
                    $viewPath
                );
            }

            //Multiple centres 
            return $this->generateZipPDF($orderedCentres, $viewPath);
        } catch (\Exception $e) {
            dd($e);
            return error_response('PDF Failed: ' . $e->getMessage(), 500);
        }
    }


    //Single PDF

    private function generateSinglePDF($centre, $viewPath)
    {
        $dynamicData = $this->getPfdDynamicName($centre);
        $pdf = PDF::loadView($viewPath, [
            'data'   => $dynamicData,
        ])
            ->setPaper('a4')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled'      => true,
                'dpi'                  => 96,
                'chroot'               => public_path(),
            ]);

        $filename = $this->sanitizeName($centre['bussiness_name']) . '_report.pdf';


        return response($pdf->output(), 200, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'X-Filename'          => $filename,
            'X-PDF-Count'         => 1,
            'X-Is-Zip'            => 'false',
        ]);
    }


    private function generateZipPDF($centres, $viewPath)
    {
        @set_time_limit(0);
        ini_set('memory_limit', '1G');

        $tempDir     = storage_path('app/temp_' . uniqid());
        $zipFilename = 'report_' . now()->format('d_m_Y_H_i_s') . '.zip';
        $zipPath     = storage_path('app/' . $zipFilename);

        if (!file_exists($tempDir)) {
            mkdir($tempDir, 0755, true);
        }

        $pdfFiles = [];

        foreach ($centres as $index => $centre) {
            $dynamicData = $this->getPfdDynamicName($centre);

            $pdfContent = Pdf::loadView($viewPath, [
                'data' => $dynamicData,
            ])
                ->setPaper('a4')
                ->setOptions([
                    'isHtml5ParserEnabled' => true,
                    'isRemoteEnabled'      => true,
                    'dpi'                  => 96,
                    'chroot'               => public_path(),
                ])
                ->output();

            if (empty($pdfContent)) {
                throw new \Exception('Empty PDF for: ' . $centre->bussiness_name);
            }

            $pdfFilename = ($index + 1) . '_' . $this->sanitizeName($centre->bussiness_name) . '.pdf';
            $pdfPath     = $tempDir . DIRECTORY_SEPARATOR . $pdfFilename;

            file_put_contents($pdfPath, $pdfContent);

            $pdfFiles[] = ['path' => $pdfPath, 'name' => $pdfFilename];

            unset($pdfContent);
            gc_collect_cycles();
        }

        // Step 2: ZIP banao
        $zip    = new ZipArchive();
        $result = $zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        if ($result !== true) {
            throw new \Exception('ZipArchive open failed. Code: ' . $result);
        }

        foreach ($pdfFiles as $file) {
            if (file_exists($file['path'])) {
                $zip->addFile($file['path'], $file['name']);
            }
        }

        $zip->close();

        // Step 3: Validate ZIP
        if (!file_exists($zipPath) || filesize($zipPath) == 0) {
            throw new \Exception('ZIP file is invalid or empty.');
        }

        // Step 4: Cleanup temp PDFs
        foreach ($pdfFiles as $file) {
            if (file_exists($file['path'])) {
                unlink($file['path']);
            }
        }

        if (is_dir($tempDir)) {
            rmdir($tempDir);
        }


        if (ob_get_length()) {
            ob_end_clean();
        }

        // Step 6: Download
        return response()->download($zipPath, $zipFilename, [
            'Content-Type' => 'application/zip',
            'X-Filename'   => $zipFilename,
            'X-PDF-Count'  => $centres->count(),
            'X-Is-Zip'     => 'true',
        ])->deleteFileAfterSend(true);
    }

    //Update save report
    public function updateSaveReport(Request $request)
    {

        try {
            $centre_ids = $request->centre_ids;
            $report_id = $request->report_id;
            $report = ProspectReport::where('id', $report_id)
                ->where('agent_id', auth()->id())
                ->update([
                    'merge_center_ids' => $centre_ids,
                    'merged' => 'Yes',
                    'status_type' => 'Save'
                ]);
            if ($report) {
                return success_response([], 'Report saved successfully.', 200, []);
            }
        } catch (\Exception $e) {
            dd($e);
            return error_response('PDF Failed: ' . $e->getMessage(), 500);
        }
    }

    private function sanitizeName($name)
    {
        return substr(preg_replace('/[^A-Za-z0-9_\-]/', '_', $name), 0, 50);
    }

    private function getPfdDynamicName($centre)
    {
        $agent = Auth::user();
        return  [
            'bussiness_name' => $centre['bussiness_name'],
            'name_of_agent' => $agent['business_name'],
            'agent_email_address' => $agent['email'],
            'data' => date('d-m-y'),
            'address' => $centre['address'],
            'agent_signature' =>  url('storage/' . $agent->agent_detail['signature_file']),
            'agent_mobile_number' => $agent['phone'] ?? '',
            'email' => $agent['email'] ?? '',
        ];
    }



    public function testPDF()
    {
        $centre = MassageExcel::first(); // pehla record
        $viewPath = 'agent.dashboard.marketing.modal.doc1';

        $dynamicData = $this->getPfdDynamicName($centre);
        dd($dynamicData);

        $pdf = PDF::loadView($viewPath, [
            //'centres' => collect([$centre]),
            'data' => $dynamicData,
        ])
            ->setPaper('a4')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled'      => true,
                'dpi'                  => 96,
                'chroot'               => public_path(),
            ]);

        // ✅ inline - browser me open hoga, download nahi
        return response($pdf->output(), 200, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'inline; filename="test.pdf"', // attachment → inline
        ]);
    }
}
