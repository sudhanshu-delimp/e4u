<?php
namespace App\Sms\Provider;

use Illuminate\Support\Facades\Log;
use MessageMediaMessagesLib\Models;
use MessageMediaMessagesLib\Exceptions;
use MessageMediaMessagesLib\MessageMediaMessagesClient;

Class MessageMedia 
{
    // public function sendMessages($phone,$msg) 
    // {
    //     $authUserName = config('constants.sms_api.key');
    //     $authPassword = config('constants.sms_api.secret');

    //    if(!$authUserName || !$authPassword) return true;
    //     /* You can change this to true when the above keys are HMAC */
    //     //dd($authUserName);
    //     $useHmacAuthentication = false;
    //     $client = new MessageMediaMessagesClient($authUserName, $authPassword, $useHmacAuthentication);

    //     $messagesController = $client->getMessages();

    //     $body = new Models\SendMessagesRequest;
    //     $body->messages = array();

    //     $body->messages[0] = new Models\Message;
    //     $body->messages[0]->content = $msg;
    //     //$body->messages[0]->content = 'Hi, this is test msg';
    //     $arr = substr($phone,0,1);
    //     if( $arr == 0) {
    //         $mobile = ltrim($phone,0);
    //     } else {
    //         $mobile = $phone;
    //     }
       
    //     $body->messages[0]->destinationNumber = "+61".$mobile;
        
    //     //$body->messages[0]->destinationNumber  = '+61475821841';

    //     try {
    //         $result = $messagesController->sendMessages($body);
    //         Log::channel('sms-log')->info(print_r($result, true));
    //         //dd($result);
    //         return $result;
    //         //print_r($result);
    //     } catch (Exceptions\SendMessages400Response $e) {
    //         Log::channel('sms-log')->info($e->getMessage());
    //         //dd($e->getMessage());
    //         return $e->getMessage();
    //         // echo 'Caught SendMessages400Response: ',  $e->getMessage(), "\n";
    //     } catch (MessageMediaMessagesLib\APIException $e) {
    //         Log::channel('sms-log')->info($e->getMessage());
    //         //dd($e->getMessage());
    //         return $e->getMessage();
    //         // echo 'Caught APIException: ',  $e->getMessage(), "\n";
    //     }
    // }

    public function sendMessages($phone, $text_message)
{
    try {

        $authUserName = config('constants.sms_api.key');
        $authPassword = config('constants.sms_api.secret');

        /*
         * Remove spaces, brackets, hyphens and any
         * other non-numeric characters.
         */
        $phone = preg_replace('/\D/', '', $phone);

        /*
         * Convert Australian number to international format.
         *
         * 0418812228      -> +61418812228
         * 04 1881 2228    -> +61418812228
         * 61418812228     -> +61418812228
         * +61418812228    -> +61418812228
         */

        if (str_starts_with($phone, '61')) {

            // Already has Australia country code
            $phone = '+' . $phone;

        } elseif (str_starts_with($phone, '0')) {

            // Australian local number
            // Remove leading 0 and add +61
            $phone = '+61' . substr($phone, 1);

        } else {

            // Assume Australian number without country code
            $phone = '+61' . $phone;
        }

        Log::info('SMS destination number', [
            'phone' => $phone,
        ]);

        $client = new MessageMediaMessagesClient(
            $authUserName,
            $authPassword,
            false
        );

        $messagesController = $client->getMessages();

        $body = new Models\SendMessagesRequest();
        $body->messages = [];

        $message = new Models\Message();

        $message->content = $text_message;
        $message->destinationNumber = $phone;

        $body->messages[] = $message;

        Log::info('Sending SMS', [
            'destination' => $phone,
        ]);

        $result = $messagesController->sendMessages($body);

        Log::info('MessageMedia SMS API response', [
            'response' => $result,
            'destination' => $phone,
        ]);

        return $result;

    } catch (\Exception $e) {

    Log::error('MessageMedia SMS API Error', [
        'message' => $e->getMessage(),
        'code' => $e->getCode(),
        'file' => $e->getFile(),
        'line' => $e->getLine(),
        'phone' => $phone ?? null,
        'trace' => $e->getTraceAsString(),
    ]);

    logErrorLocal($e);

    return false;
}
}
    
}