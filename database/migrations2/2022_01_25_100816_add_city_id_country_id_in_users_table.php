<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCityIdCountryIdInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->longText('social_links')->after('phone')->nullable();
            $table->unsignedBigInteger('country_id')->after('social_links')->nullable();
            $table->unsignedBigInteger('city_id')->after('country_id')->nullable();
            $table->unsignedBigInteger('state_id')->after('city_id')->nullable();
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('social_links');
            $table->dropColumn('country_id');
            $table->dropColumn('city_id');
            $table->dropColumn('state_id');
        });
    }
}
