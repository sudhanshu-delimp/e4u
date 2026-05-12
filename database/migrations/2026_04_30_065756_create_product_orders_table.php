<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductOrdersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('product_orders', function (Blueprint $table) {
      $table->id();
      $table->string('order_id')->nullable();
      $table->string('transaction_id')->nullable();
      $table->string('delivery_type')->nullable();
      $table->string('type')->nullable();
      $table->unsignedBigInteger('user_id')->nullable();
      $table->dateTime('order_date');
      $table->enum('order_status', ['pending', 'shipped', 'delivered', 'cancelled'])->default('pending')->comment(
        'pending=Order created, shipped=Assigned/processing, delivered=Completed, cancelled=Order cancelled'
      );
      $table->enum('payment_status', ['pending', 'paid', 'failed', 'cancelled'])->default('pending')->comment(
        'pending=Awaiting payment,  paid=Payment captured,failed=Payment Failed, cancelled=Payment failed/cancelled'
      );;
      $table->string('payment_method')->nullable();
      $table->decimal('sub_total', 10, 2)->default(0);
      $table->decimal('total_amount', 10, 2)->default(0);
      $table->decimal('tax_amount', 10, 2)->default(0);
      $table->decimal('wallet_amount', 10, 2)->default(0);
      $table->decimal('delivery_charges', 10, 2)->default(0);
      $table->string('notes')->nullable();
      $table->string('payment_message')->nullable();
      $table->timestamps();

      $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('product_orders');
  }
}
