<?php

namespace App\Listeners\Admin;

use Exception;
use App\Models\EmailLog;
use Illuminate\Support\Facades\Log;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
    public function handle(MessageSent $event)
    {
        $message = $event->message;
        try {
            $body = $message->getBody();

            if (is_object($body)) {
                $body = (string) $body;
            }
            EmailLog::create([
                'to'       => json_encode(array_keys($message->getTo() ?? [])),
                'cc'       => json_encode(array_keys($message->getCc() ?? [])),
                'bcc'      => json_encode(array_keys($message->getBcc() ?? [])),
                'subject'  => $message->getSubject(),
                'body'     => $body,
                'sent_at'  => now(),
            ]);
        } catch (Exception $e) {

            Log::error('EmailLog Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }
}
