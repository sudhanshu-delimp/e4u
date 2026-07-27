<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentMonthlyReportQueriesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('agent_monthly_report_queries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('fee_report_id')->nullable()->index();
            $table->dateTime('report_date')->nullable()->index();
            $table->enum('status', [
                'pending',
                'approved',
                'rejected',
                'paid',
                'query',
                'resolved'
            ])->default('pending')->index();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agent_monthly_report_queries');
    }
}
