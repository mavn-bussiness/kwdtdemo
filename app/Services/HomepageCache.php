<?php

namespace App\Services;

use App\Models\Content;
use App\Models\Partner;
use App\Models\Project;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Cache;

class HomepageCache
{
    /**
     * Fetch all homepage data — each section cached independently.
     */
    public static function get(): array
    {
        return [
            'blogs' => static::blogs(),
            'projects' => static::projects(),
            'partners' => static::partners(),
            'testimonials' => static::testimonials(),
        ];
    }

    public static function blogs()
    {
        return static::remember('homepage.blogs', 6 * 60, fn () => Content::published()
            ->whereIn('type', ['blog', 'news'])
            ->latestPublished()
            ->with('categories')
            ->take(3)
            ->get()
        );
    }

    public static function projects()
    {
        return static::remember('homepage.projects', 12 * 60, fn () => Project::with('content')
            ->take(3)
            ->get()
        );
    }

    public static function partners()
    {
        return static::remember('homepage.partners', 24 * 60, fn () => Partner::with('media')
            ->active()
            ->orderBy('order')
            ->get()
        );
    }

    public static function testimonials()
    {
        return static::remember('homepage.testimonials', 24 * 60, fn () => Testimonial::where('is_featured', true)
            ->orderBy('order')
            ->take(3)
            ->get()
        );
    }

    /**
     * Cache::remember with a fallback — if the cache driver is unavailable
     * (e.g. Redis not yet provisioned) it runs the query directly instead of crashing.
     */
    private static function remember(string $key, int $minutes, \Closure $callback)
    {
        try {
            return Cache::remember($key, now()->addMinutes($minutes), $callback);
        } catch (\Exception) {
            return $callback();
        }
    }

    /**
     * Bust all homepage cache keys at once.
     * Call this from an Observer or admin action whenever content is updated.
     */
    public static function flush(): void
    {
        try {
            Cache::forget('homepage.blogs');
            Cache::forget('homepage.projects');
            Cache::forget('homepage.partners');
            Cache::forget('homepage.testimonials');
        } catch (\Exception) {
            // Cache unavailable — nothing to flush
        }
    }
}
