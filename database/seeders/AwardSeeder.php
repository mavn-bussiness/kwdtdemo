<?php

namespace Database\Seeders;

use App\Models\Award;
use Illuminate\Database\Seeder;

class AwardSeeder extends Seeder
{
    public function run(): void
    {
        Award::truncate();

        $awards = [
            [
                'title' => 'KWDT Coordinator receives Award from Evolving Women',
                'year' => 2023,
                'awarding_organization' => 'Evolving Women',
                'description' => 'The KWDT Coordinator was honoured by Evolving Women in recognition of outstanding leadership and commitment to empowering women in Uganda\'s fishing communities.',
                'image_url' => 'images/awards/2023-kwdt-coordinator-receives-evolving-women.jpeg',
                'order' => 1,
            ],
            [
                'title' => 'Betty Kajule receives award as Woman Driver of Change building a Sustainable Tomorrow',
                'year' => 2022,
                'awarding_organization' => null,
                'description' => 'Betty Kajule, a member of KWDT, was recognised as a Woman Driver of Change for her transformative work in building a sustainable tomorrow for women and youth in rural Uganda.',
                'image_url' => 'images/awards/2022-betty-kajule-a-member-of-kwdt-receives-an-award-as-a-woman-driver-of-change-builing-a-sustainable-tomorrow.jpg',
                'order' => 2,
            ],
            [
                'title' => 'KWDT Coordinator is awarded the Margarita Lizárraga Medal from FAO',
                'year' => 2021,
                'awarding_organization' => 'FAO',
                'description' => 'The Food and Agriculture Organization of the United Nations awarded the KWDT Coordinator the prestigious Margarita Lizárraga Medal in recognition of exemplary contributions to sustainable fisheries and community development.',
                'image_url' => 'images/awards/2020-2021-kwdt-coordinator-is-awarded-the-margarita-lizaragga-medal-from-fao.jpg',
                'order' => 3,
            ],
            [
                'title' => 'Coordinator KWDT is declared World Food Hero 2020',
                'year' => 2020,
                'awarding_organization' => null,
                'description' => 'The KWDT Coordinator was declared a World Food Hero in 2020, celebrating her exceptional work addressing food security and economic empowerment for women in Uganda\'s lakeside communities.',
                'image_url' => 'images/awards/2020-coordinator-kwdt-is-declared-world-food-hero-2020.jpg',
                'order' => 4,
            ],
            [
                'title' => 'Contribution towards Social Economic Transformation and Development of Communities in Mpunge Sub County',
                'year' => 2020,
                'awarding_organization' => 'Mpunge Sub County',
                'description' => 'KWDT was recognised by Mpunge Sub County for its sustained contribution to social and economic transformation, improving livelihoods and building resilient communities across the sub-county.',
                'image_url' => 'images/awards/2020-contribution-towards-social-economic-transformation-and-development-of-communities-in-mpunge-sub-county.jpg',
                'order' => 5,
            ],
            [
                'title' => 'Provision of safe water sources to Nama subcounty community and Institutions',
                'year' => 2017,
                'awarding_organization' => 'Nama Sub County',
                'description' => 'KWDT was awarded for its significant contribution in providing safe and reliable water sources to households and public institutions across Nama Sub County, Mukono District.',
                'image_url' => 'images/awards/2017-provision-of-safe-water-sources-to-nama-subcounty-community-and-instituitons.jpg',
                'order' => 6,
            ],
            [
                'title' => 'Contribution in the Field of Health and Education in Mpunge Subcounty',
                'year' => 2017,
                'awarding_organization' => 'Mpunge Sub County',
                'description' => 'Recognised for impactful community programmes that improved access to health services and education in Mpunge Sub County, directly benefiting women, children, and youth.',
                'image_url' => 'images/awards/2017-contribuution-in-the-field-of-health-and-education-in-mpunge-subcounty.jpg',
                'order' => 7,
            ],
            [
                'title' => 'Recognition of support for Social Economic Empowerment of Women in Mukono District',
                'year' => 2017,
                'awarding_organization' => 'Mukono District',
                'description' => 'Mukono District authorities recognised KWDT for its long-standing support for the social and economic empowerment of women, strengthening livelihoods and gender equity across the district.',
                'image_url' => 'images/awards/2017-recognition-of-support-for-social-economic-empowerment-of-women-in-mukono-district.png',
                'order' => 8,
            ],
            [
                'title' => 'Provision of safe water sources to Nama subcounty community and Institutions (2nd)',
                'year' => 2017,
                'awarding_organization' => 'Nama Sub County',
                'description' => 'A second recognition from Nama Sub County celebrating KWDT\'s continued investment in safe water infrastructure, reaching more households and institutions in underserved communities.',
                'image_url' => 'images/awards/2017-provision-of-safe-water-sources-to-nama-subcounty-community-and-instituitons.jpg',
                'order' => 9,
            ],
            [
                'title' => 'Coordinator receives Women\'s Day Medal',
                'year' => 2015,
                'awarding_organization' => null,
                'description' => 'On International Women\'s Day, the KWDT Coordinator was presented with a special medal in honour of her outstanding advocacy for women\'s rights and community-led development in Uganda.',
                'image_url' => 'images/awards/2015-coordinator-receives-women-s-day-medal.jpg',
                'order' => 10,
            ],
            [
                'title' => 'The 3rd Kyoto World Water Grand Prize',
                'year' => 2012,
                'awarding_organization' => 'World Water Council',
                'description' => 'KWDT was awarded the prestigious 3rd Kyoto World Water Grand Prize at the World Water Forum, recognising its pioneering work delivering clean water and sanitation to fishing communities on Lake Victoria.',
                'image_url' => 'images/awards/2012-the-3rd-kyoto-world-water-grand-prize.jpg',
                'order' => 11,
            ],
            [
                'title' => 'Rio+20 Best Practice Award',
                'year' => 2012,
                'awarding_organization' => 'UN Rio+20 Conference',
                'description' => 'Recognised at the United Nations Rio+20 Conference on Sustainable Development as a Best Practice for KWDT\'s integrated approach to environmental sustainability and community empowerment.',
                'image_url' => 'images/awards/2012-rio20-best-practice-award.jpg',
                'order' => 12,
            ],
            [
                'title' => 'Best performing NGO in WASH Financial Year 2008/09',
                'year' => 2009,
                'awarding_organization' => 'Uganda Ministry of Water',
                'description' => 'KWDT was awarded Best Performing NGO in Water, Sanitation and Hygiene (WASH) for the financial year 2008/09 by the Uganda Ministry of Water, in recognition of exceptional delivery of clean water and sanitation programmes.',
                'image_url' => 'images/awards/2009-best-performing-ngo-in-wash-financial-year-2008-09.jpg',
                'order' => 13,
            ],
        ];

        foreach ($awards as $award) {
            Award::create($award);
        }
    }
}
