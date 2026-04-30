<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderAddressesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('order_addresses', function (Blueprint $table) {
      $table->unsignedBigInteger('order_id');
      $table->enum('type', ['billing', 'shipping']);
      $table->string('phone', 20);
      $table->string('email', 100);
      $table->string('address_line1', 255);
      $table->string('address_line2', 255)->nullable();
      $table->string('city', 100);
      $table->string('state', 100);
      $table->string('country', 100)->nullable();
      $table->string('pincode', 20);
      $table->string('landmark', 255)->nullable();
      $table->timestamps();

      // FK
      $table->foreign('order_id')->references('id')->on('product_orders')->onDelete('cascade');

    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('order_addresses');
  }
}
