<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMassageSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('massage_settings', function (Blueprint $table) {
        
            $table->id();
            $table->unsignedBigInteger('user_id')->unique()->nullable();

            $table->enum('features_viewer_notifications_forward-v-alerts', ['0','1'])->default('1')->nullable();
            $table->enum('features_allow_viewers_to_ask_you_a_question', ['0','1'])->default('1')->nullable();
            $table->enum('features_allow_viewers_to_send_you_a_text_message', ['0','1'])->default('1')->nullable();

            $table->enum('auto_recharge_no', ['0','1'])->default('0')->nullable();
            $table->enum('auto_recharge_500', ['0','1'])->default('0')->nullable();
            $table->enum('auto_recharge_1000', ['0','1'])->default('0')->nullable();
            $table->enum('auto_recharge_1500', ['0','1'])->default('0')->nullable();

            $table->enum('agent_receive_communications', ['0','1'])->default('0')->nullable();
            $table->enum('agent_send_communications', ['0','1'])->default('0')->nullable();
           
            $table->enum('alert_notification_email', ['0','1'])->default('0')->nullable()->comment('1 => ON, 0 => Off');;
            $table->enum('alert_notification_text', ['0','1'])->default('1')->nullable()->comment('1 => ON, 0 => Off');;
           
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
        Schema::dropIfExists('massage_settings');
    }
}
