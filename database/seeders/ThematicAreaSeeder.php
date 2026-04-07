<?php

namespace Database\Seeders;

use App\Models\ThematicArea;
use Illuminate\Database\Seeder;

class ThematicAreaSeeder extends Seeder
{
    public function run(): void
    {
        ThematicArea::truncate();

        $areas = [
            [
                'name' => 'Economic Empowerment',
                'description' => 'KWDT empowers women through economic initiatives including micro-credit schemes, cooperative enterprises, and skills training to enable financial independence and livelihoods.',
                'order' => 1,
            ],
            [
                'name' => 'Water, Sanitation & Hygiene (WASH)',
                'description' => 'Access to safe water and sanitation is fundamental. KWDT provides WASH infrastructure and health education to improve community health and dignity.',
                'order' => 2,
            ],
            [
                'name' => 'Education and Knowledge Empowerment',
                'description' => 'KWDT invests in both formal and non-formal education for women and youth, enhancing knowledge, skills, and opportunities for sustainable development.',
                'order' => 3,
            ],
            [
                'name' => 'Environment Conservation',
                'description' => 'Recognizing the link between environmental sustainability and community wellbeing, KWDT promotes conservation practices and climate resilience.',
                'order' => 4,
            ],
            [
                'name' => 'HIV, Gender, Disability and Health',
                'description' => 'KWDT mainstreams health services, gender equality, and inclusive practices across all programs to ensure no one is left behind.',
                'order' => 5,
            ],
        ];

        foreach ($areas as $area) {
            ThematicArea::create($area);
        }
    }
}
