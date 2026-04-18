<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Backfill the projects table for any content rows with type='project'
     * that have no matching row in the projects table.
     *
     * Safe to run multiple times — uses INSERT IGNORE / whereNotExists.
     */
    public function up(): void
    {
        $orphans = DB::table('content')
            ->where('type', 'project')
            ->whereNotExists(function ($q) {
                $q->select(DB::raw(1))
                    ->from('projects')
                    ->whereColumn('projects.content_id', 'content.id');
            })
            ->get(['id']);

        $meta = [
            'micro-credit-loans-scheme'                        => ['status' => 'ongoing',   'location' => 'Kalangala, Mpatta, Buvuma', 'funder' => 'Swiss Hand Foundation',   'start_date' => '2011-01-01'],
            'solar-powered-lighting'                           => ['status' => 'ongoing',   'location' => 'Mukono, Kalangala, Buvuma', 'funder' => 'Mwangaza Solar Solutions', 'start_date' => '2018-01-01'],
            'focus-frauen'                                     => ['status' => 'ongoing',   'location' => 'Mukono, Kalangala',         'funder' => 'Fokus Frauen Switzerland', 'start_date' => '2020-01-01'],
            'katosi-women-center-for-development'              => ['status' => 'planned',   'location' => 'Katosi, Mukono',            'funder' => 'ASF Sweden',               'start_date' => '2022-01-01'],
            'uganda-saxony-partnership'                        => ['status' => 'ongoing',   'location' => 'Uganda / Saxony',           'funder' => 'Free State of Saxony',     'start_date' => '2019-01-01'],
            'arche-nova-wash-fishing-communities'              => ['status' => 'ongoing',   'location' => 'Mukono, Kalangala, Buvuma', 'funder' => 'arche noVa',               'start_date' => '2017-01-01'],
            'giz-responsible-fisheries-business-chain-project' => ['status' => 'completed', 'location' => '15 Districts, Uganda',      'funder' => 'GIZ RFBCP',               'start_date' => '2021-01-01', 'end_date' => '2023-12-31'],
            'resilience-building-menstrual-health'             => ['status' => 'ongoing',   'location' => 'Mukono, Kalangala',         'funder' => 'arche noVa',               'start_date' => '2022-01-01'],
        ];

        foreach ($orphans as $row) {
            $content = DB::table('content')->where('id', $row->id)->first(['id', 'slug']);
            $m = $meta[$content->slug] ?? [];

            DB::table('projects')->insert([
                'content_id'          => $content->id,
                'status'              => $m['status']     ?? 'ongoing',
                'location'            => $m['location']   ?? null,
                'funder'              => $m['funder']      ?? null,
                'start_date'          => $m['start_date'] ?? now()->subYear()->toDateString(),
                'end_date'            => $m['end_date']   ?? null,
                'beneficiaries_count' => null,
                'budget_usd'          => null,
                'created_at'          => now(),
                'updated_at'          => now(),
            ]);
        }
    }

    public function down(): void
    {
        // Non-destructive — down() intentionally left empty.
        // Removing backfilled rows would delete real data.
    }
};
