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
       

        Schema::create('massage_rate', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('massage_profile_id');
            $table->bigInteger('duration_id');
            $table->double('massage_price', 8, 4)->nullable();
            $table->double('incall_price', 8, 4)->nullable();
            $table->double('outcall_price', 8, 4)->nullable();
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
        Schema::dropIfExists('massage_rate');
    }
};
