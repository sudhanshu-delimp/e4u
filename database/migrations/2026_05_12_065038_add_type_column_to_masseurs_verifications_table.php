<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeColumnToMasseursVerificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('masseurs_verifications', function (Blueprint $table) {
            $table->enum('type', ['0', '1', '2'])
                ->nullable()
                ->comment('0 = selfie, 1 = licence, 2 = passport')
                ->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('masseurs_verifications', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
}