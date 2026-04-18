<?php

namespace Database\Seeders;

use App\Models\Content;
use App\Models\Report;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeduplicateSeeder extends Seeder
{
    public function run(): void
    {
        // ── Find duplicate content rows by title (blog, project, report) ──────
        $duplicates = Content::select('title', 'type', DB::raw('COUNT(*) as count'), DB::raw('MIN(id) as keep_id'))
            ->groupBy('title', 'type')
            ->having('count', '>', 1)
            ->get();

        if ($duplicates->isEmpty()) {
            $this->command->info('No duplicate content rows found.');
            return;
        }

        $this->command->table(
            ['Title', 'Type', 'Duplicates', 'Keeping ID'],
            $duplicates->map(fn ($r) => [$r->title, $r->type, $r->count, $r->keep_id])->toArray()
        );

        foreach ($duplicates as $dup) {
            $idsToDelete = Content::where('title', $dup->title)
                ->where('type', $dup->type)
                ->where('id', '!=', $dup->keep_id)
                ->pluck('id');

            // Re-point any orphaned reports to the kept content row
            Report::whereIn('content_id', $idsToDelete)->update(['content_id' => $dup->keep_id]);

            // Clean up pivot rows for the dupes
            DB::table('content_categories')->whereIn('content_id', $idsToDelete)->delete();

            Content::whereIn('id', $idsToDelete)->delete();
        }

        $this->command->info('✓ Deduplication complete. Removed ' . $duplicates->sum(fn ($r) => $r->count - 1) . ' duplicate rows.');
    }
}
