<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_commissions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('agent_id');
            $table->unsignedBigInteger('user_id')->nullable(); // Loggedin user id
            $table->integer('user_type')->nullable();// Loggedin user type

            // Morph columns
            $table->morphs('commissionable');

            // Commission info
            $table->decimal('purchase_amount', 10, 2)->default(0);
            $table->decimal('commission_amount', 10, 2)->default(0);
            $table->enum('amount_type', ['percent','fixed'])->default('percent');
            $table->decimal('total_commission_amount', 10, 2)->default(0);

            $table->enum('status', [
                'pending',
                'approved',
                'paid',
                'cancelled'
            ])->default('pending');

            $table->timestamp('commission_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->index('agent_id');
            $table->foreign('agent_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->index('user_id');
           $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agent_commissions');
    }
}
