<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMergeCenterIdsToProspectReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prospect_reports', function (Blueprint $table) {
            $table->json('merge_center_ids')->nullable()->after('center_ids')->comment('store merge center ids for prospect report');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prospect_reports', function (Blueprint $table) {
            $table->dropColumn('merge_center_ids');
        });
    }
}
