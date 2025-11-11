<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('heading');
            $table->enum('type', ['adhoc', 'scheduled', 'notice'])->default('adhoc');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('member_id')->nullable(); 
            $table->enum('recurring_type', ['weekly', 'monthly', 'yearly', 'forever'])->nullable(); 
            $table->tinyInteger('start_day')->nullable();
            $table->tinyInteger('end_day')->nullable();
            $table->tinyInteger('start_month')->nullable(); 
            $table->tinyInteger('end_month')->nullable();
            $table->integer('num_recurring')->nullable();
            $table->text('content')->nullable();
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
        Schema::dropIfExists('agent_notifications');
    }
}
