<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEscortStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escort_statistics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('escort_id')->nullable();
            $table->date('date')->nullable();
            $table->unsignedBigInteger('profile_views_count')->default(0);
            $table->unsignedBigInteger('media_views_count')->default(0);
            $table->unsignedBigInteger('playbox_views_count')->default(0);
            $table->unsignedBigInteger('reviews_count')->default(0);
            $table->unsignedBigInteger('recommendation_count')->default(0)->comment('Number of recommendations received by like and reviews logged in users - waynes');
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
        Schema::dropIfExists('escort_statistics');
    }
}
