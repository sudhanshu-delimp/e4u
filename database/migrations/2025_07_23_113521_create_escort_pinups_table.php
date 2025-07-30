<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEscortPinupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escort_pinups', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('escort_id')->nullable();
            $table->integer('state_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->dateTime('utc_start_time');
            $table->dateTime('utc_end_time');
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
        Schema::dropIfExists('escort_pinups');
    }
}
