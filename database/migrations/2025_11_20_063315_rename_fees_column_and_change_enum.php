<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameFeesColumnAndChangeEnum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    
        Schema::table('fees_concierge_services', function (Blueprint $table) {
            $table->renameColumn('fee', 'service_type');
        });

        Schema::table('fees_concierge_services', function (Blueprint $table) {
            $table->mediumText('service_type')->change();
        });

         Schema::table('fees_concierge_services', function (Blueprint $table) {
            $table->string('frequency')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fees_concierge_services', function (Blueprint $table) {
            //
        });
    }
}
