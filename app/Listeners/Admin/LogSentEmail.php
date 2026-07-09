<?php

namespace App\Listeners\Admin;

use Exception;
use App\Models\EmailLog;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Events\MessageSending;

class LogSentEmail
{
  /**
   * Create the event listener.
   *
   * @return void
   */
  public function __construct()
  {
    //
  }

  /**
   * Handle the event.
   *
   * @param  object  $event
   * @return void
   */
  public function handle(MessageSending $event)
  {
    $message = $event->message;
    try {
      $body = $message->getBody();
      $toEmail = $message->getTo();
      $memberId = User::where('email', array_keys($toEmail ?? []))->select('member_id')->first();
      if (is_object($body)) {
        $body = (string) $body;
      }

      $subject = $message->getSubject();
      Log::info($subject);
      if (preg_match('/Member ID:\s*([A-Za-z0-9]+)\s*\|\s*Order Ref:\s*#?(\d+)/', $subject, $matches)) {

        $memberId = $matches[1];
        $orderRef = ltrim($matches[2], '0');

        $orderRef = $orderRef === '' ? 0 : $orderRef;
        Log::info($orderRef);
        EmailLog::where('id', $orderRef)->update([
          'to' => json_encode(array_keys($message->getTo() ?? [])),
          'cc' => json_encode(array_keys($message->getCc() ?? [])),
          'bcc' => json_encode(array_keys($message->getBcc() ?? [])),
          'subject' => $message->getSubject(),
          'body' => (string) $message->getBody(),
          'sent_at' => now(),
        ]);

        return;
      } else {
        // EmailLog::create([
        //   'to'       => json_encode(array_keys($message->getTo() ?? [])),
        //   'cc'       => json_encode(array_keys($message->getCc() ?? [])),
        //   'bcc'      => json_encode(array_keys($message->getBcc() ?? [])),
        //   'subject'  => $message->getSubject(),
        //   'body'     => $body,
        //   'member_id' => $memberId->member_id ?? null,
        //   'sent_at'  => now(),
        // ]);
        // return;
      }
    } catch (Exception $e) {

      Log::error('EmailLog Error', [
        'message' => $e->getMessage(),
        'trace' => $e->getTraceAsString(),
      ]);
    }
  }
}
