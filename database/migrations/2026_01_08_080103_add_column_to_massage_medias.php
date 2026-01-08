<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToMassageMedias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('massage_medias', function (Blueprint $table) {

             $table->unsignedBigInteger('massage_id')->nullable()->after('user_id');
             $table->enum('template', ['0', '1', '2', '3', '4', '5'])->default('0')->after('banner_image');
             $table->enum('banner_group', ['0', '1'])->default('0')->after('template');
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
            //
        });
    }
}
