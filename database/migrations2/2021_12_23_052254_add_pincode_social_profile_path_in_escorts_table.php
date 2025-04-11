<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPincodeSocialProfilePathInEscortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('escorts', function (Blueprint $table) {
            $table->integer('pincode')->after('state_id')->nullable();
            $table->longText('social_links')->after('pincode')->nullable();
            $table->tinyInteger('completed')->default(0)->after('pincode')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('escorts', function (Blueprint $table) {
            $table->dropColumn('pincode');
            $table->dropColumn('social_links');
            $table->dropColumn('completed');
        });
    }
}
