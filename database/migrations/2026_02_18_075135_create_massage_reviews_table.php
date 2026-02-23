<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMassageReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('massage_reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('massage_id');
            $table->longText('description')->nullable();
            $table->tinyInteger('star_rating')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'published', 'suspended'])->nullable()->default('pending');
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
        Schema::dropIfExists('massage_reviews');
    }
}
