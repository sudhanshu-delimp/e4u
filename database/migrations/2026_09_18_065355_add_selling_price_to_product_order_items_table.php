<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSellingPriceToProductOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up(): void
    {
        Schema::table('product_order_items', function (Blueprint $table) {
            $table->decimal('retail_price', 10, 2)
                  ->nullable()
                  ->after('price');
        });
    }

    public function down(): void
    {
        Schema::table('product_order_items', function (Blueprint $table) {
            $table->dropColumn('retail_price');
        });
    }
}
