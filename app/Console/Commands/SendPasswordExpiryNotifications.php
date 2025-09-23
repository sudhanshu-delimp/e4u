<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use App\Sms\SendSms;
use Illuminate\Console\Command;
use App\Models\PasswordSecurity;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendPasswordExpiryReminderMail;

class SendPasswordExpiryNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'passwords:send-expiry-notices';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send password expiry reminders (5 days and 1 day before expiry)';

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
    public function handle(): int
    {

        $users = User::whereHas('account_setting')->get();

        
        $reminderCount = 0;
        $today = Carbon::today('UTC');

        foreach ($users as $user) {
            $setting = $user->account_setting;

            if (!$setting || !$setting->password_updated_date || !$setting->password_expiry_days) {
                continue; 
            }



            $passwordUpdatedDate = Carbon::parse($setting->password_updated_date);
            $expiryDays = (int) $setting->password_expiry_days;

           
            $expiryDate = $passwordUpdatedDate->copy()->addDays($expiryDays);

            // Calculate reminder dates
            $reminder1 = $expiryDate->copy()->subDays(1);
            $reminder5 = $expiryDate->copy()->subDays(5);
            

           
            if ($today->isSameDay($reminder5)) {
                $this->notifyUser($user, 5, $expiryDate);
                $reminderCount++;
            }

             if ($today->isSameDay($reminder1)) {
                $this->notifyUser($user, 1, $expiryDate);
                $reminderCount++;
            }
        }


        $this->info("Password expiry reminders sent: {$reminderCount}");
        return Command::SUCCESS;
    }


    private function notifyUser($user, int $daysLeft, Carbon $expiryDate): void
    {

        if (!$user) {
            return;
        }

        $setting = $user->account_setting;
        
        if( $setting->is_text_notificaion_on=='1')
        $this->sendSms($user, $daysLeft, $expiryDate);

        if( $setting->is_email_notificaion_on=='1')
        $this->sendEmail($user, $daysLeft, $expiryDate);

    }


    private function sendEmail($user, int $daysLeft, Carbon $expiryDate): void
    {

        Log::info('sendEmail');
        Log::info($expiryDate);
        
        try {
            Mail::to($user->email)->queue(new SendPasswordExpiryReminderMail($user, $daysLeft, $expiryDate));
        } catch (\Throwable $e) {
            Log::error("Failed to send expiry email", ['user_id' => $user->id, 'error' => $e->getMessage()]);
        }
    }


    private function sendSms($user, int $daysLeft, Carbon $expiryDate): void
    {
        try {
            $sms =  new SendSms();

            $message = "Hi {$user->name}, your password will expire in {$daysLeft} day(s) " . "on " . $expiryDate->format('d M Y');
            $sms->send($user->phone, $message);
        } catch (\Throwable $e) {
            Log::error("Failed to send expiry SMS", ['user_id' => $user->id, 'error' => $e->getMessage()]);
        }
    }
}
