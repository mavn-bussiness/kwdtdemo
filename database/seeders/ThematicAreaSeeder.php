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
                'description' => 'The Economic Empowerment program engages women in integrated sustainable agriculture, fishing, fish processing and fish trade. Access to micro credit supports also supports start-up of diverse and complementary activities to reduce women\'s vulnerability and promote savings culture. The entrepreneurial programs have contributed to improved food security, rural economic development as well as enhancing women\'s contribution to community development.',
                'order' => 1,
            ],
            [
                'name' => 'Water, Sanitation & Hygiene (WASH)',
                'description' => 'The WASH program is dedicated to increasing access to clean water and improved sanitation in households, communities, and schools, with a focus on women and female youth as key drivers of these interventions. In areas such as islands where conventional water access technologies are challenging, the program employs innovative methods, such as rainwater harvesting and prioritizing borehole construction near schools, to ensure sustainable water supply. The program also enhances maintenance through the training of repair committees and water user groups, fostering self-governance in water management.',
                'order' => 2,
            ],
            [
                'name' => 'Education and Knowledge Empowerment',
                'description' => 'The Education program ensures inclusive and equitable quality education and promotion of life long learning opportunities for all. The program focuses on primary education and knowledge and skills empowerment for women who missed the opportunity to access formal education.',
                'order' => 3,
            ],
            [
                'name' => 'Environment Conservation',
                'description' => 'The Environment program ensures that development is cognizant of the environment and supports women to engage in development practices that conserve land, water resources and forests.',
                'order' => 4,
            ],
            [
                'name' => 'HIV, Gender, Disability and Health',
                'description' => 'To ensure that KWDT\'s interventions don\'t reinforce negative effects of vulnerability and discrimination in planning, designing and implementation of programs, HIV, Health, Gender, Disability & Youth are mainstreamed across all programs.',
                'order' => 5,
            ],
        ];

        foreach ($areas as $area) {
            ThematicArea::create($area);
        }
    }
}
