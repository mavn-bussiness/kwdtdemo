<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Content;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $author = User::first() ?? User::factory()->create([
            'name' => 'KWDT Admin',
            'email' => 'admin@kwdt.org',
        ]);

        $imgs = [
            'centre'    => 'images/content/1-4-photo.jpg',
            'fokus'     => 'images/content/kulubbi-dsc04996.jpg',
            'community' => 'images/content/arche-uganda-194.jpg',
            'women'     => 'images/content/arche-uganda-196.jpg',
            'water'     => 'images/content/dsc05383.jpg',
            'lake'      => 'images/content/arche-uganda-218.jpg',
            'meeting'   => 'images/content/dsc01464-2.jpg',
            'menstrual' => 'images/content/mhd-pfw-drop.png',
            'fisheries' => 'images/content/img-9742-edited.jpg',
        ];

        $projects = [

            // 1. Micro Credit Loans Scheme — slug from katosi.org
            [
                'title'          => 'Micro Credit Loans Scheme',
                'slug'           => 'micro-credit-loans-scheme',
                'excerpt'        => 'The KWDT Micro Credit Program, launched in 2011, provides financial support to rural communities with limited access to financial services, supporting women\'s groups in Kalangala, Mpatta and Buvuma with monthly loans for economic activities.',
                'featured_image' => $imgs['women'],
                'published_at'   => now()->subMonths(14),
                'categories'     => ['economic-empowerment', 'women-empowerment'],
                'body'           => '<p>The KWDT Micro Credit Program, launched in 2011, began as a small initiative funded by fishing profits from its members. It has since grown into a well-established program, providing financial support to rural communities with limited access to financial services. With significant backing from the Swiss Hand Foundation, the program now supports 8 women\'s groups in Kalangala, 11 in Mpatta, and several others in Buvuma. Each month, an average of 15 women receive loans to fund various economic activities, including communal gardening, catering, beauty salons, retail trading, and fishing.</p><p>The program emphasizes community participation and responsible lending. Trained loan committees in each group assess applicants and monitor repayments. Borrowers are vetted, and loans are disbursed based on criteria like the value of collateral and repayment history. Regular committee meetings adjust borrowing limits, ensuring financial sustainability and reducing the risk of default.</p><p>In addition to financial assistance, the program empowers women through training in business growth, credit management, and record-keeping. Weekly follow-ups ensure timely loan repayments and business progress. This approach has led to increased household income, improved business skills, and job creation within the community.</p><p>The program\'s success has attracted attention from other groups, including SACCOs and saving groups, further expanding its reach and fostering community development. Through its focus on economic empowerment and sustainable growth, the KWDT Micro Credit Programme continues to transform the lives of women and communities in rural Uganda.</p>',
            ],

            // 2. Solar Powered Lighting — slug from katosi.org
            [
                'title'          => 'Solar Powered Lighting',
                'slug'           => 'solar-powered-lighting',
                'excerpt'        => 'KWDT supports community members in Mukono, Kalangala and Buvuma to access alternative sources of lighting. In partnership with Mwangaza Solar Solutions, over 10,000 community members now benefit from solar-powered lights.',
                'featured_image' => $imgs['lake'],
                'published_at'   => now()->subMonths(11),
                'categories'     => ['women-empowerment', 'climate-environment'],
                'body'           => '<p>KWDT supports community members in Mukono, Kalangala and Buvuma to access alternative sources of lighting other than kerosene lighting.</p><h2>KWDT x Mwangaza Solar Solutions</h2><p>These solar lamps are more cost-effective compared to traditional kerosene lamps, offering a longer lifespan of up to 5 years before the battery requires replacement. Additionally, solar lights present a safer alternative by eliminating the fire hazards associated with kerosene and removing the harmful emissions that negatively impact health.</p><p><strong>Currently, over 10,000 community members are benefitting from the use of these solar powered lights. This has also reduced the occurrence of fires in fisher communities.</strong></p>',
            ],

            // 3. Fokus Frauen — slug from katosi.org
            [
                'title'          => 'Fokus Frauen: Securing Women\'s Social Rights',
                'slug'           => 'focus-frauen',
                'excerpt'        => 'With support from Fokus Frauen Switzerland, KWDT educated 560 women and 126 men on their human rights, while working to secure land tenure and launch group enterprises for women in fishing communities.',
                'featured_image' => $imgs['fokus'],
                'published_at'   => now()->subMonths(6),
                'categories'     => ['women-empowerment', 'advocacy', 'economic-empowerment'],
                'body'           => '<p>With support from <strong><a href="https://www.fokusfrauen.ch/en/projects/project_uganda" target="_blank" rel="noopener">Fokus Frauen Switzerland</a></strong>, KWDT implemented a project that created awareness on human rights violations, prompting positive change at individual and community level.</p><p>A total of <strong>560 women and 126 men</strong> were educated in their groups, while <strong>1,158 women and 607 men</strong> were reached within the communities, enlightening them about their human rights. Women working in the groups have progressively worked towards protecting human rights, particularly women\'s rights, children\'s and economic social cultural rights.</p><p>However, despite these strides, challenges persist, particularly in women\'s economic empowerment. Insecure land tenure, crucial for communities reliant on fisheries and agriculture, poses a significant barrier. Limited access to capital stems from systematic barriers such as educational restrictions and denial of inheritance rights, rendering women dependent. This prompted the continuation of the partnership between KWDT and <a href="https://www.fokusfrauen.ch/en/projects/project_uganda" target="_blank" rel="noopener">Fokus Frauen</a>.</p><h2>Objectives</h2><p>The project seeks to achieve three specific objectives:</p><p><strong>1. Secure tenure of land for women</strong><br>Supporting women working in groups to acquire land for production and secure legal tenure through the acquisition of land titles.</p><p><strong>2. Women economic empowerment through enterprises development</strong><br>Supporting women working in groups to start and operate group enterprises that aim to increase their incomes while sharing the associated risks. This includes provision of fish smoking equipment and dairy farming.</p><p><strong>3. Knowledge and skills empowerment</strong><br>Training women\'s groups to work in cooperatives, complemented with trainings and dialogues on human rights for women\'s groups and 18 fishing communities.</p>',
            ],

            // 4. Katosi Women Center for Development — slug from katosi.org
            [
                'title'          => 'Katosi Women Center for Development',
                'slug'           => 'katosi-women-center-for-development',
                'excerpt'        => 'A multipurpose two-storey training facility on the banks of Lake Victoria, designed in partnership with Architectes Sans Frontières Sweden to provide women and female youth with practical skills across fisheries, agroecology, digital literacy, carpentry, tailoring, and enterprise development.',
                'featured_image' => $imgs['centre'],
                'published_at'   => now()->subMonths(8),
                'categories'     => ['economic-empowerment', 'education'],
                'body'           => '<p>The Katosi Women Centre for Development will serve as a dynamic hub for continuous learning and skills enhancement. It will provide women and female youth with practical knowledge and training across a variety of fields, including fishing, agroecology, micro-business and enterprise development, financial literacy, tailoring, carpentry, computer and digital skills, electrical work, and crafts. The center will enable them to diversify their income sources, strengthen existing livelihoods, and engage in construction, repair, and maintenance services that are essential to driving rural economic growth and enhancing the community\'s economic resilience.</p><p>The project, in collaboration with <a href="https://www.arkitekterutangranser.se/portfolio/katosi-women-center-for-development/" target="_blank" rel="noopener"><strong><em>Architectes Sans Frontière-Sweden (ASF-Sweden)</em></strong></a>, will construct a two-story multipurpose training facility on a 3.5-acre plot in Katutu Village on the banks of Lake Victoria, Uganda.</p><p>The project is in the preliminary phase. In <strong>January 2022</strong>, two project members travelled to Uganda to collect data for the preliminary study. Together with the local partner, they carried out a workshop with some of the women affected by the project and visited local communities to gather information about the local architecture, building structure and materials.</p><p>Thanks to the data collected and the study trip, the preliminary study was approved by ASF Sweden. During <strong>April 2023</strong>, an ASF architect joined the project group to work with the project proposal, prepare process, design and fundraising campaigns.</p><p>All building materials are to be procured within the region including the burnt clay bricks and sand. The manpower for construction is to be mobilized through the community to provide employment opportunities to the skilled and unskilled labor from the area.</p>',
            ],

            // 5. Uganda-Saxony Partnership — slug from katosi.org
            [
                'title'          => 'Uganda-Saxony Partnership',
                'slug'           => 'uganda-saxony-partnership',
                'excerpt'        => 'Through the Uganda-Saxony Partnership, KWDT participates in an international exchange programme connecting Ugandan civil society organisations with partners in the German state of Saxony, funded by the Free State of Saxony.',
                'featured_image' => $imgs['meeting'],
                'published_at'   => now()->subMonths(12),
                'categories'     => ['advocacy', 'education'],
                'body'           => '<p>The <strong>Uganda-Saxony Partnership</strong> is funded by the Free State of Saxony, through the Entwicklungspolitisches Netzwerk Sachsen, ENS e.V (Development Policy Network Saxony).</p><p>The partnership project seeks to strengthen cooperation of actors in Uganda and Saxony that work in different areas of sustainable development including Civil Society Organisations (CSOs), schools, cultural institutions, sciences, business sector and municipalities interested in social and sustainable development.</p><p>Find out more at <a href="https://uganda-saxonypartnership.org/" target="_blank" rel="noopener">https://uganda-saxonypartnership.org/</a></p>',
            ],

            // 6. arche noVa WASH Programme
            [
                'title'          => 'Resilient WASH for Fishing Communities: Partnership with arche noVa',
                'slug'           => 'arche-nova-wash-fishing-communities',
                'excerpt'        => 'For over seven years, KWDT has partnered with Germany-based arche noVa to deliver comprehensive water, sanitation and hygiene services across 13 fishing villages in Mukono, Kalangala and Buvuma districts.',
                'featured_image' => $imgs['water'],
                'published_at'   => now()->subMonths(4),
                'categories'     => ['wash', 'health', 'climate-environment'],
                'body'           => '<p>For over seven years, KWDT has been implementing a comprehensive Water, Sanitation and Hygiene (WASH) programme in partnership with <strong>arche noVa</strong>, a Germany-based humanitarian non-profit, across <strong>13 fishing villages including two islands</strong>.</p><h2>What the Programme Delivers</h2><ul><li>Construction of water sources, latrines and bathing facilities</li><li>Promotion of standard hygiene practices that respect the cultural diversity of the communities served</li><li>Menstrual hygiene education for women and girls</li><li>Training to maintain the functionality of water and sanitation facilities</li><li>Promotion of ecosanitation latrines for safe waste management</li><li>Waste management committees — primarily comprising women — that convert organic waste into briquettes as an alternative to firewood and charcoal</li></ul><h2>Building Local Capacity That Lasts</h2><p>Women are trained as <strong>borehole technicians</strong> to maintain water sources independently, removing dependence on outside contractors and ensuring that infrastructure keeps working long after external support ends.</p><h2>Impact to Date</h2><ul><li>Measurable reductions in waterborne disease incidence in participating communities</li><li>Improved school attendance for girls through menstrual hygiene management education</li><li>Reduced time burden on women for water collection</li><li><strong>3,500 persons trained on human rights and gender</strong> with support from Fokus Frauen and arche noVa</li></ul>',
            ],

            // 7. GIZ RFBCP
            [
                'title'          => 'GIZ Responsible Fisheries Business Chain Project',
                'slug'           => 'giz-responsible-fisheries-business-chain-project',
                'excerpt'        => 'With support from GIZ\'s Responsible Fisheries Business Chain Project (RFBCP), KWDT trained and graduated 600 participants in business development services, digital tools and the FAO Small-Scale Fisheries Guidelines across 15 districts in Uganda.',
                'featured_image' => $imgs['fisheries'],
                'published_at'   => now()->subMonths(10),
                'categories'     => ['fisheries', 'economic-empowerment', 'education'],
                'body'           => '<p>With support from the <strong>GIZ Responsible Fisheries Business Chain Project (RFBCP)</strong>, KWDT trained and graduated <strong>600 participants in Business Development Services (BDS)</strong> — combining financial literacy, marketing skills, and practical knowledge for women engaged in the fish value chain.</p><h2>What Participants Learned</h2><ul><li>Business planning and record-keeping</li><li>Credit management and financial literacy</li><li>Fish marketing and market linkage strategies</li><li>Use of digital apps including <strong>Abavubi</strong> for fish marketing and sales tracking</li><li>The FAO <strong>Small-Scale Fisheries (SSF) Guidelines</strong> — their rights, and how to use them</li></ul><h2>Scale and Reach</h2><p>Through the RFBCP partnership, KWDT contributed to training <strong>2,016 persons from 15 districts across Uganda</strong> on the SSF Guidelines. Over 80% of BDS training participants reported applying the content to their businesses within three months of completion.</p>',
            ],

            // 8. Resilience Building / MHM
            [
                'title'          => 'Resilience Building: Menstrual Health and Community Dialogue',
                'slug'           => 'resilience-building-menstrual-health',
                'excerpt'        => 'KWDT has facilitated community dialogues on menstrual hygiene management in Sowe, Mbeya Island and other fishing villages, breaking stigma and changing how men, women and youth talk about periods.',
                'featured_image' => $imgs['menstrual'],
                'published_at'   => now()->subMonths(3),
                'categories'     => ['health', 'women-empowerment', 'education'],
                'body'           => '<p>Menstruation has long been surrounded by stigma, misinformation, and neglect in Uganda\'s fishing communities. Women were forced to hide their experiences, while girls missed school due to lack of sanitary pads or fear of being shamed. The Resilience Building of Fishing Communities project is changing this.</p><h2>Community Dialogues That Shift Norms</h2><p>KWDT has facilitated a series of menstrual hygiene management (MHM) dialogues in communities including <strong>Sowe and Mbeya Island in Mukono District</strong>, engaging women, men, and youth in honest conversations about menstruation.</p><blockquote>"Training with the men has given us confidence and an opportunity to freely manage menstruation." — Female participant, Sowe</blockquote><h2>What the Project Covers</h2><ul><li>Community awareness sessions on menstrual hygiene management for women, men and youth</li><li>Training on production of reusable sanitary pads</li><li>Engagement with schools to support girls\' continued education during menstruation</li><li>Integration of MHM into KWDT\'s broader WASH programming</li><li>Advocacy for menstrual health as a public health and gender equality issue at district level</li></ul>',
            ],

        ];

        $slugMap = [
            'women-empowerment'    => 'Women Empowerment',
            'economic-empowerment' => 'Economic Empowerment',
            'wash'                 => 'WASH',
            'health'               => 'Health',
            'fisheries'            => 'Fisheries',
            'advocacy'             => 'Advocacy',
            'education'            => 'Education',
            'climate-environment'  => 'Climate & Environment',
        ];

        $cats = collect($slugMap)->map(
            fn ($name, $slug) => Category::firstOrCreate(['slug' => $slug], ['name' => $name])
        );

        $projectMeta = [
            'micro-credit-loans-scheme'              => ['status' => 'ongoing',   'location' => 'Kalangala, Mpatta, Buvuma', 'funder' => 'Swiss Hand Foundation',    'start_date' => '2011-01-01'],
            'solar-powered-lighting'                 => ['status' => 'ongoing',   'location' => 'Mukono, Kalangala, Buvuma', 'funder' => 'Mwangaza Solar Solutions',  'start_date' => '2018-01-01'],
            'focus-frauen'                           => ['status' => 'ongoing',   'location' => 'Mukono, Kalangala',         'funder' => 'Fokus Frauen Switzerland',  'start_date' => '2020-01-01'],
            'katosi-women-center-for-development'    => ['status' => 'planned',   'location' => 'Katosi, Mukono',            'funder' => 'ASF Sweden',                'start_date' => '2022-01-01'],
            'uganda-saxony-partnership'              => ['status' => 'ongoing',   'location' => 'Uganda / Saxony',           'funder' => 'Free State of Saxony',      'start_date' => '2019-01-01'],
            'arche-nova-wash-fishing-communities'    => ['status' => 'ongoing',   'location' => 'Mukono, Kalangala, Buvuma', 'funder' => 'arche noVa',                'start_date' => '2017-01-01'],
            'giz-responsible-fisheries-business-chain-project' => ['status' => 'completed', 'location' => '15 Districts, Uganda', 'funder' => 'GIZ RFBCP',           'start_date' => '2021-01-01', 'end_date' => '2023-12-31'],
            'resilience-building-menstrual-health'   => ['status' => 'ongoing',   'location' => 'Mukono, Kalangala',         'funder' => 'arche noVa',                'start_date' => '2022-01-01'],
        ];

        foreach ($projects as $data) {
            $content = Content::updateOrCreate(
                ['slug' => $data['slug']],
                [
                    'title'          => $data['title'],
                    'type'           => 'project',
                    'status'         => 'published',
                    'excerpt'        => $data['excerpt'],
                    'body'           => $data['body'],
                    'featured_image' => $data['featured_image'],
                    'author_id'      => $author->id,
                    'published_at'   => $data['published_at'],
                ]
            );

            $categoryIds = $cats->only($data['categories'])->pluck('id');
            $content->categories()->sync($categoryIds);

            // Create or update the matching projects row
            $meta = $projectMeta[$data['slug']] ?? [];
            \App\Models\Project::updateOrCreate(
                ['content_id' => $content->id],
                [
                    'status'              => $meta['status']     ?? 'ongoing',
                    'location'            => $meta['location']   ?? null,
                    'funder'              => $meta['funder']      ?? null,
                    'start_date'          => $meta['start_date'] ?? now()->subYear()->toDateString(),
                    'end_date'            => $meta['end_date']   ?? null,
                    'beneficiaries_count' => null,
                    'budget_usd'          => null,
                ]
            );
        }

        $this->command->info('✓ ProjectSeeder: ' . count($projects) . ' projects seeded (content + projects rows).');
    }
}
