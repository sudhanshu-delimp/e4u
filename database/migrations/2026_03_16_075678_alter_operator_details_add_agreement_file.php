<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterOperatorDetailsAddAgreementFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('operator_details', function (Blueprint $table) {
            $table->string('agreement_file')
                  ->nullable()
                  ->after('agreement_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('operator_details', function (Blueprint $table) {
            $table->dropColumn('agreement_file');
        });
    }
}
