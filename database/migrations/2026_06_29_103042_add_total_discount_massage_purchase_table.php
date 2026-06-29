<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTotalDiscountMassagePurchaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('massage_purchases', function (Blueprint $table) {
           $table->decimal('total_discount', 8, 2)->nullable(true)->default('0.00')->after('discount_rate')->comment('discount amount if applicable');
           $table->decimal('final_amount', 8, 2)->nullable(true)->default('0.00')->after('paid_rate')->comment('Paid Rate with Gst');
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
