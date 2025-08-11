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
        //dd($this->getReportByAjax());

        return view('admin.advertiser-reports', [
            'advertiserReports' => $advertiserReports,
            'reports' => $reports
        ]);
    }

    public function getReportByAjax()
    {
        [$advertiserReports, $reports] = $this->getAdvertiserReports();

        $advertiserReports = $advertiserReports->map(function ($row) {
            return [
                'ref'        => $row->id . $row->escort->id,
                'date'       => date('d-m-Y', strtotime($row->created_at)),
                'member_id'  => $row->escort->user->member_id ?? '-',
                'mobile'     => $row->escort->user->mobile ?? '-',
                'home_state' => City::where('state_id', $row->escort->user->state_id)->value('state_code') ?? '-',
                'status'     => $row->report_status == 'pending' ? 'Current' : 'Resolved',
                'action'     => '<div class="dropdown no-arrow ml-3">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>

                                        <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                        aria-labelledby="dropdownMenuLink">
                                        
                                        <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#">
                                        
                                            <i class="fa fa-hourglass-half text-dark" ></i> Current 
                                        </a>

                                        <div class="dropdown-divider"></div>

                                        <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#"  data-toggle="modal" data-target="#confirm-popup">
                                            
                                            <i class="fa fa-check-circle text-dark"></i>Resolved 
                                        </a>

                                        <div class="dropdown-divider"></div>

                                        <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#">
                                        
                                            <i class="fa fa-eye text-dark"></i> View 
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="" data-toggle="modal" data-target="#add-note-popup">
                                            <i class="fa fa-book"></i> Add Note 
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
            ->addColumn('home_state', function($row) {
                
                return $row['home_state'];
            })
            ->addColumn('status', fn($row) => $row['status'] )
            
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


}
