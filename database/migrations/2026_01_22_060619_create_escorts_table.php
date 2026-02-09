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
        Schema::create('escorts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('purchase_id')->nullable();
            $table->string('user_id', 225);
            $table->string('name')->nullable();
            $table->string('profile_name')->nullable();
            $table->string('title')->nullable();
            $table->string('business_name')->nullable();
            $table->string('business_no')->nullable();
            $table->string('building')->nullable();
            $table->string('parking')->nullable();
            $table->string('entry')->nullable();
            $table->string('furniture_types')->nullable();
            $table->string('shower')->nullable();
            $table->string('ambiance')->nullable();
            $table->string('security')->nullable();
            $table->string('payment')->nullable();
            $table->string('loyalty')->nullable();
            $table->string('duration_id')->nullable();
            $table->mediumText('massage_price')->nullable();
            $table->mediumText('incall_price')->nullable();
            $table->mediumText('outcall_price')->nullable();
            $table->mediumText('availability_time')->nullable();
            $table->longText('about')->nullable();
            $table->text('about_title')->nullable();
            $table->string('phone')->nullable();
            $table->integer('age')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('utc_start_time')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->dateTime('utc_end_time')->nullable();
            $table->string('membership')->nullable();
            $table->tinyInteger('gender')->nullable()->comment('0=>female; 1=>male; 2=>other');
            $table->string('address')->nullable();
            $table->string('city_id')->nullable();
            $table->string('state_id')->nullable();
            $table->integer('pincode')->nullable();
            $table->tinyInteger('completed')->nullable()->default(0)->comment('0=>initiated; 1=>creating; 2=>completed');
            $table->tinyInteger('joined')->nullable();
            $table->longText('social_links')->nullable();
            $table->string('country_id')->nullable();
            $table->integer('nationality_id')->nullable();
            $table->string('statistics')->nullable();
            $table->string('height')->nullable();
            $table->tinyInteger('eyes')->nullable();
            $table->tinyInteger('shaved')->nullable();
            $table->tinyInteger('orientation')->nullable();
            $table->tinyInteger('hair_color')->nullable();
            $table->tinyInteger('skin_tone')->nullable();
            $table->string('breast', 4)->nullable();
            $table->tinyInteger('endowment')->nullable();
            $table->tinyInteger('thickness')->nullable();
            $table->tinyInteger('circumcised')->nullable();
            $table->tinyInteger('butt')->nullable();
            $table->tinyInteger('preference')->nullable();
            $table->tinyInteger('hormones')->nullable();
            $table->tinyInteger('contact')->nullable()->comment('0=>call; 1=>text; 2=>both');
            $table->tinyInteger('ethnicity')->nullable();
            $table->tinyInteger('body_type')->nullable();
            $table->tinyInteger('hair_style')->nullable();
            $table->integer('weight')->nullable();
            $table->integer('dress_size')->nullable();
            $table->text('language')->nullable();
            $table->tinyInteger('piercing')->nullable();
            $table->tinyInteger('drugs')->nullable();
            $table->tinyInteger('travel')->nullable();
            $table->integer('tattoos')->nullable();
            $table->tinyInteger('smoke')->nullable();
            $table->longText('available_to')->nullable();
            $table->text('license')->nullable();
            $table->longText('play_type')->nullable();
            $table->longText('pricing_policy')->nullable();
            $table->longText('disclaimer')->nullable();
            $table->tinyInteger('enabled')->default(0)->comment('0=>disabled; 1=>enabled');
            $table->tinyInteger('payment_type')->nullable();
            $table->tinyInteger('covidreport')->nullable()->comment('1=>Vaccinated Booster; 2=>Fully Vaccinated; 3=>Unvaccinated');
            $table->tinyInteger('default_setting')->default(0);
            $table->char('playmate', 1)->default('N');
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
        Schema::dropIfExists('escorts');
    }
};
