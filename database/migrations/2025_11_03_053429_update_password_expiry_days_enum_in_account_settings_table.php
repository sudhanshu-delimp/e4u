<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePasswordExpiryDaysEnumInAccountSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       DB::statement("
            ALTER TABLE `account_settings`
            MODIFY `password_expiry_days` ENUM('never', '30', '60', '90')
            NULL DEFAULT '60'
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('account_settings', function (Blueprint $table) {
            //
        });
    }
}
