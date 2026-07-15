<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE punterbox
            MODIFY COLUMN incident_nature ENUM(
                'Fraud',
                'No Show',
                'Violence',
                'Fake',
                'Under performed',
                'Liar',
                'Star fish',
                'Overpriced',
                'Rude'
            ) NULL
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE punterbox
            MODIFY COLUMN incident_nature ENUM(
                'Fraud',
                'No Show',
                'Violence'
            ) NULL
        ");
    }
};