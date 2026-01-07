<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShareholderNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shareholder_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('current_day')->nullable();               // Date jab notification create/update hua 
            $table->string('heading');
            $table->enum('type', ['Ad hoc','Scheduled','Notice','Template'])->default('Ad hoc');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('member_id')->nullable(); 
            $table->enum('recurring_type', ['weekly', 'monthly', 'yearly', 'forever'])->nullable();
            $table->tinyInteger('start_day')->nullable();   // weekly/monthly literal day or yearly date
            $table->tinyInteger('end_day')->nullable();     // weekly/monthly literal day or yearly date
            $table->tinyInteger('start_month')->nullable(); // yearly ke liye month int (1-12)
            $table->tinyInteger('end_month')->nullable();   // yearly ke liye month int (1-12)
            $table->integer('num_recurring')->nullable();   // Kitne times repeat karna hai
            $table->text('content')->nullable();
            $table->string('template_name')->nullable();
            $table->enum('status', ['Published','Completed','Suspended', 'Removed'])->default('Published');
            $table->longText('scheduled_days')->nullable();
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
        Schema::dropIfExists('shareholder_notifications');
    }
}
