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
        Schema::dropIfExists('masseur_galleries');

        Schema::create('masseur_galleries', function (Blueprint $table) {
<<<<<<<< HEAD:database/migrations/2026_01_22_070209_create_masseur_galleries_table.php
            $table->id();
            $table->string('masseur_token_id')->nullable();
            $table->tinyInteger('masseur_media_id');
            $table->tinyInteger('masseur_profile_id'); 
========
            $table->bigIncrements('id');
            $table->tinyInteger('massage_media_id');
            $table->tinyInteger('masseur_profile_id');
>>>>>>>> 1783ffb7570574e8ae71fdcdbf9e7aa5ca307e75:database/migrations/2026_01_22_060619_create_masseur_galleries_table.php
            $table->tinyInteger('type')->nullable();
            $table->tinyInteger('position')->nullable()->comment('1=>position: default image, 2-7=>position: massage image,8=>position: massage image varification 9=>position: Banner Image,10=>position: banner varification image');
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
        Schema::dropIfExists('masseur_galleries');
    }
};
