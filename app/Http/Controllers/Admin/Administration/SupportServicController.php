<?php

namespace App\Http\Controllers\Admin\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\User\UserInterface;
use Carbon\Carbon;
use App\Models\User;
use App\Models\FeesConciergeService;
use App\Models\FeesSupportService;
use App\Traits\DataTablePagination;
use Exception;

class SupportServicController extends Controller
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

    public function financialReport()
    {
        return view('admin.support-services.financial-report');
    }

    public function processPayment()
    {
        $fees_concierge_services = FeesConciergeService::all()
        ->map(function ($item) {
        $item->name = $item->service_type;
        return $item;
        });

        $fees_support_services = FeesSupportService::all()
        ->map(function ($item) {
        $item->name = $item->fee;
        return $item;
        });

        $services = $fees_concierge_services
        ->concat($fees_support_services)
        ->sortBy('name')
        ->values();
        return view('admin.support-services.process-payment', compact('services'));
    }

    public function summary()
    {
        return view('admin.support-services.process-payment');
    }
}
