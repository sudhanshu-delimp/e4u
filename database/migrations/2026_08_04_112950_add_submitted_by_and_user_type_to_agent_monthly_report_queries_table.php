<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubmittedByAndUserTypeToAgentMonthlyReportQueriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agent_monthly_report_queries', function (Blueprint $table) {
            $table->unsignedBigInteger('submitted_by')->nullable()->after('status');
            $table->tinyInteger('user_type')->nullable()->after('submitted_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agent_monthly_report_queries', function (Blueprint $table) {
            $table->dropColumn(['submitted_by', 'user_type']);
        });
    }
}