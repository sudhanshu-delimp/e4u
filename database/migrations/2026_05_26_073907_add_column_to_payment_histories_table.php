<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToPaymentHistoriesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('payment_histories', function (Blueprint $table) {
      $table->decimal('delivery_charge', 10, 2)
        ->default(0.00)
        ->after('gst_amount');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('payment_histories', function (Blueprint $table) {
      $table->dropColumn([
        'delivery_charge'
      ]);
    });
  }
}
