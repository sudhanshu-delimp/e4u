<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperatorMonthlyReportsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('operator_monthly_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('created_by')->nullable()->index();
            $table->bigInteger('updated_by')->nullable()->index();
            $table->dateTime('report_date')->nullable()->index();
            $table->date('billing_period_from')->nullable();
            $table->date('billing_period_to')->nullable();
            $table->bigInteger('operator_id')->nullable()->index();
            $table->bigInteger('country_id')->nullable()->index();
            $table->string('agent_ids', 100)->nullable();
            $table->decimal('agent_fees', 12, 2)->default(0);
            $table->decimal('spend', 12, 2)->default(0);
            $table->decimal('fees', 12, 2)->default(0);
            $table->enum('status', [
                'pending',
                'approved',
                'rejected',
                'paid',
                'query',
                'query_resolved'
            ])->default('pending')->index();
            $table->dateTime('report_approved')->nullable();
            $table->bigInteger('approved_by')->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operator_monthly_reports');
    }
}