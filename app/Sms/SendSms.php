<?php
namespace App\Sms;
use  App\Sms\Provider\MessageMedia;

class SendSms {
    public function send($phone,$text) {
        $send = new MessageMedia();
       
        return $send->sendMessages($phone, $text);
    }
}