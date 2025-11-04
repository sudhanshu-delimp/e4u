<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRateInVariablAgentOperatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    
     public function up(): void
    {
        DB::statement("UPDATE `variabl_agent_operators` SET `rate` = '1'");
        DB::statement("
            ALTER TABLE `variabl_agent_operators`
            MODIFY `rate` ENUM('1','2','3') 
            NOT NULL DEFAULT '1'
            COMMENT '1=per day; 2=per week; 3=Per Registration'
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('variabl_agent_operators', function (Blueprint $table) {
            //
        });
    }
}
