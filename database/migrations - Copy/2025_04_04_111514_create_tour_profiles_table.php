<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_location_id')->constrained('tour_locations')->onDelete('cascade');
            $table->foreignId('escort_id')->constrained('escorts')->onDelete('cascade');
            $table->integer('tour_plan')->nullable(); // Changed from string to integer
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
}
