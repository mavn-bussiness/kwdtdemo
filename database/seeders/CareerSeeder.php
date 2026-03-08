<?php

namespace Database\Seeders;

use App\Models\Career;
use Illuminate\Database\Seeder;

class CareerSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing careers
        Career::truncate();

        Career::create([
            'title' => 'Operations & Coordination Manager',
            'slug' => 'operations-coordination-manager',
            'description' => 'KWDT seeks a highly motivated and experienced Operations & Coordination Manager.',
            'advert_number' => 'KWDT001INTEXT2026',
            'pdf_url' => '/s/ADVERT-No-KWDT001INTEXT2026.pdf',
            'status' => 'open',
            'is_active' => true,
        ]);
    }
}
