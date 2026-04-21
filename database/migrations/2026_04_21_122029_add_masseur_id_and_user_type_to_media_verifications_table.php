<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMasseurIdAndUserTypeToMediaVerificationsTable extends Migration
{
    public function up()
    {
        Schema::table('media_verifications', function (Blueprint $table) {
            $table->unsignedBigInteger('masseur_id')
                  ->nullable()
                  ->after('user_id');

            $table->enum('user_type', ['1','2','3'])
                  ->comment('1 = Escorts, 2 = Massage Center, 3 = Masseur')
                  ->after('type');
        });
    }

    public function down()
    {
        Schema::table('media_verifications', function (Blueprint $table) {
            $table->dropColumn(['masseur_id', 'user_type']);
        });
    }
}