<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddPaymentColumnsToPaymentHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment_histories', function (Blueprint $table) {
            $table->decimal('wallet_amount', 10, 2)
                ->default(0.00)
                ->after('amount');

            $table->decimal('loyalty_amount', 10, 2)
                ->default(0.00)
                ->after('wallet_amount');

            $table->decimal('paid_amount', 10, 2)
                ->default(0.00)
                ->after('loyalty_amount');
        });

        // Copy amount values to paid_amount
        DB::table('payment_histories')->update([
            'paid_amount' => DB::raw('amount')
        ]);
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
                'wallet_amount',
                'loyalty_amount',
                'paid_amount'
            ]);
        });
    }
}
