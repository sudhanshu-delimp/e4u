<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\PaymentHistory;
use App\Models\PaymentItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeesSummeryController extends Controller
{
    public function feesSummery(){

      return  view('agent.dashboard.Fees.summary');
    }
}
