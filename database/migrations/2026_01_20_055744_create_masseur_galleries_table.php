<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasseurGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masseur_galleries', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('massage_media_id');
            $table->tinyInteger('masseur_profile_id'); 
            $table->tinyInteger('type')->nullable();
            $table->tinyInteger('position')->nullable()->comment('1=>position: default image, 2-7=>position: massage image,8=>position: massage image varification 9=>position: Banner Image,10=>position: banner varification image');
            $table->timestamps();
        });
    }



    public function down()
    {
        Schema::dropIfExists('masseur_galleries');
    }
}
