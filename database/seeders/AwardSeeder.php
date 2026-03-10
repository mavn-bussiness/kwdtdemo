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
                'image_url' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/1725726824597-ANFQUJ865S7FZTKYNEX7/2023+KWDT+Coordinator+receives+Evolving+women.jpeg',
                'order' => 1,
            ],
            [
                'title' => 'Betty Kajule receives award as Woman Driver of Change building a Sustainable Tomorrow',
                'year' => 2022,
                'awarding_organization' => null,
                'description' => 'Betty Kajule, a member of KWDT, was recognised as a Woman Driver of Change for her transformative work in building a sustainable tomorrow for women and youth in rural Uganda.',
                'image_url' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/1725725274651-L9FZYFG2O3QSEZSE62PN/2022+Betty+Kajule%2C+a+member+of+KWDT+receives+an+award+as+a+Woman+driver+of+change+builing+a+sustainable+tomorrow+.JPG',
                'order' => 2,
            ],
            [
                'title' => 'KWDT Coordinator is awarded the Margarita Lizárraga Medal from FAO',
                'year' => 2021,
                'awarding_organization' => 'FAO',
                'description' => 'The Food and Agriculture Organization of the United Nations awarded the KWDT Coordinator the prestigious Margarita Lizárraga Medal in recognition of exemplary contributions to sustainable fisheries and community development.',
                'image_url' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/1725726717827-GMF9NH6WBI4C1HWL61K6/2020_2021+KWDT+Coordinator+is+awarded+the+Margarita+Lizaragga+Medal+from+FAO.jpg',
                'order' => 3,
            ],
            [
                'title' => 'Coordinator KWDT is declared World Food Hero 2020',
                'year' => 2020,
                'awarding_organization' => null,
                'description' => 'The KWDT Coordinator was declared a World Food Hero in 2020, celebrating her exceptional work addressing food security and economic empowerment for women in Uganda\'s lakeside communities.',
                'image_url' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/1725725449963-7ALNSP52L67R8F11QF8R/2020+Coordinator+KWDT+is+declared+World+Food+Hero+2020+.jpg',
                'order' => 4,
            ],
            [
                'title' => 'Contribution towards Social Economic Transformation and Development of Communities in Mpunge Sub County',
                'year' => 2020,
                'awarding_organization' => 'Mpunge Sub County',
                'description' => 'KWDT was recognised by Mpunge Sub County for its sustained contribution to social and economic transformation, improving livelihoods and building resilient communities across the sub-county.',
                'image_url' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/1725725343146-KH3QBT4XBL0AGTXQUXQV/2020+Contribution+towards+Social+Economic+Transformation+and+Development+of+Communities+in+Mpunge+Sub+County+.jpg',
                'order' => 5,
            ],
            [
                'title' => 'Provision of safe water sources to Nama subcounty community and Institutions',
                'year' => 2017,
                'awarding_organization' => 'Nama Sub County',
                'description' => 'KWDT was awarded for its significant contribution in providing safe and reliable water sources to households and public institutions across Nama Sub County, Mukono District.',
                'image_url' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/1725725514295-82Q2IP1I4R8UJU33AMOP/2017+Provision+of+safe+water+sources+to+Nama+subcounty+community+and+Instituitons+.jpg',
                'order' => 6,
            ],
            [
                'title' => 'Contribution in the Field of Health and Education in Mpunge Subcounty',
                'year' => 2017,
                'awarding_organization' => 'Mpunge Sub County',
                'description' => 'Recognised for impactful community programmes that improved access to health services and education in Mpunge Sub County, directly benefiting women, children, and youth.',
                'image_url' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/1725725574649-0FBCRW93SC4JEDX5J1BA/2017+Contribuution+in+the+Field+of+Health+and+Education+in+Mpunge+Subcounty+.jpg',
                'order' => 7,
            ],
            [
                'title' => 'Recognition of support for Social Economic Empowerment of Women in Mukono District',
                'year' => 2017,
                'awarding_organization' => 'Mukono District',
                'description' => 'Mukono District authorities recognised KWDT for its long-standing support for the social and economic empowerment of women, strengthening livelihoods and gender equity across the district.',
                'image_url' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/1725725648698-L19TO2MY4ZDMWEJ7YNJN/2017+Recognition+of+support+for+Social+Economic+Empowerment+of+Women+in+Mukono+District.png',
                'order' => 8,
            ],
            [
                'title' => 'Provision of safe water sources to Nama subcounty community and Institutions (2nd)',
                'year' => 2017,
                'awarding_organization' => 'Nama Sub County',
                'description' => 'A second recognition from Nama Sub County celebrating KWDT\'s continued investment in safe water infrastructure, reaching more households and institutions in underserved communities.',
                'image_url' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/1725726591137-QXC7W3YMN9J1HFT4P9RD/2017+Provision+of+safe+water+sources+to+Nama+subcounty+community+and+Instituitons+.jpg',
                'order' => 9,
            ],
            [
                'title' => 'Coordinator receives Women\'s Day Medal',
                'year' => 2015,
                'awarding_organization' => null,
                'description' => 'On International Women\'s Day, the KWDT Coordinator was presented with a special medal in honour of her outstanding advocacy for women\'s rights and community-led development in Uganda.',
                'image_url' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/1725725782152-ILW5DMMSVJJ49BAG11RE/2015+Coordinator+receives+Women_s+Day+Medal.JPG',
                'order' => 10,
            ],
            [
                'title' => 'The 3rd Kyoto World Water Grand Prize',
                'year' => 2012,
                'awarding_organization' => 'World Water Council',
                'description' => 'KWDT was awarded the prestigious 3rd Kyoto World Water Grand Prize at the World Water Forum, recognising its pioneering work delivering clean water and sanitation to fishing communities on Lake Victoria.',
                'image_url' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/1725726055425-JXTBKWCFA7KJ55YR3NE6/2012+The+3rd+Kyoto+World+Water+Grand+Prize.jpg',
                'order' => 11,
            ],
            [
                'title' => 'Rio+20 Best Practice Award',
                'year' => 2012,
                'awarding_organization' => 'UN Rio+20 Conference',
                'description' => 'Recognised at the United Nations Rio+20 Conference on Sustainable Development as a Best Practice for KWDT\'s integrated approach to environmental sustainability and community empowerment.',
                'image_url' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/1725726140468-BVKCJMK3E7SUYWH0P496/2012+Rio%2B20+Best+Practice+Award.jpg',
                'order' => 12,
            ],
            [
                'title' => 'Best performing NGO in WASH Financial Year 2008/09',
                'year' => 2009,
                'awarding_organization' => 'Uganda Ministry of Water',
                'description' => 'KWDT was awarded Best Performing NGO in Water, Sanitation and Hygiene (WASH) for the financial year 2008/09 by the Uganda Ministry of Water, in recognition of exceptional delivery of clean water and sanitation programmes.',
                'image_url' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/1725726478975-E65JD5KMB8WCQETG65Y0/2009+Best+performing+NGO+in+WASH+Financial+Year+2008_09.JPG',
                'order' => 13,
            ],
        ];

        foreach ($awards as $award) {
            Award::create($award);
        }
    }
}
