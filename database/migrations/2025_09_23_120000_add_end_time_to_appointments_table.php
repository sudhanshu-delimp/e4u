<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('appointments', 'end_time')) {
            Schema::table('appointments', function (Blueprint $table) {
                $table->time('end_time')->nullable()->after('time');
            });
        }

        // Best-effort backfill: assume existing duration is 30 minutes
        try {
            DB::statement("UPDATE appointments SET end_time = ADDTIME(time, '00:30:00') WHERE end_time IS NULL");
        } catch (\Throwable $e) {
            // Silently ignore if unsupported; column remains nullable
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('appointments', 'end_time')) {
            Schema::table('appointments', function (Blueprint $table) {
                $table->dropColumn('end_time');
            });
        }
    }
};


