<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCancelledByAndCancelReasonToProductOrdersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('product_orders', function (Blueprint $table) {
      $table->unsignedBigInteger('cancelled_by')->nullable()->after('updated_by');
      $table->text('cancel_reason')->nullable()->after('cancelled_by');
      $table->foreign('cancelled_by')->references('id')->on('users')->nullOnDelete();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('product_orders', function (Blueprint $table) {
      $table->dropForeign(['cancelled_by']);
      $table->dropColumn(['cancelled_by', 'cancel_reason']);
    });
  }
}
