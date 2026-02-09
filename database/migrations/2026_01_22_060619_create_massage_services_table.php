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
        Schema::create('massage_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('massage_profile_id');
            $table->bigInteger('service_id');
            $table->tinyInteger('category_id')->nullable();
            $table->double('price', 8, 4)->nullable();
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
        Schema::dropIfExists('massage_services');
    }
};
