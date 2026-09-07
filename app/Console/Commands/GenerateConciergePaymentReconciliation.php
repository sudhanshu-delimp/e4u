<?php

namespace App\Console\Commands;

use App\Models\ConciergePaymentReconciliation;
use App\Models\ProductOrder;
use Carbon\Carbon;
use Illuminate\Console\Command;

class GenerateConciergePaymentReconciliation extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'concierge:generate-reconciliation';


  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Generate monthly concierge payment reconciliation report';

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

  public function handle()
  {
    /*
        |--------------------------------------------------------------------------
        | Previous Month
        |--------------------------------------------------------------------------
        */

    $reportMonth = Carbon::now()
      ->subMonth()
      ->startOfMonth();

    $billStartDate = $reportMonth->copy()->startOfMonth();
    $billEndDate   = $reportMonth->copy()->endOfMonth();

    $this->info(
      "Generating reconciliation for: "
        . $billStartDate->format('Y-m-d')
        . " to "
        . $billEndDate->format('Y-m-d')
    );

    /*
        |--------------------------------------------------------------------------
        | Prevent Duplicate Report
        |--------------------------------------------------------------------------
        */

    $alreadyGenerated = ConciergePaymentReconciliation::where(
      'bill_start_date',
      $billStartDate->format('Y-m-d')
    )
      ->where(
        'bill_end_date',
        $billEndDate->format('Y-m-d')
      )
      ->exists();

    if ($alreadyGenerated) {

      $this->warn('Reconciliation already generated for this month.');

      return Command::SUCCESS;
    }

    /*
        |--------------------------------------------------------------------------
        | Get Product Orders
        |--------------------------------------------------------------------------
        */

    $orders = ProductOrder::query()
      ->whereBetween('order_date', [
        $billStartDate->copy()->startOfDay(),
        $billEndDate->copy()->endOfDay(),
      ])
      ->where('payment_status', 'paid')
      ->where('order_status', 'delivered')
      ->get();

    if ($orders->isEmpty()) {

      $this->warn('No orders found for this billing period.');

      return Command::SUCCESS;
    }

    /*
        |--------------------------------------------------------------------------
        | Calculate Amounts
        |--------------------------------------------------------------------------
        */

    $grossSaleAmount = $orders->sum(function ($order) {
      return (float) $order->total_amount;
    });

    /*
         * Change this calculation according to your
         * actual supplier payment/business rules.
         */
    $supplierAmount = $orders->sum(function ($order) {
      return (float) $order->sub_total;
    });

    $e4uEarning = $grossSaleAmount - $supplierAmount;

    /*
        |--------------------------------------------------------------------------
        | Insert Reconciliation
        |--------------------------------------------------------------------------
        */

    ConciergePaymentReconciliation::create([
      'bill_generated_date' => Carbon::now()->format('Y-m-d H:i:s'),

      'bill_start_date' => $billStartDate->format('Y-m-d'),

      'bill_end_date' => $billEndDate->format('Y-m-d'),

      'service' => 'Concierge',

      'gross_sale_amount' => $grossSaleAmount,

      'supplier_amount' => $supplierAmount,

      'e4u_earning' => $e4uEarning,

      'status' => 'pending',
    ]);

    $this->info('Reconciliation generated successfully.');

    $this->info(
      'Gross Sale: ' . number_format($grossSaleAmount, 2)
    );

    $this->info(
      'Supplier Amount: ' . number_format($supplierAmount, 2)
    );

    $this->info(
      'E4U Earning: ' . number_format($e4uEarning, 2)
    );

    return Command::SUCCESS;
  }
}
