<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProspectReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prospect_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agent_id');
            $table->string('post_code_label');
            $table->string('type'); // single, multiple, all
            $table->integer('listings_count')->default(0);
            $table->json('center_ids');
            $table->enum('merged', ['Yes', 'No'])->default('No');
            $table->enum('status_type', ['Unsave', 'Save'])->nullable();
            $table->timestamps();
            $table->index('agent_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prospect_reports');
    }
}
