<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_settings', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('user_id')->unique()->nullable();

            
            $table->enum('direct_chatting_with_advertisers', ['0','1'])->default('1')->nullable()->comment('1 => ON, 0 => Off');

            $table->enum('advertiser_email', ['0','1'])->default('0')->nullable()->comment('1 => ON, 0 => Off');
            $table->enum('advertiser_text', ['0','1'])->default('1')->nullable()->comment('1 => ON, 0 => Off');
           
            $table->enum('escort_email', ['0','1'])->default('0')->nullable()->comment('1 => ON, 0 => Off');
            $table->enum('escort_text', ['0','1'])->default('1')->nullable()->comment('1 => ON, 0 => Off');
            $table->enum('call', ['0','1'])->default('0')->nullable()->comment('1 => ON, 0 => Off');;
           
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
        Schema::dropIfExists('agent_settings');
    }
}
