<?php

namespace App\Http\Controllers\Center;

use App\Http\Controllers\Controller;
use App\Models\PaymentHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MassageCenterDashboardController extends Controller
{

  public function dashboard()
  {

    $fyStart = Carbon::create(now()->month >= 7 ? now()->year : now()->year - 1, 7, 1)->startOfDay();

    $userId = auth()->id();
    $now = now();
    $nowCopy = $now->copy();
    // current weekday and month 
    $weekStart = $nowCopy->startOfWeek(Carbon::MONDAY);
    $monthStart = $nowCopy->startOfMonth();

    // Previous Year Comparison
    $lastWeekStart = $weekStart->copy()->subYear();
    $lastWeekEnd   = $nowCopy->subYear();
    $lastMonthStart = $monthStart->copy()->subYear();
    $lastMonthEnd   = $nowCopy->subYear();

    $lastFyStart = $fyStart->copy()->subYear();
    $lastFyEnd   = $nowCopy->subYear();

    // Advertising Services
    $advertisingServices = collect(config('payment_mail_templates'))->pluck('service_title')->toArray();
    $otherServices = ['Email Account', 'Product Purchase',  'Mobile SIM',  'Support E4U'];

    // other services
    $services = ['otherYear' => $otherServices,    'mobile_sim'    => ['Mobile SIM'], 'email' => ['Email Account'], 'supporte4u' => ['Support E4U'],  'productAmount' => ['Product Purchase']];

    $totals = [];

    foreach ($services as $key => $service)
      $totals[$key] = $this->calculateSumOfService($service, $fyStart, $now, $userId);

    $data['otherServices'] = ['email_account' => $totals['email'], 'mobile_sim' => $totals['mobile_sim'], 'product' => $totals['productAmount'], 'support' => $totals['supporte4u'], 'year_to_date_total' => $totals['otherYear']];

    // Advertising 
    // week day record
    $periods = [
      'week_to_date'                  => [$weekStart, $now],
      'same_week_period_last_year'    => [$lastWeekStart, $lastWeekEnd],
      'month_to_date'                 => [$monthStart, $now],
      'same_month_period_last_year'   => [$lastMonthStart, $lastMonthEnd],
      'year_to_date'                  => [$fyStart, $now],
      'same_year_period_last_year'    => [$lastFyStart, $lastFyEnd],
    ];

    $data['advertiseServices'] = [];

    foreach ($periods as $key => [$start, $end])
      $data['advertiseServices'][$key] = $this->calculateSumOfService($advertisingServices,   $start,  $end,  $userId);

    return view('center.dashboard.our-spend', compact('data'));
  }

  private function calculateSumOfService(array $services, object $from, string $to, int $userId)
  {

    DB::enableQueryLog();
    $amount = PaymentHistory::where('user_id', $userId)
      ->where('status', 'success')
      ->whereBetween('paid_at', [$from, $to])
      ->whereIn('service', $services)->sum(DB::raw('amount + gst_amount + delivery_charge'));
    dd(DB::getQueryLog());
    return $amount;
  }

  // public function dashboard()
  // {

  //   $fyStart = Carbon::create(now()->month >= 7 ? now()->year : now()->year - 1, 7, 1)->startOfDay();

  //   $userId = auth()->id();
  //   $now = now();
  //   $nowCopy = $now->copy();
  //   // current weekday and month 
  //   $weekStart = $nowCopy->startOfWeek(Carbon::MONDAY);
  //   $monthStart = $nowCopy->startOfMonth();

  //   // Previous Year Comparison
  //   $lastWeekStart = $weekStart->copy()->subYear();
  //   $lastWeekEnd   = $nowCopy->subYear();
  //   $lastMonthStart = $monthStart->copy()->subYear();
  //   $lastMonthEnd   = $nowCopy->subYear();

  //   $lastFyStart = $fyStart->copy()->subYear();
  //   $lastFyEnd   = $nowCopy->subYear();


  //   // Advertising Services
  //   $advertisingServices = [
  //     'Listing',
  //     'Profile Listing',
  //     'Profile Pin Up',
  //     'Profile Bump Up',
  //     'Profile Extend',
  //     'Profile Upgrade',
  //   ];


  //   $otherServices = [
  //     'Email Account',
  //     'Product Purchase',
  //     'Mobile SIM',
  //     'Support E4U'
  //   ];

  //   // other services
  //   $otherYear = $this->calculateSumOfService($otherServices, $fyStart, $now, $userId);
  //   $mobile_sim = $this->calculateSumOfService(['Mobile SIM'], $fyStart, $now, $userId);
  //   $email = $this->calculateSumOfService(['Email Account'], $fyStart, $now, $userId);
  //   $supporte4u = $this->calculateSumOfService(['Support E4U'], $fyStart, $now, $userId);
  //   $productAmount = $this->calculateSumOfService(['Product Purchase'], $fyStart, $now, $userId);


  //   $data['otherServices'] = ['email_account' => $email, 'mobile_sim' => $mobile_sim, 'product' => $productAmount, 'support' => $supporte4u, 'year_to_date_total' => $otherYear];

  //   // Advertising 
  //   // week day record
  //   $advertisingWeek      = $this->calculateSumOfService($advertisingServices, $weekStart, $now, $userId);
  //   $advertisingWeekLast  = $this->calculateSumOfService($advertisingServices, $lastWeekStart, $lastWeekEnd, $userId);

  //   // month record
  //   $advertisingMonth     = $this->calculateSumOfService($advertisingServices, $monthStart, $now, $userId);
  //   $advertisingMonthLast = $this->calculateSumOfService($advertisingServices, $lastMonthStart, $lastMonthEnd, $userId);

  //   // yearly record
  //   $advertisingYear      = $this->calculateSumOfService($advertisingServices, $fyStart, $now, $userId);
  //   $advertisingYearLast  = $this->calculateSumOfService($advertisingServices, $lastFyStart, $lastFyEnd, $userId);
  //   $data['advertiseServices'] = ['week_to_date' => $advertisingWeek, 'same_week_period_last_year' => $advertisingWeekLast, 'month_to_date' => $advertisingMonth, 'same_month_period_last_year' => $advertisingMonthLast, 'year_to_date' => $advertisingYear, 'same_year_period_last_year' => $advertisingYearLast];

  //   return view('center.dashboard.our-spend', compact('data'));
  // }
}
