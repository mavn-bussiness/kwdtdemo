<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    use HasFactory;

    /**
     * No updated_at — media files are immutable once uploaded.
     * If a file needs changing, the old record is deleted and a new one created.
     */
    public $timestamps = false;

    const string CREATED_AT = 'created_at';

    protected $fillable = [
        'mediable_type',
        'mediable_id',
        'file_path',
        'file_type',
        'file_name',
        'alt_text',
        'file_size_kb',
        'uploaded_by',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'file_size_kb' => 'integer',
        ];
    }

    // -------------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------------

    /**
     * The parent model this media belongs to.
     * Could be Content, TeamMember, or Partner.
     * Laravel resolves this automatically via mediable_type + mediable_id.
     */
    public function mediable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * The admin who uploaded this file.
     */
    public function uploadedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    // -------------------------------------------------------------------------
    // Helpers
    // -------------------------------------------------------------------------

    /**
     * Get the public URL for this media file.
     */
    public function url(): string
    {
        return Storage::url($this->file_path);
    }

    /**
     * Check if this media is an image type.
     */
    public function isImage(): bool
    {
        return str_starts_with($this->file_type, 'image/');
    }

    /**
     * Check if this media is a document (PDF, DOCX, etc.)
     */
    public function isDocument(): bool
    {
        return in_array($this->file_type, [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        ]);
    }

    /**
     * Human-readable file size.
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
