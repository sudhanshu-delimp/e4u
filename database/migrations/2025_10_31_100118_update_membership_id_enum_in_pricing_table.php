<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMembershipIdEnumInPricingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         DB::statement("
            ALTER TABLE `pricing`
            MODIFY `membership_id` ENUM('1','2','3','4','5','6') 
            NULL DEFAULT NULL,
            MODIFY `days` ENUM('1','2','3','4','5','6','7','8','9','10')
            NULL DEFAULT NULL
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       
    }
}
