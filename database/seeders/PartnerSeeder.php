<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing partners
        Partner::truncate();

        $partners = [
            [
                'name' => 'World Forum for Fish Workers and Fish Harvesters',
                'description' => 'Networking small scale fisheries organisations',
                'website' => 'https://worldfisher-forum.org/member-list',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'name' => 'Women for Water Partnership (WfWP)',
                'description' => 'A partnership of women\'s organization and networks to unite women leadership in water and sanitation',
                'website' => 'https://womenforwater.org/projects-work/',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'name' => 'Women Organizing for Change in Agriculture and Natural Resource Management (WOCAN)',
                'description' => 'A women led international membership network of women and men professionals and women organizations that pioneers in gender equality and climate change',
                'website' => 'https://wocan.org',
                'is_active' => true,
                'order' => 3,
            ],
            [
                'name' => 'The Butterfly Effect',
                'description' => 'A network of international and local CSO/NGO from all over the globe, which advocates for effective local solutions that have a sustainable impact on improving access to water and sanitation',
                'website' => 'https://effetpapillon.org',
                'is_active' => true,
                'order' => 4,
            ],
            [
                'name' => 'Gender Water Alliance (GWA)',
                'description' => 'Promotes women and men\'s equitable access to and management of safe water',
                'website' => null,
                'is_active' => true,
                'order' => 5,
            ],
            [
                'name' => 'Uganda National NGO Forum (UNNGOF)',
                'description' => 'Provides a sharing and reflection platform for NGOs in Uganda',
                'website' => null,
                'is_active' => true,
                'order' => 6,
            ],
            [
                'name' => 'Uganda Water and Sanitation NGO Network (UWASNET)',
                'description' => 'National coordination of CSOs including social enterprises, development programs, private sector and NGOs on water and environment',
                'website' => 'https://uwasnet.org',
                'is_active' => true,
                'order' => 7,
            ],
            [
                'name' => 'Uganda Women\'s Network',
                'description' => null,
                'website' => null,
                'is_active' => true,
                'order' => 8,
            ],
            [
                'name' => 'Women of Uganda Network (WOUGNET)',
                'description' => 'Develops use of ICTs among women as tools to share information and address issues collectively',
                'website' => null,
                'is_active' => true,
                'order' => 9,
            ],
            [
                'name' => 'Uganda National Women\'s Fish Organisation',
                'description' => 'Networks national women\'s organization in fisheries and aquaculture',
                'website' => null,
                'is_active' => true,
                'order' => 10,
            ],
            [
                'name' => 'Mukono District NGO Forum (MUDINFO)',
                'description' => 'Builds and enhances sustainable networking mechanism of CSOs in Mukono',
                'website' => 'https://mukonongoforum.wordpress.com',
                'is_active' => true,
                'order' => 11,
            ],
        ];

        foreach ($partners as $partner) {
            Partner::create($partner);
        }
    }
}
