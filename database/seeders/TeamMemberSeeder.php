<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    public function run(): void
    {
        TeamMember::truncate();

        $members = [
            ['name' => 'Nakato Margaret',       'title' => 'Executive Director / Coordinator',    'order' => 1,  'is_active' => true],
            ['name' => 'Viola Nabuguzi',         'title' => 'Finance & Administration Officer',    'order' => 2,  'is_active' => true],
            ['name' => 'Namugga Vaal Benjamin',  'title' => 'Monitoring & Evaluation Officer',     'order' => 3,  'is_active' => true],
            ['name' => 'Nalugga Catherine',      'title' => 'Project Officer – WASH & Advocacy',  'order' => 4,  'is_active' => true],
            ['name' => 'Katongole George',       'title' => 'Field Officer – Mukono District',     'order' => 5,  'is_active' => true],
            ['name' => 'Kulumba Leonard',        'title' => 'Field Officer – Kalangala District',  'order' => 6,  'is_active' => true],
            ['name' => 'Okwere Fiona',           'title' => 'Community Mobilisation Officer',      'order' => 7,  'is_active' => true],
            ['name' => 'Kaysinga Joan',          'title' => 'Programme Officer – Economic Empowerment', 'order' => 8, 'is_active' => true],
            ['name' => 'Nalubwama Lucy',         'title' => 'Field Officer – Buvuma District',     'order' => 9,  'is_active' => true],
            ['name' => 'Mildred Kusemererwa',    'title' => 'Communications & Outreach Officer',   'order' => 10, 'is_active' => true],
            ['name' => 'Kasoga Jackline',        'title' => 'Gender & Social Inclusion Officer',   'order' => 11, 'is_active' => true],
            ['name' => 'Wakooli Zoe',            'title' => 'Accounts & Procurement Assistant',    'order' => 12, 'is_active' => true],
        ];

        foreach ($members as $member) {
            TeamMember::create($member);
        }
    }
}
