<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderRefToConciergeMobileSimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('concierge_mobile_sims', function (Blueprint $table) {
            $table->string('order_ref')->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('concierge_mobile_sims', function (Blueprint $table) {
            $table->dropColumn('order_ref');
        });
    }
}
