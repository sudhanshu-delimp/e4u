<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('timezones', function (Blueprint $table) {
            $table->id();
            $table->integer('state_id')->nullable()->index();
            $table->string('state_name', 100)->nullable();
            $table->string('timezone_id', 100)->nullable();
            $table->string('standard_utc', 100)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('timezones');
    }
};
