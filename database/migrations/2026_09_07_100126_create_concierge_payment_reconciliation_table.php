<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConciergePaymentReconciliationTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('concierge_payment_reconciliation', function (Blueprint $table) {
      $table->id();
      $table->string('bill_generated_date')->nullable();
      $table->string('bill_start_date')->nullable();
      $table->string('bill_end_date')->nullable();
      $table->string('service')->nullable();
      $table->decimal('gross_sale_amount', 10, 2)->default(0);
      $table->decimal('supplier_amount', 10, 2)->default(0);
      $table->decimal('e4u_earning', 10, 2)->default(0);
      $table->string('status')->default('pending');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('concierge_payment_reconciliation');
  }
}
