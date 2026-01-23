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
        Schema::create('massage_medias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('massage_id')->nullable();
            $table->tinyInteger('type')->nullable()->comment('0=>image; 1=>video');
            $table->longText('path')->nullable();
            $table->text('banner_image')->nullable();
            $table->enum('template', ['0', '1', '2', '3', '4', '5'])->default('0');
            $table->enum('banner_group', ['0', '1', '2', '3', '4', '5'])->nullable();
            $table->tinyInteger('status')->nullable()->default(1);
            $table->tinyInteger('position')->nullable()->comment('position 1-7 massage image,
position 9 Banner Image,
position 8 massage varification
position 10 banner vatification');
            $table->tinyInteger('default')->nullable();
            $table->tinyInteger('varified')->nullable()->comment('1=>varified,2=>unvarified');
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
        Schema::dropIfExists('massage_medias');
    }
};
