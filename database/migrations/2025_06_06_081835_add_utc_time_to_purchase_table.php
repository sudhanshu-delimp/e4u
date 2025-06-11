<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUtcTimeToPurchaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase', function (Blueprint $table) {
            $table->dateTime('utc_start_time')->nullable()->after('start_date');
            $table->dateTime('utc_end_time')->nullable()->after('end_date');
        });

        // php artisan migrate --path=database/migrations/2025_06_06_081835_add_utc_time_to_purchase_table.php
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchase', function (Blueprint $table) {
            $table->dropColumn('utc_start_time');
            $table->dropColumn('utc_end_time');
        });
    }
}
