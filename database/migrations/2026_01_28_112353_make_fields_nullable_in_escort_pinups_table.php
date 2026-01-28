<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeFieldsNullableInEscortPinupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('escort_pinups', function (Blueprint $table) {
            $table->dateTime('utc_start_time')->nullable()->change();
            $table->dateTime('utc_end_time')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('escort_pinups', function (Blueprint $table) {
            $table->timestamp('utc_start_time')->nullable(false)->change();
            $table->timestamp('utc_end_time')->nullable(false)->change();
        });
    }
}
