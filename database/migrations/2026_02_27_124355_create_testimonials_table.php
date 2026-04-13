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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('community')->nullable();        // e.g. "Katosi Landing Site, Mukono"
            $table->text('quote');
            $table->text('photo_url')->nullable();
            $table->boolean('is_featured')->default(false); // true = shows on homepage
            $table->unsignedTinyInteger('order')->default(0); // controls display order
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
