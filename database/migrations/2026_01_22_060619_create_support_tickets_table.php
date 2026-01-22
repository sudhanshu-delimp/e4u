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
        Schema::create('support_tickets', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id');
            $table->string('ref_number')->nullable()->index();
            $table->string('department', 50);
            $table->string('priority', 50);
            $table->string('service_type', 50);
            $table->string('subject');
            $table->text('message');
            $table->text('file')->nullable();
            $table->dateTime('created_on');
            $table->tinyInteger('status')->default(1)->comment('\'1\' => \'Active\', \'2\' => \'In-progress\',  \'3\' => \'Resolved\'');
            $table->char('unread', 1)->default('0')->comment('1=> unread, 0 =>read');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('support_tickets');
    }
};
