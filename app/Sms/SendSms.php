<?php
namespace App\Sms;
use  App\Sms\Provider\MessageMedia;
use Exception;
use Illuminate\Support\Facades\Log;

class SendSms {
    
    
    public function send($phone,$text) {
        $send = new MessageMedia();
        return true;
       
         //return $send->sendMessages($phone, $text);
    }


public function send_otp_sms($phone, $text)
{
    try {

        $send = new MessageMedia();

        return $send->sendMessages($phone, $text);

    } catch (\Exception $e) {

        Log::error('OTP SMS Error', [
            'message' => $e->getMessage(),
        ]);

        logErrorLocal($e);

        return false;
    }
} 
}