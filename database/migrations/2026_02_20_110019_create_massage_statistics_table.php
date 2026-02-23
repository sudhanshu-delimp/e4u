<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMassageStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('massage_statistics', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('massage_id')->nullable();

            $table->date('date')->nullable();

            $table->unsignedBigInteger('profile_views_count')->default(0);
            $table->unsignedBigInteger('media_views_count')->default(0);
            $table->unsignedBigInteger('playbox_views_count')->default(0);
            $table->unsignedBigInteger('reviews_count')->default(0);

            $table->unsignedBigInteger('recommendation_count')
                  ->default(0)
                  ->comment('Number of recommendations received by like and reviews logged in users');

            $table->timestamps();

            // Optional Foreign Keys (agar tables exist karti hain)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('massage_id')->references('id')->on('massage_profiles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('massage_statistics');
    }
}
