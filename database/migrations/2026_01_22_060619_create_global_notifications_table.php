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
        Schema::create('global_notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('heading');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('type', ['Ad hoc', 'Template']);
            $table->text('content')->nullable();
            $table->string('template_name')->nullable();
            $table->enum('status', ['Published', 'Completed', 'Suspended', 'Removed'])->default('Published');
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
        Schema::dropIfExists('global_notifications');
    }
};
