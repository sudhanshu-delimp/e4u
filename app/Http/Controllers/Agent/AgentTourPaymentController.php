<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\Payment;
use App\Models\TourLocation;
use App\Repositories\Escort\EscortInterface;
use App\Repositories\Tour\TourInterface;

use App\Repositories\User\UserInterface;
use App\Http\Requests\Escort\StoreRequest;
use App\Http\Requests\Escort\StoreServiceRequest;
use App\Http\Requests\UpdateEscortRequest;
use App\Http\Requests\MassageProfile\UpdateRequestAboutMe;
use App\Http\Requests\Escort\UpdateRequestPolicy;
use App\Http\Requests\Escort\UpdateRequestReadMore;
use App\Http\Requests\Escort\UpdateRequestAbout;
use App\Http\Requests\MassageProfile\StoreMasssageMediaRequest;
use App\Http\Requests\Escort\StoreRateRequest;
use App\Http\Requests\Escort\StoreAvailabilityRequest;
use App\Repositories\Duration\DurationInterface;
use Illuminate\Http\Request;
use Carbon\Carbon;

use FFMpeg;
use File;
//use Illuminate\Http\Request;

class AgentTourPaymentController extends Controller
{
    protected $escort;
    protected $tour;
    protected $service;
    protected $duration;
    protected $user;
    protected $media;
    protected $massage_profile;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct( UserInterface $user, EscortInterface $escort, TourInterface $tour)
    {
        $this->escort = $escort;
        $this->tour = $tour;
        // $this->service = $service;
        // $this->duration = $duration;
        //$this->media = $media;
        $this->user = $user;
        
        
    }

