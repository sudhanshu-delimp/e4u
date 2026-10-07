<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\User\UserInterface;
use Carbon\Carbon;
use App\Models\User;
use App\Models\State;
use App\Models\Pricing;
use App\Models\AdvertiserDiscount;
use App\Traits\DataTablePagination;
use Exception;

class StatisticsController extends Controller
{
    protected $user;
    protected $account;
    protected $local_timezone;
    use DataTablePagination;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;

        $this->middleware(function ($request, $next) {
            $this->account = auth()->user();
            $this->local_timezone = config('common.local_timezone');
            return $next($request);
        });
    }

    public function index() {}

    public function creditReport()
    {
        $states = config('escorts.profile.states');
        
        // $now = Carbon::now('UTC');
        // $australiaTimeNow = getAustraliaTime($now);

        // $currentStart = $australiaTimeNow->copy()->startOfYear()->utc();
        // $currentEndDate   = $australiaTimeNow->copy()->endOfDay()->utc();


        // $lastNow = $australiaTimeNow->copy()->subYear();
        // $lastStart = $lastNow->copy()->startOfYear()->utc();
        // $lastEndDate   = $lastNow->copy()->endOfDay()->utc();
        // $lastEnd   = $lastNow->copy()->endOfYear()->utc();

        // $previousNow = $australiaTimeNow->copy()->subYears(2);
        // $previousStart = $previousNow->copy()->startOfYear()->utc();
        // $previousEnd   = $previousNow->copy()->endOfYear()->utc();
        $financialYear = getFinancialYear();

        $currentStart = $financialYear['currentStart'];
        $currentEnd = $financialYear['currentEnd'];

        $lastStart = $financialYear['lastStart'];
        $lastEnd = $financialYear['lastEnd'];

        $previousStart = $financialYear['previousStart'];
        $previousEnd = $financialYear['previousEnd'];

        $currentTodayEnd = $financialYear['todayEnd'];
        $lastTodayEnd = $financialYear['lastTodayEnd'];

        return view('admin.management.statistics.credit', compact('states', 'currentStart', 'currentEnd', 'lastStart', 'lastEnd', 'previousStart', 'previousEnd', 'currentTodayEnd','lastTodayEnd'));
    }

    public function emailReport()
    {
        return view('admin.management.statistics.email');
    }

    public function membershipReport()
    {
        return view('admin.management.statistics.memberships');
    }

    public function productReport()
    {
        return view('admin.management.statistics.product');
    }

    public function profileReport()
    {
        return view('admin.management.statistics.profile');
    }

    public function simReport()
    {
        return view('admin.management.statistics.sim');
    }

    public function tourReport()
    {
        return view('admin.management.statistics.tours');
    }
}
