<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGroupToEscortsMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('escorts_medias', function (Blueprint $table) {
            Schema::table('escorts_medias', function (Blueprint $table) {
                // Add group column with enum 1 to 5, nullable or default as needed
                $table->enum('banner_group', ['0','1', '2', '3', '4', '5'])
                      ->default('0')
                      ->after('template');  // Add after template column
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
        Schema::table('escorts_medias', function (Blueprint $table) {
            Schema::table('escorts_medias', function (Blueprint $table) {
                $table->dropColumn('banner_group');
            });
        });
    }
}
