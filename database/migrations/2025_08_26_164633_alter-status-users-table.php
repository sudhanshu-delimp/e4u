<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterStatusUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up() 
   { 

     Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('status');
      });

    Schema::table('users', function (Blueprint $table) { 
        $table->enum('status', ['1', '2', '3','4'])
            ->default('1')
            ->comment('1-Active,2-Pending,3-Suspended,4-Blocked')
            ->after('otp');
     });
    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('status')->nullable();
        });
    }
}
