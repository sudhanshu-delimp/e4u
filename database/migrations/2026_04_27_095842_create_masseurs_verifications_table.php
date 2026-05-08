<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('masseurs_verifications', function (Blueprint $table) {
            $table->id();

            // Relations
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('masseur_id');

            // Image
            $table->string('image_path');

            // Status
            $table->enum('status', ['0', '1', '2'])
                ->default('0')
                ->comment('0 = pending, 1 = verified, 2 = unverified');


            // Review info
            $table->unsignedBigInteger('reviewed_by')->nullable();
            $table->timestamp('reviewed_at')->nullable();

            // Submitted by
            $table->unsignedBigInteger('submitted_by')->nullable();

            $table->timestamps();

            // Indexes
            $table->index('user_id');
            $table->index('masseur_id');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('masseurs_verifications');
    }
};