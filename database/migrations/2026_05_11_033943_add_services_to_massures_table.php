<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddServicesToMassuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('masseurs', function (Blueprint $table) {

            $table->mediumText('massage_service_types')->nullable()->after('is_default');
            $table->mediumText('other_service_types')->nullable()->after('massage_service_types');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('masseurs', function (Blueprint $table) {
            //
        });
    }
}
