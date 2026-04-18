<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Fisheries',            'slug' => 'fisheries'],
            ['name' => 'Women Empowerment',    'slug' => 'women-empowerment'],
            ['name' => 'WASH',                 'slug' => 'wash'],
            ['name' => 'Climate & Environment','slug' => 'climate-environment'],
            ['name' => 'Advocacy',             'slug' => 'advocacy'],
            ['name' => 'Economic Empowerment', 'slug' => 'economic-empowerment'],
            ['name' => 'Health',               'slug' => 'health'],
            ['name' => 'Education',            'slug' => 'education'],
            ['name' => 'Water & Sanitation',   'slug' => 'water-sanitation'],
            ['name' => 'Menstrual Health',     'slug' => 'menstrual-health'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['slug' => $category['slug']], $category);
        }
    }
}
