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

      //get all appointend Advertiser 
      $user = User::whereIn('type', ['3', '4'])->where('assigned_agent_id', Auth::id())->first();
     // dd($user);
     $data = PaymentItem::with(['item', 'payment' => function($query) use ($user) {
      $query->user_id = $user->id;
     }])->where('id', 10)->first();
     //dd($data);
     
    // dd($data->item()->first());

     //PaymentHistory
     $phitry =  PaymentHistory::get();
     //dd($phitry);
     //dd($data->item()->get(), $data->payment()->first());
      return  view('agent.dashboard.Fees.summary');
    }
}
