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
        Schema::create('account_notifications_setting', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable()->unique();
            $table->boolean('is_adviser_alert_notification_on')->default(true)->comment('0 => No, 1 => Yes');
            $table->json('adviser_alert_notification_setting')->nullable();
            $table->boolean('is_escort_alert_notification_on')->default(true)->comment('0 => No, 1 => Yes');
            $table->json('escort_alert_notification_setting')->nullable();
            $table->json('two_fa_authentication')->nullable();
            $table->boolean('direct_chat_with_adviser')->default(true)->comment('0 => No, 1 => Yes');
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
        Schema::dropIfExists('account_notifications_setting');
    }
};
