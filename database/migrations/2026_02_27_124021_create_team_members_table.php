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
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
                $table->string('title')->nullable();           // job title e.g. "Executive Director"
            $table->text('bio')->nullable();
            $table->text('photo_url')->nullable();
            $table->string('email')->nullable();
            $table->unsignedTinyInteger('order')->default(0); // controls display order on the page
            $table->boolean('is_active')->default(true);   // hide without deleting
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_members');
    }
};
