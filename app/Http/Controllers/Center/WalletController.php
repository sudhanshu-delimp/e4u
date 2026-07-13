<?php

namespace App\Http\Controllers\Center;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\WalletService;

class WalletController extends Controller
{
    protected $walletService;
    protected $user;
    public function __construct(WalletService $walletService)
    {
        $this->walletService = $walletService;
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $user = $this->user;
        return view('escort.dashboard.Bookkeeping.my-wallet', compact('user'));
    }

    public function transactionList()
    {
        list($result, $count, $other) = $this->walletService->paginatedList(
            request()->get('start'),
            request()->get('length'),
            request()->get('order')[0]['column'],
            request()->get('order')[0]['dir'],
            request()->get('columns'),
            request()->get('search')['value'],
            $this->user
        );
        $result = $this->walletService->modifyRecords($result);
        $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "other" => $other,
            "data"            => $result
        );

        return response()->json($data);
    }
}
