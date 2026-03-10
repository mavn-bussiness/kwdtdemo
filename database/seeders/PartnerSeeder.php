<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        $partners = [
            [
                'name' => 'World Forum for Fish Workers and Fish Harvesters',
                'logo_url' => 'https://worldfisherforum.org/wp-content/uploads/2020/08/WFF-Logo-Final.png',
                'website' => 'https://worldfisherforum.org/',
                'description' => 'International network of fish workers and harvesters advocating for sustainable fisheries and social justice.',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'name' => 'Gender Water Alliance',
                'logo_url' => 'https://genderandwater.org/logo-gwa.png/@@images/image.png',
                'website' => 'https://genderandwater.org/',
                'description' => 'Promotes women and men\'s equitable access to and management of safe water.',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'name' => 'Uganda National NGO Forum',
                'logo_url' => 'https://ngoforum.or.ug/wp-content/uploads/2022/05/UNNGOF-Logo-Full-Color-1536x430.png',
                'website' => 'https://ngoforum.or.ug/',
                'description' => 'Provides a sharing and reflection platform for NGOs in Uganda.',
                'is_active' => true,
                'order' => 3,
            ],
            [
                'name' => 'Uganda Women\'s Network (UWONET)',
                'logo_url' => null, // No logo found
                'website' => 'https://uwonet.or.ug/',
                'description' => 'A network of organizations and individuals working towards gender equality and women\'s empowerment in Uganda.',
                'is_active' => true,
                'order' => 4,
            ],
            [
                'name' => 'Women of Uganda Network (WOUGNET)',
                'logo_url' => 'https://wougnet.org/wp-content/uploads/2021/05/cropped-WOUGNET-LOGO-1.png',
                'website' => 'https://wougnet.org/',
                'description' => 'Develops use of information and communication technologies among women as tools to share information and address issues collectively.',
                'is_active' => true,
                'order' => 5,
            ],
            [
                'name' => 'Uganda National Women\'s Fish Organisation (UNWFO)',
                'logo_url' => null, // No logo found
                'website' => null,
                'description' => 'Networks national women\'s organization in fisheries and aquaculture.',
                'is_active' => true,
                'order' => 6,
            ],
            // Additional existing/previous partners
            [
                'name' => 'University of Northampton',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/en/thumb/9/98/University_of_Northampton_logo.svg/1920px-University_of_Northampton_logo.svg.png',
                'website' => 'https://www.northampton.ac.uk/',
                'description' => 'UK-based university supporting KWDT through research and academic partnerships.',
                'is_active' => true,
                'order' => 7,
            ],
            [
                'name' => 'Universität Hamburg',
                'logo_url' => 'https://www.uni-hamburg.de/resources/logo/uh-logo.svg',
                'website' => 'https://www.uni-hamburg.de/',
                'description' => 'German university collaborating on research and community development projects.',
                'is_active' => true,
                'order' => 8,
            ],
            [
                'name' => 'Uganda Management Institute',
                'logo_url' => 'https://www.umi.ac.ug/wp-content/uploads/2021/02/UMI-Logo.png',
                'website' => 'https://www.umi.ac.ug/',
                'description' => 'Ugandan center for management training and development.',
                'is_active' => true,
                'order' => 9,
            ],
            [
                'name' => 'GIZ',
                'logo_url' => 'https://www.giz.de/static/img/giz-logo.png',
                'website' => 'https://www.giz.de/',
                'description' => 'German development agency supporting sustainable development initiatives.',
                'is_active' => true,
                'order' => 10,
            ],
            [
                'name' => 'ARCHE NOVA',
                'logo_url' => 'https://arche-nova.org/wp-content/uploads/2022/01/ArcheNova-Logo.svg',
                'website' => 'https://arche-nova.org/',
                'description' => 'German NGO supporting community-based development projects.',
                'is_active' => true,
                'order' => 11,
            ],
            [
                'name' => 'FIAN Uganda',
                'logo_url' => 'https://www.fian.org/fileadmin/_processed_/e/f/csm_fian-logo_aaf3237f2f.png',
                'website' => 'https://www.fian.org/',
                'description' => 'Human rights organization working on the right to food and nutrition.',
                'is_active' => true,
                'order' => 12,
            ],
            [
                'name' => 'Fokus Frauen',
                'logo_url' => 'https://fokus-frauen.de/wp-content/uploads/2020/09/logo-ff.png',
                'website' => 'https://fokus-frauen.de/',
                'description' => 'German organization focusing on women\'s rights and empowerment.',
                'is_active' => true,
                'order' => 13,
            ],
            [
                'name' => 'European Union Delegation to Uganda',
                'logo_url' => 'https://european-union.europa.eu/logo-eu.svg',
                'website' => 'https://www.eeas.europa.eu/delegations/uganda_en',
                'description' => 'EU representation in Uganda supporting development cooperation.',
                'is_active' => true,
                'order' => 14,
            ],
            [
                'name' => 'FAO',
                'logo_url' => 'https://www.fao.org/logo/fao-logo.svg',
                'website' => 'https://www.fao.org/',
                'description' => 'Food and Agriculture Organization of the United Nations.',
                'is_active' => true,
                'order' => 15,
            ],
            [
                'name' => 'NGO Bureau Uganda',
                'logo_url' => 'https://ngobureau.go.ug/sites/default/files/logo.png',
                'website' => 'https://ngobureau.go.ug/',
                'description' => 'Government body regulating NGO operations in Uganda.',
                'is_active' => true,
                'order' => 16,
            ],
        ];

        // Optional: Clear existing partners (uncomment if you want to start fresh)
        // Partner::truncate();

        foreach ($partners as $partner) {
            Partner::create($partner);
        }

        $this->command->info('Successfully seeded '.count($partners).' partners.');
    }
}
