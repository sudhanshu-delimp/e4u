<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private array $tables = [
        'users',
        'concierge_mobile_sims',
        'agent_notifications',
        'center_notifications',
        'escort_notifications',
        'global_notifications',
        'legbox_notifications',
        'notifications',
        'shareholder_notifications',
        'viewer_notifications',
        'publication_blogs',
        'reviews',
        'massage_reviews',
        'advertiser_agent_requests',
        'communications',
        'nums',
        'punterbox',
        'support_tickets',
        'notebox',
        'influencers',
        'feedbacks',
        //'payment_histories'
        
    ];

    public function up(): void
    {
        foreach ($this->tables as $table) {
            if (Schema::hasTable($table) && !Schema::hasColumn($table, 'ref_number')) {
                Schema::table($table, function (Blueprint $table) {
                    $table->string('ref_number', 100)->nullable()->index()->after('id');
                    if($table == 'support_tickets'){
                        $table->timestamps();
                    }
                });
            }

            if (Schema::hasTable($table) && !Schema::hasColumn($table, 'created_at')) {
                Schema::table($table, function (Blueprint $table) {
                    $table->timestamp('created_at')->nullable();
                });
            }

            if (Schema::hasTable($table) && !Schema::hasColumn($table, 'updated_at')) {
                Schema::table($table, function (Blueprint $table) {
                    $table->timestamp('updated_at')->nullable();
                });
            }

             if (Schema::hasTable($table) && !Schema::hasColumn($table, 'created_by')) {
                Schema::table($table, function (Blueprint $table) {
                    $table->unsignedBigInteger('created_by')->nullable();
                });
            }

            if (Schema::hasTable($table) && !Schema::hasColumn($table, 'updated_by')) {
                Schema::table($table, function (Blueprint $table) {
                    $table->unsignedBigInteger('updated_by')->nullable()->after('created_by');
                });
            }
        }
    }

    public function down(): void
    {
        foreach ($this->tables as $table) {
            if (Schema::hasTable($table) && Schema::hasColumn($table, 'ref_number')) {
                Schema::table($table, function (Blueprint $table) {
                    $table->dropColumn('ref_number');
                });
            }
        }
    }
};