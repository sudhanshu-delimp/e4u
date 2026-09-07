<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSeoScriptAndRobotsTxtToSeoMetasTable extends Migration
{
    public function up()
    {
        Schema::table('seo_metas', function (Blueprint $table) {
            $table->text('schema_script')->nullable();
            $table->text('robots_txt')->nullable();
        });
    }

    public function down()
    {
        Schema::table('seo_metas', function (Blueprint $table) {
            $table->dropColumn(['schema_script', 'robots_txt']);
        });
    }
}
