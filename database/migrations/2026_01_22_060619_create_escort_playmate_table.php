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
        Schema::create('escort_playmate', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('escort_id');
            $table->unsignedBigInteger('playmate_id')->index('escort_playmate_playmate_id_foreign');
            $table->timestamps();

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
};
