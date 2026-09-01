<?php

namespace App\Services;

use App\Mail\Escort\VisaMigrationMailToPeams;
use App\Mail\Escort\VisaMigrationRequestMail;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class VisaMigrationService
{

  public function sendEmailToPeams(object $visaMigration, array $mailData)
  {
    try {

      Mail::to(Auth::user()->email)->send(new VisaMigrationRequestMail($mailData));
      $contactPreferences = json_decode($visaMigration->contact_preference, true) ?? [];

      $preferredContactMethod = collect($contactPreferences)
        ->map(fn($method) => ucfirst($method))
        ->implode(' and ');
      $mailData['preferred_contact_method'] = $preferredContactMethod;
      $mailData['email'] = $visaMigration->email;

      $mailData['mobile'] =   preg_replace('/\s+/', '', $visaMigration->mobile);;
      $mailData['visa_enquiry_type'] =   config('escorts.visa_types.' . $visaMigration->visa_enquiry_type, $visaMigration->visa_enquiry_type);;
      $mailData['comments'] = $visaMigration->comments;
      $mailData['area_type'] = $visaMigration->area_type;
      $mailData['passport_country'] = $visaMigration->passport_country;
      if ($mailData['console'] == 'EC') {
        $mailData['first_name'] = $visaMigration->first_name;
        $mailData['last_name'] = $visaMigration->last_name;
      } else {
        $mailData['business_name'] = $visaMigration->business_name ?? '';
      }
      // $peamsMail = "ashish.kumar+56@delimp.com";
      $peamsMail = config("app.peams_mail");

      $e4uEmail = config('app.e4u_mail');
      // $e4uEmail = "ashish.kumar@delimp.com";

      Mail::to($peamsMail)->cc([$e4uEmail])->send(new VisaMigrationMailToPeams($mailData));
      return true;
    } catch (Exception $e) {
      Log::info("visa migration service " . $e->getMessage());
      return false;
    }
  }
}
