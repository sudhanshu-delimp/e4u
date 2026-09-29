<?php

namespace App\Http\Controllers\Center\Concierge;

use App\Http\Controllers\Controller;
use App\Http\Requests\VisaMigrationMcRequest;
use App\Http\Requests\VisaMigrationRequest;
use App\Models\VisaMigration;
use App\Services\VisaMigrationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class VisaMigrationController extends Controller
{
  public function index()
  {
    return view('center.dashboard.Concierge.visa');
  }
  public function store(VisaMigrationMcRequest  $request, VisaMigrationService $visaMigrationService)
  {
    try {

      $data = $request->validated();
      $data['contact_preference'] = json_encode($request->contact_pref);
      $data['area_type'] = $request->advice_area;
      $data['user_id'] = Auth::user()->id;
      $created = VisaMigration::create($data);
      $mailData['ref'] = $created->id;
      $mailData['member_id'] = Auth::user()->member_id;

      $mailData['member_name'] = $created->business_name ? $created->business_name : Auth::user()->name;
      $mailData['console'] = "MC";

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
