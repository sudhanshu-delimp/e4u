<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddRejectedStatusToProductOrdersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('product_orders', function (Blueprint $table) {
      $table->text('reject_reason')->nullable()->after('order_status');
    });

    DB::statement("
        ALTER TABLE product_orders
        MODIFY COLUMN order_status ENUM(
            'pending',
            'hold',
            'shipped',
            'delivered',
            'cancelled',
            'returned',
            'rejected'
        ) NOT NULL DEFAULT 'pending'
        COMMENT 'pending=Order created, hold=Order on hold, shipped=Assigned/processing, delivered=Completed, cancelled=Order cancelled, returned=Order returned, rejected=Order rejected'
    ");
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('product_orders', function (Blueprint $table) {
      $table->dropColumn('reject_reason');
    });

    DB::statement("
        ALTER TABLE product_orders
        MODIFY COLUMN order_status ENUM(
            'pending',
            'hold',
            'shipped',
            'delivered',
            'cancelled',
            'returned'
        ) NOT NULL DEFAULT 'pending'
    ");
  }
}
