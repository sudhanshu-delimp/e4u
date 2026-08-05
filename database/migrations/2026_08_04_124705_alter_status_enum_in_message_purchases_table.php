<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AlterStatusEnumInMessagePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            ALTER TABLE massage_purchases
            MODIFY COLUMN status
            ENUM('pending', 'listed', 'expire', 'cancel', 'suspend')
            NOT NULL DEFAULT 'pending'
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("
            ALTER TABLE massage_purchases
            MODIFY COLUMN status
            ENUM('pending', 'listed', 'expire', 'cancel')
            NOT NULL DEFAULT 'pending'
        ");
    }
}
