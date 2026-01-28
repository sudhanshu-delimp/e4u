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
        Schema::table('escort_playmate', function (Blueprint $table) {
            $table->foreign(['escort_id'])->references(['id'])->on('escorts')->onDelete('CASCADE');
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
        Schema::table('escort_playmate', function (Blueprint $table) {
            $table->dropForeign('escort_playmate_escort_id_foreign');
            $table->dropForeign('escort_playmate_playmate_id_foreign');
        });
    }
};
