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
        Schema::create('report_escort_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('escort_id');
            $table->integer('viewer_id')->comment('its user id of viewer');
            $table->string('report_tag')->nullable();
            $table->text('report_desc')->nullable();
            $table->integer('admin_id')->nullable();
            $table->string('report_status')->default('pending')->comment('status can be pending, approrved or unapproved by admin');
            $table->text('action_message')->nullable()->comment('reason of unapproved etc - action taken by admin');
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
        Schema::dropIfExists('report_escort_profiles');
    }
};
