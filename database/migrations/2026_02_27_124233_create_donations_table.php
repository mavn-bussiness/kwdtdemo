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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->string('donor_name')->nullable();       // null if is_anonymous = true
            $table->string('donor_email')->nullable();      // null if is_anonymous = true
            $table->string('donor_phone', 50)->nullable();  // required for MTN MoMo & Airtel Money
            $table->text('reason')->nullable();             // optional message from the donor

            /*
             * Split amount into original + USD equivalent
             * A Ugandan donor paying via MTN pays in UGX — storing only USD would lose precision
             * amount_usd is populated after conversion and is used for reporting/totals
             */
            $table->decimal('amount_original', 15, 2);     // what the donor actually entered
            $table->string('currency', 3)->default('USD'); // 'UGX', 'USD', 'EUR'
            $table->decimal('amount_usd', 10, 2)->nullable(); // converted equivalent, set after payment

            $table->enum('payment_method', ['paypal', 'mtn_momo', 'airtel_money']);
            $table->boolean('is_anonymous')->default(false);

            /*
             * status here is a convenience mirror of the latest payment_transaction status
             * Source of truth is always payment_transactions — this is for quick queries only
             * e.g. "show me all successful donations" without joining transactions
             */
            $table->enum('status', ['pending', 'success', 'failed'])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
