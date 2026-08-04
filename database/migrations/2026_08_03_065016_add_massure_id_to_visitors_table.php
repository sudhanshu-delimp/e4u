<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMassureIdToVisitorsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */

  public function up(): void
  {
    Schema::table('visitors', function (Blueprint $table) {
      $table->integer('masseur_id')->nullable()->after('id');
      $table->string('visitorUuid')->nullable()->after('masseur_id');
    });
  }

  public function down(): void
  {
    Schema::table('visitors', function (Blueprint $table) {
      $table->dropColumn('masseur_id');
      $table->dropColumn('visitorUuid');
    });
  }
}
