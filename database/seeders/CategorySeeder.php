<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing categories
        Category::query()->delete();

        $categories = [
            [
                'name' => 'Water & Sanitation',
                'slug' => 'water-sanitation',
            ],
            [
                'name' => 'Menstrual Health',
                'slug' => 'menstrual-health',
            ],
            [
                'name' => 'Fisheries',
                'slug' => 'fisheries',
            ],
            [
                'name' => 'Women Empowerment',
                'slug' => 'women-empowerment',
            ],
            [
                'name' => 'Events',
                'slug' => 'events',
            ],
            [
                'name' => 'News',
                'slug' => 'news',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
