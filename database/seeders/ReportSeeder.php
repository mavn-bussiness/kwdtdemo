<?php

namespace Database\Seeders;

use App\Models\Content;
use App\Models\Report;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing reports
        Report::query()->delete();
        Content::where('type', 'report')->delete();

        $user = User::first() ?? User::factory()->create();

        $reports = [
            [
                'title' => 'Annual Report 2024',
                'slug' => 'annual-report-2024',
                'excerpt' => 'Comprehensive report on KWDT\'s impact and achievements throughout 2024.',
                'file_name' => 'KWDT-Annual-Report-2024.pdf',
                'file_path' => 'reports/2024/KWDT-Annual-Report-2024.pdf',
                'file_type' => 'pdf',
                'file_size_kb' => 2400,
                'report_year' => 2024,
            ],
            [
                'title' => 'Annual Report 2023',
                'slug' => 'annual-report-2023',
                'excerpt' => '2023 annual report documenting KWDT\'s progress in community development.',
                'file_name' => 'KWDT-Annual-Report-2023.pdf',
                'file_path' => 'reports/2023/KWDT-Annual-Report-2023.pdf',
                'file_type' => 'pdf',
                'file_size_kb' => 2100,
                'report_year' => 2023,
            ],
            [
                'title' => 'Annual Report 2022',
                'slug' => 'annual-report-2022',
                'excerpt' => 'Documentation of our 2022 initiatives and program outcomes.',
                'file_name' => 'KWDT-Annual-Report-2022.pdf',
                'file_path' => 'reports/2022/KWDT-Annual-Report-2022.pdf',
                'file_type' => 'pdf',
                'file_size_kb' => 1900,
                'report_year' => 2022,
            ],
            [
                'title' => 'Strategic Plan 2024-2028',
                'slug' => 'strategic-plan-2024-2028',
                'excerpt' => 'KWDT\'s strategic vision and roadmap for the next five years.',
                'file_name' => 'KWDT-Strategic-Plan-2024-2028.pdf',
                'file_path' => 'reports/2024/KWDT-Strategic-Plan-2024-2028.pdf',
                'file_type' => 'pdf',
                'file_size_kb' => 3200,
                'report_year' => 2024,
            ],
        ];

        foreach ($reports as $report) {
            $content = Content::create([
                'title' => $report['title'],
                'slug' => $report['slug'],
                'type' => 'report',
                'status' => 'published',
                'excerpt' => $report['excerpt'],
                'body' => $report['excerpt'],
                'author_id' => $user->id,
                'published_at' => now(),
            ]);

            Report::create([
                'content_id' => $content->id,
                'file_name' => $report['file_name'],
                'file_path' => $report['file_path'],
                'file_type' => $report['file_type'],
                'file_size_kb' => $report['file_size_kb'],
                'report_year' => $report['report_year'],
            ]);
        }
    }
}

