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
        Schema::create('appointments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('advertiser_name')->nullable();
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('address')->nullable();
            $table->decimal('lat', 10, 7)->nullable();
            $table->decimal('long', 10, 7)->nullable();
            $table->enum('source', ['database', 'referral', 'cold'])->default('database');
            $table->enum('importance', ['high', 'medium', 'low'])->default('medium');
            $table->enum('status', ['in_progress', 'over_due', 'completed'])->default('in_progress');
            $table->string('point_of_contact')->nullable();
            $table->string('mobile')->nullable();
            $table->text('summary')->nullable();
            $table->unsignedBigInteger('agent_id')->index();
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
        Schema::dropIfExists('appointments');
    }
};
