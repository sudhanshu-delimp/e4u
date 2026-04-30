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
      $table->unsignedBigInteger('user_id')->nullable();
      $table->dateTime('order_date');
      $table->enum('order_status', ['pending', 'paid', 'shipped', 'delivered', 'canceled'])->default('pending')->comment(
        'pending=Order created, paid=Payment done, shipped=Assigned/processing, delivered=Completed, canceled=Order canceled'
      );
      $table->enum('payment_status', ['pending', 'confirmed', 'completed', 'cancelled'])->default('pending')->comment(
        'pending=Awaiting payment, confirmed=Payment verified, completed=Payment captured, cancelled=Payment failed/cancelled'
      );;
      $table->string('payment_method')->nullable();
      $table->decimal('total_amount', 10, 2)->default(0);
      $table->decimal('tax_amount', 10, 2)->default(0);
      $table->decimal('wallet_amount', 10, 2)->default(0);
      $table->decimal('delivery_charges', 10, 2)->default(0);
      $table->string('notes')->nullable();
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
