<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSuspendedAtToMassagePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('massage_purchases', function (Blueprint $table) {
            $table->dateTime('suspended_at')
                ->nullable()
                ->after('status')
                ->comment('Stores the date and time when an admin suspends the profile listing. Remains NULL until the listing is suspended.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('massage_purchases', function (Blueprint $table) {
            $table->dropColumn('suspended_at');
        });
    }
}
