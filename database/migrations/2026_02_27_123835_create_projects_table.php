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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('content_id')
                ->unique()                // enforces 1-to-1 with content
                ->constrained('content')
                ->cascadeOnDelete();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('location')->nullable();
            $table->enum('status', ['planned', 'ongoing', 'completed'])->default('planned');
            $table->unsignedInteger('beneficiaries_count')->nullable();
            $table->string('funder')->nullable();          // e.g. "GIZ", "EU Delegation", "ARCHE NOVA"
            $table->decimal('budget_usd', 12, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
