<?php

namespace Database\Seeders;

use App\Models\Career;
use Illuminate\Database\Seeder;

class CareerSeeder extends Seeder
{
    public function run(): void
    {
        Career::truncate();

        $careers = [
            [
                'title'          => 'Operations & Coordination Manager',
                'slug'           => 'operations-coordination-manager',
                'description'    => 'KWDT seeks a highly motivated and experienced Operations & Coordination Manager.',
                'advert_number'  => 'KWDT001INTEXT2026',
                'pdf_url'        => '/s/ADVERT-No-KWDT001INTEXT2026.pdf',
                'status'         => 'open',
                'is_active'      => true,
            ],
            [
                'title'          => 'Terms of Reference: Incinerator Latrine Construction',
                'slug'           => 'tor-incinerator-latrine-construction',
                'description'    => 'KWDT invites qualified contractors to submit proposals for the construction of incinerator latrines in fishing communities.',
                'advert_number'  => 'KWDT-TOR-2026-03',
                'pdf_url'        => '/s/2026-03-09-ToRs_Incinerator-Latrine.pdf',
                'status'         => 'open',
                'is_active'      => true,
            ],
            [
                'title'          => 'Agricultural Officer',
                'slug'           => 'agricultural-officer',
                'description'    => 'KWDT seeks a qualified Agricultural Officer to support integrated agriculture and agroecology programmes across fishing communities in Mukono, Kalangala and Buvuma.',
                'advert_number'  => 'KWDT-ADVERT-02-2026',
                'pdf_url'        => '/s/2026-03-KWDT-ADVERT_02_-Agricultural-Officer.pdf',
                'status'         => 'open',
                'is_active'      => true,
            ],
        ];

        foreach ($careers as $career) {
            Career::create($career);
        }
    }
}
