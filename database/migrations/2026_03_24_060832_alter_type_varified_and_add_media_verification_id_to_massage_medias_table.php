<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTypeVarifiedAndAddMediaVerificationIdToMassageMediasTable extends Migration
{
    public function up()
    {
        Schema::table('massage_medias', function (Blueprint $table) {

            // Drop old varified column
            if (Schema::hasColumn('massage_medias', 'varified')) {
                $table->dropColumn('varified');
            }
        });

        Schema::table('massage_medias', function (Blueprint $table) {

            // Add new varified column
            $table->enum('varified', ['1', '2'])
                  ->nullable()
                   ->comment('1=>verified,2=>unverified')
                  ->after('default');

            // Add media_verification_id column
            $table->unsignedBigInteger('media_verification_id')
                  ->nullable()
                  ->after('varified');

            // Add foreign key
            $table->foreign('media_verification_id')
                  ->references('id')
                  ->on('media_verifications')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('massage_medias', function (Blueprint $table) {

            // Drop foreign key first
            $table->dropForeign(['media_verification_id']);

            // Drop columns
            $table->dropColumn('media_verification_id');
            $table->dropColumn('varified');
        });

        // Optional: Recreate old varified column if needed
        Schema::table('massage_medias', function (Blueprint $table) {
            $table->string('varified')->nullable();
        });
    }
}