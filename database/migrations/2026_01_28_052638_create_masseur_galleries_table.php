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
            $table->bigIncrements('id');
            $table->string('masseur_token_id')->nullable();
            $table->unsignedBigInteger('massage_media_id');
            $table->unsignedBigInteger('masseur_profile_id');
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
