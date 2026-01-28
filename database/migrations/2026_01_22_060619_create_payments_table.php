<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('plan_type');
            $table->string('PaymentAmount');
            $table->string('AmountPaid');
            $table->integer('user_id');
            $table->integer('tour_id')->nullable();
            $table->string('user_type');
            $table->string('referenceId');
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
        Schema::dropIfExists('payments');
    }
};
