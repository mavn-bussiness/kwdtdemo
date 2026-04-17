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
        Schema::create('content', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->enum('type', ['blog', 'page', 'event', 'news', 'project', 'report', 'award', 'thematic_area']);
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->text('excerpt')->nullable();           // short summary shown in cards & meta description
            $table->longText('body')->nullable();          // full rich-text content
            $table->text('featured_image')->nullable();
            $table->foreignId('author_id')
                ->constrained('users')
                ->restrictOnDelete();                    // prevent deleting a user who has authored content
            $table->timestamp('published_at')->nullable(); // null = not yet published
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content');
    }
};
