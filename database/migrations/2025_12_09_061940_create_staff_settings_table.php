<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateStaffSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('staff_settings', function (Blueprint $table) {
            $table->increments('id');

            // Staff ID (FK)
              $table->integer('user_id')->unsigned();

            // Idle time preference
           $table->enum('idle_preference_time', ['15', '30', '60', '99999999'])
            ->nullable()
            ->default('30');


            // Two-factor authentication
            $table->enum('twofa', ['1', '2'])
                  ->nullable()
                  ->default('1')
                  ->comment('1 => Email, 2 => Text');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('staff_settings');
    }
}
