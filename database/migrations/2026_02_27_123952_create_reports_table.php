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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('content_id')
                ->unique()                // enforces 1-to-1 with content
                ->constrained('content')
                ->cascadeOnDelete();
            $table->string('file_name');                   // original uploaded filename
            $table->string('file_path', 500);              // storage path e.g. reports/2024/annual-report.pdf
            $table->string('file_type', 50);               // e.g. 'pdf', 'docx'
            $table->unsignedInteger('file_size_kb')->nullable();
            $table->unsignedSmallInteger('report_year');   // e.g. 2024 — used for filtering/display
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
