<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTypeVarifiedAndAddMediaVerificationIdToEscortsMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::table('escorts_medias', function (Blueprint $table) {

            // Drop old columns first
            $table->dropColumn(['type', 'varified']);
        });

        Schema::table('escorts_medias', function (Blueprint $table) {

            // Recreate columns with enum
            $table->enum('type', ['0', '1'])
                  ->nullable()
                  ->comment('0=>image; 1=>video')
                  ->after('user_id');

            $table->enum('varified', ['1', '2'])
                  ->nullable()
                  ->comment('1=>varified,2=>unvarified')
                  ->after('default');

            // Add media_verification_id column
            $table->unsignedBigInteger('media_verification_id')
                  ->nullable()
                  ->after('varified')
                  ->index();

            // Add foreign key
            $table->foreign('media_verification_id')
                  ->references('id')
                  ->on('media_verifications')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('escorts_medias', function (Blueprint $table) {

            $table->dropForeign(['media_verification_id']);
            $table->dropColumn('media_verification_id');

            $table->dropColumn(['type', 'varified']);
        });
    }
}
