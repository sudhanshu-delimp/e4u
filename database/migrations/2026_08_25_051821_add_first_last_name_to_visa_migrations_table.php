<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddFirstLastNameToVisaMigrationsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('visa_migrations', function (Blueprint $table) {
      $table->string('first_name')->nullable();
      $table->string('last_name')->nullable();

      DB::statement("
            ALTER TABLE visa_migrations
            MODIFY status ENUM(
                'pending',
                'on_hold',
                'in_progress',
                'completed'
            ) NOT NULL DEFAULT 'pending'
        ");
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('visa_migrations', function (Blueprint $table) {
      $table->dropColumn(['first_name', 'last_name']);

          DB::statement("
            ALTER TABLE visa_migrations
            MODIFY status ENUM(
                'pending',
                'in_progress',
                'completed'
            ) NOT NULL DEFAULT 'pending'
        ");
    });
  }
}
