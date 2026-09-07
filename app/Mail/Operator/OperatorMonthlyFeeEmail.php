<?php

namespace App\Mail\Operator;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OperatorMonthlyFeeEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public  $body;

    public function __construct($body)
    {
        $this->body = $body;
    }


    public function build()
    {
        return $this->from(config('mail.from.address'))
            ->subject('Operator Monthly Fee Report')
            ->markdown('emails.operator.operator_monthly_fee')
            ->with('operator', $this->body);
    }
}
