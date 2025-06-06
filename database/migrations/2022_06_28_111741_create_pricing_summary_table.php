<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricingSummaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pricing_summary', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('membership_id');
            $table->tinyInteger('days')->nullable();
            $table->decimal('price', 5, 2)->nullable();
            $table->tinyInteger('comment_id')->nullable();
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
        Schema::dropIfExists('pricing_summary');
    }
}
