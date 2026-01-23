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
        Schema::create('viewer_notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('current_day')->nullable();
            $table->string('heading');
            $table->enum('type', ['Ad hoc', 'Scheduled', 'Notice', 'Template'])->default('Ad hoc');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('member_id')->nullable();
            $table->enum('recurring_type', ['weekly', 'monthly', 'yearly', 'forever'])->nullable();
            $table->tinyInteger('start_day')->nullable();
            $table->tinyInteger('end_day')->nullable();
            $table->tinyInteger('start_month')->nullable();
            $table->tinyInteger('end_month')->nullable();
            $table->integer('num_recurring')->nullable();
            $table->text('content')->nullable();
            $table->string('template_name')->nullable();
            $table->enum('status', ['Published', 'Completed', 'Suspended', 'Removed'])->default('Published');
            $table->text('scheduled_days')->nullable();
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
        Schema::dropIfExists('viewer_notifications');
    }
};
