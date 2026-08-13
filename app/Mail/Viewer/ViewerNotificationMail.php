<?php

namespace App\Mail\Viewer;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ViewerNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function build()
    {

         return $this->subject('Profile Listing Notification')
        ->view('emails.viewer.viewer-profile-notification')
        ->with($this->data);

        
    }
}
