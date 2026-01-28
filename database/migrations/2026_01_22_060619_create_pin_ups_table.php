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
        Schema::create('pin_ups', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('state_id');
            $table->integer('user_id');
            $table->integer('escort_id');
            $table->date('week_start');
            $table->decimal('payment_amount', 5);
            $table->dateTime('payment_date');
            $table->string('payment_status', 50)->default('Failed');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pin_ups');
    }
};
