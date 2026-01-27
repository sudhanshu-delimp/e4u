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
        Schema::create('viewer_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable()->unique();
            $table->unsignedBigInteger('user_type')->nullable();
            $table->enum('advertiser_email', ['0', '1'])->nullable()->default('0')->comment('1 => ON, 0 => Off');
            $table->enum('advertiser_text', ['0', '1'])->nullable()->default('1')->comment('1 => ON, 0 => Off');
            $table->enum('escort_email', ['0', '1'])->nullable()->default('0')->comment('1 => ON, 0 => Off');
            $table->enum('escort_text', ['0', '1'])->nullable()->default('1')->comment('1 => ON, 0 => Off');
            $table->enum('idle_preference_time', ['15', '30', '60'])->nullable()->default('60');
            $table->enum('twofa', ['1', '2'])->nullable()->default('2')->comment('1 => Email, 2=> Text');
            $table->enum('features_push_notifications_from_escorts', ['0', '1'])->nullable()->default('1');
            $table->enum('features_direct_chatting_with_escorts', ['0', '1'])->nullable()->default('1');
            $table->enum('features_write_reviews', ['0', '1'])->nullable()->default('1');
            $table->enum('features_enable_my_legbox', ['0', '1'])->nullable()->default('1');
            $table->enum('features_enable_my_notebox', ['0', '1'])->nullable()->default('1');
            $table->enum('listings_preferences_view', ['1', '2'])->nullable()->default('1')->comment('1 => Grid View, 2=> List View');
            $table->enum('interests_with_male', ['0', '1'])->nullable()->default('1');
            $table->enum('interests_with_female', ['0', '1'])->nullable()->default('1');
            $table->enum('interests_with_trans', ['0', '1'])->nullable()->default('1');
            $table->enum('interests_with_cross_dresser', ['0', '1'])->nullable()->default('1');
            $table->enum('interests_with_couples', ['0', '1'])->nullable()->default('1');
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
};
