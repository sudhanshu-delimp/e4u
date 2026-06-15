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
      //  $user = User::whereIn('type', ['3', '4'])->where('assigned_agent_id', Auth::id())->first();

      //dd($query->first());
    //  $data = PaymentItem::with(['item', 'payment' => function($query) use ($user) {
    //   $query->user_id = $user->id;
    //  }])->first();
    //  dd($data);

      // $d = PaymentHistory::where('user_id', $user->id)->with(['items' => function($query){
      //   $query->whereHas('item', function($q){
      //     //$q->where('membership', 2);
      //   });
      // }])->first();
      // dd($d);

    //  dd($d->items()->first()->item()->first()->membership == 2);
     
    // dd($data->item()->first());

     //PaymentHistory
    //  $phitry =  PaymentHistory::get();
     //dd($phitry);
     //dd($data->item()->get(), $data->payment()->first());
      return  view('agent.dashboard.Fees.summary');
    }
}
