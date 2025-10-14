<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Sms\SendSms;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use App\Models\PasswordSecurity;
use App\Sms\Provider\MessageMedia;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendPasswordExpiryReminderMail;

use MessageMediaMessagesLib\Models;
use MessageMediaMessagesLib\Exceptions;
use MessageMediaMessagesLib\MessageMediaMessagesClient;


class DemoController extends Controller
{
    public function sendPasswordExpire(SendSms $sms){

        $records = PasswordSecurity::query()
        ->with('user')
        ->where('password_expiry_days', '>', 0)
        ->where('user_id', 339)
        ->get();

        $mytime = Carbon::now('UTC')->startOfDay();
       

            $sent = 0;

            foreach ($records as $sec) {
                $days = Carbon::parse($mytime)->diffInDays(Carbon::parse($sec->password_updated_at)->startOfDay());
                if($sec->password_expiry_days < $days) {
                    $user = User::find($sec->user_id);
                    $user->password = null;
                    $user->save();
                }
                    
                dd('donme');

                $updated = Carbon::parse($sec->password_updated_at)->startOfDay();
              
                $expiryDate = $updated->copy()->addDays($sec->password_expiry_days);
               // dd($expiryDate);
                if($expiryDate->isSameDay(now()->addDays(1))){ 
                   // dd('working');

                    $modes = is_string($sec->password_notification) ? json_decode($sec->password_notification) : (is_array($sec->password_notification) ? $sec->password_notification : []);
                    dd($modes);
                }
              
    
               
               
            }

        //$this->info("Password expiry notices sent: {$sent}");
        //return Command::SUCCESS;
        
    }


    private function notify(PasswordSecurity $sec, int $days, Carbon $expiryDate, SendSms $sms): void
    {

        $user = $sec->user;
        $channels = json_decode($sec->password_notification, true) ?? [];

        foreach ($channels as $ch) {
            if ($ch == "2") {
                // Email
                Mail::to($user->email)->queue(new SendPasswordExpiryReminderMail($user, $days, $expiryDate));
                Log::info("Password expiry EMAIL queued", ['user_id' => $user->id, 'days' => $days]);
            }

            if ($ch == "1") {
                // SMS
                $text = $this->buildSmsText($user->name, $days, $expiryDate);
                $sms->send($user->phone, $text);
                Log::info("Password expiry SMS sent", ['user_id' => $user->id, 'days' => $days]);
            }
        }
    }


    private function buildSmsText(string $name, int $days, Carbon $expiryDate): string
    {
        $when = $days === 1 ? '24 hours' : "{$days} days";
        $date = $expiryDate->format('d M Y');
        return "Hi {$name}, your password will expire in {$when} (on {$date}). Please update it. - " . config('app.name');
    }

  




    public function checkSmsSend(Request $request)
    {
        // API credentials from .env
        $authUserName = env('SMS_API_KEY');
        $authPassword = env('SMS_API_SECRET');
        $useHmacAuthentication = false; // Usually false unless using HMAC

        // Recipient number and message from request
        $to = '+61480089451';       // Example: '+61491570156'
        $text = 'Hello from Laravel!'; // Example: 'Hello from Laravel!'

        // Initialize client
        $client = new MessageMediaMessagesClient($authUserName, $authPassword, $useHmacAuthentication);
        $messagesController = $client->getMessages();

        // Prepare message
        $body = new Models\SendMessagesRequest();
        $body->messages = [];

        $message = new Models\Message();
        $message->content = $text;
        $message->destinationNumber = $to;

        $body->messages[] = $message;

        try {
            $result = $messagesController->sendMessages($body);

            // Check remaining credits
            $creditsResult = $messagesController->checkCreditsRemaining();

            return response()->json([
                'status' => 'success',
                'response' => $result,
                'remaining_credits' => $creditsResult,
            ]);
        } catch (Exceptions\SendMessages400Response $e) {
            return response()->json([
                'status' => 'error',
                'message' => '400 Error: ' . $e->getMessage()
            ], 400);
        } catch (\MessageMediaMessagesLib\APIException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'API Error: ' . $e->getMessage()
            ], 500);
        }
    }



    public function checkMessageStatus(Request $request)
    {
        // API credentials from .env
        $authUserName = env('SMS_API_KEY');
        $authPassword = env('SMS_API_SECRET');
        $useHmacAuthentication = false;

        // Message ID from request
        $messageId = 'cfdf962c-19b7-4ccf-9692-80789a340c6f';

        // Initialize client
        $client = new MessageMediaMessagesClient($authUserName, $authPassword, $useHmacAuthentication);
        $messagesController = $client->getMessages();

        try {
            // Get message status
            $result = $messagesController->getMessageStatus($messageId);

            return response()->json([
                'status' => 'success',
                'message_status' => $result
            ]);
        } catch (Exceptions\APIException $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }



}
