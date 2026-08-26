<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToVisaMigrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
{
    Schema::table('visa_migrations', function (Blueprint $table) {
        $table->enum('status', ['pending', 'in_progress', 'completed'])
            ->default('pending')
            ->after('user_id');
    });
}

public function down()
{
    Schema::table('visa_migrations', function (Blueprint $table) {
        $table->dropColumn('status');
    });
}
}
