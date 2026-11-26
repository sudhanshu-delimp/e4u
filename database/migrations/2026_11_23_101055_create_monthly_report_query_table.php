
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('monthly_report_queries', function (Blueprint $table) {
            $table->id();
            $table->string('ref_number')->nullable();
            $table->unsignedBigInteger('fee_report_id');
            $table->enum('fee_report_type', ['operator', 'agent'])->default('agent')->after('fee_report_id');
            $table->dateTime('report_date')->nullable();

            $table->enum('status', [
                'pending',
                'approved',
                'rejected',
                'paid',
                'query',
                'query_resolved'
            ])->default('pending');

            $table->unsignedBigInteger('submitted_by')->nullable();
            $table->string('user_type')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();

            // Indexes
            $table->index('fee_report_id');
            $table->index('fee_report_type');
            $table->index('submitted_by');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('monthly_report_queries');
    }
};
