<?php

namespace App\Filament\Widgets;

use App\Models\Donation;
use Filament\Widgets\LineChartWidget;
use Illuminate\Support\Carbon;

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

        $labels = $months->map(fn ($m) => $m->format('M Y'))->toArray();

        $revenue = $months->map(fn ($m) => (float) Donation::where('status', 'success')
            ->whereYear('created_at', $m->year)
            ->whereMonth('created_at', $m->month)
            ->sum('amount_usd')
        )->toArray();

        $count = $months->map(fn ($m) => Donation::where('status', 'success')
            ->whereYear('created_at', $m->year)
            ->whereMonth('created_at', $m->month)
            ->count()
        )->toArray();

        return [
            'datasets' => [
                [
                    'label'                => 'Revenue (USD)',
                    'data'                 => $revenue,
                    'borderColor'          => '#F5820A',
                    'backgroundColor'      => 'rgba(245,130,10,0.10)',
                    'pointBackgroundColor' => '#F5820A',
                    'pointRadius'          => 4,
                    'tension'              => 0.4,
                    'fill'                 => true,
                    'yAxisID'              => 'y',
                ],
                [
                    'label'                => 'Donations (count)',
                    'data'                 => $count,
                    'borderColor'          => '#F0A500',
                    'backgroundColor'      => 'rgba(240,165,0,0.07)',
                    'pointBackgroundColor' => '#F0A500',
                    'pointRadius'          => 4,
                    'borderDash'           => [5, 4],
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
                    'position' => 'left',
                    'ticks'    => ['callback' => 'function(v){return "$"+v.toLocaleString()}'],
                    'grid'     => ['color' => 'rgba(240,223,192,0.4)'],
                ],
                'y1' => [
                    'position' => 'right',
                    'grid'     => ['drawOnChartArea' => false],
                ],
                'x'  => ['grid' => ['color' => 'rgba(240,223,192,0.3)']],
            ],
            'plugins' => [
                'legend' => ['position' => 'top'],
                'tooltip' => ['mode' => 'index', 'intersect' => false],
            ],
        ];
    }
}
