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
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->morphs('mediable');

            $table->string('file_path', 500);
            $table->string('file_type', 50);               // e.g. 'image/jpeg', 'image/png', 'application/pdf'
            $table->string('file_name');                   // original uploaded filename
            $table->string('alt_text')->nullable();        // for accessibility & SEO on images
            $table->unsignedInteger('file_size_kb')->nullable();
            $table->foreignId('uploaded_by')
                ->constrained('users')
                ->restrictOnDelete();
            $table->timestamp('created_at')->nullable();   // no updated_at — media is immutable once uploaded
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
