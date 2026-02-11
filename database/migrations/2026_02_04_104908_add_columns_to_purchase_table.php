<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToPurchaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase', function (Blueprint $table) {
            $table->decimal('rate', 10, 2)
                  ->default(0.00)
                  ->after('status');
        
            $table->decimal('discount_rate', 10, 2)
                  ->default(0.00)
                  ->after('rate');
        
            $table->decimal('total_rate', 10, 2)
                  ->default(0.00)
                  ->after('discount_rate');
        
            $table->decimal('paid_rate', 10, 2)
                  ->default(0.00)
                  ->after('total_rate');
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
            $table->dropColumn([
                'rate',
                'discount_rate',
                'total_rate',
                'paid_rate',
            ]);
        });
    }
}
