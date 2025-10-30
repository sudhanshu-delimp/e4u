<?php

namespace App\Http\Controllers\Center;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Duration;
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

class PolyPaymentController extends Controller
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
    public function __construct(MassageAvailabilityInterface $massage_availability, MassageProfileInterface $massage_profile, UserInterface $user, EscortInterface $escort, AvailabilityInterface $availability,  ServiceInterface $service, DurationInterface $duration, MassageMediaInterface $media)
    {
        $this->escort = $escort;
        $this->massage_availability = $massage_availability;
        $this->service = $service;
        $this->duration = $duration;
        $this->user = $user;
        $this->media = $media;
        $this->massage_profile = $massage_profile;
    }

    public function polyPaymentUrl(Request $request,$id)
    {
        $escort = $this->massage_profile->find($id);
        $start_date = $escort->start_date;
        $end_date = $escort->end_date;
        $total_rate = null;
        $above_day = null;
        // $days = $request->days;
        $days = Carbon::parse($escort->end_date)->diffInDays(Carbon::parse($escort->start_date))+1;
        if($days !== null && $days <= 21) {
            //$rate = $days*30/days;
            $total_rate = $days*30;
            
        } else {
            $above_day = $days - 21;
            $rate = ($above_day*28.5 + 21*30)/$days;
            $total_rate = ($above_day*28.5 +630);
            
        }
        $data = [];
        $data = [
            'start_date' => $start_date,
            'end_date' => $end_date,
            'days' => $days,
            'Amount' => $total_rate,
            "CurrencyCode" => "AUD",
            "MerchantReference" => "123",
            "MerchantHomepageURL" => route('home'),
            // "SuccessURL" =>  route('center.update.profile',$escort->id),
            "SuccessURL" =>  route('center.poly.paymentUrl.status.success'),
            "FailureURL" => route('center.poly.paymentUrl.status.success'),
            "CancellationURL" => route('center.poly.paymentUrl.status.success'),
            "NotificationURL" => route('center.poly.paymentUrl.status.success'), 
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
        //$header = header('Location: '.$json['NavigateURL']);
         //return response()->json(compact('json'));
        // return response()->json(compact('json','header'));
        return redirect($json['NavigateURL']);


    }
    public function successUrl(Request $request) {
        
        //dd($request->token);
        $token = $request->token;
        
        // if(is_null($token)) {
        //     $token = $_GET["token"];
        // }
        
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
        // if($json['TransactionStatusCode'] == "Completed") {
        //     $msg = "Your Transaction Successfully";
        // } elseif($json['TransactionStatusCode'] == "Cancelled") {
        //     $msg = "Your Transaction Cancelled ";
        // }
        // dd($json);
        //dd($json['TransactionStatusCode']);
 
        //print_r($json);
        session()->flash('message',"Your Transaction ".$json['TransactionStatusCode']);
        return redirect()->back();
                    
    }
   
}