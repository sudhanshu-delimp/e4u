<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agent_id')->unique()->nullable();
            $table->date('agreement_date')->nullable();
            $table->string('term',200)->nullable();
            $table->string('option_peroid',100)->nullable();
            $table->string('option_exercised',100)->nullable();
            $table->string('commission_advertising_percent',100)->nullable();
            $table->string('commission_registration_amount',100)->nullable();
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
        Schema::dropIfExists('agent_details');
    }
}
