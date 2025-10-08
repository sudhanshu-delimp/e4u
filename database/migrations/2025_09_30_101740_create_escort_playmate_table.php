<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEscortPlaymateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escort_playmate', function (Blueprint $table) {
            $table->id();
            // Escort who is adding playmates
            $table->unsignedBigInteger('escort_id');
            // Playmate (also an escort)
            $table->unsignedBigInteger('playmate_id');
            $table->timestamps();
            // Foreign keys to escorts table
            $table->foreign('escort_id')->references('id')->on('escorts')->onDelete('cascade');
            $table->foreign('playmate_id')->references('id')->on('escorts')->onDelete('cascade');
            // Unique constraint to avoid duplicates
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
        Schema::dropIfExists('escort_playmate');
    }
}
