<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('page_title')->nullable();
            $table->string('slug')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('sub_title')->nullable();
            $table->string('body_title')->nullable();
            $table->text('content')->nullable();
            $table->tinyInteger('published')->comment('1-published 0-unpublished')->default(0);
             $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
