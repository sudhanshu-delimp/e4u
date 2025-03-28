<?php
namespace App\Sms\Provider;
use MessageMediaMessagesLib\Models;
use MessageMediaMessagesLib\Exceptions;
use MessageMediaMessagesLib\MessageMediaMessagesClient;
use Illuminate\Support\Facades\Log;

Class MessageMedia 
{
    public function sendMessages($phone,$msg) {
        $authUserName = env('SMS_API_KEY');
        $authPassword = env('SMS_API_SECRET');

       if(!$authUserName || !$authPassword) return true;
        /* You can change this to true when the above keys are HMAC */
        //dd($authUserName);
        $useHmacAuthentication = false;
        $client = new MessageMediaMessagesClient($authUserName, $authPassword, $useHmacAuthentication);

        $messagesController = $client->getMessages();

        $body = new Models\SendMessagesRequest;
        $body->messages = array();

        $body->messages[0] = new Models\Message;
        $body->messages[0]->content = $msg;
        //$body->messages[0]->content = 'Hi, this is test msg';
        $arr = substr($phone,0,1);
        if( $arr == 0) {
            $mobile = ltrim($phone,0);
        } else {
            $mobile = $phone;
        }
       
        $body->messages[0]->destinationNumber = "+61".$mobile;
        
        //$body->messages[0]->destinationNumber  = '+61475821841';

        try {
            $result = $messagesController->sendMessages($body);
            Log::channel('sms-log')->info(print_r($result, true));
            //dd($result);
            return $result;
            //print_r($result);
        } catch (Exceptions\SendMessages400Response $e) {
            Log::channel('sms-log')->info($e->getMessage());
            //dd($e->getMessage());
            return $e->getMessage();
            // echo 'Caught SendMessages400Response: ',  $e->getMessage(), "\n";
        } catch (MessageMediaMessagesLib\APIException $e) {
            Log::channel('sms-log')->info($e->getMessage());
            //dd($e->getMessage());
            return $e->getMessage();
            // echo 'Caught APIException: ',  $e->getMessage(), "\n";
        }
    }
    
}