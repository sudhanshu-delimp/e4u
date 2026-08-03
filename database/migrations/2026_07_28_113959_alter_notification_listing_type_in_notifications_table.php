<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
        ALTER TABLE `notifications`
        MODIFY `notification_listing_type`
        ENUM('1','2','3')
        NOT NULL
        COMMENT '1-Support Ticket,2-Alert Center,3-Agent Fee Report'
    ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE notifications
            MODIFY COLUMN notification_listing_type
            ENUM('1','2')
            COMMENT '1-Support Ticket, 2-Alert Center'
            NULL
        ");
    }
};