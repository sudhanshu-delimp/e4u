<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSpendAmountToAdvertiserDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('advertiser_discounts', function (Blueprint $table) {
            $table->decimal('spend_amount', 10, 2)
            ->default(0.00)
            ->nullable()
            ->after('value'); 
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('advertiser_discounts', function (Blueprint $table) {
            $table->dropColumn('spend_amount');
        });
    }
}
