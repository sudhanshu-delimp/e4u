<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeesSummeryController extends Controller
{
    public function feesSummery(){
      return  view('agent.dashboard.Fees.summary');
    }
}
