<?php

namespace App\Listeners\Escort;

use App\Events\EscortRegister;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\RegisterEscort\RegisterEmailForAdmin;

class RegisterListenerForAdmin implements ShouldQueue
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
     * @param  \App\Events\EscortRegister  $event
     * @return void
     */

    public function handle(EscortRegister $event)
    {
        
        $user = $event->escort;
        $ccEmail = config('common.contactus_cc_email'); // or any variable
        Mail::to(config('common.contactus_admin_email'))
            ->when(!empty($ccEmail), function ($mail) use ($ccEmail) {
                $mail->cc($ccEmail);
            })
            ->send(new RegisterEmailForAdmin($user));
		
    }
}
