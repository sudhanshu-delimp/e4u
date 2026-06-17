<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddTrackingIdToProductOrdersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up(): void
  {
    Schema::table('product_orders', function (Blueprint $table) {
      $table->string('tracking_id')->nullable()->after('transaction_id');
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
            COMMENT 'pending=Order created, hold=Order on hold, shipped=Assigned/processing, delivered=Completed, cancelled=Order cancelled, returned=Order returned'
        ");
    });
  }

  public function down(): void
  {
    Schema::table('product_orders', function (Blueprint $table) {
      $table->dropColumn('tracking_id');
      DB::statement("
            ALTER TABLE product_orders
            MODIFY COLUMN order_status ENUM(
                'pending',
                'shipped',
                'delivered',
                'cancelled'
            ) NOT NULL DEFAULT 'pending'
            COMMENT 'pending=Order created, shipped=Assigned/processing, delivered=Completed, cancelled=Order cancelled'
        ");
    });
  }
}
