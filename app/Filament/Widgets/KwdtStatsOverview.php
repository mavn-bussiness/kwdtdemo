<?php

namespace App\Filament\Widgets;

use App\Models\Content;
use App\Models\Donation;
use App\Models\NewsletterSubscriber;
use App\Models\TeamMember;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class KwdtStatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        // Donations this month vs. last month
        $totalRevenue = Donation::where('status', 'success')->sum('amount_usd') ?? 0;
        $donationsThisMonth = Donation::where('status', 'success')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        $donationsLastMonth = Donation::where('status', 'success')
            ->whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();
        $donationTrend = $donationsLastMonth > 0
            ? round((($donationsThisMonth - $donationsLastMonth) / $donationsLastMonth) * 100)
            : 0;

        // Content counts
        $publishedContent = Content::where('status', 'published')->count();
        $draftContent = Content::where('status', 'draft')->count();

        // Team
        $activeTeam = TeamMember::where('is_active', true)->count();

        // Subscribers
        $activeSubscribers = NewsletterSubscriber::where('is_active', true)->count();
        $newSubscribers = NewsletterSubscriber::where('is_active', true)
            ->whereMonth('subscribed_at', now()->month)
            ->count();

        return [
            Stat::make('Total Revenue (USD)', '$'.number_format($totalRevenue, 2))
                ->description($donationsThisMonth.' donations this month')
                ->descriptionIcon($donationTrend >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($donationTrend >= 0 ? 'success' : 'danger'),

            Stat::make('Donations This Month', $donationsThisMonth)
                ->description($donationTrend >= 0 ? '+'.$donationTrend.'% vs last month' : $donationTrend.'% vs last month')
                ->descriptionIcon($donationTrend >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($donationTrend >= 0 ? 'success' : 'warning'),

            Stat::make('Published Content', $publishedContent)
                ->description($draftContent.' drafts pending')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('info'),

            Stat::make('Active Team Members', $activeTeam)
                ->description('Staff & leadership')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),

            Stat::make('Newsletter Subscribers', $activeSubscribers)
                ->description($newSubscribers.' new this month')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('warning'),
        ];
    }
}
