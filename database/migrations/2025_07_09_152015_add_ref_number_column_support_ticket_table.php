<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRefNumberColumnSupportTicketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('support_tickets', function (Blueprint $table) {
            $table->string('ref_number')->index()->nullable()->after('user_id');
        });
        // php artisan migrate --path=database/migrations/2025_07_09_152015_add_ref_number_column_support_ticket_table.php
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('support_tickets', function (Blueprint $table) {
            $table->dropColumn('ref_number');
        });
    }
}
