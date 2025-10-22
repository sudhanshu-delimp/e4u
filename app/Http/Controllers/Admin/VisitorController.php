<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;

class VisitorController extends Controller
{
    public function index()
    {
        [$visitors,$serverTime] = $this->getAllVisitors();

        return view('admin.visitors',['visitors'=>$visitors,'serverTime'=>$serverTime]);
    }

    public function getVisitorsByAjax()
    {
        [$visitors, $serverTime] = $this->getAllVisitors();
            
        return DataTables::of($visitors)
            ->addColumn('date', fn($row) => date('d-m-Y', strtotime($row->date)))
            ->addColumn('landed', fn($row) => $row->landed ?? '-')
            ->addColumn('idle', fn($row) => $row->idle ?? '-')
            ->addColumn('origin', fn($row) => $row->state ? $row->state :  $row->origin ?? '-')
            ->addColumn('ip', fn($row) => $row->ip_address ?? '-')
            ->addColumn('platform', fn($row) => $row->platform ?? '-')
            ->addColumn('page', fn($row) => $row->page ?? '-')
            ->with('serverTime', $serverTime)
            ->make(true);
    }

    private function getAllVisitors()
    {
        # Remove visitor if there is no activity after 10 minutes
        $threshold = now('UTC')->subMinutes(5);

        Visitor::where('updated_at', '<=', $threshold)
       ->delete();
        Visitor::where('user_id', '!=', null)
       ->delete();

        # Get all visitors
        $visitors = Visitor::all();

         $serverTime = [
                'upTime' => getAppUptime(),
                'server_time' => Carbon::now(config('app.escort_server_timezone'))->format('h:i:s A'),
                'total' => count($visitors->toArray())
            ];

        return [$visitors, $serverTime];
    }
}
