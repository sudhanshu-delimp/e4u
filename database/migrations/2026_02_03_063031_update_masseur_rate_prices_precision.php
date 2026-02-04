<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMasseurRatePricesPrecision extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

         DB::statement("
            ALTER TABLE masseur_rate
            MODIFY massage_price DOUBLE(8,2),
            MODIFY incall_price  DOUBLE(8,2),
            MODIFY outcall_price DOUBLE(8,2)
        ");


      
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
