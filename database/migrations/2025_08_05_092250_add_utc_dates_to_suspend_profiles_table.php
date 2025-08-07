<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUtcDatesToSuspendProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suspend_profiles', function (Blueprint $table) {
            $table->dateTime('utc_start_date')->nullable();
            $table->dateTime('utc_end_date')->nullable();
        });

       // php artisan migrate --path=database/migrations/2025_08_05_092250_add_utc_dates_to_suspend_profiles_table.php
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('suspend_profiles', function (Blueprint $table) {
            $table->dropColumn(['utc_start_date', 'utc_end_date']);
        });
    }
}
