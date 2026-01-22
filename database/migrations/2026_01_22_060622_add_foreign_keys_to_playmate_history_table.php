<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('playmate_history', function (Blueprint $table) {
            $table->foreign(['escort_id'])->references(['id'])->on('escorts')->onDelete('CASCADE');
            $table->foreign(['user_id'])->references(['id'])->on('users')->onDelete('CASCADE');
            $table->foreign(['playmate_id'])->references(['id'])->on('escorts')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('playmate_history', function (Blueprint $table) {
            $table->dropForeign('playmate_history_escort_id_foreign');
            $table->dropForeign('playmate_history_user_id_foreign');
            $table->dropForeign('playmate_history_playmate_id_foreign');
        });
    }
};
