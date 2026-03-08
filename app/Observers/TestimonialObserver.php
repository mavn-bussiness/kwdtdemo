<?php

namespace App\Observers;

use App\Models\Testimonial;
use App\Services\HomepageCache;

class TestimonialObserver
{
    public function saved(Testimonial $testimonial): void
    {
        HomepageCache::flush();
    }

    public function deleted(Testimonial $testimonial): void
    {
        HomepageCache::flush();
    }
}
