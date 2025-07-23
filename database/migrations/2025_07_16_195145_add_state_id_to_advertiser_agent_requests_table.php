<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStateIdToAdvertiserAgentRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::table('advertiser_agent_requests', function (Blueprint $table) {
             $table->unsignedBigInteger('state_id')->nullable()->after('user_id');
        });
        //php artisan migrate --path=database/migrations/2025_07_16_195145_add_state_id_to_advertiser_agent_requests_table.php
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('advertiser_agent_requests', function (Blueprint $table) {
            $table->dropColumn('state_id');
        });
    }
}
