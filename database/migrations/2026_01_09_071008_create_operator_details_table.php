<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperatorDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operator_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique()->nullable();
            $table->date('date_appointed')->nullable();
            $table->string('point_of_contact',100)->nullable();
            $table->date('agreement_date')->nullable();
            $table->string('term',200)->nullable();
            $table->string('fee',100)->nullable();
            $table->string('commission_advertising_percent',100)->nullable();
            $table->string('commission_massage_centre_percent',100)->nullable();
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
        Schema::dropIfExists('operator_details');
    }
}
