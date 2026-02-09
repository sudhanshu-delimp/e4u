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
        Schema::create('variabl_agent_operators', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('rate', ['1', '2', '3'])->default('1')->comment('1=per day; 2=per week; 3=Per Registration');
            $table->decimal('amount')->nullable();
            $table->string('percent')->nullable();
            $table->string('discription')->nullable();
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
};
