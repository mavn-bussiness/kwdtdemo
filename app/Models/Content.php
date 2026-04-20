<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Content extends Model
{
    use HasSlug;

    protected $table = 'content';

    protected $fillable = [
        'title',
        'slug',
        'type',
        'status',
        'excerpt',
        'body',             // was sometimes called 'content' – standardised to 'body'
        'featured_image',   // stores the relative path from FileUpload
        'author_id',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    // -------------------------------------------------------------------------
    // Slug
    // -------------------------------------------------------------------------

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(80);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    // -------------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------------

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'content_categories');
    }

    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function project()
    {
        return $this->hasOne(Project::class);
    }

    public function event()
    {
        return $this->hasOne(Event::class);
    }

    public function report()
    {
        return $this->hasOne(Report::class);
    }

    // -------------------------------------------------------------------------
    // Scopes
    // -------------------------------------------------------------------------

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }

    public function scopeLatestPublished($query)
    {
        return $query->latest('published_at');
    }

    /**
     * Resolve featured_image to a public URL regardless of whether
     * the stored value is a full external URL or a local storage path.
     */
    public function featuredImageUrl(): ?string
    {
        if (empty($this->featured_image)) {
            return null;
        }
        if (str_starts_with($this->featured_image, 'http')) {
            return $this->featured_image;
        }
        return asset('storage/' . ltrim($this->featured_image, '/'));
    }
}
