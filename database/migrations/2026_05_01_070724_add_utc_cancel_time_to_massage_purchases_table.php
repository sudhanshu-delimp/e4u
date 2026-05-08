<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUtcCancelTimeToMassagePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('massage_purchases', function (Blueprint $table) {
            $table->dateTime('utc_cancel_time')->nullable()->after('paid_rate');
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
            //
        });
    }
}
