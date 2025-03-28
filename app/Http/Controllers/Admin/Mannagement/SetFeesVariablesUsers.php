<?php

namespace App\Http\Controllers\Admin\Mannagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PricingSummary;
use App\Models\MembershipPlan;
use DB;

class SetFeesVariablesUsers extends Controller
{
    //

    public function setFees()
    {
        $pricings = PricingSummary::with('memberships')->get();
        $items = $pricings->groupBy('days');

        // foreach( $items as $key => $result) {
        //     dd($result->where('days',$key)->where('membership_id',1));
        // }
        // dd($items);
        //$plans = MembershipPlan::get();
        //$collection = $pricing->getCollection();
        // $collection = $pricing->map(function($item, $key) {
        //     return $item;
        // })->collect();
        // $collection = $collection->groupBy(['days' => function($item) {
        //     return $item->membership_id;
        // }], $preserveKeys = true)->sortKeys();
       
        // $pricing =  PricingSummary::select(DB::raw('price, membership_id, days,count(*) as day_count'))
        // ->groupBy('days')
        // ->get();
        // $pricings = $pricings->groupBy('days');

        // $pricings = $pricings->map(function($pricing, $key)use ($plans){
        //     $pricing = $pricing->map(function($pricing, $key)use ($plans){
        //         //$plans = $plans->where('id', $pricing->id)->all();
        //         $pricing = $plans->map(function($plan, $key)use ($pricing){
        //             return $pricing->merge($plan->where('id', $plan->membership_id)->first())->all();
        //         })->all();
        //         //$plans = $plans->concat($plans->where('id', $plans->membership_id)->first())->all();
        //         return $pricing;
        //     });

        //     return $pricing;
        // });

        //dd($pricings);
        
        return view('admin.management.set-fees',compact('pricings','items'));
    }
}
