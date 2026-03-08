<?php

namespace Database\Seeders;

use App\Models\Content;
use App\Models\User;
use Illuminate\Database\Seeder;

class ThematicAreaSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing thematic areas
        Content::where('type', 'thematic_area')->delete();

        $user = User::first() ?? User::factory()->create();

        $thematicAreas = [
            [
                'title' => 'Economic Empowerment',
                'slug' => 'economic-empowerment',
                'description' => 'KWDT empowers women through economic initiatives including micro-credit schemes, cooperative enterprises, and skills training to enable financial independence and livelihoods.',
            ],
            [
                'title' => 'Water, Sanitation & Hygiene (WASH)',
                'slug' => 'water-sanitation-hygiene-wash',
                'description' => 'Access to safe water and sanitation is fundamental. KWDT provides WASH infrastructure and health education to improve community health and dignity.',
            ],
            [
                'title' => 'Education and Knowledge Empowerment',
                'slug' => 'education-and-knowledge-empowerment',
                'description' => 'KWDT invests in both formal and non-formal education for women and youth, enhancing knowledge, skills, and opportunities for sustainable development.',
            ],
            [
                'title' => 'Environment Conservation',
                'slug' => 'environment-conservation',
                'description' => 'Recognizing the link between environmental sustainability and community wellbeing, KWDT promotes conservation practices and climate resilience.',
            ],
            [
                'title' => 'HIV, Gender, Disability and Health',
                'slug' => 'hiv-gender-disability-and-health',
                'description' => 'KWDT mainstreams health services, gender equality, and inclusive practices across all programs to ensure no one is left behind.',
            ],
        ];

        foreach ($thematicAreas as $area) {
            Content::create([
                'title' => $area['title'],
                'slug' => $area['slug'],
                'type' => 'thematic_area',
                'status' => 'published',
                'excerpt' => $area['description'],
                'body' => $area['description'],
                'author_id' => $user->id,
                'published_at' => now(),
            ]);
        }
    }
}
