<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\KwdtGoogleAnalytics;
use App\Filament\Widgets\KwdtStatsOverview;
use App\Filament\Widgets\KwdtRecentDonations;
use App\Filament\Widgets\KwdtUpcomingEvents;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static string|null|\BackedEnum $navigationIcon = 'heroicon-o-home';

    protected static ?string $title = 'Dashboard';

    protected static ?int $navigationSort = -1; // Always first in nav

    public function getWidgets(): array
    {
        return [
            KwdtStatsOverview::class,
            KwdtGoogleAnalytics::class,
            KwdtRecentDonations::class,
            KwdtUpcomingEvents::class,
        ];
    }

    public function getColumns(): int|array
    {
        return 2;
    }
}
