<?php

namespace App\Observers;

use App\Models\Project;
use App\Services\HomepageCache;

class ProjectObserver
{
    public function saved(Project $project): void
    {
        HomepageCache::flush();
    }

    public function deleted(Project $project): void
    {
        HomepageCache::flush();
    }
}
