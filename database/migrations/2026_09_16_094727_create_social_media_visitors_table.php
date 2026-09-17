<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialMediaVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_media_visitors', function (Blueprint $table) {

            $table->id();
            $table->enum('user_type', ['guest', 'user'])->default('guest');
            $table->unsignedBigInteger('listing_profile_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('visitorUuid')->nullable();
            $table->mediumText('social_link')->nullable();
            $table->string('ip_address');
            $table->string('page')->nullable();
            $table->string('platform')->nullable();
            $table->string('device')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('landed')->nullable();
            $table->string('idle')->nullable();
            $table->string('origin')->nullable();
            $table->dateTime('date')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('social_media_visitors');
    }
}
