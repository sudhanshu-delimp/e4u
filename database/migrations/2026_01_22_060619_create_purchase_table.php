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
        Schema::create('purchase', function (Blueprint $table) {
            $table->integer('id', true);
            $table->unsignedBigInteger('tour_location_id')->nullable();
            $table->integer('escort_id');
            $table->integer('membership');
            $table->date('start_date');
            $table->dateTime('utc_start_time')->nullable();
            $table->date('end_date');
            $table->dateTime('utc_end_time')->nullable();
            $table->enum('status', ['pending', 'listed', 'expire'])->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase');
    }
};
