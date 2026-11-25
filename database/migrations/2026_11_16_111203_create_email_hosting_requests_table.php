<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailHostingRequestsTable extends Migration
{
  public function up(): void
  {
    Schema::create('email_hosting_requests', function (Blueprint $table) {
      $table->id();

      // User details
      $table->unsignedBigInteger('user_id')->nullable();
      $table->string('user_type')->nullable()
        ->comment('Requesting user type: escort, massage_center etc.');

      // Contact details
      $table->string('email');
      $table->string('first_name');
      $table->string('last_name');
      $table->string('mobile')->nullable();
      $table->json('contact_preference')->nullable()->comment('Email, SMS or other contact preferences');

      // Request details
      $table->boolean('term_condition')->default(false);
      $table->boolean('auth')->default(false)
        ->comment('Whether the user authorized the one-time payment');
      $table->unsignedInteger('period_required')->nullable()
        ->comment('Email hosting duration in months');

      // Request status
      $table->enum('request_status', ['pending', 'active', 'on_hold', 'completed', 'rejected', 'cancelled'])->default('pending');

      // Payment details (One-time payment only)
      $table->enum('payment_status', ['pending', 'processing', 'paid', 'failed', 'refunded'])->default('pending');

      // Pricing breakdown
      $table->decimal('monthly_fee', 10, 2)->default(0)
        ->comment('Monthly pricing used to calculate the one-time payment');

      $table->decimal('total_subscription_cost', 10, 2)->default(0) ->comment('Total base cost for the requested duration, excluding GST');

      $table->decimal('gst_rate', 5, 2)->default(0)->comment('GST percentage');
      $table->decimal('total_gst', 10, 2)->default(0)->comment('Total GST for the requested duration');
      $table->decimal('total_amount', 10, 2)->default(0)->comment('Total one-time payment amount including GST');
      $table->decimal('amount_paid', 10, 2)->default(0)->comment('Actual amount successfully paid');
      $table->string('currency', 3)->default('AUD');

      // Payment dates
      $table->timestamp('payment_date')->nullable()->comment('Date and time payment was successfully completed');

      // Service validity dates
      $table->date('start_date')->nullable()->comment('Email hosting service start date');
      $table->date('end_date')->nullable()->comment('Email hosting service expiry date');

      // Payment gateway information
      $table->string('payment_gateway')->nullable();
      $table->string('gateway_customer_id')->nullable();
      $table->string('payment_method_id')->nullable();
      $table->string('payment_transaction_id')->nullable()->comment('Payment Intent ID or gateway transaction ID');
      $table->string('payment_reference')->nullable() ->comment('Internal or external payment reference');

      // Payment failure / refund information
      $table->text('payment_error_message')->nullable();
      $table->timestamp('refunded_at')->nullable();
      $table->decimal('refunded_amount', 10, 2)->default(0);

      // Admin notes
      $table->text('comments')->nullable();

      // Indexes
      $table->index('user_type');
      $table->index('request_status');
      $table->index('payment_status');
      $table->index('user_id');
      $table->index('payment_transaction_id');
      $table->index('payment_date');

      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('email_hosting_requests');
  }
}
