<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo_url',
        'website',
        'description',
        'is_active',
        'order',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'order'     => 'integer',
        ];
    }

    // ── Accessors ────────────────────────────────────────────────────────────

    /**
     * Resolve the logo URL from either the direct column OR the media
     * morph relationship — whichever is populated.
     *
     * Returns null when neither source has a value.
     */
    public function getLogoUrlAttribute(): ?string
    {
        // 1. Direct column takes priority (fastest path)
        if (! empty($this->attributes['logo_url'])) {
            return $this->attributes['logo_url'];
        }

        // 2. Fall back to the first media record
        //    Works whether the relationship is already loaded or not.
        $media = $this->relationLoaded('media')
            ? $this->media->first()
            : $this->media()->first();

        if (! $media) {
            return null;
        }

        // Support common Media model field names
        return $media->url
            ?? $media->original_url
            ?? $media->path
            ?? (isset($media->file_name) ? asset('storage/' . $media->file_name) : null);
    }

    /**
     * True when a logo can be resolved from any source.
     */
    public function getHasLogoAttribute(): bool
    {
        return ! empty($this->logo_url);
    }

    /**
     * Initials fallback (max 4 chars, skips parenthesised text).
     */
    public function getInitialsAttribute(): string
    {
        $cleanName = preg_replace('/\s*\([^)]*\)/', '', $this->name);
        $initials  = '';

        foreach (explode(' ', trim($cleanName)) as $word) {
            if (! empty($word) && ctype_alpha($word[0])) {
                $initials .= strtoupper($word[0]);
            }
        }

        return substr($initials, 0, 4);
    }

    /**
     * Short display name: abbreviation from parentheses, or first 3 words.
     */
    public function getShortNameAttribute(): string
    {
        if (preg_match('/\(([^)]+)\)/', $this->name, $matches)) {
            return $matches[1];
        }

        return implode(' ', array_slice(explode(' ', $this->name), 0, 3));
    }

    // ── Relationships ────────────────────────────────────────────────────────

    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    // ── Scopes ───────────────────────────────────────────────────────────────

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('order');
    }
}
