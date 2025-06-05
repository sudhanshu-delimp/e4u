<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMassageMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('massage_medias', function (Blueprint $table) {
            $table->id();
            $table->integer('massage_id');
            $table->tinyInteger('type')->nullable()->comment('0=>image; 1=>video');
            $table->longText('path')->nullable();
            $table->text('banner_image')->nullable();
            $table->tinyInteger('status')->default(1)->nullable();
            $table->tinyInteger('default')->nullable();
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
}
