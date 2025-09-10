<?php
namespace App\Sms;
use  App\Sms\Provider\MessageMedia;

class SendSms {
    public function send($phone,$text) {
<<<<<<< HEAD

        return true;
       // $send = new MessageMedia();
       // return $send->sendMessages($phone, $text);
=======
        $send = new MessageMedia();
        return true;
       
         //return $send->sendMessages($phone, $text);
>>>>>>> 9fd996d5dbf8e4b85ea1defefbf40dd28cde915a
    }
}