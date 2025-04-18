<?php

namespace App\Http\Controllers\Escort;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\Payment;
use App\Models\MassageGallery;
use App\Repositories\Escort\EscortInterface;
use App\Repositories\Escort\AvailabilityInterface;
use App\Repositories\Service\ServiceInterface;
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
use App\Traits\ResizeImage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Repositories\MassageProfile\MassageMediaInterface;
use App\Repositories\MassageProfile\MassageProfileInterface;
use App\Repositories\MassageProfile\MassageAvailabilityInterface;
use App\Models\EscortCovidReport;
use FFMpeg;
use File;
//use Illuminate\Http\Request;

class EscortPolyPaymentController extends Controller
{
    protected $escort;
    protected $massage_availability;
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
    public function __construct( UserInterface $user, EscortInterface $escort)
    {
        $this->escort = $escort;
        // $this->massage_availability = $massage_availability;
        // $this->service = $service;
        // $this->duration = $duration;
        //$this->media = $media;
        $this->user = $user;


    }

    public function polyPaymentUrl(Request $request)
    {
        $checkout = session()->get('checkout');
        ksort($checkout);
//        $escort = $this->escort->find($id);
        $user = auth()->user();

        $final_fee = 0;
        $final_dis = 0;
        $activate_listing = [];
        $form_data = [];
        foreach ($checkout as $idx => $listing) {
            $start_date = $listing['start_date'];
            $end_date = $listing['end_date'];
            $plan = $listing['membership'];
            $enable = 1;
            $days = Carbon::parse($listing['end_date'])->diffInDays(Carbon::parse($listing['start_date']));
            $total_rate = null;
            $above_day = null;

            $dis_rate = 0;
            if($plan == 1 ) {
                $actual_rate = 8;
                if($days <= 21) {
                    $rate = 8;
                } else {
                    $rate = 7.5;
                    $dis_rate = 0.5;
                }

            } else if($plan == 2) {
                $actual_rate = 6;
                if($days <= 21) {
                    $rate = 6;
                } else {
                    $rate = 5.7;
                    $dis_rate = 0.3;
                }
            } else if($plan == 3) {
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

            if($days !== null && $days <= 21) {
                //$rate = $days*30/days;
                $total_rate = $days*$rate;
                $total_dis = 0;

            } else {
                $days_21 = 21*$actual_rate;
                $above_day = $days - 21;
                $total_rate = ($above_day*$rate + $days_21);
                $total_dis = $above_day*$dis_rate;
            }

            $final_fee += $total_rate;
            $final_dis += $total_dis;

            $checkout[$idx]['days'] = $days;
            $checkout[$idx]['amount'] = $total_rate;
            $checkout[$idx]['discount'] = $total_dis;
            $checkout[$idx]['user_id'] = $user->id;
            $checkout[$idx]['referenceId'] = $listing['escort_id'];
            $checkout[$idx]['plan'] = $listing['membership'];
            $checkout[$idx]['enable'] = 1;

            $payment['start_date'] = $start_date;
            $payment['end_date'] = $end_date;
            $payment['plan_type'] = $listing['membership'];
            $payment['PaymentAmount'] = $total_rate;
            $payment['AmountPaid'] = 0;
            $payment['user_id'] = $user->id;
            $payment['user_type'] = auth()->user()->roleType;
            $payment['referenceId'] = $listing['escort_id'];
//            $item['AmountPaid'] = $item['amount'];
            $form_data[] = Payment::create($payment)->id;
            /*if(empty($activate_listing)) {
                $activate_listing = $checkout[$idx];
            }*/
        }
        session()->put('checkout', $checkout);

//        $final_fee-$final_dis == $request->total_fee;

        //$data =json_encode($prebook);
//        $save_data = json_encode($checkout);
        /*$form_data = [
            'user_id' => $activate_listing['user_id'],
            'referenceId' => $activate_listing['referenceId'],
            'start_date' => $activate_listing['start_date'],
            'end_date' => $activate_listing['end_date'],
            'days' => $activate_listing['days'],
            'plan' => $activate_listing['plan'],
            'enable' => $activate_listing['enable']
        ];*/
        $save_data = implode("/",$form_data);
//        $save_data = 'session key';
        // $save_data = base64_encode(json_encode($form_data));
        //dd($save_data);
        //$id = $activate_listing['escort_id'];
        $id = $user->id;
        $data = [
            /*'start_date' => $activate_listing['start_date'],
            'end_date' => $activate_listing['end_date'],*/
           // 'membership' => $activate_listing['membership'],
            /*'days' => $days,*/
            'Amount' => ($final_fee-$final_dis),
            "CurrencyCode" => "AUD",
            "MerchantReference" => $save_data,
            "MerchantHomepageURL" => route('home'),
            // "SuccessURL" =>  route('center.update.profile',$escort->id),
            "SuccessURL" =>  route('escort.poly.paymentUrl.status.success',[$id]),
            "FailureURL" => route('escort.poly.paymentUrl.status.FailureURL',$id),
            "CancellationURL" => route('escort.poly.paymentUrl.status.CancellationURL',$id),
            "NotificationURL" => route('escort.poly.paymentUrl.status.NotificationURL',$id),
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
        //$auth = base64_encode('Power_Creations:Powercreations@12');

        $header = array();
        $header[] = 'Content-Type: application/json';
        $header[] = 'Authorization: Basic '.$auth;

        /*$ch = curl_init("https://poliapi.apac.paywithpoli.com/api/v2/Transaction/Initiate");
//        $ch = curl_init("https://poliapi.apac.paywithpoli.com/api");
//        $ch = curl_init("https://polipaymenturl.com");
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
        curl_close ($ch);*/

//        $json = json_decode($response, true);
        //Poli_transaction::create( $json);

        //$header = header('Location: '.$json['NavigateURL']);
        //return response()->json(compact('json'));
        // return response()->json(compact('json','header'));
//        return redirect($json['NavigateURL']);
        $this->bypass_payment($save_data, $total_rate);
        return redirect(route('escort.list', 'current'));  //TODO::Added for poli chang


    }

    public function polyPaymentUrl_OLD(Request $request,$id)
    {
        //dd($request->membership);
        $escort = $this->escort->find($id);
        $user = auth()->user();
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $plan = $request->membership;
        $enable = $request->enable;

        $days = Carbon::parse($request->end_date)->diffInDays(Carbon::parse($request->start_date));
        $total_rate = null;
        $above_day = null;
        // $days = $request->days;
        if($plan == 1 ) {
            $actual_rate = 8;
            if($days <= 21) {
               $rate = 8;
            } else {
                $rate = 7.5;
                $dis_rate = 0.5;
            }

        } else if($plan == 2) {
            $actual_rate = 6;
            if($days <= 21) {
               $rate = 6;
            } else {
                $rate = 5.7;
                $dis_rate = 0.3;
            }
        } else if($plan == 3) {
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
            $total_rate = $days*$rate;

        } else {
            $days_21 = 21*$actual_rate;
            $above_day = $days - 21;

            $total_rate = ($above_day*$rate + $days_21);

            $dis = $above_day*$dis_rate;

        }
        //$data =json_encode($prebook);
        $form_data = [];
        $form_data = [
            'user_id' => $user->id,
            'referenceId' => $escort->id,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'days' => $days,
            'plan' => $plan,
            'enable' => $enable,
        ];
        $save_data = implode("/",$form_data);
        // $save_data = base64_encode(json_encode($form_data));
        //dd($save_data);
        $data = [];
        $data = [
            'start_date' => $start_date,
            'end_date' => $end_date,
            'days' => $days,
            'Amount' => $total_rate,
            "CurrencyCode" => "AUD",
            "MerchantReference" => $save_data,
            "MerchantHomepageURL" => route('home'),
            // "SuccessURL" =>  route('center.update.profile',$escort->id),
            "SuccessURL" =>  route('escort.poly.paymentUrl.status.success',[$id]),
            "FailureURL" => route('escort.poly.paymentUrl.status.FailureURL',$id),
            "CancellationURL" => route('escort.poly.paymentUrl.status.CancellationURL',$id),
            "NotificationURL" => route('escort.poly.paymentUrl.status.NotificationURL',$id),
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
        //$auth = base64_encode('Power_Creations:Powercreations@12');

        $header = array();
        $header[] = 'Content-Type: application/json';
        $header[] = 'Authorization: Basic '.$auth;

        $ch = curl_init("https://poliapi.apac.paywithpoli.com/api/v2/Transaction/Initiate");
       // $ch = curl_init("https://poliapi.apac.paywithpoli.com/api");
       // $ch = curl_init("https://polipaymenturl.com");
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
       // dd($json);
        //Poli_transaction::create( $json);

        //$header = header('Location: '.$json['NavigateURL']);
         //return response()->json(compact('json'));
        // return response()->json(compact('json','header'));
        return redirect($json['NavigateURL']);


    }
    public function AgentPolyPaymentUrl(Request $request,$id)
    {
        //dd($request->membership);
        $escort = $this->escort->find($id);

        $user = $this->user->find($escort->user_id);
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $plan = $request->membership;
        $enable = $request->enable;

        $days = Carbon::parse($request->end_date)->diffInDays(Carbon::parse($request->start_date));
        $total_rate = null;
        $above_day = null;
        // $days = $request->days;
        if($plan == 1 ) {
            $actual_rate = 8;
            if($days <= 21) {
               $rate = 8;
            } else {
                $rate = 7.5;
                $dis_rate = 0.5;
            }

        } else if($plan == 2) {
            $actual_rate = 6;
            if($days <= 21) {
               $rate = 6;
            } else {
                $rate = 5.7;
                $dis_rate = 0.3;
            }
        } else if($plan == 3) {
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
            $total_rate = $days*$rate;

        } else {
            $days_21 = 21*$actual_rate;
            $above_day = $days - 21;

            $total_rate = ($above_day*$rate + $days_21);

            $dis = $above_day*$dis_rate;

        }
        //$data =json_encode($prebook);
        $form_data = [];
        $form_data = [
            'user_id' => $user->id,
            'referenceId' => $escort->id,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'days' => $days,
            'plan' => $plan,
            'enable' => $enable,
        ];
        $save_data = implode("/",$form_data);
        // $save_data = base64_encode(json_encode($form_data));
        //dd($save_data);
        $data = [];
        $data = [
            'start_date' => $start_date,
            'end_date' => $end_date,
            'days' => $days,
            'Amount' => $total_rate,
            "CurrencyCode" => "AUD",
            "MerchantReference" => $save_data,
            "MerchantHomepageURL" => route('home'),
            // "SuccessURL" =>  route('center.update.profile',$escort->id),
            "SuccessURL" =>  route('agent.poly.paymentUrl.status.success',[$id]),
            "FailureURL" => route('agent.poly.paymentUrl.status.FailureURL',[$id]),
            "CancellationURL" => route('agent.poly.paymentUrl.status.CancellationURL',[$id]),
            "NotificationURL" => route('agent.poly.paymentUrl.status.NotificationURL',[$id]),
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
        /*$auth = config('escorts.poli_payment_authorization_code');

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

        $json = json_decode($response, true);*/
        //dd($json);
        //Poli_transaction::create( $json);

        //$header = header('Location: '.$json['NavigateURL']);
         //return response()->json(compact('json'));
        // return response()->json(compact('json','header'));

        return redirect($json['NavigateURL']);


    }

    function bypass_payment($save_data, $total_rate) {
        $json = [];
        $json['CountryName'] =  'Australia';
        $json['FinancialInstitutionCountryCode'] =  'TEST_BYPASS';
        $json['TransactionID'] =  rand();
        $json['MerchantEstablishedDateTime'] =  date('Y-m-d H:i:s');
        $json['PayerAccountNumber'] =  rand(0, 99999);
        $json['PayerAccountSortCode'] =  rand(0, 99999);
        $json['MerchantAccountSortCode'] =  rand(0, 99999);
        $json['MerchantAccountName'] =  'TEST';
        $json['CurrencyName'] =  'Australian Dollar';
        $json['TransactionStatus'] =  'Completed';
        $json['MerchantEntityID'] =  rand(0, 99999);
        $json['UserIPAddress'] =  '122.160.197.21';
        $json['TransactionRefNo'] =  rand(0, 99999);
        $json['PaymentAmount'] =  $total_rate;
        $json['AmountPaid'] =  $total_rate;
        $json['BankReceipt'] =  '32323';
        $json['BankReceiptDateTime'] =  date('Y-m-d H:i:s');
        $json['TransactionStatusCode'] =  'Completed';
        $json['MerchantReference'] =  '3232323';
        $json['MerchantAccountNumber'] =  '232323';
        $json['EstablishedDateTime'] =  date('Y-m-d H:i:s');
        $json['StartDateTime'] =  date('Y-m-d H:i:s');
        $json['EndDateTime'] =  date('Y-m-d H:i:s');


        // $escort = $this->escort->find($get_id[1]);
        $arr = explode("/",$save_data);
        // dd(explode("/",$json['MerchantReference']));
        /*$form_data = [
            'user_id' => $arr[0],
            'referenceId' => $arr[1],
            'start_date' => $arr[2],
            'end_date' => $arr[3],
            'days' => $arr[4],
            'plan' => $arr[5],
        ];*/
        //dd($form_data);
        //dd(json_decode($json['MerchantReference']));
        $user = auth()->user();
        $payment_data = [];
        $purchaseTotal = Payment::whereIn('id', $arr)->sum('PaymentAmount');
        if($purchaseTotal == $json['PaymentAmount']) {
            $payments = Payment::whereIn("id", $arr)->get();
            foreach ($payments as $payment) {
                $payment->AmountPaid = $payment['PaymentAmount'];
                $payment->save();
            }
        }
        /*$payment_data = [
            'start_date'=>$arr[2] . " 00:00:00",
            'end_date'=>$arr[3] . " 00:00:00",
            'plan_type'=>$arr[5],
            'PaymentAmount'=>$json['PaymentAmount'],
            'AmountPaid'=>$json['AmountPaid'],
            'user_id'=>auth()->user()->id,
            'user_type'=>auth()->user()->roleType,
            'referenceId'=>$arr[1],

        ];*/
        $checkout = session()->get('checkout');
        foreach ($checkout as $startDate => $item) {
            $item['plan_type'] = $item['plan'];
            $item['user_type'] = auth()->user()->roleType;
            $item['PaymentAmount'] = $item['amount'];
            //$item['referenceId'] = $item['referenceId'];
            $item['AmountPaid'] = $item['amount'];
            //Payment::create($item);  //Moved to polyPaymentUrl()
            Purchase::create($item);

            if ($item['start_date'] <= date('Y-m-d') && $item['end_date'] >= date('Y-m-d')) {
                $escort = $this->escort->find($item['referenceId']);
                $escort->start_date = $item['start_date'];
                $escort->end_date = $item['end_date'];
                $escort->membership = $item['plan'];
                $escort->enabled = 1;
                $escort->save();
            }
        }
        Transaction::create($json);
        session()->flash('message',"Your Transaction successful");
        return true;

    }

    public function successUrl(Request $request, $id) {


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
        // dd(explode("/",$json['MerchantReference']));
        /*$form_data = [
            'user_id' => $arr[0],
            'referenceId' => $arr[1],
            'start_date' => $arr[2],
            'end_date' => $arr[3],
            'days' => $arr[4],
            'plan' => $arr[5],
        ];*/
        //dd($form_data);
        //dd(json_decode($json['MerchantReference']));
        $user = auth()->user();
        $payment_data = [];
        if($json['TransactionStatus'] == "Completed") {
            //$escort->membership = $request->membership;

            $purchaseTotal = Payment::whereIn('id', $arr)->sum('PaymentAmount');
            if($purchaseTotal == $json['PaymentAmount']) {
                $payments = Payment::whereIn("id", $arr)->get();
                foreach ($payments as $payment) {
                    $payment->AmountPaid = $payment['PaymentAmount'];
                    $payment->save();
                }
            }
            /*$payment_data = [
                'start_date'=>$arr[2] . " 00:00:00",
                'end_date'=>$arr[3] . " 00:00:00",
                'plan_type'=>$arr[5],
                'PaymentAmount'=>$json['PaymentAmount'],
                'AmountPaid'=>$json['AmountPaid'],
                'user_id'=>auth()->user()->id,
                'user_type'=>auth()->user()->roleType,
                'referenceId'=>$arr[1],

            ];*/
            $checkout = session()->get('checkout');
            foreach ($checkout as $startDate => $item) {
                $item['plan_type'] = $item['plan'];
                $item['user_type'] = auth()->user()->roleType;
                $item['PaymentAmount'] = $item['amount'];
                //$item['referenceId'] = $item['referenceId'];
                $item['AmountPaid'] = $item['amount'];
                //Payment::create($item);  //Moved to polyPaymentUrl()
                Purchase::create($item);

                if($item['start_date'] == date('Y-m-d')) {
                    $escort = $this->escort->find($item['referenceId']);
                    $escort->start_date = $item['start_date'];
                    $escort->end_date = $item['end_date'];
                    $escort->membership = $item['plan'];
                    $escort->enabled = 1;
                    $escort->save();
                }
            }
        }
        Transaction::create($json);
        session()->flash('message',"Your Transaction ".$json['TransactionStatusCode']);
        return redirect()->back();

    }
    public function FailureURL(Request $request, $id) {


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
//        dd($json);
        $json['EstablishedDateTime'] =  Carbon::parse($json['EstablishedDateTime'])->format('Y-m-d H:i:s');
        $json['StartDateTime'] =  Carbon::parse($json['StartDateTime'])->format('Y-m-d H:i:s');
        $json['EndDateTime'] =  Carbon::parse($json['EndDateTime'])->format('Y-m-d H:i:s');
        if(!$json['PayerAccountNumber']) {
            $json['PayerAccountNumber'] = NULL;
        }
        if(!$json['PayerAccountSortCode']) {
            $json['PayerAccountSortCode'] = NULL;
        }

        $escort = $this->escort->find($id);

        $arr = explode("/",$json['MerchantReference']);


        $payment_data = [];
        Transaction::create($json);
        session()->flash('message',"Your Transaction ".$json['TransactionStatusCode']);
        return redirect()->back();

    }
    public function CancellationURL(Request $request, $id) {


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
        $json['EstablishedDateTime'] =  Carbon::parse($json['EstablishedDateTime'])->format('Y-m-d H:i:s');
        $json['StartDateTime'] =  Carbon::parse($json['StartDateTime'])->format('Y-m-d H:i:s');
        $json['EndDateTime'] =  Carbon::parse($json['EndDateTime'])->format('Y-m-d H:i:s');
        if(!$json['PayerAccountNumber']) {
            $json['PayerAccountNumber'] = NULL;
        }
        if(!$json['PayerAccountSortCode']) {
            $json['PayerAccountSortCode'] = NULL;
        }

        $escort = $this->escort->find($id);

        $arr = explode("/",$json['MerchantReference']);


        $payment_data = [];
        Transaction::create($json);
        session()->flash('message',"Your Transaction ".$json['TransactionStatusCode']);
        return redirect()->back();

    }
    public function NotificationURL(Request $request, $id) {


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
        $json['EstablishedDateTime'] =  Carbon::parse($json['EstablishedDateTime'])->format('Y-m-d H:i:s');
        $json['StartDateTime'] =  Carbon::parse($json['StartDateTime'])->format('Y-m-d H:i:s');
        $json['EndDateTime'] =  Carbon::parse($json['EndDateTime'])->format('Y-m-d H:i:s');

        $escort = $this->escort->find($id);

        $arr = explode("/",$json['MerchantReference']);


        $payment_data = [];
        Transaction::create($json);
        session()->flash('message',"Your Transaction ".$json['TransactionStatusCode']);
        return redirect()->back();

    }

    public function successUrl_ByAgent(Request $request, $id) {


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

        $escort = $this->escort->find($id);
        // $escort = $this->escort->find($get_id[1]);
        $arr = explode("/",$json['MerchantReference']);
       // dd(explode("/",$json['MerchantReference']));
        $form_data = [
            'user_id' => $arr[0],
            'referenceId' => $arr[1],
            'start_date' => $arr[2],
            'end_date' => $arr[3],
            'days' => $arr[4],
            'plan' => $arr[5],
        ];
        //dd($form_data);
        //dd(json_decode($json['MerchantReference']));
        $user = $this->user->find($escort->user_id);
        $payment_data = [];
        if($json['TransactionStatus'] == "Completed") {
            //$escort->membership = $request->membership;
            $payment_data = [
                'start_date'=>$arr[2],
                'end_date'=>$arr[3],
                'plan_type'=>$arr[5],
                'PaymentAmount'=>$json['PaymentAmount'],
                'AmountPaid'=>$json['AmountPaid'],
                'user_id'=>$user->id,
                'user_type'=>$user->roleType,
                'referenceId'=>$arr[1],

            ];
            $escort->start_date = $arr[2];
            $escort->end_date = $arr[3];
            $escort->membership = $arr[5];
            $escort->enabled = 1;
            $escort->save();

            Payment::create($payment_data);
        }
        Transaction::create($json);
        session()->flash('message',"Your Transaction ".$json['TransactionStatusCode']);
        return redirect()->back();

    }
    public function FailureURL_ByAgent(Request $request, $id) {


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
        $json['EstablishedDateTime'] =  Carbon::parse($json['EstablishedDateTime'])->format('Y-m-d H:i:s');
        $json['StartDateTime'] =  Carbon::parse($json['StartDateTime'])->format('Y-m-d H:i:s');
        $json['EndDateTime'] =  Carbon::parse($json['EndDateTime'])->format('Y-m-d H:i:s');

        $escort = $this->escort->find($id);

        $arr = explode("/",$json['MerchantReference']);


        $payment_data = [];
        Transaction::create($json);
        session()->flash('message',"Your Transaction ".$json['TransactionStatusCode']);
        return redirect()->back();

    }
    public function CancellationURL_ByAgent(Request $request, $id) {


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
        $json['EstablishedDateTime'] =  Carbon::parse($json['EstablishedDateTime'])->format('Y-m-d H:i:s');
        $json['StartDateTime'] =  Carbon::parse($json['StartDateTime'])->format('Y-m-d H:i:s');
        $json['EndDateTime'] =  Carbon::parse($json['EndDateTime'])->format('Y-m-d H:i:s');

        $escort = $this->escort->find($id);

        $arr = explode("/",$json['MerchantReference']);


        $payment_data = [];
        Transaction::create($json);
        session()->flash('message',"Your Transaction ".$json['TransactionStatusCode']);
        return redirect()->back();

    }
    public function NotificationURL_ByAgent(Request $request, $id) {


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
        $json['EstablishedDateTime'] =  Carbon::parse($json['EstablishedDateTime'])->format('Y-m-d H:i:s');
        $json['StartDateTime'] =  Carbon::parse($json['StartDateTime'])->format('Y-m-d H:i:s');
        $json['EndDateTime'] =  Carbon::parse($json['EndDateTime'])->format('Y-m-d H:i:s');

        $escort = $this->escort->find($id);

        $arr = explode("/",$json['MerchantReference']);


        $payment_data = [];
        Transaction::create($json);
        session()->flash('message',"Your Transaction ".$json['TransactionStatusCode']);
        return redirect()->back();

    }

}
