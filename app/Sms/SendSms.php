<?php
namespace App\Sms;
use Exception;
use  App\Sms\Provider\MessageMedia;

class SendSms {
    
    
    public function send($phone,$text) {
        $send = new MessageMedia();
        return true;
       
         //return $send->sendMessages($phone, $text);
    }


    public function send_otp_sms($phone,$text) 
    {
        try 
        {
            $send = new MessageMedia();
            return $send->sendMessages($phone, $text);
        } 
        catch (Exception $e) {
            logErrorLocal($e);
        }
    }
}