<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeoMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo_metas', function (Blueprint $table) {
            $table->id();
            $table->string('route_name')->unique();
            $table->string('seo_label')->nullable();
            $table->string('url')->nullable();
            // Optional
            $table->foreignId('page_type_id')->nullable()->constrained('page_types')->nullOnDelete();

            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();

            // Open Graph
            $table->string('og_title')->nullable();
            $table->string('og_description')->nullable();
            $table->string('og_image')->nullable();

            $table->json('schema_json')->nullable();  

            // Extra content field for feature use
            $table->text('page_content')->nullable();

            $table->boolean('sitemap_include')->default(true);

            //for feature use
            $table->boolean('is_active')->default(true);


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
        Schema::dropIfExists('seo_metas');
    }
}
