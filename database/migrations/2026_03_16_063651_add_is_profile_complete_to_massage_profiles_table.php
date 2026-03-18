<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsProfileCompleteToMassageProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('massage_profiles', function (Blueprint $table) {
            $table->enum('is_profile_complete', ['1', '0'])->default('0')->after('default_setting'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('massage_profiles', function (Blueprint $table) {
            //
        });
    }
}
