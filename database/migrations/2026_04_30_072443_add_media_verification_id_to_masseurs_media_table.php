<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMediaVerificationIdToMasseursMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('massuers_media', function (Blueprint $table) {
        $table->unsignedBigInteger('media_verification_id')->nullable()->after('varified');
    });
}

public function down()
{
    Schema::table('massuers_media', function (Blueprint $table) {
        $table->dropColumn('media_verification_id');
    });
}
}
