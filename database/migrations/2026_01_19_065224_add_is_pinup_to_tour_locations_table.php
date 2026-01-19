<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsPinupToTourLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tour_locations', function (Blueprint $table) {
            $table->enum('is_pinup', ['0', '1'])
            ->default('0')
            ->comment('0 = No, 1 = Yes')->after('end_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tour_locations', function (Blueprint $table) {
            $table->dropColumn('is_pinup');
        });
    }
}
