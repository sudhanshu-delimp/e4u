<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUpdatedByToPaymentHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        if (!Schema::hasColumn('payment_histories', 'updated_by')) {
            Schema::table('payment_histories', function (Blueprint $table) {

                $table->unsignedBigInteger('created_by')
                ->nullable()
                ->after('id');

                $table->unsignedBigInteger('updated_by')
                      ->nullable()
                      ->after('created_by');
                
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('payment_histories', 'updated_by')) {
            Schema::table('payment_histories', function (Blueprint $table) {
                $table->dropColumn('updated_by');
                $table->dropColumn('created_by');
            });
        }
    }
}
