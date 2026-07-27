<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentMonthlyReportsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('agent_monthly_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('created_by')->nullable()->index();
            $table->bigInteger('updated_by')->nullable()->index();
            $table->dateTime('report_date')->nullable();
            $table->date('billing_period_from')->nullable();
            $table->date('billing_period_to')->nullable();
            $table->bigInteger('agent_id')->nullable()->index();
            $table->bigInteger('state_id')->nullable();
            $table->decimal('spend', 12, 2)->default(0);
            $table->decimal('fees', 12, 2)->default(0);
            $table->enum('status', [
                'pending',
                'approved',
                'rejected',
                'paid',
                'query',
                'resolved'
            ])->default('pending');
            $table->dateTime('report_approved')->nullable();
            $table->bigInteger('approved_by')->nullable()->index();
            $table->timestamps();
            $table->index(['report_date', 'agent_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agent_monthly_reports');
    }
}