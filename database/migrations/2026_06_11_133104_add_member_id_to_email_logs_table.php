<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddMemberIdToEmailLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('email_logs', function (Blueprint $table) {
            $table->string('member_id')->nullable()->after('id');
        });

         $this->updateMemberIds();
    }

    private function updateMemberIds(): void
    {
        DB::table('email_logs')
            ->select('id', 'to')
            ->orderBy('id')
            ->chunk(500, function ($logs) {
                foreach ($logs as $log) {
                    $emails = json_decode($log->to, true);
                    if (empty($emails) || ! isset($emails[0])) {
                        continue;
                    }
                    $email = $emails[0];
                    $memberId = DB::table('users')
                        ->where('email', $email)
                        ->value('member_id');

                    if ($memberId) {
                        DB::table('email_logs')
                            ->where('id', $log->id)
                            ->update([
                                'member_id' => $memberId,
                            ]);
                    }
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
        Schema::table('email_logs', function (Blueprint $table) {
            $table->dropColumn('member_id');
        });
    }
}
