<?php

namespace App\Mail\Supplier;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
class ApprovalEmail extends Mailable
{
    use Queueable, SerializesModels;
    public  $body;

    public function __construct($body)
    {
         $this->body = $body;
    }

    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
                ->subject('Supplier Approval Notification') 
                ->markdown('emails.supplier.approval_email')
                ->with('supplier', $this->body);
    }
}
