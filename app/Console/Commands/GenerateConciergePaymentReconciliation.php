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
        . $billStartDate->format('d-m-Y')
        . " to "
        . $billEndDate->format('d-m-Y')
    );

    /*
        |--------------------------------------------------------------------------
        | Prevent Duplicate Report
        |--------------------------------------------------------------------------
        */

    $alreadyGenerated = ConciergePaymentReconciliation::where(
      'bill_start_date',
      $billStartDate->format('d-m-Y')
    )
      ->where(
        'bill_end_date',
        $billEndDate->format('d-m-Y')
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

    $orders = ProductOrder::with(['paymentDetails', 'user'])
      // $orders = ProductOrder::query()
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
      return (float) $order->paymentDetails->total_payable_amount;
    });

    $supplierAmount = $orders->sum(function ($order) {
      return (float) $order->paymentDetails->amount;
    });

    /*
         * Change this calculation according to your
         * actual supplier payment/business rules.
         */

    $e4uEarning = $grossSaleAmount - $supplierAmount;

    /*
        |--------------------------------------------------------------------------
        | Insert Reconciliation
        |--------------------------------------------------------------------------
        */

    ConciergePaymentReconciliation::create([
      'bill_generated_date' => Carbon::now()->format('d-m-Y H:i:s'),

      'bill_start_date' => $billStartDate->format('d-m-Y'),

      'bill_end_date' => $billEndDate->format('d-m-Y'),

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
