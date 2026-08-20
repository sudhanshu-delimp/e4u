<?php

namespace App\Http\Controllers\Escort\Concierge;

use App\Http\Controllers\Controller;
use App\Http\Requests\VisaMigrationRequest;
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
      $created = VisaMigration::create($data);
      $mailData['ref']=$created->id;
      $mailData['member_id']=Auth::user()->member_id;
      $mailData['member_name']=$request->first_name." ".$request->last_name;
      if ($created) {

        Mail::to($request->email)->send(new VisaMigrationRequestMail($mailData));
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
