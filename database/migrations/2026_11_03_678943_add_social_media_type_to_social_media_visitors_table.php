<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSocialMediaTypeToSocialMediaVisitorsTable extends Migration
{
    public function up()
    {
        Schema::table('social_media_visitors', function (Blueprint $table) {
            $table->enum('social_media_type', ['facebook', 'twitter', 'instagram', 'other'])->default('other')->index()->after('social_link');
        });
    }

    public function down()
    {
        Schema::table('social_media_visitors', function (Blueprint $table) {
            $table->dropColumn('social_media_type');
        });
    }
}