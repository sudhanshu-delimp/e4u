<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdateStatusInMassageSuspendProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            ALTER TABLE `massage_suspend_profiles`
            MODIFY `status` ENUM('1', '0') NOT NULL DEFAULT '1'
        ");

        Schema::table('massage_suspend_profiles', function (Blueprint $table) {
            $table->enum('is_cancelled', ['1', '0'])
                  ->default('0')
                  ->nullable(true)
                  ->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('massage_suspend_profiles', function (Blueprint $table) {
            //
        });
    }
}
