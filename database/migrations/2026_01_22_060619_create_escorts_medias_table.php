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
        Schema::create('escorts_medias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('escort_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('type')->nullable()->comment('0=>image; 1=>video');
            $table->enum('template', ['0', '1'])->default('0');
            $table->enum('banner_group', ['0', '1', '2', '3', '4', '5'])->default('0');
            $table->text('banner_image')->nullable();
            $table->longText('path')->nullable();
            $table->tinyInteger('default')->nullable();
            $table->tinyInteger('varified')->nullable()->comment('1=>varified,2=>unvarified');
            $table->tinyInteger('status')->nullable();
            $table->timestamps();
            $table->tinyInteger('position')->nullable()->comment('1=>position: default image, 2-7=>position: massage image,8=>position: massage image varification 9=>position: Banner Image,10=>position: banner varification image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('escorts_medias');
    }
};
