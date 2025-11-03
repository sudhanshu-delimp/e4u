<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariablAgentOperatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variabl_agent_operators', function (Blueprint $table) {
            $table->id();
            $table->string('rate')->nullable(true);
            $table->decimal('amount', 8, 2)->nullable(true);
            $table->string('percent')->nullable(true);
            $table->string('discription')->nullable(true);
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
        Schema::dropIfExists('variabl_agent_operators');
    }
}
