<?php

use App\Models\Escort;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStarRatingToEscortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('escorts', function (Blueprint $table) {
            $table->integer('star_rating')->default(0)->after('membership');
        });

        Escort::chunkById(100, function ($escorts) {
            foreach ($escorts as $escort) {
                $escort->update([
                    'star_rating' => getStarRatingForEscort($escort->id)
                ]);
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('escorts', function (Blueprint $table) {
            $table->dropColumn('star_rating');
        });
    }
}
