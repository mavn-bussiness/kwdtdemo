<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Remove 'award' and 'thematic_area' from the content.type enum.
     *
     * These are standalone tables (awards, thematic_areas) that have no
     * content_id FK and were never intended to go through the content table.
     * Their enum values were added by mistake and are unused.
     *
     * MySQL requires re-declaring the full enum to change it.
     */
    public function up(): void
    {
        // Safety: ensure no rows use these types before altering
        DB::table('content')
            ->whereIn('type', ['award', 'thematic_area'])
            ->delete();

        Schema::table('content', function (Blueprint $table) {
            $table->enum('type', ['blog', 'news', 'page', 'event', 'project', 'report'])
                ->default('blog')
                ->change();
        });
    }

    public function down(): void
    {
        Schema::table('content', function (Blueprint $table) {
            $table->enum('type', ['blog', 'page', 'event', 'news', 'project', 'report', 'award', 'thematic_area'])
                ->change();
        });
    }
};
