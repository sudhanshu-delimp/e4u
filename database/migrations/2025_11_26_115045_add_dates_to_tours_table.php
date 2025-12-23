<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDatesToToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tours', function (Blueprint $table) {
            Schema::table('tours', function (Blueprint $table) {
                $table->date('start_date')->nullable()->after('name');
                $table->date('end_date')->nullable()->after('start_date');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tours', function (Blueprint $table) {
            Schema::table('tours', function (Blueprint $table) {
                $table->dropColumn(['start_date', 'end_date']);
            });
        });
    }
}
