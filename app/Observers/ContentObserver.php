<?php

namespace App\Observers;

use App\Models\Content;
use App\Services\HomepageCache;

class ContentObserver
{
    /**
     * Fired after any save (create or update).
     * Only bust the cache when content status is published —
     * saving a draft shouldn't invalidate the public homepage cache.
     */
    public function saved(Content $content): void
    {
        if ($content->status === 'published') {
            HomepageCache::flush();
        }
    }

    /**
     * Bust cache when content is deleted too —
     * e.g. a published blog post gets removed.
     */
    public function deleted(Content $content): void
    {
        HomepageCache::flush();
    }
}
