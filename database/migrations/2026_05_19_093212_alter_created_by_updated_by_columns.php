<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $tables = [
            'escorts',
            'masseurs',
            'tours',
            'massage_profiles',
            'visitors',
            'escort_brb',
            'escort_bumpups',
            'escort_pinups',
            'suspend_profiles',
            'massage_bumpup',
            'massage_brbs',
            'purchase',
            'massage_purchases',
            'massage_gallery',
            'massage_medias',
            'payment_histories',
        ];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->unsignedBigInteger('created_by')->nullable()->index()->after('id');
                $table->unsignedBigInteger('updated_by')->nullable()->index()->after('created_by');
            });
        }
    }

    public function down(): void
    {
        $tables = [
            'escorts',
            'masseurs',
            'tours',
            'massage_profiles',
            'visitors',
            'escort_brb',
            'escort_bumpups',
            'escort_pinups',
            'suspend_profiles',
            'massage_bumpup',
            'massage_brbs',
            'purchase',
            'massage_purchases',
            'massage_gallery',
            'massage_medias',
            'payment_histories'
        ];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                // rollback example
                $table->unsignedBigInteger('created_by')->nullable()->index()->after('id');
                $table->unsignedBigInteger('updated_by')->nullable()->index()->after('created_by');
            });
        }
    }
};
