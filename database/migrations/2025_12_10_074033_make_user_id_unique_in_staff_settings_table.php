<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeUserIdUniqueInStaffSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('staff_settings', function (Blueprint $table) {
            $table->unique('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('staff_settings', function (Blueprint $table) {
            $table->dropUnique(['user_id']);
        });
    }
}
