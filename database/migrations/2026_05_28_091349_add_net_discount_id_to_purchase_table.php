<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNetDiscountIdToPurchaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase', function (Blueprint $table) {
            $table->decimal('special_discount_value', 10, 2)
                ->default(0.00)
                ->after('discount_rate');

            $table->enum('special_discount_type', ['percentage', 'fixed'])
                ->nullable()
                ->after('special_discount_value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchase', function (Blueprint $table) {
            $table->dropColumn('special_discount');
        });
    }
}
