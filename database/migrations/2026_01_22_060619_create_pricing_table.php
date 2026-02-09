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
        Schema::create('pricing', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('membership_id', ['1', '2', '3', '4', '5', '6', '7'])->nullable();
            $table->enum('frequency', ['Fixed', '21 Days'])->default('Fixed');
            $table->enum('days', ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'])->nullable();
            $table->decimal('price')->nullable();
            $table->decimal('percentage')->nullable();
            $table->decimal('discount_amount')->nullable();
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
        Schema::dropIfExists('pricing');
    }
};
