<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PasswordSecurity;
use App\Models\User;
use Carbon\Carbon;
use App\Sms\SendSms;
use Auth;

class PasswordSecurityReset extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'resetPassword';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //return 0;
        $arr = [];
        $passwordData = PasswordSecurity::all();
        $mytime = Carbon::now();//->format('Y-m-d');
        foreach($passwordData as $key=>$data) {


            if($data->password_expiry_days != 0) {
                $days = Carbon::parse($mytime)->diffInDays(Carbon::parse($data->password_updated_at));

                $arr += ['exp'=>$data->password_expiry_days,'day'=>$days];
                if($data->password_expiry_days < $days) {
                $user = User::find($data->user_id);
                $user->password = null;
                $user->save();


                $arr +=  ["msg"=>"password reset"];

                }
                $espiryDay = $data->password_expiry_days - 1;
                if($espiryDay == $days) {
                $user = User::find($data->user_id);

                // $user->save();
                //2fa send msg
                $msg = "Your E4U password will expire in 1 day. Change your password now.";
                $sendotp = new SendSms();
                $output = $sendotp->send($user->phone,$msg);
                }
            }
            //dd($arr);
            // echo "today==".$mytime."</br>";
            // echo "endday==".Carbon::parse($data->password_updated_at)."</br>";
            // echo "days==".$days."</br>";
        }

    }
}
