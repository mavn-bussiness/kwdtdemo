<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\KwdtContentActivityChart;
use App\Filament\Widgets\KwdtDonationsTrendChart;
use App\Filament\Widgets\KwdtRecentDonations;
use App\Filament\Widgets\KwdtStatsOverview;
use App\Filament\Widgets\KwdtSubscriberGrowthChart;
use App\Filament\Widgets\KwdtUpcomingEvents;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    public static function canAccess(): bool
    {
        return true;
    }

    protected static string|null|\BackedEnum $navigationIcon = 'heroicon-o-home';
    protected static ?string $title = 'Katosi Women Development Trust';
    protected static ?int $navigationSort = -1;

    public function getSubheading(): ?string
    {
        return 'Organisation Overview & Performance';
    }

    public function getWidgets(): array
    {
        $user = auth()->user();

        if ($user?->isEditor()) {
            return [
                KwdtContentActivityChart::class,
            ];
        }

        return [
            KwdtStatsOverview::class,
            KwdtDonationsTrendChart::class,
            KwdtContentActivityChart::class,
            KwdtSubscriberGrowthChart::class,
            KwdtRecentDonations::class,
            KwdtUpcomingEvents::class,
        ];
    }

    public function getColumns(): int|array
    {
        return 2;
    }
}
