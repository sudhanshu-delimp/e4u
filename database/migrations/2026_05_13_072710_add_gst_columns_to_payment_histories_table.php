<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddGstColumnsToPaymentHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment_histories', function (Blueprint $table) {
            $table->decimal('net_amount', 10, 2)
                ->default(0.00)
                ->after('loyalty_amount');
            $table->decimal('gst_amount', 10, 2)
            ->default(0.00)
            ->after('net_amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment_histories', function (Blueprint $table) {
            $table->dropColumn([
                'net_amount',
                'gst_amount'
            ]);
        });
    }
}
