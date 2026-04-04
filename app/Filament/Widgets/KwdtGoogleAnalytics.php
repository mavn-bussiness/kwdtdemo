<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class KwdtGoogleAnalytics extends Widget
{
    protected static ?int $sort = 5;
    protected int|string|array $columnSpan = 'full';
    protected string $view = 'filament.widgets.google-analytics';

    public function getEmbedUrl(): ?string
    {
        return config('services.google_analytics.embed_url') ?: null;
    }

    public function getMeasurementId(): ?string
    {
        return config('services.google_analytics.measurement_id') ?: null;
    }
}
