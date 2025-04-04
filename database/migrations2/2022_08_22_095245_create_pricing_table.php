<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pricing', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('membership_id')->comment("1-Platinum,2-Gold,3-Silver,4-Free,5-M.C,6-PinUp");
            $table->string('frequency')->nullable();
            $table->tinyInteger('days')->comment('1-per-day,2-per-week')->nullable();
            $table->decimal('price', 5, 2)->nullable();
            $table->decimal('percentage', 5, 2)->nullable();
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
}
