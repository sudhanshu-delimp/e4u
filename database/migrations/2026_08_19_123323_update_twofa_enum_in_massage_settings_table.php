<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateTwofaEnumInMassageSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Convert existing NULL values to Text (2)
        DB::table('massage_settings')
            ->whereNull('twofa')
            ->update(['twofa' => '2']);

        DB::statement("
            ALTER TABLE massage_settings
            MODIFY COLUMN twofa
            ENUM('1', '2', '3')
            NOT NULL
            DEFAULT '2'
            COMMENT '1 => Email, 2 => Text, 3 => Both'
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Convert '3' (Both) back to '2' before removing it from ENUM
        DB::table('massage_settings')
            ->where('twofa', '3')
            ->update(['twofa' => '2']);

        DB::statement("
            ALTER TABLE massage_settings
            MODIFY COLUMN twofa
            ENUM('1', '2')
            NOT NULL
            DEFAULT '2'
            COMMENT '1 => Email, 2 => Text'
        ");
    }
}