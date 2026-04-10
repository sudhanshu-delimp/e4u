<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShareholderSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shareholder_settings', function (Blueprint $table) {
             $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index();
            $table->enum('idle_preference_time', ['15', '30', '60', '90', '99999999'])->default('30');
            // Two-factor authentication
            $table->enum('twofa', ['1', '2'])->nullable()->default('1')->comment('1 => Email, 2 => Text');
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
        Schema::dropIfExists('shareholder_settings');
    }
}
