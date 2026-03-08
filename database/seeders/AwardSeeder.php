<?php

namespace Database\Seeders;

use App\Models\Award;
use Illuminate\Database\Seeder;

class AwardSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing awards
        Award::truncate();

        $awards = [
            ['title' => 'KWDT Coordinator receives Award from Evolving Women', 'year' => 2023, 'awarding_organization' => 'Evolving Women'],
            ['title' => 'Betty Kajule receives award as Woman Driver of Change building a Sustainable Tomorrow', 'year' => 2022, 'awarding_organization' => null],
            ['title' => 'Contribution towards Social Economic Transformation and Development of Communities in Mpunge Sub County', 'year' => 2020, 'awarding_organization' => null],
            ['title' => 'KWDT Coordinator is awarded the Margarita Lizárraga Medal from FAO', 'year' => 2021, 'awarding_organization' => 'FAO'],
            ['title' => 'Coordinator KWDT is declared World Food Hero 2020', 'year' => 2020, 'awarding_organization' => null],
            ['title' => 'Provision of safe water sources to Nama subcounty community and Institutions', 'year' => 2017, 'awarding_organization' => null],
            ['title' => 'Contribution in the Field of Health and Education in Mpunge Subcounty', 'year' => 2017, 'awarding_organization' => null],
            ['title' => 'Recognition of support for Social Economic Empowerment of Women in Mukono District', 'year' => 2017, 'awarding_organization' => null],
            ['title' => 'Provision of safe water sources to Nama subcounty community and Institutions (2nd)', 'year' => 2017, 'awarding_organization' => null],
            ['title' => 'Coordinator receives Women\'s Day Medal', 'year' => 2015, 'awarding_organization' => null],
            ['title' => 'The 3rd Kyoto World Water Grand Prize', 'year' => 2012, 'awarding_organization' => null],
            ['title' => 'Rio+20 Best Practice Award', 'year' => 2012, 'awarding_organization' => null],
            ['title' => 'Best performing NGO in WASH Financial Year 2008/09', 'year' => 2009, 'awarding_organization' => null],
        ];

        foreach ($awards as $index => $award) {
            Award::create(array_merge($award, ['order' => $index + 1]));
        }
    }
}
