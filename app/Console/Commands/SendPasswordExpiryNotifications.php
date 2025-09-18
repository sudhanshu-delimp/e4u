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


        $now = Carbon::now('UTC')->startOfDay();

        $securities = PasswordSecurity::query()
            ->with('user')
            ->where('password_expiry_days', '>', 0)
            ->get();

        $sent = 0;

        foreach ($securities as $sec) {
            if (!$sec->password_updated_at) {
                continue;
            }

            //password null when user expire

            $days = Carbon::parse($now)->diffInDays(Carbon::parse($sec->password_updated_at)->startOfDay());
            
            // if ($sec->password_expiry_days < $days) {
            //     $user = User::find($sec->user_id);
            //     $user->password = null;
            //     $user->save();
            // }


            $updated = Carbon::parse($sec->password_updated_at)->startOfDay();
            $expiryDate = $updated->copy()->addDays($sec->password_expiry_days);

            if ($expiryDate->isSameDay(now()->addDays(1))) {
                $this->notifyUser($sec, 1, $expiryDate);
                $sent++;
            }

            if ($expiryDate->isSameDay(now()->addDays(5))) {
                $this->notifyUser($sec, 5, $expiryDate);
                $sent++;
            }
        }

        $this->info("Password expiry reminders sent: {$sent}");
        return Command::SUCCESS;
    }


    private function notifyUser($sec, int $daysLeft, Carbon $expiryDate): void
    {

        $user = $sec->user;
        if (!$user) {
            return;
        }

        // Notification preferences parse karo
        $modes = is_string($sec->password_notification) ? json_decode($sec->password_notification) : (is_array($sec->password_notification) ? $sec->password_notification : []);


        foreach ($modes as $mode) {

            if ($mode == "2") {
                $this->sendEmail($user, $daysLeft, $expiryDate);
            }
            if ($mode == "1") {
                $this->sendSms($user, $daysLeft, $expiryDate);
            }
        }
    }


    private function sendEmail($user, int $daysLeft, Carbon $expiryDate): void
    {
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
