<?php

namespace Database\Seeders;

use App\Models\Content;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing projects
        Project::truncate();
        Content::where('type', 'project')->delete();

        $user = User::first() ?? User::factory()->create();

        $projects = [
            [
                'title' => 'Micro Credit Loans Scheme',
                'slug' => 'micro-credit-loans-scheme',
                'description' => 'Providing accessible micro-credit loans to women entrepreneurs and farmers to start or expand income-generating activities.',
                'status' => 'ongoing',
                'location' => 'Mukono, Kalangala, Buvuma',
            ],
            [
                'title' => 'Solar Powered Lighting',
                'slug' => 'solar-powered-lighting',
                'description' => 'Implementing solar-powered lighting solutions in rural communities to improve safety, education, and economic opportunities.',
                'status' => 'ongoing',
                'location' => 'Mukono, Kalangala, Buvuma',
            ],
            [
                'title' => 'Fokus Frauen',
                'slug' => 'fokus-frauen',
                'description' => 'A collaborative project focused on women\'s development and sustainable livelihoods in partnership with international organizations.',
                'status' => 'ongoing',
                'location' => 'Mukono, Kalangala, Buvuma',
            ],
            [
                'title' => 'Katosi Women Center for Development',
                'slug' => 'katosi-women-center-for-development',
                'description' => 'Establishing a community center providing training, resources, and support services to women and youth in development initiatives.',
                'status' => 'ongoing',
                'location' => 'Katosi Town Council',
            ],
            [
                'title' => 'Uganda Saxony Partnership',
                'slug' => 'uganda-saxony-partnership',
                'description' => 'A partnership project between KWDT and Saxony organizations for development cooperation and knowledge exchange.',
                'status' => 'ongoing',
                'location' => 'Mukono District',
            ],
        ];

        foreach ($projects as $projectData) {
            $content = Content::create([
                'title' => $projectData['title'],
                'slug' => $projectData['slug'],
                'type' => 'project',
                'status' => 'published',
                'excerpt' => $projectData['description'],
                'body' => $projectData['description'],
                'author_id' => $user->id,
                'published_at' => now(),
            ]);

            Project::create([
                'content_id' => $content->id,
                'start_date' => now()->subYears(2)->startOfYear(),  // 2 years ago
                'end_date' => null,  // Ongoing projects
                'status' => $projectData['status'],
                'location' => $projectData['location'],
            ]);
        }
    }
}
