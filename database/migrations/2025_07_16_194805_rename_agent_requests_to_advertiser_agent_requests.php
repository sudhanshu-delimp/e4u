<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameAgentRequestsToAdvertiserAgentRequests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::rename('agent_requests', 'advertiser_agent_requests');
    }

    public function down(): void
    {
        Schema::rename('advertiser_agent_requests', 'agent_requests');
    }
}
