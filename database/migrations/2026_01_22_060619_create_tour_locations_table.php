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
        Schema::create('tour_locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('tour_id');
            $table->string('status')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('is_pinup', ['0', '1'])->default('0')->comment('0 = No, 1 = Yes');
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
        Schema::dropIfExists('tour_locations');
    }
};
