<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEscortAccountSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escort_account_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');

            // JSON fields for multi-value settings
            $table->json('notification_feature')->nullable();     // e.g. ["viewer_notification"]
            $table->json('agent_communications')->nullable();     // e.g. ["receive","send"]
            $table->json('alert_notifications')->nullable();      // e.g. ["email","text"]

            // Single-value settings
            $table->string('auto_recharge_option')->default('no'); // e.g. "100"
            $table->integer('idle_time')->nullable();                // e.g. 15 (minutes)
            $table->string('auth')->nullable();                      // e.g. "2"
            $table->string('num')->nullable();                       // e.g. "NUM"
            $table->string('subscription')->nullable();      
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
        Schema::dropIfExists('escort_account_settings');
    }
}
