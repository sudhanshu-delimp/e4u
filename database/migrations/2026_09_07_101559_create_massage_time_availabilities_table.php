<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMassageTimeAvailabilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('massage_time_availabilities', function (Blueprint $table) {
             $table->id();
             $table->unsignedBigInteger('purchase_id')->nullable();
             $table->unsignedBigInteger('masseur_id')->nullable();
             $table->longText('masseur_availibility')->nullable();
             $table->unsignedBigInteger('massage_profile_id')->nullable();   
             $table->longText('massage_availibility')->nullable();
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
        Schema::dropIfExists('massage_time_availabilities');
    }
}
