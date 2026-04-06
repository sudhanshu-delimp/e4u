<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement("
            ALTER TABLE escorts_medias 
            MODIFY varified ENUM('0','1','2') 
            NULL DEFAULT '0' 
            COMMENT '0 = pending, 1 = verified, 2 = unverified'
        ");
    }

    public function down()
    {
        DB::statement("
            ALTER TABLE escorts_medias 
            MODIFY varified ENUM('1','2') 
            NULL DEFAULT '1' 
            COMMENT '1 = verified, 2 = unverified'
        ");
    }
};