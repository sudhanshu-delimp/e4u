<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSelectedTimeToEscortBrbTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('escort_brb', function (Blueprint $table) {
            Schema::table('escort_brb', function (Blueprint $table) {
                $table->dateTime('selected_time')->nullable()->after('date_set'); 
            });
        });
        //php artisan migrate --path=database/migrations/2025_06_05_122119_add_selected_time_to_escort_brb_table.php
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('escort_brb', function (Blueprint $table) {
            //
        });
    }
}
