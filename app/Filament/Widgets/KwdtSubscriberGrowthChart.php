<?php

namespace App\Filament\Widgets;

use App\Models\NewsletterSubscriber;
use Filament\Widgets\LineChartWidget;

class KwdtSubscriberGrowthChart extends LineChartWidget
{
    protected static ?int $sort = 4;
    protected int|string|array $columnSpan = 1;
    protected ?string $heading = 'Subscriber Growth — Last 6 Months';
    protected ?string $maxHeight = '260px';

    protected function getData(): array
    {
        $months = collect(range(5, 0))->map(fn ($i) => now()->subMonths($i));
        $labels = $months->map(fn ($m) => $m->format('M Y'))->toArray();

        $newSubs = $months->map(fn ($m) => NewsletterSubscriber::whereYear('subscribed_at', $m->year)
            ->whereMonth('subscribed_at', $m->month)
            ->count()
        )->toArray();

        // Cumulative active count as of each month-end (accounts for unsubscribes)
        $cumulative = $months->map(fn ($m) => NewsletterSubscriber::where('subscribed_at', '<=', $m->copy()->endOfMonth())
            ->where(fn ($q) => $q
                ->whereNull('unsubscribed_at')
                ->orWhere('unsubscribed_at', '>', $m->copy()->endOfMonth())
            )
            ->count()
        )->toArray();

        return [
            'datasets' => [
                [
                    'label'                => 'New Subscribers',
                    'data'                 => $newSubs,
                    'borderColor'          => '#F5820A',
                    'backgroundColor'      => 'rgba(245,130,10,0.12)',
                    'pointBackgroundColor' => '#F5820A',
                    'pointRadius'          => 4,
                    'tension'              => 0.4,
                    'fill'                 => true,
                    'yAxisID'              => 'y',
                ],
                [
                    'label'                => 'Total Active',
                    'data'                 => $cumulative,
                    'borderColor'          => '#F0A500',
                    'backgroundColor'      => 'transparent',
                    'pointBackgroundColor' => '#F0A500',
                    'pointRadius'          => 3,
                    'borderDash'           => [4, 3],
                    'tension'              => 0.4,
                    'fill'                 => false,
                    'yAxisID'              => 'y1',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y'  => [
                    'position'  => 'left',
                    'beginAtZero' => true,
                    'grid'      => ['color' => 'rgba(240,223,192,0.4)'],
                ],
                'y1' => [
                    'position' => 'right',
                    'grid'     => ['drawOnChartArea' => false],
                ],
                'x'  => ['grid' => ['display' => false]],
            ],
            'plugins' => ['legend' => ['position' => 'top']],
        ];
    }
}
