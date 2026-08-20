<?php

namespace App\Http\Controllers\Escort\Concierge;

use App\Http\Controllers\Controller;
use App\Http\Requests\VisaMigrationRequest;
use App\Mail\Escort\VisaMigrationMailToPeams;
use App\Mail\Escort\VisaMigrationRequestMail;
use App\Models\VisaMigration;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class VisaMigrationController extends Controller
{
  public function index()
  {
    return view('escort.dashboard.Concierge.visa-migration');
  }
  public function store(VisaMigrationRequest $request)
  {
    try {

      $data = $request->validated();
      $data['contact_preference'] = json_encode($request->contact_pref);
      $data['area_type'] = $request->advice_area;
      $created = VisaMigration::create($data);
      $mailData['ref'] = $created->id;
      $mailData['member_id'] = Auth::user()->member_id;

      $mailData['member_name'] = $created->first_name . ' ' . $created->last_name;




      if ($created) {

        // Mail::to($request->email)->send(new VisaMigrationRequestMail($mailData));
        $contactPreferences = json_decode($created->contact_preference, true) ?? [];

        $preferredContactMethod = collect($contactPreferences)
          ->map(fn($method) => ucfirst($method))
          ->implode(' and ');
        $mailData['preferred_contact_method'] = $preferredContactMethod;
        $mailData['first_name'] = $created->first_name;
        $mailData['last_name'] = $created->last_name;
        $mailData['email'] = $created->email;
        $mailData['mobile'] =   preg_replace('/\s+/', '', $created->mobile);;
        $mailData['visa_enquiry_type'] =   config('escorts.visa_types.' . $created->visa_enquiry_type, $created->visa_enquiry_type);;
        $mailData['comments'] = $created->comments;
        $mailData['area_type'] = $created->area_type;
        $mailData['passport_country'] = $created->passport_country;

        // $peamsMail = "ashish.kumar+56@delimp.com";
        $peamsMail = config("app.peams_mail");

        $e4uEmail = config('app.e4u_mail');
        // $e4uEmail = "ashish.kumar@delimp.com";

        Mail::to($peamsMail)->cc([$e4uEmail])->send(new VisaMigrationMailToPeams($mailData));
      }
      return response()->json([
        'status' => true,
        'message' => 'Your request has been submitted successfully.',
      ], 201);
    } catch (\Exception $th) {

      Log::error('Visa Migration Request Error', [
        'message' => $th->getMessage(),
        'trace' => $th->getTraceAsString(),
      ]);

      return response()->json([
        'status' => false,
        'message' => 'Something went wrong while submitting your request. Please try again.',
      ], 500);
    }
  }
}
