<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('visitors', function (Blueprint $table) {
            if (!Schema::hasColumn('visitors', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('id');
            }
            if (!Schema::hasColumn('visitors', 'user_type')) {
                $table->enum('user_type', ['guest','user'])->default('guest');
            }
            if (!Schema::hasColumn('visitors', 'ip_address')) {
                $table->string('ip_address')->after('user_id');
            }
            if (!Schema::hasColumn('visitors', 'page')) {
                $table->string('page')->nullable()->after('ip_address');
            }
            if (!Schema::hasColumn('visitors', 'platform')) {
                $table->string('platform')->nullable()->after('page');
            }
            if (!Schema::hasColumn('visitors', 'device')) {
                $table->string('device')->nullable()->after('platform');
            }
            if (!Schema::hasColumn('visitors', 'country')) {
                $table->string('country')->nullable()->after('device');
            }
            if (!Schema::hasColumn('visitors', 'state')) {
                $table->string('state')->nullable()->after('country');
            }
            if (!Schema::hasColumn('visitors', 'city')) {
                $table->string('city')->nullable()->after('state');
            }
            if (!Schema::hasColumn('visitors', 'landed')) {
                $table->string('landed')->nullable()->after('city');
            }
            if (!Schema::hasColumn('visitors', 'idle')) {
                $table->string('idle')->nullable()->after('landed');
            }
            if (!Schema::hasColumn('visitors', 'origin')) {
                $table->string('origin')->nullable()->after('idle');
            }
            if (!Schema::hasColumn('visitors', 'date')) {
                $table->dateTime('date')->nullable()->after('origin');
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
        Schema::table('visitors', function (Blueprint $table) {
            $table->dropColumn([
                'user_id', 'user_type' ,'ip_address', 'page', 'platform', 'device',
                'country','state', 'city', 'landed', 'idle', 'origin', 'date'
            ]);
        });
    }
}
