<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('member_id')->nullable();
            $table->longText('avatar_img')->nullable();
            $table->string('contact_type')->nullable()->comment('1=>Message; 2=>Text; 3=>Email; 4=>Callme');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->longText('social_links')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->unsignedBigInteger('state_id')->nullable();
            $table->unsignedBigInteger('current_state_id')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('otp')->nullable();
            $table->enum('status', ['1', '2', '3', '4', '5', '6', '7', '8'])->default('1')->comment('1=Active, 2=Pending, 3=Suspended, 4=Blocked, 5=Registered, 6=On Hold, 7=Rejected, 8=Cancelled');
            $table->text('rejection_reason')->nullable();
            $table->string('name')->nullable();
            $table->string('escorts_names')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('user_bank_pin', 10)->default('1234');
            $table->rememberToken();
            $table->string('pay_id_name')->nullable();
            $table->string('pay_id_no')->nullable();
            $table->enum('type', ['0', '1', '2', '3', '4', '5', '6', '7', '8'])->default('0')->comment('0=user; 1=admin; 2=sub-admin; 3=escort; 4=massage-center; 5=agents,6=staff, 7=operator,8=shareholder');
            $table->string('viewer_contact_type')->nullable()->comment('1=>Call me,2=>Text me,3=>Email me');
            $table->string('tour_permissition_type')->nullable()->comment('1=>Allow Created,2=>Allow Edit,3=>Post a Tour leg');
            $table->string('profile_creator')->nullable()->comment('1=>Stage Name optional 2=>Information over ride 3=>media information');
            $table->string('agent_communications')->nullable()->comment('1=Receive ,2=Send');
            $table->json('notification_features')->nullable();
            $table->string('alert_notifications')->nullable()->comment('1=>Email,2=>Text msg');
            $table->timestamp('last_online_at')->useCurrent()->comment('0=>female; 1=>male; 2=>ither');
            $table->string('ip')->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->tinyInteger('enabled');
            $table->tinyInteger('plan_type')->nullable()->comment('1- Platinum 2 - gold3- silver 4- free');
            $table->unsignedBigInteger('active_escort_id')->nullable();
            $table->timestamp('otp_created_at')->nullable();
            $table->string('business_name')->nullable();
            $table->bigInteger('business_number')->nullable();
            $table->bigInteger('abn')->nullable();
            $table->longText('business_address')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('email2')->nullable()->unique();
            $table->enum('is_agent_assign', ['0', '1'])->default('0')->comment('1-yes,0-No');
            $table->dateTime('agent_assign_date')->nullable();
            $table->integer('assigned_agent_id')->nullable()->comment('assigned agent id');
            $table->string('referred_by_agent_id')->nullable()->comment('referred by agent member id');
            $table->timestamps();
            $table->tinyInteger('available_playmate')->nullable();
            $table->integer('idle_preference_time')->default(30)->comment('Idle time preference in minutes default 30 minutes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
