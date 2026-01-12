<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddTypeOptionToViewerNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('viewer_notifications', function (Blueprint $table) {
            $table->string('template_name')->nullable()->after('content');
            DB::statement("ALTER TABLE viewer_notifications MODIFY COLUMN type 
                ENUM('Ad hoc', 'Scheduled', 'Notice', 'Template') 
                NOT NULL DEFAULT 'Ad hoc'");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('viewer_notifications', function (Blueprint $table) {
            $table->dropColumn('template_name');

            DB::statement("ALTER TABLE viewer_notifications MODIFY COLUMN type
            ENUM('Ad hoc', 'Scheduled', 'Notice')
            NOT NULL DEFAULT 'Ad hoc'");
        });
    }
}
