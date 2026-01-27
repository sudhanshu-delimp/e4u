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
        Schema::create('availability', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('escort_id');
            $table->time('monday_from')->nullable();
            $table->time('monday_to')->nullable();
            $table->time('tuesday_from')->nullable();
            $table->time('tuesday_to')->nullable();
            $table->time('wednesday_from')->nullable();
            $table->time('wednesday_to')->nullable();
            $table->time('thursday_from')->nullable();
            $table->time('thursday_to')->nullable();
            $table->time('friday_from')->nullable();
            $table->time('friday_to')->nullable();
            $table->time('saturday_from')->nullable();
            $table->time('saturday_to')->nullable();
            $table->time('sunday_from')->nullable();
            $table->time('sunday_to')->nullable();
            $table->timestamps();
            $table->longText('availability_time')->nullable()->comment('1=>Unavialable; 2=>By Appointment; 3=>Available 24 hours
            ');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('availability');
    }
};
