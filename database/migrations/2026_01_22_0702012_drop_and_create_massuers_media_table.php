<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropAndCreateMassuersMediaTable extends Migration
{
    
    
    public function up(): void
    {
        // 1. Drop table if exists
        Schema::dropIfExists('massuers_media');

        // 2. Create table again
        Schema::create('massuers_media', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('masseur_token_id')->nullable();
            $table->unsignedBigInteger('masseur_id')->nullable();

            $table->tinyInteger('type')
                  ->nullable()
                  ->comment('0 => image, 1 => video');

            $table->longText('path')->nullable();
            $table->text('banner_image')->nullable();

            $table->enum('template', ['0','1','2','3','4','5'])
                  ->default('0');

            $table->enum('banner_group', ['0','1','2','3','4','5'])
                  ->nullable();

            $table->tinyInteger('status')->default(1);

            $table->tinyInteger('position')
                  ->nullable()
                  ->comment(
                      "position 1-7 massage image,
                       position 9 banner image,
                       position 8 massage verification,
                       position 10 banner verification"
                  );

            $table->tinyInteger('default')->nullable();

            $table->tinyInteger('varified')
                  ->nullable()
                  ->comment('1 => verified, 2 => unverified');

            $table->timestamps();
        });
    }





    public function down()
    {
        //
    }
}
