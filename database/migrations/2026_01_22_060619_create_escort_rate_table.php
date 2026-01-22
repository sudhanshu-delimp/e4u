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
        Schema::create('escort_rate', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('escort_id');
            $table->bigInteger('duration_id');
            $table->integer('massage_price')->nullable();
            $table->integer('incall_price')->nullable();
            $table->integer('outcall_price')->nullable();
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
        Schema::dropIfExists('escort_rate');
    }
};
