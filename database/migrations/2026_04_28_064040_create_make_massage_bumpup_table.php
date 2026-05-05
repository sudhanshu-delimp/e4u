<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMakeMassageBumpupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('massage_bumpup', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('massage_id');

            $table->date('start_date');
            $table->date('end_date');

            $table->timestamp('utc_start_time')->nullable();
            $table->timestamp('utc_end_time')->nullable();

           

           
            $table->index('user_id');
            $table->index('massage_id');


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
        Schema::dropIfExists('massage_bumpup');
    }
}
