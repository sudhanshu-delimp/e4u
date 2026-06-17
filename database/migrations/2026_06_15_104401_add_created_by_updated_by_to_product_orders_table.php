<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCreatedByUpdatedByToProductOrdersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('product_orders', function (Blueprint $table) {
      $table->unsignedBigInteger('created_by')->nullable()->after('id');
      $table->unsignedBigInteger('updated_by')->nullable()->after('created_by');

      // Optional foreign keys
      $table->foreign('created_by')->references('id')->on('users')->nullOnDelete();
      $table->foreign('updated_by')->references('id')->on('users')->nullOnDelete();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('product_orders', function (Blueprint $table) {
      $table->dropForeign(['created_by']);
      $table->dropForeign(['updated_by']);

      $table->dropColumn(['created_by', 'updated_by']);
    });
  }
}
