<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePricingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('pricing'); 
        Schema::create('pricing', function (Blueprint $table) {
            $table->id();
            $table->enum('membership_id', ['1','2','3','4','5'])->nullable()->comment('1-Platinum,2-Gold,3-Silver,4-Free,5-Pin-Up');
            $table->enum('frequency',['Fixed','21 Days'])->default('Fixed');
            $table->enum('days', ['1','2','3'])->nullable()->comment('1-per day,2-per week,3-per Service');
            $table->decimal('price', 8, 2)->nullable();
            $table->decimal('percentage', 8, 2)->nullable();
            $table->decimal('discount_amount', 8, 2)->nullable();
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
}
