<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Facades\DB;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    public function up(): void
    {
        // Re-type all existing 'news' rows to 'blog'
        \Illuminate\Support\Facades\DB::table('content')
            ->where('type', 'news')
            ->update(['type' => 'blog']);

        // Remove 'news' from the enum
        Schema::table('content', function (Blueprint $table) {
            $table->enum('type', ['blog', 'page', 'event', 'project', 'report'])
                ->default('blog')
                ->change();
        });
    }

    public function down(): void
    {
        Schema::table('content', function (Blueprint $table) {
            $table->enum('type', ['blog', 'news', 'page', 'event', 'project', 'report'])
                ->default('blog')
                ->change();
        });
    }
};
