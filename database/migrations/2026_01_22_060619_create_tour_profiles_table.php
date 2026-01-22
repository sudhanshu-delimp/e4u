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
        Schema::create('tour_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tour_location_id')->index('tour_profiles_tour_location_id_foreign');
            $table->unsignedBigInteger('escort_id')->index('tour_profiles_escort_id_foreign');
            $table->integer('tour_plan')->nullable();
            $table->integer('is_pinup')->nullable();
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
        Schema::dropIfExists('tour_profiles');
    }
};
