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
     * This means updating a partner doesn't bust the blogs cache etc.
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
        return Cache::remember('homepage.blogs', now()->addHours(6), fn () => Content::published()
            ->ofType('blog')
            ->latestPublished()
            ->take(3)
            ->get()
        );
    }

    public static function projects()
    {
        return Cache::remember('homepage.projects', now()->addHours(12), fn () => Project::with('content')
            ->ongoing()
            ->take(3)
            ->get()
        );
    }

    public static function partners()
    {
        return Cache::remember('homepage.partners', now()->addDay(), fn () => Partner::active()->get()
        );
    }

    public static function testimonials()
    {
        return Cache::remember('homepage.testimonials', now()->addDay(), fn () => Testimonial::featured()->get()
        );
    }

    /**
     * Bust all homepage cache keys at once.
     * Called by observers when any relevant model is saved or deleted.
     */
    public static function flush(): void
    {
        Cache::forget('homepage.blogs');
        Cache::forget('homepage.projects');
        Cache::forget('homepage.partners');
        Cache::forget('homepage.testimonials');
    }
}
