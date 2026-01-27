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
        Schema::create('agent_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable()->unique();
            $table->enum('direct_chatting_with_advertisers', ['0', '1'])->nullable()->default('1')->comment('1 => ON, 0 => Off');
            $table->enum('advertiser_email', ['0', '1'])->nullable()->default('0')->comment('1 => ON, 0 => Off');
            $table->enum('advertiser_text', ['0', '1'])->nullable()->default('1')->comment('1 => ON, 0 => Off');
            $table->enum('escort_email', ['0', '1'])->nullable()->default('0')->comment('1 => ON, 0 => Off');
            $table->enum('escort_text', ['0', '1'])->nullable()->default('1')->comment('1 => ON, 0 => Off');
            $table->enum('call', ['0', '1'])->nullable()->default('0')->comment('1 => ON, 0 => Off');
            $table->enum('idle_preference_time', ['15', '30', '60'])->nullable()->default('60');
            $table->enum('twofa', ['1', '2'])->nullable()->default('2')->comment('1 => Email, 2=> Text');
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
        Schema::dropIfExists('agent_settings');
    }
};
