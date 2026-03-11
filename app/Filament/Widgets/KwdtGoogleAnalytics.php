<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class KwdtGoogleAnalytics extends Widget
{
    protected static ?int $sort = 2;
    protected int|string|array $columnSpan = 'full';
    protected string $view = 'filament.widgets.google-analytics';

    /**
     * The GA4 embedded report URL.
     * Set GOOGLE_ANALYTICS_EMBED_URL in your .env after following setup steps.
     */
    public function getEmbedUrl(): ?string
    {
        return config('services.google_analytics.embed_url');
    }

    public function getMeasurementId(): ?string
    {
        return config('services.google_analytics.measurement_id');
    }
}