    public function polyPaymentUrl(Request $request,$id)
    {
        //dd($request->all());
        $total_rate = [];
        $total_amount = 0;
        $total_days = 0;
        $above_day = null;
        $actual_rate = null;
        $tours = $this->tour->find($id);
        //dd($tours->tour_location);
        foreach($tours->tour_location as $key=>$tour) {
            $days = Carbon::parse($tour->end_date)->diffInDays(Carbon::parse($tour->start_date));
            //$days[] += $tour->tour_plan;
            $total_days += $days;
            // echo $days."</br>";
            // echo "plan-:".$tour->tour_plan."</br>";
            // $days = $request->days;
            if($tour->tour_plan == 1 ) {
                $actual_rate = 8;
                if($days <= 21) {
                $rate = 8; 
                } else {
                    $rate = 7.5; 
                    $dis_rate = 0.5; 
                }
                
            } else if($tour->tour_plan == 2) {
                $actual_rate = 6;
                if($days <= 21) {
                $rate = 6; 
                } else {
                    $rate = 5.7; 
                    $dis_rate = 0.3; 
                }
            } else if($tour->tour_plan == 3) {
                $actual_rate = 4;
                if($days <= 21) {
                $rate = 4; 
                } else {
                    $rate = 3.8; 
                    $dis_rate = 0.2; 
                }
            } else {
                //return redirect()->route('escort.setting.profile',$id);
                $actual_rate = 0;
                $rate = 0;
                $dis_rate = 0; 
            }
            ///
        
            if($days !== null && $days <= 21) {
                //$rate = $days*30/days;
                $total_rate[] += $days*$rate;
                $total_amount += $total_rate[$key];
                
            } else {
                $days_21 = 21*$actual_rate;
                $above_day = $days - 21;

                $total_rate[] += ($above_day*$rate + $days_21);
                
                $dis = $above_day*$dis_rate;
                $total_amount += $total_rate[$key];
                
            }

            //end foreach
        }
        //echo "total amount d =".$total_days;
        //dd($total_rate);
        //$data =json_encode($prebook);
        //dd($tours->tour_location->pluck('profile_id'));
        $form_data = [];
        $form_data = [
            'user_id' => $request->user_id,
            'tour_id' => $tours->id,
            //'refrenceId' => [$tours->tour_location->pluck('profile_id')->toArray()],
            'start_date' => $tours->start_date,
            'end_date' => $tours->end_date,
            'days' => $total_days,
            
        ];
        $save_data = implode("/",$form_data);
        //dd($save_data);
        // $save_data = base64_encode(json_encode($form_data));
        //dd($save_data);
        $data = [];
        $data = [
            'start_date' => $tours->start_date,
            'end_date' => $tours->end_date,
            'days' => $total_days,
            'Amount' => $total_amount,
            "CurrencyCode" => "AUD",
            "MerchantReference" => $save_data,
            "MerchantHomepageURL" => route('home'),
            // "SuccessURL" =>  route('center.update.profile',$escort->id),
            "SuccessURL" =>  route('agent.tour.paymentUrl.status.success',[$id,$request->user_id]),
            "FailureURL" => route('agent.tour.paymentUrl.status.FailureURL',[$id,$request->user_id]),
            "CancellationURL" => route('agent.tour.paymentUrl.status.CancellationURL',[$id,$request->user_id]),
            "NotificationURL" => route('agent.tour.paymentUrl.status.NotificationURL',[$id,$request->user_id]), 
            // "FailureURL" => route('center.poly.paymentUrl.status.fail'),
            // "CancellationURL" => route('center.poly.paymentUrl.status.cencel'),
            // "NotificationURL" => route('center.poly.paymentUrl.status.notification'), 
        ];
        // $json_builder = '{
        //     "Amount":"1.2",
        //     "CurrencyCode":"AUD",
        //     "MerchantReference":"CustomerRef12345",
        //     "MerchantHomepageURL":"https://www.mycompany.com",
        //     "SuccessURL":"https://www.mycompany.com/Success",
        //     "FailureURL":"https://www.mycompany.com/Failure",
        //     "CancellationURL":"https://www.mycompany.com/Cancelled",
        //     "NotificationURL":"https://www.mycompany.com/nudge" 
        // }';
        //dd($data);
        $auth = config('escorts.poli_payment_authorization_code');
        
        $header = array();
        $header[] = 'Content-Type: application/json';
        $header[] = 'Authorization: Basic '.$auth;

        $ch = curl_init("https://poliapi.apac.paywithpoli.com/api/v2/Transaction/Initiate");
        //$ch = curl_init("https://poliapi.apac.paywithpoli.com/api");
        //See the cURL documentation for more information: http://curl.haxx.se/docs/sslcerts.html
        //We recommend using this bundle: https://raw.githubusercontent.com/bagder/ca-bundle/master/ca-bundle.crt
        //curl_setopt( $ch, CURLOPT_CAINFO, "ca-bundle.crt");
        curl_setopt( $ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt( $ch, CURLOPT_HEADER, 0);
        curl_setopt( $ch, CURLOPT_POST, 1);
        curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 0);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec( $ch );
        //dd($response);
        curl_close ($ch);
         
        $json = json_decode($response, true);
        //dd($json);
        //Poli_transaction::create( $json);
        
        //$header = header('Location: '.$json['NavigateURL']);
         //return response()->json(compact('json'));
        // return response()->json(compact('json','header'));
        //dd($json['NavigateURL']);
        return redirect($json['NavigateURL']);


    }
    public function EditPolyPaymentUrl(Request $request,$id)
    {
        //dd($request->all());
        $total_rate = [];
        $total_amount = 0;
        $total_days = 0;
        $above_day = null;
        $actual_rate = null;

        $request_total_days = 0;
        $edit_total_rate = [];
        $edit_total_amount = 0;
        $edit_total_days = 0;
        $edit_above_day = null;
        $edit_actual_rate = null;
        $tours = $this->tour->find($id);
        $old_tour_price = $tours->price;

        //dd($tours->tour_location);
        // foreach($tours->tour_location as $key=>$tour) {
        //     $days = Carbon::parse($tour->end_date)->diffInDays(Carbon::parse($tour->start_date));
        //     //$days[] += $tour->tour_plan;
        //     $total_days += $days;
        //     // echo $days."</br>";
        //     // echo "plan-:".$tour->tour_plan."</br>";
        //     // $days = $request->days;
        //     if($tour->tour_plan == 1 ) {
        //         $actual_rate = 8;
        //         if($days <= 21) {
        //         $rate = 8; 
        //         } else {
        //             $rate = 7.5; 
        //             $dis_rate = 0.5; 
        //         }
                
        //     } else if($tour->tour_plan == 2) {
        //         $actual_rate = 6;
        //         if($days <= 21) {
        //         $rate = 6; 
        //         } else {
        //             $rate = 5.7; 
        //             $dis_rate = 0.3; 
        //         }
        //     } else if($tour->tour_plan == 3) {
        //         $actual_rate = 4;
        //         if($days <= 21) {
        //         $rate = 4; 
        //         } else {
        //             $rate = 3.8; 
        //             $dis_rate = 0.2; 
        //         }
        //     } else {
        //         //return redirect()->route('escort.setting.profile',$id);
        //         $actual_rate = 0;
        //         $rate = 0;
        //         $dis_rate = 0; 
        //     }
        //     ///
        
        //     if($days !== null && $days <= 21) {
        //         //$rate = $days*30/days;
        //         $total_rate[] += $days*$rate;
        //         $total_amount += $total_rate[$key];
                
        //     } else {
        //         $days_21 = 21*$actual_rate;
        //         $above_day = $days - 21;

        //         $total_rate[] += ($above_day*$rate + $days_21);
                
        //         $dis = $above_day*$dis_rate;
        //         $total_amount += $total_rate[$key];
                
        //     }

           
        // }


        foreach($request->stateId as $key => $stateId)
        {
            // $arr += [$stateId  => [
            //     "profile_id" => (int) $request->escortId[$key],
            //     "start_date" => $request->start_date[$key],
            //     "end_date" => $request->end_date[$key],
            //     "user_id" => $request->user_id,
            //     "tour_plan" => $request->tour_plan[$key],
            //     ]
            // ];
            $edit_days = Carbon::parse($request->end_date[$key])->diffInDays(Carbon::parse($request->start_date[$key]));
            $request_total_days += $edit_days; 
           
           
           
            
            if($request->tour_plan[$key] == 1 ) {
                $edit_actual_rate = 8;
                if($edit_days <= 21) {
                $edit_rate = 8; 
                } else {
                    $edit_rate = 7.5; 
                    $edit_dis_rate = 0.5; 
                }
                
            } else if($request->tour_plan[$key] == 2) {
                $edit_actual_rate = 6;
                if($edit_days <= 21) {
                $edit_rate = 6; 
                } else {
                    $edit_rate = 5.7; 
                    $edit_dis_rate = 0.3; 
                }
            } else if($request->tour_plan[$key] == 3) {
                $edit_actual_rate = 4;
                if($edit_days <= 21) {
                $edit_rate = 4; 
                } else {
                    $edit_rate = 3.8; 
                    $edit_dis_rate = 0.2; 
                }
            } else {
                //return redirect()->route('escort.setting.profile',$id);
                $edit_actual_rate = 0;
                $edit_rate = 0;
                $edit_dis_rate = 0; 
            }
            ///
        
            if($edit_days !== null && $edit_days <= 21) {
                //$rate = $days*30/days;
                $edit_total_rate[] += $edit_days*$edit_rate;
                $edit_total_amount += $edit_total_rate[$key];
                
            } else {
                $edit_days_21 = 21*$edit_actual_rate;
                $edit_above_day = $edit_days - 21;

                $edit_total_rate[] += ($edit_above_day*$edit_rate + $edit_days_21);
                
                $edit_dis = $edit_above_day*$edit_dis_rate;
                $edit_total_amount += $edit_total_rate[$key];
                
            }

        }

        echo "old_tour_price : ".$old_tour_price;
        echo "</br>edit_tour_price : ".$edit_total_amount;
        echo "</br>id : ".$id;
        dd( $tours);
        //echo "total amount d =".$total_days;
        //dd($total_rate);
        //$data =json_encode($prebook);
        //dd($tours->tour_location->pluck('profile_id'));
        $form_data = [];
        $form_data = [
            'user_id' => $request->user_id,
            'tour_id' => $tours->id,
            //'refrenceId' => [$tours->tour_location->pluck('profile_id')->toArray()],
            'start_date' => $tours->start_date,
            'end_date' => $tours->end_date,
            'days' => $total_days,
            
        ];
        $save_data = implode("/",$form_data);
        //dd($save_data);
        // $save_data = base64_encode(json_encode($form_data));
        //dd($save_data);
        $data = [];
        $data = [
            'start_date' => $tours->start_date,
            'end_date' => $tours->end_date,
            'days' => $total_days,
            'Amount' => $total_amount,
            "CurrencyCode" => "AUD",
            "MerchantReference" => $save_data,
            "MerchantHomepageURL" => route('home'),
            // "SuccessURL" =>  route('center.update.profile',$escort->id),
            "SuccessURL" =>  route('agent.tour.paymentUrl.status.success',[$id,$request->user_id]),
            "FailureURL" => route('agent.tour.paymentUrl.status.FailureURL',[$id,$request->user_id]),
            "CancellationURL" => route('agent.tour.paymentUrl.status.CancellationURL',[$id,$request->user_id]),
            "NotificationURL" => route('agent.tour.paymentUrl.status.NotificationURL',[$id,$request->user_id]), 
            // "FailureURL" => route('center.poly.paymentUrl.status.fail'),
            // "CancellationURL" => route('center.poly.paymentUrl.status.cencel'),
            // "NotificationURL" => route('center.poly.paymentUrl.status.notification'), 
        ];
        // $json_builder = '{
        //     "Amount":"1.2",
        //     "CurrencyCode":"AUD",
        //     "MerchantReference":"CustomerRef12345",
        //     "MerchantHomepageURL":"https://www.mycompany.com",
        //     "SuccessURL":"https://www.mycompany.com/Success",
        //     "FailureURL":"https://www.mycompany.com/Failure",
        //     "CancellationURL":"https://www.mycompany.com/Cancelled",
        //     "NotificationURL":"https://www.mycompany.com/nudge" 
        // }';
        //dd($data);
        $auth = config('escorts.poli_payment_authorization_code');
        
        $header = array();
        $header[] = 'Content-Type: application/json';
        $header[] = 'Authorization: Basic '.$auth;

        $ch = curl_init("https://poliapi.apac.paywithpoli.com/api/v2/Transaction/Initiate");
        //$ch = curl_init("https://poliapi.apac.paywithpoli.com/api");
        //See the cURL documentation for more information: http://curl.haxx.se/docs/sslcerts.html
        //We recommend using this bundle: https://raw.githubusercontent.com/bagder/ca-bundle/master/ca-bundle.crt
        //curl_setopt( $ch, CURLOPT_CAINFO, "ca-bundle.crt");
        curl_setopt( $ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt( $ch, CURLOPT_HEADER, 0);
        curl_setopt( $ch, CURLOPT_POST, 1);
        curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 0);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec( $ch );
        //dd($response);
        curl_close ($ch);
         
        $json = json_decode($response, true);
        //dd($json);
        //Poli_transaction::create( $json);
        
        //$header = header('Location: '.$json['NavigateURL']);
         //return response()->json(compact('json'));
        // return response()->json(compact('json','header'));
        //dd($json['NavigateURL']);
        return redirect($json['NavigateURL']);


    }
    public function successUrl(Request $request, $id,$uid) {
        
       //dd($request->all());
        $token = $request->token;
        $auth = config('escorts.poli_payment_authorization_code');
        
        $header = array();
        $header[] = 'Content-Type: application/json';
        $header[] = 'Authorization: Basic '.$auth;
        
        $ch = curl_init("https://poliapi.apac.paywithpoli.com/api/v2/Transaction/GetTransaction?token=".urlencode($token));
        //https://poliapi.apac.paywithpoli.com/api
        //See the cURL documentation for more information: http://curl.haxx.se/docs/sslcerts.html
        //We recommend using this bundle: https://raw.githubusercontent.com/bagder/ca-bundle/master/ca-bundle.crt
        //curl_setopt( $ch, CURLOPT_CAINFO, "ca-bundle.crt");
        curl_setopt( $ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt( $ch, CURLOPT_HEADER, 0);
        curl_setopt( $ch, CURLOPT_POST, 0);
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 0);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec( $ch );
        
        curl_close ($ch);
        
        $json = json_decode($response, true);
        $json['EstablishedDateTime'] =  Carbon::parse($json['EstablishedDateTime'])->format('Y-m-d H:i:s');
        $json['StartDateTime'] =  Carbon::parse($json['StartDateTime'])->format('Y-m-d H:i:s');
        $json['EndDateTime'] =  Carbon::parse($json['EndDateTime'])->format('Y-m-d H:i:s');
       
        
        // $escort = $this->escort->find($get_id[1]);
        $arr = explode("/",$json['MerchantReference']);
        //dd(explode("/",$json['MerchantReference']));
        
        $tours = $this->tour->find($id);
        $user = $this->user->find($uid);
        $payment_data = [];
        if($json['TransactionStatus'] == "Completed") {
            $payment_data = [
                'tour_id'=>$tours->id,
                'start_date'=>$arr[2],
                'end_date'=>$arr[3],
                'plan_type'=>$tours->tour_location->pluck('tour_plan')->toArray(),
                'PaymentAmount'=>$json['PaymentAmount'],
                'AmountPaid'=>$json['AmountPaid'],
                'user_id'=>$uid,
                'user_type'=>$user->roleType,
                'referenceId'=>$tours->tour_location->pluck('profile_id')->toArray(),
                // 'referenceId'=>$arr[1],
               
            ];
           
            $tours->price = $json['AmountPaid'];
            $tours->transaction_status_code = "Completed";
            $tours->save();

            Payment::create($payment_data);
        }
        Transaction::create($json);
        session()->flash('msg',"Your Transaction ".$json['TransactionStatusCode']);
        //return redirect()->back();
        return redirect()->route('agent.manage.escorts.list');
                    
    }
    public function FailureURL(Request $request, $id, $uid) {
        
        
        $token = $request->token;
        $auth = config('escorts.poli_payment_authorization_code');
        $header = array();
        $header[] = 'Content-Type: application/json';
        $header[] = 'Authorization: Basic '.$auth;
        
        $ch = curl_init("https://poliapi.apac.paywithpoli.com/api/v2/Transaction/GetTransaction?token=".urlencode($token));
        curl_setopt( $ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt( $ch, CURLOPT_HEADER, 0);
        curl_setopt( $ch, CURLOPT_POST, 0);
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 0);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec( $ch );
        
        curl_close ($ch);
        
        $json = json_decode($response, true);
        //dd($json);//Failed
        $json['EstablishedDateTime'] =  Carbon::parse($json['EstablishedDateTime'])->format('Y-m-d H:i:s');
        $json['StartDateTime'] =  Carbon::parse($json['StartDateTime'])->format('Y-m-d H:i:s');
        $json['EndDateTime'] =  Carbon::parse($json['EndDateTime'])->format('Y-m-d H:i:s');
       
        $tour = $this->tour->find($id);
        
        $arr = explode("/",$json['MerchantReference']);
       
        
        $tours = $this->tour->find($id);
        $user = $this->user->find($uid);
        $payment_data = [];
        if($json['TransactionStatus'] == "Failed") {
            $payment_data = [
                'tour_id'=>$tours->id,
                'start_date'=>$arr[2],
                'end_date'=>$arr[3],
                'plan_type'=>$tours->tour_location->pluck('tour_plan')->toArray(),
                'PaymentAmount'=>$json['PaymentAmount'],
                'AmountPaid'=>$json['AmountPaid'],
                'user_id'=>$user->id,
                'user_type'=>$user->roleType,
                'referenceId'=>$tours->tour_location->pluck('profile_id')->toArray(),
                // 'referenceId'=>$arr[1],
               
            ];
           
            $tours->price = $json['AmountPaid'];
            $tours->transaction_status_code = "Failed";
            $tours->save();

            Payment::create($payment_data);
        }
        Transaction::create($json);
        session()->flash('msg',"Your Transaction ".$json['TransactionStatusCode']);
        //return redirect()->back();
        return redirect()->route('agent.manage.escorts.list');
                    
    }
    public function CancellationURL(Request $request, $id, $uid) {
        
        
        $token = $request->token;
        $auth = config('escorts.poli_payment_authorization_code');
        $header = array();
        $header[] = 'Content-Type: application/json';
        $header[] = 'Authorization: Basic '.$auth;
        
        $ch = curl_init("https://poliapi.apac.paywithpoli.com/api/v2/Transaction/GetTransaction?token=".urlencode($token));
        curl_setopt( $ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt( $ch, CURLOPT_HEADER, 0);
        curl_setopt( $ch, CURLOPT_POST, 0);
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 0);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec( $ch );
        
        curl_close ($ch);
        
        $json = json_decode($response, true);
       // dd($json);//Cancelled
        $json['EstablishedDateTime'] =  Carbon::parse($json['EstablishedDateTime'])->format('Y-m-d H:i:s');
        $json['StartDateTime'] =  Carbon::parse($json['StartDateTime'])->format('Y-m-d H:i:s');
        $json['EndDateTime'] =  Carbon::parse($json['EndDateTime'])->format('Y-m-d H:i:s');
       
        $escort = $this->escort->find($id);
        
        $arr = explode("/",$json['MerchantReference']);
       
        
        $tours = $this->tour->find($id);
        $user = $this->user->find($uid);
        
        $payment_data = [];
        if($json['TransactionStatus'] == "Cancelled") {
            $payment_data = [
                'tour_id'=>$tours->id,
                'start_date'=>$arr[2],
                'end_date'=>$arr[3],
                'plan_type'=>$tours->tour_location->pluck('tour_plan')->toArray(),
                'PaymentAmount'=>$json['PaymentAmount'],
                'AmountPaid'=>$json['AmountPaid'],
                'user_id'=>$user->id,
                'user_type'=>$user->roleType,
                'referenceId'=>$tours->tour_location->pluck('profile_id')->toArray(),
                // 'referenceId'=>$arr[1],
               
            ];
           
            $tours->price = $json['AmountPaid'];
            $tours->transaction_status_code = "Cancelled";
            $tours->save();

            Payment::create($payment_data);
        }
        Transaction::create($json);
        session()->flash('msg',"Your Transaction ".$json['TransactionStatusCode']);
        //return redirect()->back();
        return redirect()->route('agent.manage.escorts.list');
                    
    }
    public function NotificationURL(Request $request, $id, $uid) {
        
        
        $token = $request->token;
        $auth = config('escorts.poli_payment_authorization_code');
        $header = array();
        $header[] = 'Content-Type: application/json';
        $header[] = 'Authorization: Basic '.$auth;
        
        $ch = curl_init("https://poliapi.apac.paywithpoli.com/api/v2/Transaction/GetTransaction?token=".urlencode($token));
        curl_setopt( $ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt( $ch, CURLOPT_HEADER, 0);
        curl_setopt( $ch, CURLOPT_POST, 0);
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 0);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec( $ch );
        
        curl_close ($ch);
        
        $json = json_decode($response, true);
        //dd($json);
        $json['EstablishedDateTime'] =  Carbon::parse($json['EstablishedDateTime'])->format('Y-m-d H:i:s');
        $json['StartDateTime'] =  Carbon::parse($json['StartDateTime'])->format('Y-m-d H:i:s');
        $json['EndDateTime'] =  Carbon::parse($json['EndDateTime'])->format('Y-m-d H:i:s');
       
        $escort = $this->escort->find($id);
        
        $arr = explode("/",$json['MerchantReference']);
       
        
        $tours = $this->tour->find($id);
        $user = $this->user->find($uid);
        $payment_data = [];
        //if($json['TransactionStatus'] == "Cancelled") {
            $payment_data = [
                'tour_id'=>$tours->id,
                'start_date'=>$arr[2],
                'end_date'=>$arr[3],
                'plan_type'=>$tours->tour_location->pluck('tour_plan')->toArray(),
                'PaymentAmount'=>$json['PaymentAmount'],
                'AmountPaid'=>$json['AmountPaid'],
                'user_id'=>$user->id,
                'user_type'=>$user->roleType,
                'referenceId'=>$tours->tour_location->pluck('profile_id')->toArray(),
                // 'referenceId'=>$arr[1],
               
            ];
           
            $tour->price = $json['AmountPaid'];
            $tour->transaction_status_code = $json['TransactionStatusCode'];
            $tour->save();

            Payment::create($payment_data);
        //}
        Transaction::create($json);
        session()->flash('msg',"Your Transaction ".$json['TransactionStatusCode']);
        //return redirect()->back();
        return redirect()->route('agent.manage.escorts.list');
                    
    }
   
}