<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


class UpdateStatusEnumInUsersTable extends Migration
{
 public function up()
{
    // Step 1: Convert ENUM to VARCHAR temporarily
    DB::statement("
        ALTER TABLE `users`
        CHANGE COLUMN `status` `status` VARCHAR(2) NOT NULL DEFAULT '1';
    ");

    // Step 2: Convert VARCHAR back to ENUM with all values
    DB::statement("
        ALTER TABLE `users`
        MODIFY `status` ENUM('1','2','3','4','5','6','7','8')
        NOT NULL DEFAULT '1'
        COMMENT '1=Active, 2=Pending, 3=Suspended, 4=Blocked, 5=Registered, 6=On Hold, 7=Rejected, 8=Cancelled';
    ");
}

public function down()
{
    // Revert ENUM back to old values if migration rolled back
    DB::statement("
        ALTER TABLE `users`
        CHANGE COLUMN `status` `status` VARCHAR(2) NOT NULL DEFAULT '1';
    ");

    DB::statement("
        ALTER TABLE `users`
        MODIFY `status` ENUM('1','2','3','4')
        NOT NULL DEFAULT '1'
        COMMENT '1=Active, 2=Pending, 3=Suspended, 4=Blocked';
    ");
}

}
