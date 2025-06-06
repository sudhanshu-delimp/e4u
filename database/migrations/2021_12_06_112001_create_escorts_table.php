<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEscortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escorts', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
			$table->string('name')->nullable();
			$table->string('title')->nullable();
			$table->longText('about')->nullable();
			$table->string('phone')->nullable();
			$table->integer('age')->nullable();
			$table->dateTime('start_date')->nullable();
			$table->dateTime('end_date')->nullable();
			$table->string('membership')->nullable();
			$table->tinyInteger('gender')->comment('0=>female; 1=>male; 2=>other')->nullable();
			$table->string('address')->nullable();
			$table->string('city_id')->nullable();
			$table->string('state_id')->nullable();
			$table->string('country_id')->nullable();
			$table->integer('nationality_id')->nullable();
			$table->string('statistics')->nullable();
			$table->string('height')->nullable();
			$table->tinyInteger('eyes')->nullable();
			$table->tinyInteger('shaved')->nullable();
			$table->tinyInteger('orientation')->nullable();
			$table->tinyInteger('hair_color')->nullable();
			$table->tinyInteger('skin_tone')->nullable();
			$table->tinyInteger('breast')->nullable();
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
			$table->tinyInteger('play_type')->nullable();
            $table->tinyInteger('enabled')->comment('0=>disabled; 1=>enabled');
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
}
