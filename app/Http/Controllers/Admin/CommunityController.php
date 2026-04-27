<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\User\UserInterface;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Pricing;
use App\Models\FeesConciergeService;
use App\Models\VariablLoyaltyProgram;
use App\Models\FeesSupportService;
use App\Traits\DataTablePagination;
use Exception;

class CommunityController extends Controller
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

    public function index()
    {
        return view('admin.management.fee_discount.index');
    }

    public function pricingSummary(Request $request){
        $advertings = Pricing::with('memberships')->get()->toArray();
        $fees_concierge_services = FeesConciergeService::all();
        $fees_support_services = FeesSupportService::all();
        $variablLoyaltyProgram = VariablLoyaltyProgram::all();
        return view('admin.community.pricing-summary',compact('advertings','fees_concierge_services','fees_support_services','variablLoyaltyProgram'));
    }

    
}