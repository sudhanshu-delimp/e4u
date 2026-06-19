<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AlertTableAddAmoutTypeToVariablAgentOperatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('variabl_agent_operators', function (Blueprint $table) {
            $table->enum('amount_type', ['percent', 'fixed'])->default('percent')->after('amount');
            $table->enum('fee_for', ['advertising', 'mc_signup', 'operator'])->default('advertising')->after('amount_type');
        });

        DB::table('variabl_agent_operators')->where('id', 1)->update(['fee_for' => 'advertising']);
        DB::table('variabl_agent_operators')->where('id', 2)->update(['fee_for' => 'mc_signup']);
        DB::table('variabl_agent_operators')->where('id', 3)->update(['fee_for' => 'operator']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('variabl_agent_operators', function (Blueprint $table) {
            $table->dropColumn('amount_type');
        });
    }
}
