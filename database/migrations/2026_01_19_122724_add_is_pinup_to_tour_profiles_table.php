<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsPinupToTourProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tour_profiles', function (Blueprint $table) {
            $table->integer('is_pinup')->nullable()->after('tour_plan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tour_profiles', function (Blueprint $table) {
            $table->dropColumn('is_pinup');
        });
    }
}
