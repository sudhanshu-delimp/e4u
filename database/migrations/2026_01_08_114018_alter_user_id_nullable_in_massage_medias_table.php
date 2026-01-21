<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUserIdNullableInMassageMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::statement("
            ALTER TABLE massage_medias 
            MODIFY banner_group ENUM('0', '1', '2', '3', '4', '5')
        ");

        
        Schema::table('massage_medias', function (Blueprint $table) {

            $table->unsignedBigInteger('user_id')
                  ->nullable()
                  ->default(null)
                  ->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('massage_medias', function (Blueprint $table) {
            //
        });
    }
}
