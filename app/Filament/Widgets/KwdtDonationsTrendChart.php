<?php

namespace App\Filament\Widgets;

use App\Models\Donation;
use Filament\Widgets\LineChartWidget;

class KwdtDonationsTrendChart extends LineChartWidget
{
    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    protected ?string $heading = 'Donation Revenue — Last 12 Months';

    protected ?string $description = 'Monthly USD totals from successful donations';

    protected ?string $maxHeight = '280px';

    protected function getData(): array
    {
        $months = collect(range(11, 0))->map(fn ($i) => now()->subMonths($i));

        // Single query — group by year+month instead of 24 separate queries
        $rows = Donation::where('status', 'success')
            ->where('created_at', '>=', now()->subMonths(11)->startOfMonth())
            ->selectRaw('YEAR(created_at) as yr, MONTH(created_at) as mo, SUM(amount_usd) as revenue, COUNT(*) as cnt')
            ->groupByRaw('YEAR(created_at), MONTH(created_at)')
            ->get()
            ->keyBy(fn ($r) => $r->yr.'-'.$r->mo);

        $labels = $months->map(fn ($m) => $m->format('M Y'))->toArray();
        $revenue = $months->map(fn ($m) => (float) ($rows->get($m->year.'-'.$m->month)?->revenue ?? 0))->toArray();
        $count = $months->map(fn ($m) => (int) ($rows->get($m->year.'-'.$m->month)?->cnt ?? 0))->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Revenue (USD)',
                    'data' => $revenue,
                    'borderColor' => '#F5820A',
                    'backgroundColor' => 'rgba(245,130,10,0.10)',
                    'pointBackgroundColor' => '#F5820A',
                    'pointRadius' => 4,
                    'tension' => 0.4,
                    'fill' => true,
                    'yAxisID' => 'y',
                ],
                [
                    'label' => 'Donations (count)',
                    'data' => $count,
                    'borderColor' => '#F0A500',
                    'backgroundColor' => 'rgba(240,165,0,0.07)',
                    'pointBackgroundColor' => '#F0A500',
                    'pointRadius' => 4,
                    'borderDash' => [5, 4],
                    'tension' => 0.4,
                    'fill' => false,
                    'yAxisID' => 'y1',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'position' => 'left',
                    'ticks' => ['callback' => 'function(v){return "$"+v.toLocaleString()}'],
                    'grid' => ['color' => 'rgba(240,223,192,0.4)'],
                ],
                'y1' => [
                    'position' => 'right',
                    'grid' => ['drawOnChartArea' => false],
                ],
                'x' => ['grid' => ['color' => 'rgba(240,223,192,0.3)']],
            ],
            'plugins' => [
                'legend' => ['position' => 'top'],
                'tooltip' => ['mode' => 'index', 'intersect' => false],
            ],
        ];
    }
}
