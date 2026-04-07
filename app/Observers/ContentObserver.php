<?php

namespace App\Observers;

use App\Models\Content;
use App\Services\HomepageCache;

class ContentObserver
{
    public function saving(Content $content): void
    {
        // Auto-set published_at when status transitions to published
        if ($content->isDirty('status') && $content->status === 'published' && ! $content->published_at) {
            $content->published_at = now();
        }

        // Clear published_at when archiving or reverting to draft
        if ($content->isDirty('status') && in_array($content->status, ['draft', 'archived'])) {
            $content->published_at = null;
        }
    }

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
