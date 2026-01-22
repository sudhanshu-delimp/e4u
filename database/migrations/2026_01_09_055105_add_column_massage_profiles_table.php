<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnMassageProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('massage_profiles', function (Blueprint $table) {
            
            $table->string('business_name')->nullable()->after('profile_name');
            $table->string('business_no')->nullable()->after('business_name');
            $table->mediumText('about_us_box')->nullable()->after('business_no');

            

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_name', function (Blueprint $table) {
            //
        });
    }
}
