<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        Partner::truncate();

        $partners = [
            [
                'name' => 'World Forum for Fish Workers and Fish Harvesters',
                'logo_url' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/0a79a067-a783-42f4-b8ee-fb06a514ef05/1+WFF.png?format=500w',
                'website' => 'https://worldfisherforum.org/',
                'description' => 'International network of fish workers and harvesters advocating for sustainable fisheries and social justice.',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'name' => 'Women For Water Partnership',
                'logo_url' => 'https://womenforwater.org/wp-content/uploads/2023/02/logo-black.png',
                'website' => 'https://womenforwater.org/projects-work/',
                'description' => 'A partnership of women\'s organization and networks to unite women leadership in water and sanitation.',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'name' => 'Wocan',
                'logo_url' => 'https://www.wocan.org/wp-content/uploads/2023/06/wocan-logo.svg',
                'website' => 'https://www.wocan.org/',
                'description' => 'A women led international membership network of women and men professionals and women organizations that pioneers in gender equality and climate change.',
                'is_active' => true,
                'order' => 3,
            ],
            [
                'name' => 'The Butterfly Effect',
                'logo_url' => 'https://www.effetpapillon.org//public/static/project/css/images/logo_EN.png',
                'website' => 'https://www.effetpapillon.org/en/',
                'description' => 'A network of international and local CSO/NGO, from all over the globe, which advocates for effective local solutions that have a sustainable impact on improving access to water and sanitation and water resource management.',
                'is_active' => true,
                'order' => 4,
            ],
            [
                'name' => 'Gender Water Alliance',
                'logo_url' => 'https://genderandwater.org/%2b%2btheme%2b%2bgwa.theme/images/logo.png',
                'website' => 'https://genderandwater.org/en/',
                'description' => 'Promotes women and men\'s equitable access to and management of safe water.',
                'is_active' => true,
                'order' => 5,
            ],
            [
                'name' => 'Uganda National NGO Forum',
                'logo_url' => 'https://ngoforum.or.ug/wp-content/uploads/2024/01/UNNGOFlogoBase.png',
                'website' => 'https://ngoforum.or.ug/',
                'description' => 'Provides a sharing and reflection platform for NGOs in Uganda.',
                'is_active' => true,
                'order' => 6,
            ],
            [
                'name' => 'Uganda Water and Sanitation NGO Network',
                'logo_url' => 'https://uwasnet.org/wp-content/uploads/2024/04/uwasnet-logo-new.png',
                'website' => 'https://uwasnet.org/',
                'description' => 'National coordination of CSOs including social enterprises, development programs, private sector and NGOs on water and environment.',
                'is_active' => true,
                'order' => 7,
            ],
            [
                'name' => 'Uganda Women\'s Network',
                'logo_url' => 'https://www.uwonet.or.ug/wp-content/themes/uwonet/images/uwonet-logo-with-tagline.png',
                'website' => 'https://www.uwonet.or.ug/',
                'description' => 'Uganda Women\'s Network (UWONET) is a women\'s rights advocacy organization that exists to coordinate collective action among women\'s rights and gender equality stakeholders for the attainment of gender equality and equity in Uganda.',
                'is_active' => true,
                'order' => 8,
            ],
            [
                'name' => 'Women of Uganda Network',
                'logo_url' => 'https://wougnet.org/wp-content/uploads/2025/11/cropped-cropped-wougnet-logo.png',
                'website' => 'https://wougnet.org/',
                'description' => 'Ugandan center for management training and development.',
                'is_active' => true,
                'order' => 9,
            ],
            [
                'name' => 'Uganda National Women\'s Fish Organisation',
                'logo_url' => 'https://unwfo.org/wp-content/uploads/2024/04/cropped-UNWFO-logo-2.png',
                'website' => 'https://unwfo.org/',
                'description' => 'UNWFO is a registered non-profit organization established in 2015 and officially launched in 2019 with the support of the Ministry of Agriculture Animal Industry and Fisheries. The Organization serves as a network for women and youth involved in fish production, processing, marketing and trade.',
                'is_active' => true,
                'order' => 10,
            ],
            [
                'name' => 'Mukono District NGO Forum',
                'logo_url' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/64f05fc1-386f-481f-9540-bfa708f11880/7+MUDINFO.jpeg?format=500w',
                'website' => 'https://mukonongoforum.wordpress.com/',
                'description' => 'German NGO supporting community-based development projects.',
                'is_active' => true,
                'order' => 11,
            ],
        ];

        foreach ($partners as $partner) {
            Partner::create($partner);
        }

        $this->command->info('Successfully seeded '.count($partners).' partners.');
    }
}
