<?php

namespace App\Http\Controllers\Admin\Administration;

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
        return view('admin.support-services.process-payment');
    }

    public function summary()
    {
        return view('admin.support-services.summary');
    }
}
