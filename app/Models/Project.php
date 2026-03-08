<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'content_id',
        'start_date',
        'end_date',
        'location',
        'status',
        'beneficiaries_count',
        'funder',
        'budget_usd',
    ];

    protected function casts(): array
    {
        return [
            'start_date'          => 'date',
            'end_date'            => 'date',
            'beneficiaries_count' => 'integer',
            'budget_usd'          => 'decimal:2',
        ];
    }

    // -------------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------------

    /**
     * The parent content record (holds title, body, slug, featured_image etc.)
     */
    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    // -------------------------------------------------------------------------
    // Scopes
    // -------------------------------------------------------------------------

    public function scopeOngoing(Builder $query): Builder
    {
        return $query->where('status', 'ongoing');
    }

    public function scopeCompleted(Builder $query): Builder
    {
        return $query->where('status', 'completed');
    }

    public function scopePlanned(Builder $query): Builder
    {
        return $query->where('status', 'planned');
    }

    // -------------------------------------------------------------------------
    // Helpers
    // -------------------------------------------------------------------------

    public function isOngoing(): bool
    {
        return $this->status === 'ongoing';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    /**
     * Human-readable status label for display in views.
     */
    public function statusLabel(): string
    {
        return match($this->status) {
            'planned'   => 'Planned',
            'ongoing'   => 'Ongoing',
            'completed' => 'Completed',
            default     => ucfirst($this->status),
        };
    }
}
