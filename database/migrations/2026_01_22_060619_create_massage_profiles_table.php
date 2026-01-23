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
        Schema::create('massage_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('profile_name')->nullable();
            $table->string('business_name')->nullable();
            $table->string('business_no')->nullable();
            $table->mediumText('about_us_box')->nullable();
            $table->longText('address')->nullable();
            $table->longText('about')->nullable();
            $table->string('phone')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->string('city_id')->nullable();
            $table->string('state_id')->nullable();
            $table->tinyInteger('completed')->nullable();
            $table->string('user_id');
            $table->tinyInteger('ambiance')->nullable();
            $table->tinyInteger('parking')->nullable();
            $table->tinyInteger('entry')->nullable();
            $table->tinyInteger('building')->nullable();
            $table->tinyInteger('furniture_types')->nullable();
            $table->tinyInteger('shower')->nullable();
            $table->tinyInteger('security')->nullable();
            $table->tinyInteger('payment')->nullable();
            $table->tinyInteger('loyalty')->nullable();
            $table->text('language')->nullable();
            $table->longText('social_links')->nullable();
            $table->tinyInteger('enabled')->default(1)->comment('0=>disabled; 1=>enabled');
            $table->tinyInteger('default_setting')->default(0);
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
        Schema::dropIfExists('massage_profiles');
    }
};
