<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddArchiveColumnToMassageExcelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('massage_excels', function (Blueprint $table) {
             $table->enum('archive', ['true', 'false'])->default('false')->after('website');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('massage_excels', function (Blueprint $table) {
             $table->dropColumn('archive');
        });
    }
}
