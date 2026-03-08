<?php

namespace App\Observers;

use App\Models\Partner;
use App\Services\HomepageCache;

class PartnerObserver
{
    public function saved(Partner $partner): void
    {
        HomepageCache::flush();
    }

    public function deleted(Partner $partner): void
    {
        HomepageCache::flush();
    }
}
