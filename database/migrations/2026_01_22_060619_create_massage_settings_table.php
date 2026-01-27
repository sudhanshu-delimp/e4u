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
        Schema::create('massage_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable()->unique();
            $table->string('features_viewer_notifications_forward_v_alerts')->nullable()->default('1');
            $table->enum('features_allow_viewers_to_ask_you_a_question', ['0', '1'])->nullable()->default('1');
            $table->enum('features_allow_viewers_to_send_you_a_text_message', ['0', '1'])->nullable()->default('1');
            $table->enum('auto_recharge_no', ['0', '1'])->nullable()->default('0');
            $table->enum('auto_recharge_500', ['0', '1'])->nullable()->default('0');
            $table->enum('auto_recharge_1000', ['0', '1'])->nullable()->default('0');
            $table->enum('auto_recharge_1500', ['0', '1'])->nullable()->default('0');
            $table->enum('agent_receive_communications', ['0', '1'])->nullable()->default('0');
            $table->enum('agent_send_communications', ['0', '1'])->nullable()->default('0');
            $table->enum('alert_notification_email', ['0', '1'])->nullable()->default('0')->comment('1 => ON, 0 => Off');
            $table->enum('alert_notification_text', ['0', '1'])->nullable()->default('1')->comment('1 => ON, 0 => Off');
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
        Schema::dropIfExists('massage_settings');
    }
};
