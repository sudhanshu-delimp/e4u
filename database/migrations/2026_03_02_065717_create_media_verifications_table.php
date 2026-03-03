<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaVerificationsTable extends Migration
{
    public function up()
    {
        Schema::create('media_verifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');

            $table->string('image_path');

            // selfie / licence / passport
            $table->enum('type', ['0', '1', '2'])
             ->comment('0 = selfie, 1 = licence, 2 = passport');

             $table->enum('status', ['0', '1', '2'])
                ->default('0')
                ->comment('0 = pending, 1 = approved, 2 = rejected');
            $table->text('comment')->nullable();

            $table->unsignedBigInteger('reviewed_by')->nullable();
            $table->timestamp('reviewed_at')->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('reviewed_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('media_verifications');
    }
}