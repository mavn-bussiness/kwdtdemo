<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            AwardSeeder::class,
            ThematicAreaSeeder::class,
            ProjectSeeder::class,
            CategorySeeder::class,
            BlogPostSeeder::class,
            TestimonialSeeder::class,
            ReportSeeder::class,
            TeamMemberSeeder::class,
            PartnerSeeder::class,
            CareerSeeder::class,
        ]);
    }
}
