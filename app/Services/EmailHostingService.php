<?php

namespace App\Services;

use App\Mail\EmailHostingRequestMail;
use App\Mail\Escort\VisaMigrationMailToPeams;
use App\Mail\Escort\VisaMigrationRequestMail;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmailHostingService
{

  public function sendEmailToPeams(object $emailHosting, array $mailData)
  {
    try {

      Mail::to($emailHosting->email)->send(new EmailHostingRequestMail($mailData));
      $contactPreferences = json_decode($emailHosting->contact_preference, true) ?? [];

      $preferredContactMethod = collect($contactPreferences)
        ->map(fn($method) => ucfirst($method))
        ->implode(' and ');
      $mailData['preferred_contact_method'] = $preferredContactMethod;
      $mailData['email'] = $emailHosting->email;

      $mailData['mobile'] =   preg_replace('/\s+/', '', $emailHosting->mobile);;
      $mailData['comments'] = $emailHosting->comments;
      if ($mailData['console'] == 'EC') {
        $mailData['first_name'] = $emailHosting->first_name;
        $mailData['last_name'] = $emailHosting->last_name;
      }  

      $e4uEmail = config('app.e4u_mail') ? [config('app.e4u_mail')] : [];
      // $e4uEmail = "ashish.kumar@delimp.com";

      Mail::to($e4uEmail)->send(new VisaMigrationMailToPeams($mailData));
      return true;
    } catch (Exception $e) {
      Log::info("visa migration service " . $e->getMessage());
      return false;
    }
  }
}
