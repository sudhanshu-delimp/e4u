<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserNotificationSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
        Schema::create('viewer_notification_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique()->nullable();
            $table->unsignedBigInteger('user_type')->nullable();

            $table->enum('advertiser_email', ['0','1'])->default('0')->nullable()->comment('1 => ON, 0 => Off');;
            $table->enum('advertiser_text', ['0','1'])->default('1')->nullable()->comment('1 => ON, 0 => Off');;
            $table->enum('is_adviser_notification_on', ['0','1'])->default('1')->nullable()->comment('1 => ON, 0 => Off');;

            $table->enum('escort_email', ['0','1'])->default('0')->nullable()->comment('1 => ON, 0 => Off');;
            $table->enum('escort_text', ['0','1'])->default('1')->nullable()->comment('1 => ON, 0 => Off');;
            $table->enum('is_escort_notification_on', ['0','1'])->default('1')->nullable()->comment('1 => ON, 0 => Off');
            $table->enum('idle_preference_time', ['15','30','60'])->default('60')->nullable();
            $table->enum('twofa', ['1','2'])->default('2')->nullable()->comment('1 => Email, 2=> Text');
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
        Schema::table('user_notification_settings', function (Blueprint $table) {
            //
        });
    }
}
