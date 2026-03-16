<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeEscortIdFromReportEscortProfiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('report_escort_profiles', function (Blueprint $table) {
            $table->renameColumn('escort_id', 'advertiser_id');
            $table->enum('advertiser_type', ['escort', 'massage'])->default('escort')->after('viewer_id'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('report_escort_profiles', function (Blueprint $table) {
            //
        });
    }
}
