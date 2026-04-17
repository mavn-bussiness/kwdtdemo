<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
            // Create or get default admin user
            User::updateOrCreate(
                ['email' => 'admin@kwdt.org'],
                [
                    'name' => 'KWDT Admin',
                    'password' => bcrypt('password'),
                    'role' => 'super_admin',
                ]
            );

        // Call seeders in order
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
