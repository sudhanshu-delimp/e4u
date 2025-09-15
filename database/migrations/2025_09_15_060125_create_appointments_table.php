<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('advertiser_id')->index();
            $table->date('date'); //Appointment date
            $table->time('time'); // Appointment time
            $table->string('address')->nullable();
            $table->decimal('lat',10,7)->nullable(); //latitude
            $table->decimal('long',10,7)->nullable(); // longitude
            $table->enum('source', ['database', 'referral', 'cold'])->default('database');
            $table->enum('importance', ['high', 'medium', 'low'])->default('medium');
            $table->enum('status', ['in_progress', 'comleted', 'cancelled', 'rescheduled'])->default('in_progress');
            $table->text('summary')->nullable();
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
}
