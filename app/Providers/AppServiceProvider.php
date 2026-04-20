<?php

namespace App\Providers;

use App\Models\Content;
use App\Models\Partner;
use App\Models\Project;
use App\Models\Testimonial;
use App\Observers\ContentObserver;
use App\Observers\PartnerObserver;
use App\Observers\ProjectObserver;
use App\Observers\TestimonialObserver;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureDefaults();
        $this->ensureStorageLink();

        if (app()->isProduction()) {
            URL::forceScheme('https');
        }

        Paginator::defaultView('vendor.pagination.kwdt');

        Content::observe(ContentObserver::class);
        Partner::observe(PartnerObserver::class);
        Project::observe(ProjectObserver::class);
        Testimonial::observe(TestimonialObserver::class);
    }

    protected function ensureStorageLink(): void
    {
        $link = public_path('storage');
        $target = storage_path('app/public');

        if (! file_exists($link) && file_exists($target)) {
            (new Filesystem)->link($target, $link);
        }
    }

    /**
     * Configure default behaviors for production-ready applications.
     */
    protected function configureDefaults(): void
    {
        Builder::defaultStringLength(191);

        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            false // temporarily disabled to allow initial seeding
        );

        Password::defaults(fn (): ?Password => app()->isProduction()
            ? Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
            : null,
        );
    }
}
