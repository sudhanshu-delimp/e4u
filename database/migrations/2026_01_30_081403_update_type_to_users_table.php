<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateTypeToUsersTable extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE users 
            MODIFY type ENUM(
                '0','1','2','3','4','5','6','7','8','9'
            )
            NOT NULL DEFAULT '0'
            COMMENT '0=user,1=admin,2=sub-admin,3=escort,4=massage-center,5=agents,6=staff,7=operator,8=shareholder,9=operator-staff'
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE users 
            MODIFY type ENUM(
                '0','1','2','3','4','5','6','7','8'
            )
            NOT NULL DEFAULT '0'
            COMMENT '0=user,1=admin,2=sub-admin,3=escort,4=massage-center,5=agents,6=staff,7=operator,8=shareholder'
        ");
    }
}
