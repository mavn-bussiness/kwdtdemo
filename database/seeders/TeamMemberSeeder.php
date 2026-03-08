<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing team members
        TeamMember::truncate();

        $members = [
              ['name' => 'Nakato Margaret', 'title' => 'Executive Director', 'order' => 1],
              ['name' => 'Viola Nabuguzi', 'title' => 'Team Member', 'order' => 2],
              ['name' => 'Namugga Vaal Benjamin', 'title' => 'Team Member', 'order' => 3],
              ['name' => 'Nalugga Catherine', 'title' => 'Project Officer', 'order' => 4],
              ['name' => 'Katongole George', 'title' => 'Team Member', 'order' => 5],
              ['name' => 'Kulumba Leonard', 'title' => 'Team Member', 'order' => 6],
              ['name' => 'Okwere Fiona', 'title' => 'Team Member', 'order' => 7],
              ['name' => 'Kaysinga Joan', 'title' => 'Team Member', 'order' => 8],
              ['name' => 'Nalubwama Lucy', 'title' => 'Team Member', 'order' => 9],
              ['name' => 'Mildred Kusemererwa', 'title' => 'Team Member', 'order' => 10],
              ['name' => 'Kasoga Jackline', 'title' => 'Team Member', 'order' => 11],
              ['name' => 'Wakooli Zoe', 'title' => 'Team Member', 'order' => 12],
        ];

        foreach ($members as $member) {
            TeamMember::create($member);
        }
    }
}
