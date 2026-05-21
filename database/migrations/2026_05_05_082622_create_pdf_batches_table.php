<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePdfBatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pdf_batches', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('pending');
            $table->integer('total')->default(0);
            $table->integer('processed')->default(0);
            $table->string('file_path')->nullable();
            $table->string('file_type')->nullable();
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
        Schema::dropIfExists('pdf_batches');
    }
}
