<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPendingToFeedbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('feedbacks', function (Blueprint $table) {
            $table->enum('status', ['1', '2'])
                ->default('1')
                ->after('email')
                ->comment('1=Pending, 2=Completed');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('feedbacks', function (Blueprint $table) {
            $table->dropColumn('status'); // rollback me column remove ho jaye
        });
    }
}
