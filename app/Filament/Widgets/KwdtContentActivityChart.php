<?php

namespace App\Filament\Widgets;

use App\Models\Content;
use Filament\Widgets\BarChartWidget;

class KwdtContentActivityChart extends BarChartWidget
{
    protected static ?int $sort = 3;
    protected int|string|array $columnSpan = 1;
    protected ?string $heading = 'Content Published — Last 6 Months';
    protected ?string $maxHeight = '260px';

    protected function getData(): array
    {
        $months = collect(range(5, 0))->map(fn ($i) => now()->subMonths($i));
        $labels = $months->map(fn ($m) => $m->format('M Y'))->toArray();

        $published = $months->map(fn ($m) => Content::where('status', 'published')
            ->whereYear('created_at', $m->year)
            ->whereMonth('created_at', $m->month)
            ->count()
        )->toArray();

        $drafts = $months->map(fn ($m) => Content::where('status', 'draft')
            ->whereYear('created_at', $m->year)
            ->whereMonth('created_at', $m->month)
            ->count()
        )->toArray();

        return [
            'datasets' => [
                [
                    'label'           => 'Published',
                    'data'            => $published,
                    'backgroundColor' => '#F5820A',
                    'borderRadius'    => 6,
                ],
                [
                    'label'           => 'Drafts',
                    'data'            => $drafts,
                    'backgroundColor' => '#F0DFC0',
                    'borderRadius'    => 6,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'x' => ['stacked' => false, 'grid' => ['display' => false]],
                'y' => ['beginAtZero' => true, 'grid' => ['color' => 'rgba(240,223,192,0.4)']],
            ],
            'plugins' => ['legend' => ['position' => 'top']],
        ];
    }
}
