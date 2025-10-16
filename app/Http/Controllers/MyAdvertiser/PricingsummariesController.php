<?php

namespace App\Http\Controllers\MyAdvertiser;

use App\Http\Controllers\Controller;
use App\Repositories\Escort\EscortInterface;
use App\Repositories\User\UserInterface;
use App\Repositories\Pricing\PricingInterface;
use Illuminate\Http\Request;

class PricingsummariesController extends Controller
{
    //
    protected $escort;
    protected $user;
    protected $pricing;
    public function __construct(PricingInterface $pricing,EscortInterface $escort, UserInterface $user){
        $this->escort = $escort;
        $this->user = $user;
        $this->pricing = $pricing;
    }

    
    public function showPricingsummary() {
        
        $states = config('escorts.profile.states');
        $advertings= config('agent.advertising');
        $membership_types = config('agent.membership_types');
        $no_of_members = config('agent.no_of_members');

        
        return view('agent.dashboard.Advertisers.pricingsummaries',compact('advertings', 'membership_types','states','no_of_members'));
    }



    public function PricingDataTable() {
        
       list($pricing, $count) = $this->pricing->paginatedPricingList(
            request()->get('start'),
            request()->get('length'),
            request()->get('order')[0]['column'],
            request()->get('order')[0]['dir'],
            request()->get('columns'),
            request()->get('search')['value'],
            // auth()->user()->id,
        );

        //dd($pricing);

        $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $pricing
        );

        return response()->json($data);
    }
    public function storePricingDetail(Request $request) {
        
        //dd($request->all());
        $id = $request->pricingId; 
        $arr = [];
        $arr = [
                'price' => $request->price,
                'frequency' => $request->frequency,
                'discount_amount' => $request->discount_amount,
        ];
        $error = 0;
        //$data = $this->pricing->store($arr, $id);
        $data = $this->pricing->find($id);
        if(isset($request->frequency)) {
        $data->frequency = $request->frequency;
        $data->save();
        }
        // $percent = $request->price*$data->percentage/100;
        // $data->status = $request->price - $percent;

        $data->price = $request->price;
        $data->discount_amount = $request->discount_amount;
        $data->days = $request->days;
        $data->save();
       

        return response()->json(compact('error','data'));
    }
}
