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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('content_id')
                ->unique()                // enforces 1-to-1 with content
                ->constrained('content')
                ->cascadeOnDelete();
            $table->dateTime('event_date');
            $table->dateTime('end_date')->nullable();
            $table->string('venue')->nullable();
            $table->string('district')->nullable();        // e.g. "Mukono", "Kalangala", "Buvuma"
            $table->string('registration_url', 500)->nullable();
            $table->unsignedInteger('capacity')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
