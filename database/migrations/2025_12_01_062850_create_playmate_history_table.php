<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaymateHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playmate_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('escort_id');
            $table->unsignedBigInteger('playmate_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->index('escort_id');
            $table->index('playmate_id');
            $table->index('user_id');

            $table->foreign('escort_id')->references('id')->on('escorts')->onDelete('cascade');
            $table->foreign('playmate_id')->references('id')->on('escorts')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unique(['escort_id', 'playmate_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('playmate_history');
    }
}
