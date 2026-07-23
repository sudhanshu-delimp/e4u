<?php

namespace App\Http\Controllers\Center;

use App\Http\Controllers\Controller;
use App\Models\PaymentHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MassageCenterDashboardController extends Controller
{
  //


  public function dashboard()
  {

    $query = PaymentHistory::where('status', 'success')->where('service', 'Product Purchase')->where('user_id', auth()->id());
    $productAmount = $query->sum(DB::raw('amount + gst_amount + delivery_charge'));
    $fyStart = Carbon::create(now()->month >= 7 ? now()->year : now()->year - 1, 7, 1)->startOfDay();

    $userId = auth()->id();
    $now = now();

    $weekStart = $now->copy()->startOfWeek(Carbon::MONDAY);
    $monthStart = $now->copy()->startOfMonth();

    // Previous Year Comparison
    $lastWeekStart = $weekStart->copy()->subYear();
    $lastWeekEnd   = $now->copy()->subYear();
    $lastMonthStart = $monthStart->copy()->subYear();
    $lastMonthEnd   = $now->copy()->subYear();

    $lastFyStart = $fyStart->copy()->subYear();
    $lastFyEnd   = $now->copy()->subYear();


    // Advertising Services
    $advertisingServices = [
      'Listing',
      'Profile Listing',
      'Profile Pin Up',
      'Profile Bump Up',
      'Profile Extend',
      'Profile Upgrade',
    ];


    $otherServices = [
      'Email Account',
      'Product Purchase',
      'Mobile SIM',
      'Support E4U'
    ];

    // other services
    $otherYear = $this->calculateSumOfService($otherServices, $fyStart, $now, $userId);
    $mobile_sim = $this->calculateSumOfService(['Mobile SIM'], $fyStart, $now, $userId);
    $email = $this->calculateSumOfService(['Email Account'], $fyStart, $now, $userId);
    $supporte4u = $this->calculateSumOfService(['Support E4U'], $fyStart, $now, $userId);
    $data['otherServices'] = ['email_account' => $email, 'mobile_sim' => $mobile_sim, 'product' => $productAmount, 'support' => $supporte4u, 'year_to_date_total' => $otherYear];

    // Advertising 
    // week day record
    $advertisingWeek      = $this->calculateSumOfService($advertisingServices, $weekStart, $now, $userId);
    $advertisingWeekLast  = $this->calculateSumOfService($advertisingServices, $lastWeekStart, $lastWeekEnd, $userId);

    // month record
    $advertisingMonth     = $this->calculateSumOfService($advertisingServices, $monthStart, $now, $userId);
    $advertisingMonthLast = $this->calculateSumOfService($advertisingServices, $lastMonthStart, $lastMonthEnd, $userId);

    // yearly record
    $advertisingYear      = $this->calculateSumOfService($advertisingServices, $fyStart, $now, $userId);
    $advertisingYearLast  = $this->calculateSumOfService($advertisingServices, $lastFyStart, $lastFyEnd, $userId);
    $data['advertiseServices'] = ['week_to_date' => $advertisingWeek, 'same_week_period_last_year' => $advertisingWeekLast, 'month_to_date' => $advertisingMonth, 'same_month_period_last_year' => $advertisingMonthLast, 'year_to_date' => $advertisingYear, 'same_year_period_last_year' => $advertisingYearLast];


    return view('center.dashboard.our-spend', compact('data'));
  }

  private function calculateSumOfService(array $services, object $from, string $to, int $userId)
  {
    $amount = PaymentHistory::where('user_id', $userId)
      ->where('status', 'success')
      ->whereBetween('paid_at', [$from, $to])
      ->whereIn('service', $services)->sum(DB::raw('amount + gst_amount + delivery_charge'));
    return $amount;
  }
}
