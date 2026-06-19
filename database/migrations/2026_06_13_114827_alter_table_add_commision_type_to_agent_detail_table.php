<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableAddCommisionTypeToAgentDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agent_details', function (Blueprint $table) {
            $table->enum('commission_advertising_type', ['percent', 'fixed'])->default('percent')->after('commission_advertising_percent');
            $table->enum('commission_registration_type', ['percent', 'fixed'])->default('percent')->after('commission_registration_amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agent_details', function (Blueprint $table) {
            $table->dropColumn('commission_advertising_type');
            $table->dropColumn('commission_registration_type');
        });
    }
}
