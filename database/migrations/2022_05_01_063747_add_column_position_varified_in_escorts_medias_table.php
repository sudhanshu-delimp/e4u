<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnPositionVarifiedInEscortsMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('escorts_medias', function (Blueprint $table) {
            $table->tinyInteger('position')->nullable()->comment('1=>position: default image, 2-7=>position: massage image,8=>position: massage image varification 9=>position: Banner Image,10=>position: banner varification image');
            $table->tinyInteger('varified')->after('default')->nullable()->comment("1=>varified,2=>unvarified");
            $table->tinyInteger('user_id')->after('escort_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('escorts_medias', function (Blueprint $table) {
            $table->dropColumn('position');
            $table->dropColumn('varified');
            $table->dropColumn('user_id');
        });
    }
}
