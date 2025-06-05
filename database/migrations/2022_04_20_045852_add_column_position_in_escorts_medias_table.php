<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnPositionInEscortsMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('massage_medias', function (Blueprint $table) {
            $table->renameColumn('massage_id','user_id');
            $table->tinyInteger('varified')->after('default')->nullable()->comment("1=>varified,2=>unvarified");
            //$table->tinyInteger('position')->after('status')->nullable()->comment("position 1-7 massage image, position 9 Banner Image, position 8 massage varification position 10 banner vatification");

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
            $table->renameColumn('user_id','massage_id');
            $table->dropColumn('varified');
            //$table->dropColumn('position');
        });
    }
}
