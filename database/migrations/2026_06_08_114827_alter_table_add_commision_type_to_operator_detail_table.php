<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableAddCommisionTypeToOperatorDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('operator_details', function (Blueprint $table) {
            $table->enum('advertising_commission_type', ['percent', 'fixed'])->default('percent')->after('commission_advertising_percent');
            $table->enum('massge_centre_commission_type', ['percent', 'fixed'])->default('percent')->after('commission_massage_centre_percent');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('operator_details', function (Blueprint $table) {
            $table->dropColumn('advertising_commission_type');
            $table->dropColumn('massge_centre_commission_type');
        });
    }
}
