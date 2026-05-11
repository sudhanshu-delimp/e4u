<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('shareholding', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index();
            $table->string('member_id')->index()->nullable();
            $table->date('date_of_entry')->nullable();;
            $table->enum('member_type', ['ordinary', 'corporate', 'associate'])->default('ordinary');;
            $table->enum('threshold', ['yes', 'no'])->default('no');
            $table->unsignedBigInteger('number_of_shares')->nullable();
            $table->decimal('share_purchase', 10, 2)->nullable();
            $table->unsignedInteger('shareholding')->nullable();
            $table->enum('held_on_trust', ['yes', 'no'])->default('no');
            $table->string('trust_deed_file')->nullable();
            $table->timestamps();
            // Optional foreign key (uncomment if users table exists)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shareholding');
    }
};