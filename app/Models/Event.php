<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'content_id',
        'event_date',
        'end_date',
        'venue',
        'district',
        'registration_url',
        'capacity',
    ];

    protected function casts(): array
    {
        return [
            'event_date' => 'datetime',
            'end_date' => 'datetime',
            'capacity' => 'integer',
        ];
    }

    // -------------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------------

    /**
     * The parent content record.
     */
    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class);
    }

    // -------------------------------------------------------------------------
    // Scopes
    // -------------------------------------------------------------------------

    /**
     * Upcoming events only (event_date in the future).
     * Usage: Event::upcoming()->get()
     */
    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->where('event_date', '>=', now());
    }

    /**
     * Past events only.
     */
    public function scopePast(Builder $query): Builder
    {
        return $query->where('event_date', '<', now());
    }

    // -------------------------------------------------------------------------
    // Helpers
    // -------------------------------------------------------------------------

    public function isUpcoming(): bool
    {
        return $this->event_date->isFuture();
    }

    public function isPast(): bool
    {
        return $this->event_date->isPast();
    }

    /**
     * Check if the event spans multiple days.
     */
    public function isMultiDay(): bool
    {
        return $this->end_date && ! $this->event_date->isSameDay($this->end_date);
    }
}
