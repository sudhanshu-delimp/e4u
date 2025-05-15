<?php

namespace App\Http\Controllers\Escort;

use App\Http\Controllers\Controller;
use App\Mail\sendOrderMobileSimRequest;
use App\Mail\sendOrderMobileSimRequestToAdmin;
use App\Mail\sendOrderMobileSimRequestToVox;
use App\Models\ConciergeMobileSim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ConciergeController extends Controller
{
    public function mobileReadSim(Request $request)
    {
        
        $request->validate([
            'contact_pref_email' => 'nullable',
            'contact_pref_mobile' => 'nullable',
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'required|string|max:20',
            'delivery_address' => 'required|string',
            'period_required' => 'nullable',
            'comments' => 'nullable|string',
            'terms' => 'accepted',
            'auth' => 'accepted',
        ]);

        // dd($request->all());

        #payment integration pending here before adding it

        $simData = ConciergeMobileSim::create([
            'user_id' => Auth::id(),
            'contact_pref_email' => $request->has('contact_pref_email') ? 1 : 0,
            'contact_pref_mobile' => $request->has('contact_pref_mobile') ? 1 : 0,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'delivery_address' => $request->delivery_address,
            'period_required' => (int)$request->period_required,
            'comments' => $request->comments,
            'terms' => $request->has('terms') ? 1 : 0,
            'status' => false,
            'order_ref'=>'ord_'. uniqid()
        ]);

        $data = [
            'concierge_mobile_sim_id' =>$simData->id,
            'name'=> $simData->first_name. ' '. $simData->last_name,
            'date'=> $simData->created_at->format('d-m-Y'),
            'order_ref'=> $simData->order_ref,
            'fees'=> 20.00,
            'total'=> 20.00,
        ];

        // dd($simData, $data);

        return view('escort.mobileSim.mobileSim', ['data'=>$data]);

        // $body = [
        //     'email' => $simData->email,
        //     'member_id' => Auth::user()->member_id,
        //     'escort_name' => $simData->first_name. ' '. $simData->last_name,
        //     'subject' => 'Mobile Sim Request'
        //  ];

        // Mail::to($request->email)->cc(['e4u@voxaustralia.com.au', 'admin@e4u.com.au'])->send(new sendOrderMobileSimRequest($body));

        // if(!$simData){
        //     return response()->json([
        //         'status'=>false,
        //         'message'=>'Something went wrong!',
        //         'data'=>null
        //     ],422);
        // }

        // return response()->json([
        //     'status'=>true,
        //     'message'=>'Form submitted successfully!',
        //     'data'=>[
        //         'created_at'=>$simData->created_at->format('d-m-Y')
        //     ]
        // ],200);
    }

    function mobileOrderSimPayment(Request $request)
    {
        $simData = ConciergeMobileSim::where('id',$request->concierge_mobile_sim_id)->first();
        $username = Auth::user()->name;
        
        $body = [
            'email' => $simData->email,
            'member_id' => $simData->user_id,
            'escort_name' => $username ? $username : $simData->first_name,
            'order_ref'=> $simData->order_ref,
            'subject' => 'Mobile Sim Request',
            'mobile' => $simData->mobile,
            'address' => $simData->delivery_address,
            'period' => $simData->period_required,
            'comment' => $simData->comments,
            'pref_email' => $simData->contact_pref_email,
            'pref_mobile' => $simData->contact_pref_mobile,
            'payment_authorized' => 'Yes',
         ];

        Mail::to($simData->email)->queue(new sendOrderMobileSimRequest($body));
        Mail::to(config('escorts.mobileOrderSimRequest.vox'))->queue(new sendOrderMobileSimRequestToVox($body));
        Mail::to(config('escorts.mobileOrderSimRequest.admin'))->queue(new sendOrderMobileSimRequestToAdmin($body));

        if(!$simData){
            return view('escort.dashboard.Concierge.mobile-read-sim',['simData'=>null,'status'=>false]);
        }

        return view('escort.dashboard.Concierge.mobile-read-sim',['simData'=>$simData,'status'=>false]);

    }

    // function listing_checkout($data) {
    //     //        $escort_id = $request->escort_id;
        
    //     $checkoutData = [];
    //     $escort_ids = [];
    //     foreach ($data as $idx => $listing) {
            

    //         $index = date('Ymd', strtotime($listing['start_date'])).rand(100,999);
    //         // dump($data, $idx, $listing, $index);
    //        // $data[$idx]['escort_id'] = $escort_id;
    //         $escort_ids[] = $listing['escort_id'];
    //         $checkoutData[$index] = $data[$idx];
    //     }
    //     $escorts = Escort::whereIn('id', $escort_ids)->pluck('name', 'id')->toArray();
    //     //save here in session to retrieve later
    //     session()->put('checkout', $checkoutData);
    //     // $checkoutData = json_encode($checkoutData);


    //     return view('escort.dashboard.checkoutPage', compact('data', 'escorts'));
    // }
}
