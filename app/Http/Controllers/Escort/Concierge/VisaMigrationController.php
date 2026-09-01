<?php

namespace App\Http\Controllers\Escort\Concierge;

use App\Http\Controllers\Controller;
use App\Http\Requests\VisaMigrationRequest;
use App\Mail\Escort\VisaMigrationMailToPeams;
use App\Mail\Escort\VisaMigrationRequestMail;
use App\Models\VisaMigration;
use App\Services\VisaMigrationService;
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
  public function store(VisaMigrationRequest $request, VisaMigrationService $visaMigrationService)
  {
    try {

      $data = $request->validated();
      $data['contact_preference'] = json_encode($request->contact_pref);
      $data['area_type'] = $request->advice_area;
      $data['user_id'] = Auth::user()->id;
      $created = VisaMigration::create($data);
      $mailData['ref'] = $created->id;
      $mailData['member_id'] = Auth::user()->member_id;

      $mailData['member_name'] = !empty($created->first_name) ? $created->first_name . " " . $created->last_name : Auth::user()->name;
      $mailData['console'] = "EC";

      if ($created) {
        $response =   $visaMigrationService->sendEmailToPeams($created, $mailData);
        if ($response) {
          return response()->json([
            'status' => true,
            'message' => 'Your request has been submitted successfully.',
          ], 200);
        } else {
          return response()->json([
            'status' => false,
            'message' => 'Unable to send the email to PEAMS & E4U. Please check the recipient email addresses and try again.',
          ], 419);
        }
      }
    } catch (\Exception $th) {

      return response()->json([
        'status' => false,
        'message' => $th->getMessage(),
      ], 419);
    }
  }
}
