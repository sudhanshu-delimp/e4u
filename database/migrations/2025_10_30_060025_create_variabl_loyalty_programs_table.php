<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariablLoyaltyProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      
        Schema::create('variabl_loyalty_programs', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable(true);
            $table->string('level')->nullable(true);
            $table->mediumText('discription')->nullable(true);
            $table->decimal('amount', 8, 2)->nullable(true);
            $table->enum('reward', ['1','2','3','4','5'])->nullable(true); 
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
        Schema::dropIfExists('variabl_loyalty_programs');
    }
}
