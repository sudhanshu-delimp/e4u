<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCovidreportToEscortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('escorts', function (Blueprint $table) {
            $table->tinyInteger('covidreport')->after('payment_type')->nullable()->comment('1=>Vaccinated, not up to date; 2=>Vaccinated, up to date; 3=>Not Vaccinated');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('escorts', function (Blueprint $table) {
            $table->dropColumn('covidreport');
        });
    }
}
