<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AlterRateColumnVariablAgentOperators extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            ALTER TABLE variabl_agent_operators
            MODIFY status ENUM('1','2','3')
            DEFAULT '1'
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("
            ALTER TABLE variabl_agent_operators
            MODIFY status ENUM('pending','listed','expire')
            DEFAULT 'pending'
        ");
    }
}
