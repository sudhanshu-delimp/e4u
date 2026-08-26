<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveFirstLastNameAddBusinessNameToVisaMigrations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
  {
    Schema::table('visa_migrations', function (Blueprint $table) {
      $table->dropColumn(['first_name', 'last_name']);
      $table->string('business_name')->nullable()->after('id');
    });
  }

  public function down()
  {
    Schema::table('visa_migrations', function (Blueprint $table) {
      $table->string('first_name')->nullable();
      $table->string('last_name')->nullable();

      $table->dropColumn('business_name');
    });
  }
}
