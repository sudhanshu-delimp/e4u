<?php

namespace App\Jobs;

use App\Mail\Viewer\ViewerNotificationMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class SendViewerNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $email;
    public $data;

    public function __construct($email, array $data)
    {
        $this->email = $email;
        $this->data = $data;
    }

    public function handle(): void
    {
        try {

            Mail::to($this->email)
                ->send(new ViewerNotificationMail($this->data));

        } catch (Throwable $e) {
            Log::error('SendViewerNotificationJob failed.', [
                'email' => $this->email,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
            throw $e;
        }
    }
}
