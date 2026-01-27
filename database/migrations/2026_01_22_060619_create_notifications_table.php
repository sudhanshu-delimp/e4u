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
        Schema::create('notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->mediumText('title');
            $table->longText('message')->nullable();
            $table->unsignedBigInteger('from_user')->nullable();
            $table->integer('to_user');
            $table->enum('user_type', ['0', '1', '2', '3', '4', '5'])->nullable()->comment('0=>user; 1=>admin; 2=>sub-admin; 3=>escort; 4=>massage-center; 5=>agents');
            $table->string('ref_number_id', 50)->nullable()->default('NULL')->comment('Refer to support ticket reference Number');
            $table->enum('notification_listing_type', ['1', '2'])->comment('1-Support Ticket,2-Alert Center');
            $table->mediumText('notification_icon')->nullable();
            $table->enum('notification_type', ['general', 'agent_accept', 'agent_follow_up', 'support_ticket', 'legbox_notification'])->default('general');
            $table->integer('is_seen')->default(0);
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
        Schema::dropIfExists('notifications');
    }
};
