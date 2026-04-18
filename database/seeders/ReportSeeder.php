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
        $user = User::first() ?? User::factory()->create();

        $reports = [
            [
                'title'        => 'Annual Report 2024',
                'slug'         => 'annual-report-2024',
                'excerpt'      => 'KWDT\'s 2024 Annual Report documents programme outcomes across economic empowerment, WASH, education and environmental conservation — covering 1,235 women in 52 groups across Mukono, Kalangala and Buvuma districts.',
                'file_name'    => 'KWDT-Annual-Report-2024.pdf',
                'file_path'    => 'reports/2024/KWDT-Annual-Report-2024.pdf',
                'file_type'    => 'pdf',
                'file_size_kb' => 2400,
                'report_year'  => 2024,
            ],
            [
                'title'        => 'Annual Report 2023',
                'slug'         => 'annual-report-2023',
                'excerpt'      => 'The 2023 report highlights KWDT\'s participation in the 1st Justice Forum on Fisheries and Human Rights in Kalangala, the Fokus Frauen land rights programme, and the expansion of the arche noVa WASH partnership to Buvuma island communities.',
                'file_name'    => 'KWDT-Annual-Report-2023.pdf',
                'file_path'    => 'reports/2023/KWDT-Annual-Report-2023.pdf',
                'file_type'    => 'pdf',
                'file_size_kb' => 2100,
                'report_year'  => 2023,
            ],
            [
                'title'        => 'Annual Report 2022',
                'slug'         => 'annual-report-2022',
                'excerpt'      => 'The 2022 report covers the GIZ Responsible Fisheries Business Chain Project outcomes, including the graduation of 600 participants in Business Development Services and digital tools training across 15 Ugandan districts.',
                'file_name'    => 'KWDT-Annual-Report-2022.pdf',
                'file_path'    => 'reports/2022/KWDT-Annual-Report-2022.pdf',
                'file_type'    => 'pdf',
                'file_size_kb' => 1900,
                'report_year'  => 2022,
            ],
            [
                'title'        => 'Annual Report 2021',
                'slug'         => 'annual-report-2021',
                'excerpt'      => 'The 2021 report documents KWDT\'s response to COVID-19 impacts on fishing communities, the FAO Margarita Lizárraga Medal awarded to the KWDT Coordinator, and continued WASH programme delivery across Mukono and Kalangala.',
                'file_name'    => 'KWDT-Annual-Report-2021.pdf',
                'file_path'    => 'reports/2021/KWDT-Annual-Report-2021.pdf',
                'file_type'    => 'pdf',
                'file_size_kb' => 1750,
                'report_year'  => 2021,
            ],
            [
                'title'        => 'Strategic Plan 2024–2028',
                'slug'         => 'strategic-plan-2024-2028',
                'excerpt'      => 'KWDT\'s five-year strategic plan sets out the vision, mission and programmatic priorities for 2024–2028, including the Katosi Women Centre for Development, digital empowerment, and expanded advocacy at national and international levels.',
                'file_name'    => 'KWDT-Strategic-Plan-2024-2028.pdf',
                'file_path'    => 'reports/2024/KWDT-Strategic-Plan-2024-2028.pdf',
                'file_type'    => 'pdf',
                'file_size_kb' => 3200,
                'report_year'  => 2024,
            ],
        ];

        foreach ($reports as $report) {
            $content = Content::updateOrCreate(
                ['slug' => $report['slug']],
                [
                    'title'        => $report['title'],
                    'type'         => 'report',
                    'status'       => 'published',
                    'excerpt'      => $report['excerpt'],
                    'body'         => $report['excerpt'],
                    'author_id'    => $user->id,
                    'published_at' => now(),
                ]
            );

            Report::updateOrCreate(
                ['content_id' => $content->id],
                [
                    'file_name'    => $report['file_name'],
                    'file_path'    => $report['file_path'],
                    'file_type'    => $report['file_type'],
                    'file_size_kb' => $report['file_size_kb'],
                    'report_year'  => $report['report_year'],
                ]
            );
        }

        $this->command->info('✓ ReportSeeder: '.count($reports).' reports seeded.');
    }
}
