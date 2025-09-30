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
       
        Schema::create('viewer_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique()->nullable();
            $table->unsignedBigInteger('user_type')->nullable();

            $table->enum('advertiser_email', ['0','1'])->default('0')->nullable()->comment('1 => ON, 0 => Off');;
            $table->enum('advertiser_text', ['0','1'])->default('1')->nullable()->comment('1 => ON, 0 => Off');;
           

            $table->enum('escort_email', ['0','1'])->default('0')->nullable()->comment('1 => ON, 0 => Off');;
            $table->enum('escort_text', ['0','1'])->default('1')->nullable()->comment('1 => ON, 0 => Off');;
           
            $table->enum('idle_preference_time', ['15','30','60'])->default('60')->nullable();
            $table->enum('twofa', ['1','2'])->default('2')->nullable()->comment('1 => Email, 2=> Text');

            $table->enum('features_push_notifications_from_escorts', ['0','1'])->default('1')->nullable();
            $table->enum('features_direct_chatting_with_escorts', ['0','1'])->default('1')->nullable();
            $table->enum('features_write_reviews', ['0','1'])->default('1')->nullable();
            $table->enum('features_enable_my_legbox', ['0','1'])->default('1')->nullable();
            $table->enum('features_enable_my_notebox', ['0','1'])->default('1')->nullable();

            $table->enum('listings_preferences_view', ['1','2'])->default('1')->nullable()->comment('1 => Grid View, 2=> List View');

            $table->enum('interests_with_male', ['0','1'])->default('1')->nullable();
            $table->enum('interests_with_female', ['0','1'])->default('1')->nullable();
            $table->enum('interests_with_trans', ['0','1'])->default('1')->nullable();
            $table->enum('interests_with_cross_dresser', ['0','1'])->default('1')->nullable();
            $table->enum('interests_with_couples', ['0','1'])->default('1')->nullable();



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
        Schema::dropIfExists('viewer_settings');
    }
}
