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
        Schema::create('escort_brb', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('profile_id');
            $table->date('date_set');
            $table->dateTime('selected_time')->nullable();
            $table->dateTime('brb_time');
            $table->text('brb_note');
            $table->char('active', 1)->default('Y');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('escort_brb');
    }
};
