<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnPositionInMassageMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('massage_medias', function (Blueprint $table) {
            $table->tinyInteger('position')->after('status')->nullable()->comment('1=>position 1-7 massage image, 2=> position 9 Banner Image,3=> position 8 massage varification, 4=> position 10 banner vatification');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('massage_medias', function (Blueprint $table) {
            $table->dropColumn('position');
        });
    }
}
