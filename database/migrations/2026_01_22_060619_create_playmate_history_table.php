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
        Schema::create('playmate_history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('escort_id')->index();
            $table->unsignedBigInteger('playmate_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->enum('is_deleted', ['0', '1'])->default('0');
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
        Schema::dropIfExists('playmate_history');
    }
};
