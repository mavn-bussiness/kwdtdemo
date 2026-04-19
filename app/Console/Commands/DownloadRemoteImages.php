<?php

namespace App\Console\Commands;

use App\Models\Award;
use App\Models\Content;
use App\Models\Partner;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DownloadRemoteImages extends Command
{
    protected $signature   = 'images:download-remote {--dry-run : Preview without saving}';
    protected $description = 'Download all remote images and update DB paths to local storage';

    private int $downloaded = 0;
    private int $skipped    = 0;
    private int $failed     = 0;

    public function handle(): int
    {
        $dry = $this->option('dry-run');

        $this->processTable(
            label:    'content.featured_image',
            records:  Content::whereNotNull('featured_image')
                             ->where('featured_image', 'not like', 'images/%')
                             ->where('featured_image', 'not like', '/storage/%')
                             ->get(['id', 'featured_image']),
            urlField: 'featured_image',
            folder:   'images/content',
            update:   fn ($id, $path) => DB::table('content')->where('id', $id)->update(['featured_image' => $path]),
            dry:      $dry,
        );

        $this->processTable(
            label:    'partners.logo_url',
            records:  Partner::whereNotNull('logo_url')
                             ->where('logo_url', 'not like', 'images/%')
                             ->where('logo_url', 'not like', '/storage/%')
                             ->get(['id', 'logo_url']),
            urlField: 'logo_url',
            folder:   'images/partners',
            update:   fn ($id, $path) => DB::table('partners')->where('id', $id)->update(['logo_url' => $path]),
            dry:      $dry,
        );

        $this->processTable(
            label:    'awards.image_url',
            records:  Award::whereNotNull('image_url')
                           ->where('image_url', 'not like', 'images/%')
                           ->where('image_url', 'not like', '/storage/%')
                           ->get(['id', 'image_url']),
            urlField: 'image_url',
            folder:   'images/awards',
            update:   fn ($id, $path) => DB::table('awards')->where('id', $id)->update(['image_url' => $path]),
            dry:      $dry,
        );

        $this->newLine();
        $this->table(['Stat', 'Count'], [
            ['Downloaded',             $this->downloaded],
            ['Skipped (already local)', $this->skipped],
            ['Failed',                 $this->failed],
        ]);

        if ($dry) {
            $this->warn('Dry-run — no files written, no DB rows updated.');
        }

        return self::SUCCESS;
    }

    private function processTable(
        string $label,
        $records,
        string $urlField,
        string $folder,
        callable $update,
        bool $dry
    ): void {
        $this->info("\n── {$label} ({$records->count()} rows) ──");

        foreach ($records as $record) {
            $url = $record->$urlField;

            if (! filter_var($url, FILTER_VALIDATE_URL)) {
                $this->line("  SKIP  (not a URL) {$url}");
                $this->skipped++;
                continue;
            }

            $urlPath  = parse_url($url, PHP_URL_PATH);
            $basename = basename(urldecode($urlPath));
            $basename = Str::slug(pathinfo($basename, PATHINFO_FILENAME))
                        .'.'.strtolower(pathinfo($basename, PATHINFO_EXTENSION) ?: 'jpg');
            $storagePath = "{$folder}/{$basename}";

            // If file already downloaded, just update the DB path
            if (Storage::disk('public')->exists($storagePath)) {
                $this->line("  EXIST {$storagePath}");
                if (! $dry) {
                    $update($record->id, $storagePath);
                }
                $this->skipped++;
                continue;
            }

            if ($dry) {
                $this->line("  WOULD → {$storagePath}");
                $this->downloaded++;
                continue;
            }

            try {
                $response = Http::timeout(30)->get($url);

                if (! $response->successful()) {
                    $this->error("  FAIL  [{$response->status()}] {$url}");
                    $this->failed++;
                    continue;
                }

                Storage::disk('public')->put($storagePath, $response->body());
                $update($record->id, $storagePath);
                $this->line("  OK    {$storagePath}");
                $this->downloaded++;

            } catch (\Throwable $e) {
                $this->error("  FAIL  {$url} — {$e->getMessage()}");
                $this->failed++;
            }
        }
    }
}
