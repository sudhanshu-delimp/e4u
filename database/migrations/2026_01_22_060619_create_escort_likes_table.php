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
        Schema::create('escort_likes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ip_address', 50)->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('escort_id')->nullable();
            $table->tinyInteger('like')->nullable()->comment('1=> Like, 0=> Dislike');
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
        Schema::dropIfExists('escort_likes');
    }
};
