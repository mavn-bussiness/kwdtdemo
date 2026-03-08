<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'content_id',
        'file_name',
        'file_path',
        'file_type',
        'file_size_kb',
        'report_year',
    ];

    protected function casts(): array
    {
        return [
            'report_year' => 'integer',
            'file_size_kb' => 'integer',
        ];
    }

    // -------------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------------

    /**
     * The parent content record (holds title, description, featured_image etc.)
     */
    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class);
    }

    // -------------------------------------------------------------------------
    // Scopes
    // -------------------------------------------------------------------------

    /**
     * Filter by report year.
     * Usage: Report::forYear(2024)->get()
     */
    public function scopeForYear(Builder $query, int $year): Builder
    {
        return $query->where('report_year', $year);
    }

    /**
     * Order by the most recent year first.
     */
    public function scopeLatestYear(Builder $query): Builder
    {
        return $query->orderByDesc('report_year');
    }

    // -------------------------------------------------------------------------
    // Helpers
    // -------------------------------------------------------------------------

    /**
     * Get the public download URL for this report file.
     */
    public function downloadUrl(): string
    {
        return Storage::url($this->file_path);
    }

    /**
     * Human-readable file size.
     * E.g. "2.4 MB", "340 KB"
     */
    public function formattedFileSize(): string
    {
        if (! $this->file_size_kb) {
            return 'Unknown size';
        }

        if ($this->file_size_kb >= 1024) {
            return round($this->file_size_kb / 1024, 1).' MB';
        }

        return $this->file_size_kb.' KB';
    }
}
