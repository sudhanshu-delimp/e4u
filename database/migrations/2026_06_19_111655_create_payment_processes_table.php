<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_processes', function (Blueprint $table) {
            $table->id();

            // unique reference sent to payment gateway metadata
            $table->uuid('token')->unique();

            // payment gateway transaction id (after payment)
            $table->string('payment_id')->nullable();

            // store encrypted checkout/payment data
            $table->longText('payload');

            // pending, completed, failed
            $table->string('status')->default('pending');

            // optional: keep payment type/reference
            $table->string('type')->nullable();

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
        Schema::dropIfExists('payment_processes');
    }
}
