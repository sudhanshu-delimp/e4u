<?php

namespace App\Http\Controllers\Escort\Concierge;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmailHostingRequest;
use App\Models\EmailHostingRequest as ModelsEmailHostingRequest;
use App\Models\EscortBankDetail;
use App\Models\FeesConciergeService;
use App\Services\EmailHostingService;
use App\Services\VisaMigrationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EmailAccountRequestController extends Controller
{
  public function index()
  {
    return view('escort.dashboard.Concierge.email-hosting');
  }
  public function store(EmailHostingRequest $request, EmailHostingService $emailHostingService)
  {
    try {

      $data = $request->validated();
      // dd($data);
      $data['contact_preference'] = json_encode($request->contact_pref);
      $data['user_id'] = Auth::user()->id;
      $data['auth'] = $request->boolean('auth');
      $data['term_condition'] = $request->boolean('term_condition');
      $created = ModelsEmailHostingRequest::create($data);
      $mailData['ref'] = $created->id;
      $mailData['member_id'] = Auth::user()->member_id;

      $mailData['member_name'] = !empty($created->first_name) ? $created->first_name . " " . $created->last_name : Auth::user()->name;
      $mailData['console'] = "EC";

      if ($created) {
        $response =   $emailHostingService->sendEmailToPeams($created, $mailData);
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

  public function paymentSummary(Request $request)
  {
    // $request->validate([
    //     'duration' => 'required|integer|min:1|max:24',
    // ]);

    try {
      $user = auth()->user();

      $duration =   4;


      $monthlyFee =  FeesConciergeService::where('service_type', 'Email Account')->value('amount');
      $amountDueToday = $monthlyFee;
      $totalSubscriptionCost = $monthlyFee * $duration;
      $bankDetails = EscortBankDetail::where('user_id', auth()->user()->id)->first();


      return response()->json([
        'success' => true,
        'currency_symbol' => '$',
        'monthly_fee' => number_format($monthlyFee, 2),
        'duration' => $duration,
        'total_subscription_cost' => number_format($totalSubscriptionCost, 2),
        'amount_due_today' => number_format($amountDueToday, 2),
        'account_details' => $bankDetails,
      ]);
    } catch (\Exception $e) {

      Log::error('Email hosting payment summary error', [
        'user_id' => auth()->id(),
        'error' => $e->getMessage(),
      ]);

      return response()->json([
        'success' => false,
        'message' => 'Unable to load payment summary. Please try again.',
      ], 500);
    }
  }
}
