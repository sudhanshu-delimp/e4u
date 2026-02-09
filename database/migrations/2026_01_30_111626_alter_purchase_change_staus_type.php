<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AlterPurchaseChangeStausType extends Migration
{
    public function up()
    {
        DB::statement("
            ALTER TABLE purchase
            MODIFY status ENUM('pending','listed','expire','cancel')
            DEFAULT 'pending'
        ");
    }

    public function down()
    {
        DB::statement("
            ALTER TABLE purchase
            MODIFY status ENUM('per day','per week','Per Registration')
            DEFAULT 'per day'
        ");
    }
}