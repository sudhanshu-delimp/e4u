<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\ReportEscortProfile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;

class AdvertiserReportContoller extends Controller
{
    public function index(Request $request)
    {
        [$advertiserReports, $reports] = $this->getAdvertiserReports();

        return view('admin.advertiser-reports', [
            'advertiserReports' => $advertiserReports,
            'reports' => $reports
        ]);
    }

    public function getReportByAjax()
    {
        [$advertiserReports, $reports] = $this->getAdvertiserReports();

        // dd($advertiserReports);

        // $advertiserReports = $advertiserReports->orderBy('updated_at','desc')->get()->groupBy('report_status');

        $advertiserReports = ReportEscortProfile::with('escort.user')
        ->orderByRaw("CASE WHEN report_status = 'pending' THEN 1 WHEN report_status = 'resolved' THEN 2 END")
        ->orderBy('updated_at', 'desc')
        ->get();

        $advertiserReports = $advertiserReports->map(function ($row) {

            $statusActionHtml = '<a title="Mark status as current" class="dropdown-item d-flex justify-content-start gap-10 align-items-center update-member-status" data-toggle="modal" data-target="#confirm-popup" data-id=' . $row->id . ' data-val="pending" href="#">
                                        
                                            <i class="fa fa-hourglass-half text-dark" ></i> Current 
                                        </a>';
            if ($row->report_status == 'pending') {
                $statusActionHtml =  '<a title="Mark status as resolved" class="dropdown-item d-flex justify-content-start gap-10 align-items-center update-member-status" data-id=' . $row->id . ' data-val="resolved" href="#"  data-toggle="modal" data-target="#confirm-popup" >
                                            
                                            <i class="fa fa-check-circle text-dark"></i>Resolved 
                                        </a>';
            }

            return [
                'ref'        => $row->id . $row->escort->id,
                'date'       => date('d-m-Y', strtotime($row->created_at)),
                'member_id'  => $row->escort->user->member_id ?? '-',
                'mobile'     => $row->escort->user->phone ?? '-',
                'home_state' => City::where('state_id', $row->escort->user->state_id)->value('state_code') ?? '-',
                'status'     => $row->report_status == 'pending' ? 'Current' : 'Resolved',
                'action'     => '<div class="dropdown no-arrow ml-3">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>

                                        <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                        aria-labelledby="dropdownMenuLink">
                                        '.$statusActionHtml.'
                                        <div class="dropdown-divider"></div>

                                        <a class="view_member_report dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#" data-id=' . $row->id . '>
                                        
                                            <i class="fa fa-eye text-dark"></i> View 
                                        </a>
                                        
                                    </div>

                                    </div>
                                </div>',
            ];
        });

        return DataTables::of($advertiserReports)
            ->addColumn('ref', fn($row) => $row['ref'])
            ->addColumn('date', fn($row) =>  $row['date'])
            ->addColumn('member_id', fn($row) => $row['member_id'])
            ->addColumn('mobile', fn($row) => $row['mobile'])
            ->addColumn('home_state', function ($row) {

                return $row['home_state'];
            })
            ->addColumn('status', fn($row) => $row['status'])

            ->addColumn('action', fn($row) => $row['action'])
            ->rawColumns(['action'])
            ->with([
                'reports' => $reports
            ])
            ->make(true);
    }

    private function getAdvertiserReports()
    {
        $timezone = $this->getUserTimezone();

        $today      = Carbon::now($timezone)->startOfDay();
        $monthStart = Carbon::now($timezone)->startOfMonth();
        $yearStart  = Carbon::now($timezone)->startOfYear();

        $advertiserReports = ReportEscortProfile::with('escort.user')->get();

        $reports = [
            'today'    => $advertiserReports->where('created_at', '>=', $today)->count(),
            'month'    => $advertiserReports->where('created_at', '>=', $monthStart)->count(),
            'year'     => $advertiserReports->where('created_at', '>=', $yearStart)->count(),
            'all_time' => $advertiserReports->count(),
        ];

        return [$advertiserReports, $reports];
    }

    /**
     * Determine timezone based on user or fallback.
     */
    private function getUserTimezone()
    {
        $user = Auth::user();
        if ($user && $user->state_id) {
            return config("escorts.profile.states.$user->state_id.timeZone");
        }
        return config('app.escort_server_timezone');
    }

    public function getSingleMemberEscortReport(Request $request)
    {
        $user = Auth::user();
        if (!($user && $user->id)) {
            $data = array(
                "status"     => 404,
                "error"     => true,
                "message"    => "You are not authorized user!",
                "data" => [],
            );
        } else {

            $report = ReportEscortProfile::where('id', $request->report_id)
                ->with([
                    'escort:id,user_id',
                    'escort.user:id,member_id,phone,state_id',
                ])
                ->first();

            if ($report) {
                $report->formatted_created_at = $report->created_at->format('d-m-Y');
            }

            $data = array(
                "status"     => 200,
                "error"     => false,
                "message"    => "Member report successfully fetched.",
                "data" => $report != null ? $report : null,
            );
        }

        return response()->json($data);
    }

    public function printSingleMemberEscortReport(Request $request)
    {
        $report_id = $request->report_id;
        $user = Auth::user();
        if (!($user && $user->id)) {
            $data = array(
                "status"     => 404,
                "error"     => true,
                "message"    => "You are not authorized user!",
                "data" => [],
            );

            //return $data;
        } else {

            $report = ReportEscortProfile::where('id', $report_id)
                ->with([
                    'escort:id,user_id',
                    'escort.user:id,member_id,phone,state_id',
                ])
                ->first();

            // $html = view('admin.prints_file.advertiser_report_print', ['report' => $report])->render();

            // $data = array(
            //     "status"     => 200,
            //     "error"     => false,
            //     "message"    => "Page printed sucessfully.",
            //     "data" => $html,
            // );
            return view('admin.prints_file.advertiser_report_print', ['report' => $report]);
        }

        // return response()->json($data);

    }

    public function updateMemberReportStatus(Request $request)
    {
        $report_id = $request->report_id;
        $status = $request->status;

        $user = Auth::user();
        if (!($user && $user->id)) {
            $data = array(
                "status"     => 404,
                "error"     => true,
                "message"    => "You are not authorized user!",
                "data" => [],
            );

            return $data;
        } else {

            $reportStatus = ReportEscortProfile::where('id', $report_id)->update([
                'report_status' => $status,
                'action_message' => $status == 'resolved' ? 'registered' : null,
                'admin_id' => $user->id
            ]);

            $data = array(
                "status"     => 200,
                "member_status"     => $status,
                "error"     => false,
                "message"    => "Member report status updated successfully.",
                "data" => $reportStatus != null ? $reportStatus : null,
            );
        }

        return response()->json($data);
    }
}
