<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTourPlanInTourLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tour_location', function (Blueprint $table) {
            $table->tinyInteger("tour_plan")->after('tour_id')->nullable()->comment("1=>platinum ,2=>gold,3=>silver,4=>free");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tour_location', function (Blueprint $table) {
            $table->dropColumn("tour_plan");
        });
    }
}
