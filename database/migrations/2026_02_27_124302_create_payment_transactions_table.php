<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payment_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donation_id')
                ->constrained('donations')
                ->cascadeOnDelete();

            /*
             * transaction_id is the reference ID returned by the payment gateway
             * e.g. PayPal order ID, MTN MoMo referenceId
             * Must be unique — prevents duplicate webhook processing
             */
            $table->string('transaction_id')->unique();

            $table->enum('payment_gateway', ['paypal', 'mtn_momo', 'airtel_money']);
            $table->decimal('amount_usd', 10, 2);
            $table->string('currency', 3)->default('USD');

            /*
             * 'cancelled' added beyond the donations status ENUM
             * Mobile Money users can cancel the USSD prompt — that's distinct from a failed charge
             */
            $table->enum('status', ['pending', 'success', 'failed', 'cancelled'])->default('pending');

            /*
             * Store the raw gateway API response as JSON
             * Invaluable for debugging failed payments and reconciliation
             * e.g. PayPal capture response, MTN callback body
             */
            $table->json('gateway_response')->nullable();

            $table->timestamp('paid_at')->nullable();      // set when status becomes 'success'
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_transactions');
    }
};
