<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnPositionInMassageGalleryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
        Schema::table('massage_gallery', function (Blueprint $table) {
            $table->tinyInteger('position')->nullable()->comment('1=>position: default image, 2-7=>position: massage image,8=>position: massage image varification 9=>position: Banner Image,10=>position: banner varification image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('massage_gallery', function (Blueprint $table) {
            $table->dropColumn('position');
        });
    }
}
