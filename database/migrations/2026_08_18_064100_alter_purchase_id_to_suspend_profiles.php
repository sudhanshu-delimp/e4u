<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPurchaseIdToSuspendProfiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suspend_profiles', function (Blueprint $table) {});

        Schema::table('suspend_profiles', function (Blueprint $table) {
            $table->integer('purchase_id')
                ->nullable()
                ->after('updated_by')
                ->comment('Stores the current active purchase id that belogs to the escort profile.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('suspend_profiles', function (Blueprint $table) {
            $table->dropColumn('purchase_id');
        });
    }
}
