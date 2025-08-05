<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->mediumText('title');
            $table->longText('message')->nullable();
            $table->integer('to_user');
            $table->enum('notification_listing_type', ['1', '2'])->comment('1-Support Ticket,2-Alert Center');
            $table->mediumText('notification_icon')->nullable();
            $table->enum('notification_type', ['general', 'agent_accept','agent_follow_up'])->default('general');
            $table->integer('is_seen')->default('0');	
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
        Schema::dropIfExists('Notifications');
    }
}
