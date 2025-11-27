<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameFeaturesColumnInMassageSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('massage_settings', function (Blueprint $table) {
            
            DB::statement("
            ALTER TABLE massage_settings 
            CHANGE `features_viewer_notifications_forward-v-alerts` `features_viewer_notifications_forward_v_alerts` VARCHAR(255) DEFAULT '1'
        ");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('massage_settings', function (Blueprint $table) {
            //
        });
    }
}
