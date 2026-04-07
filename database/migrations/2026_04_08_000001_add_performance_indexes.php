<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // donations — filtered by status, payment_method; sorted by created_at; searched by donor_name/email
        Schema::table('donations', function (Blueprint $table) {
            $table->index('status', 'donations_status_idx');
            $table->index('payment_method', 'donations_payment_method_idx');
            $table->index('created_at', 'donations_created_at_idx');
            $table->index('donor_email', 'donations_donor_email_idx');
        });

        // payment_transactions — looked up by donation_id (already has FK index) + status
        Schema::table('payment_transactions', function (Blueprint $table) {
            $table->index('status', 'pt_status_idx');
            $table->index('paid_at', 'pt_paid_at_idx');
        });

        // content — filtered by type and status constantly; sorted by published_at
        Schema::table('content', function (Blueprint $table) {
            $table->index('type', 'content_type_idx');
            $table->index('status', 'content_status_idx');
            $table->index('published_at', 'content_published_at_idx');
            $table->index(['type', 'status'], 'content_type_status_idx');
        });
    }

    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->dropIndex('donations_status_idx');
            $table->dropIndex('donations_payment_method_idx');
            $table->dropIndex('donations_created_at_idx');
            $table->dropIndex('donations_donor_email_idx');
        });

        Schema::table('payment_transactions', function (Blueprint $table) {
            $table->dropIndex('pt_status_idx');
            $table->dropIndex('pt_paid_at_idx');
        });

        Schema::table('content', function (Blueprint $table) {
            $table->dropIndex('content_type_idx');
            $table->dropIndex('content_status_idx');
            $table->dropIndex('content_published_at_idx');
            $table->dropIndex('content_type_status_idx');
        });
    }
};
