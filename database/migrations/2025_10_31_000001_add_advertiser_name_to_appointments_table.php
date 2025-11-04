<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            
            if (!Schema::hasColumn('appointments', 'advertiser_name')) {
                $table->string('advertiser_name')->nullable()->after('advertiser_id');
            }
            // Also drop advertiser_id (and FK) if present – merged into this migration
            if (Schema::hasColumn('appointments', 'advertiser_id')) {
                try {
                   // $table->dropForeign(['advertiser_id']);
                } catch (\Throwable $e) {
                    // Ignore if foreign key doesn't exist
                }
            }

        });

        if (Schema::hasColumn('appointments', 'advertiser_id')) {
            Schema::table('appointments', function (Blueprint $table) {
                $table->dropColumn('advertiser_id');
            });
        }
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            if (Schema::hasColumn('appointments', 'advertiser_name')) {
                $table->dropColumn('advertiser_name');
            }

            if (!Schema::hasColumn('appointments', 'advertiser_id')) {
                $table->unsignedBigInteger('advertiser_id')->nullable()->after('id');
            }
            
        });
    }
};


