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
        Schema::create('nums', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->date('incident_date')->nullable();
            $table->string('incident_state')->nullable();
            $table->string('incident_location')->nullable();
            $table->string('offender_name')->nullable();
            $table->string('offender_mobile', 20)->nullable();
            $table->string('offender_email')->nullable();
            $table->string('incident_nature')->nullable();
            $table->string('platform')->nullable();
            $table->string('profile_link')->nullable();
            $table->text('what_happened')->nullable();
            $table->string('rating')->nullable();
            $table->string('status')->nullable();
            $table->text('admin_action')->nullable();
            $table->unsignedBigInteger('admin_id')->nullable();
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
        Schema::dropIfExists('nums');
    }
};
