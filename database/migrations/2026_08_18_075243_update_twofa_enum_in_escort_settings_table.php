<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateTwofaEnumInEscortSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        ALTER TABLE escort_settings
        MODIFY COLUMN twofa
        ENUM('1', '2', '3')
        NOT NULL
        DEFAULT '2'
        COMMENT '1 => Email, 2 => Text, 3 => Both'
    ");
    }

    public function down()
    {
        DB::statement("
        ALTER TABLE escort_settings
        MODIFY COLUMN twofa
        ENUM('1', '2')
        NOT NULL
        DEFAULT '2'
        COMMENT '1 => Email, 2 => Text'
    ");
    }
}
