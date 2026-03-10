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

        // ── Squarespace CDN images from katosi.org ────────────────────────────
        $imgs = [
            'centre' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/051514c5-16a6-4835-9e16-229d28e61206/1_4+-+Photo.jpg',
            'centre2' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/ced6224a-a54e-48ba-982f-c42766bb88a4/1_1+-+Photo.jpg',
            'fokus' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/b0c4b55c-133c-4609-b8cd-7540351bf0c6/Kulubbi+DSC04996.JPG',
            'community' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/82eada9f-8188-4ebd-bab8-3fdcf85ca5f8/ARCHE_UGANDA_194.jpg',
            'women' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/0a689bfb-2ee0-4451-ae42-f9fc54f37d71/ARCHE_UGANDA_196.jpg',
            'field' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/3ef1650d-ef5e-4b49-bc13-1b771013aa68/DSC03764.JPG',
            'water' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/d764e888-bfec-47a8-b5a6-a1f0f288a166/DSC05383.JPG',
            'lake' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/c8973b94-5f49-4092-974c-26e2359d0baa/ARCHE_UGANDA_218.jpg',
            'meeting' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/f3fce0f7-c4b3-4e55-ba3e-04c48e8ee2c6/DSC01464+2.JPG',
            'group' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/fc6e9483-6da8-4944-b548-91aef5bb9f99/ARCHE_UGANDA_204.jpg',
            'solar' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/f3fce0f7-c4b3-4e55-ba3e-04c48e8ee2c6/DSC01464+2.JPG',
            'menstrual' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/1748440913792-WB1YP19U51SIPRHEI1KH/MHD_PFW_Drop.png',
            'fisheries' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/85e1a80d-da0d-4326-8423-372ad989d2cb/IMG_9742+-+Edited.jpg',
        ];

        $projects = [

            // ── 1. Katosi Women Centre for Development ────────────────────────
            [
                'title' => 'Katosi Women Centre for Development',
                'slug' => 'katosi-women-centre-for-development',
                'excerpt' => 'A multipurpose two-storey training facility on the banks of Lake Victoria, designed in partnership with Architectes Sans Frontières Sweden to provide women and female youth with practical skills across fisheries, agroecology, digital literacy, carpentry, tailoring, and enterprise development.',
                'featured_image' => $imgs['centre'],
                'published_at' => now()->subMonths(8),
                'categories' => ['economic-empowerment', 'education'],
                'body' => <<<'HTML'
<p>The Katosi Women Centre for Development will serve as a dynamic hub for continuous learning and skills enhancement. It will provide women and female youth with practical knowledge and training across a variety of fields, including fishing, agroecology, micro-business and enterprise development, financial literacy, tailoring, carpentry, computer and digital skills, electrical work, and crafts.</p>

<p>The centre will enable women to diversify their income sources, strengthen existing livelihoods, and engage in construction, repair, and maintenance services that are essential to driving rural economic growth and enhancing the community's economic resilience.</p>

<h2>Partnership with ASF Sweden</h2>

<p>The project is being developed in collaboration with <strong>Architectes Sans Frontières Sweden (ASF-Sweden)</strong>, and will construct a two-storey multipurpose training facility on a <strong>3.5-acre plot in Katutu Village</strong> on the banks of Lake Victoria. This is ASF Sweden's newest approved project in Uganda.</p>

<h2>Community-Centred Construction</h2>

<p>All building materials are to be procured within the region — including burnt clay bricks and sand — and construction manpower will be mobilized from the local community, providing employment opportunities for skilled and unskilled workers from the area. This approach ensures that the construction process itself becomes an economic opportunity for the communities the centre will serve.</p>

<h2>Project Progress</h2>

<p>In <strong>January 2022</strong>, two ASF project members travelled to Uganda to collect data for the preliminary study. Together with KWDT, they conducted a workshop with women affected by the project and visited local communities to gather information about local architecture, building structures and materials.</p>

<p>The preliminary study was subsequently approved by ASF Sweden. During <strong>April 2023</strong>, an ASF architect joined the project team to develop the project proposal, design, and fundraising strategy.</p>

<p>Fundraising is currently ongoing. To support the construction of the Katosi Women Centre for Development, <a href="/donate">make a donation today</a>.</p>
HTML,
            ],

            // ── 2. Fokus Frauen — Women's Rights & Economic Empowerment ───────
            [
                'title' => 'Fokus Frauen: Securing Women\'s Land Rights and Economic Empowerment',
                'slug' => 'fokus-frauen-land-rights-economic-empowerment',
                'excerpt' => 'With support from Fokus Frauen Switzerland, KWDT has educated 560 women and 126 men on their human rights, while working to secure land tenure and launch group enterprises for women in fishing communities across Mukono District.',
                'featured_image' => $imgs['fokus'],
                'published_at' => now()->subMonths(6),
                'categories' => ['women-empowerment', 'advocacy', 'economic-empowerment'],
                'body' => <<<'HTML'
<p>With support from <strong><a href="https://www.fokusfrauen.ch/en/projects/project_uganda" target="_blank" rel="noopener">Fokus Frauen Switzerland</a></strong>, KWDT has implemented a programme that created awareness on human rights violations, prompting positive change at both individual and community level.</p>

<h2>What Has Been Achieved</h2>

<p>Through community education sessions:</p>
<ul>
  <li><strong>560 women and 126 men</strong> were educated in their groups about their human rights</li>
  <li><strong>1,158 women and 607 men</strong> were reached within communities, enlightening them about women's rights, children's rights, and economic, social and cultural rights</li>
  <li>Women working in groups have progressively worked towards protecting human rights, particularly women's rights and land rights</li>
</ul>

<h2>Why This Project Continues: Persistent Challenges</h2>

<p>Despite these strides, significant challenges persist — particularly in women's economic empowerment. Insecure land tenure, crucial for communities reliant on fisheries and agriculture, poses a significant barrier. Limited access to capital stems from systemic barriers such as educational restrictions and denial of inheritance rights, leaving women economically dependent.</p>

<p>These ongoing challenges are what has prompted the continuation of the partnership between KWDT and Fokus Frauen.</p>

<h2>Three Core Objectives</h2>

<p><strong>1. Secure land tenure for women</strong><br>
Supporting women in groups to acquire land for production and secure legal tenure through land title acquisition — a critical foundation for agricultural and fisheries livelihoods.</p>

<p><strong>2. Women's economic empowerment through enterprise development</strong><br>
Supporting women in groups to start and operate group enterprises that increase incomes while sharing associated risks. This includes provision of fish smoking equipment and support for dairy farming.</p>

<p><strong>3. Knowledge and skills empowerment</strong><br>
Training women's groups to work as cooperatives, complemented with dialogues on human rights for women's groups and 18 fishing communities across the project area.</p>
HTML,
            ],

            // ── 3. arche noVa WASH Programme ─────────────────────────────────
            [
                'title' => 'Resilient WASH for Fishing Communities: Partnership with arche noVa',
                'slug' => 'arche-nova-wash-fishing-communities',
                'excerpt' => 'For over seven years, KWDT has partnered with Germany-based arche noVa to deliver comprehensive water, sanitation and hygiene services across 13 fishing villages — including two islands — in Mukono, Kalangala and Buvuma districts.',
                'featured_image' => $imgs['water'],
                'published_at' => now()->subMonths(4),
                'categories' => ['wash', 'health', 'climate-environment'],
                'body' => <<<'HTML'
<p>For over seven years, KWDT has been implementing a comprehensive Water, Sanitation and Hygiene (WASH) programme in partnership with <strong>arche noVa</strong>, a Germany-based humanitarian non-profit, across <strong>13 fishing villages including two islands</strong>.</p>

<h2>What the Programme Delivers</h2>

<p>The programme goes far beyond infrastructure construction. Its components include:</p>

<ul>
  <li>Construction of water sources, latrines and bathing facilities</li>
  <li>Promotion of standard hygiene practices that respect the cultural diversity of the communities served</li>
  <li>Menstrual hygiene education for women and girls</li>
  <li>Training to maintain the functionality of water and sanitation facilities</li>
  <li>Promotion of ecosanitaton latrines for safe waste management</li>
  <li>Waste management committees — primarily comprising women — that convert organic waste into briquettes as an alternative to firewood and charcoal</li>
</ul>

<h2>Building Local Capacity That Lasts</h2>

<p>A cornerstone of the programme is community ownership. Women are trained as <strong>borehole technicians</strong> to maintain water sources independently, removing dependence on outside contractors and ensuring that infrastructure keeps working long after external support ends. Communities are trained on safe water practices to prevent contamination and disease outbreak.</p>

<h2>Impact to Date</h2>

<p>Across KWDT's network, the WASH partnership with arche noVa has contributed to:</p>
<ul>
  <li>Measurable reductions in waterborne disease incidence in participating communities</li>
  <li>Improved school attendance for girls — particularly through menstrual hygiene management education</li>
  <li>Reduced time burden on women for water collection</li>
  <li>Increased awareness of human rights related to water and sanitation, with <strong>3,500 persons trained on human rights and gender</strong> with support from Fokus Frauen and arche noVa</li>
</ul>
HTML,
            ],

            // ── 4. GIZ RFBCP — Business Dev & SSF Guidelines ──────────────────
            [
                'title' => 'GIZ Responsible Fisheries Business Chain Project',
                'slug' => 'giz-responsible-fisheries-business-chain-project',
                'excerpt' => 'With support from GIZ\'s Responsible Fisheries Business Chain Project (RFBCP), KWDT trained and graduated 600 participants in business development services, digital tools and the FAO Small-Scale Fisheries Guidelines across 15 districts in Uganda.',
                'featured_image' => $imgs['fisheries'],
                'published_at' => now()->subMonths(10),
                'categories' => ['fisheries', 'economic-empowerment', 'education'],
                'body' => <<<'HTML'
<p>With support from the <strong>GIZ Responsible Fisheries Business Chain Project (RFBCP)</strong>, KWDT trained and graduated <strong>600 participants in Business Development Services (BDS)</strong> — combining financial literacy, marketing skills, and practical knowledge for women engaged in the fish value chain.</p>

<h2>What Participants Learned</h2>

<p>The BDS training programme covered:</p>
<ul>
  <li>Business planning and record-keeping</li>
  <li>Credit management and financial literacy</li>
  <li>Fish marketing and market linkage strategies</li>
  <li>Use of digital apps including <strong>Abavubi</strong> for fish marketing and sales tracking</li>
  <li>The FAO <strong>Small-Scale Fisheries (SSF) Guidelines</strong> — their rights, and how to use them</li>
</ul>

<h2>Scale and Reach</h2>

<p>Through the RFBCP partnership, KWDT contributed to training <strong>2,016 persons from 15 districts across Uganda</strong> on the SSF Guidelines. Over 80% of BDS training participants reported applying the content to their businesses within three months of completion.</p>

<h2>Bridging the Digital Divide</h2>

<p>A key innovation of this project was training women in fishing communities to use digital tools — including the Abavubi app — for marketing fish products, comparing prices, and managing business records. For many participants, this was their first experience using technology for business purposes. The training has directly increased their negotiating confidence with buyers and financial service providers.</p>

<h2>Project Status</h2>

<p>The GIZ RFBCP project has formally closed. KWDT is building on its achievements through continued digital and business skills integration across its women's groups, and is actively exploring partnerships to scale these outcomes.</p>
HTML,
            ],

            // ── 5. Solar Powered Lighting ─────────────────────────────────────
            [
                'title' => 'Solar-Powered Lighting for Safer Landing Sites',
                'slug' => 'solar-powered-lighting-landing-sites',
                'excerpt' => 'KWDT has installed solar-powered lighting systems at key landing sites and fishing villages to improve safety for women returning from night fishing activities, reduce sexual harassment, and enable evening economic activity.',
                'featured_image' => $imgs['lake'],
                'published_at' => now()->subMonths(9),
                'categories' => ['women-empowerment', 'climate-environment'],
                'body' => <<<'HTML'
<p>Fishing communities on Lake Victoria operate around the clock. Night fishing is common, and women involved in processing and trading fish are often at the landing site before dawn and after dark. Without lighting, these hours represent a significant safety risk — particularly for women and girls who face harassment and assault in unlit areas.</p>

<h2>What the Project Does</h2>

<p>KWDT's solar-powered lighting project has installed solar lighting systems at key landing sites and fishing villages across the project area. The lighting:</p>

<ul>
  <li>Improves safety for women returning from night fishing activities or evening markets</li>
  <li>Reduces incidents of sexual harassment and gender-based violence in unlit areas</li>
  <li>Enables women to extend their economic activities into evening hours</li>
  <li>Reduces household dependence on kerosene lamps, which are costly, polluting, and a fire hazard</li>
</ul>

<h2>Solar Energy in the Context of Climate Adaptation</h2>

<p>The choice of solar energy is not incidental. In communities with unreliable grid electricity or no connection at all, solar represents the only viable renewable energy option. The project also builds local familiarity with solar technology, creating a foundation for future solar adoption at the household and community level.</p>

<p>Solar lighting is a small but significant example of how appropriate technology, correctly deployed with community input, can address multiple overlapping challenges — safety, energy access, and climate resilience — simultaneously.</p>

<h2>Community Feedback</h2>

<p>Women in communities where solar lighting has been installed consistently report feeling safer, particularly on routes from the landing site to their homes. Several women have also reported that their daughters are now more willing to attend evening study sessions because the risk of harassment en route has diminished.</p>
HTML,
            ],

            // ── 6. Resilience Building / MHM ─────────────────────────────────
            [
                'title' => 'Resilience Building of Fishing Communities: Menstrual Health and Community Dialogue',
                'slug' => 'resilience-building-fishing-communities-menstrual-health',
                'excerpt' => 'As part of the Resilience Building of Fishing Communities project, KWDT has facilitated community dialogues on menstrual hygiene management in Sowe, Mbeya Island and other fishing villages, breaking stigma and changing how men, women and youth talk about periods.',
                'featured_image' => $imgs['menstrual'],
                'published_at' => now()->subMonths(3),
                'categories' => ['health', 'women-empowerment', 'education'],
                'body' => <<<'HTML'
<p>Menstruation has long been surrounded by stigma, misinformation, and neglect in Uganda's fishing communities. Women were forced to hide their experiences, while girls missed school due to lack of sanitary pads or fear of being shamed. The Resilience Building of Fishing Communities project is changing this.</p>

<h2>Community Dialogues That Shift Norms</h2>

<p>Over the past years, KWDT has facilitated a series of menstrual hygiene management (MHM) dialogues in communities including <strong>Sowe and Mbeya Island in Mukono District</strong>, engaging women, men, and youth in honest, urgent conversations about menstruation — and the systems that keep it invisible.</p>

<p>These dialogues are sparking real change:</p>
<blockquote>"Training with the men has given us confidence and an opportunity to freely manage menstruation." — Female participant, Sowe</blockquote>

<p>For the first time, men in these fishing communities are stepping into the conversation — and into the solution.</p>

<h2>What the Project Covers</h2>

<ul>
  <li>Community awareness sessions on menstrual hygiene management for women, men and youth</li>
  <li>Training on production of reusable sanitary pads — providing women with an affordable, sustainable solution</li>
  <li>Engagement with schools to support girls' continued education during menstruation</li>
  <li>Integration of MHM into KWDT's broader WASH programming</li>
  <li>Advocacy for menstrual health as a public health and gender equality issue at district level</li>
</ul>

<h2>Why Fishing Communities?</h2>

<p>Fishing communities face particular barriers to menstrual health. The absence of private sanitation facilities at landing sites, the physical demands of fish processing work, and the economic pressures that push girls out of school early all compound the challenges that menstruation presents. Addressing MHM in this context requires both practical solutions and cultural shifts — which is why KWDT's approach combines infrastructure, education, and community dialogue.</p>

<h2>Broader Resilience Goals</h2>

<p>Menstrual health is one component of the wider Resilience Building project, which aims to strengthen the capacity of fishing communities to withstand social, economic and climate-related shocks. Healthy, educated, economically active women are more resilient communities — which is why MHM sits at the heart of KWDT's resilience agenda.</p>
HTML,
            ],

            // ── 7. Uganda-Saxony Partnership ──────────────────────────────────
            [
                'title' => 'Uganda-Saxony Partnership: International Exchange for Development',
                'slug' => 'uganda-saxony-partnership',
                'excerpt' => 'Through the Uganda-Saxony Partnership, KWDT participates in an international exchange programme that connects Ugandan civil society organisations with partners in the German state of Saxony, sharing knowledge and strengthening organisational capacity.',
                'featured_image' => $imgs['meeting'],
                'published_at' => now()->subMonths(12),
                'categories' => ['advocacy', 'education'],
                'body' => <<<'HTML'
<p>The <strong>Uganda-Saxony Partnership</strong> is an international development partnership that connects civil society organisations, local governments, and communities in Uganda with counterparts in the German state of Saxony. KWDT participates in this programme as part of its broader engagement with international solidarity networks.</p>

<h2>What the Partnership Involves</h2>

<p>The partnership supports mutual learning and exchange between partner organisations in Uganda and Saxony. Activities include:</p>

<ul>
  <li>Exchange visits enabling KWDT staff and community members to visit partner organisations in Germany and vice versa</li>
  <li>Joint project planning and implementation on agreed thematic areas</li>
  <li>Capacity building workshops focused on organisational governance, financial management, and programme monitoring</li>
  <li>Joint fundraising and advocacy for issues affecting both partner communities</li>
</ul>

<h2>What KWDT Gains from the Partnership</h2>

<p>International exchange partnerships like Uganda-Saxony offer KWDT access to technical expertise, alternative development models, and peer learning opportunities that are difficult to access domestically. Exposure to how women's organisations in Saxony navigate land rights, cooperative enterprise, and environmental advocacy has directly informed KWDT's programming.</p>

<p>Equally, KWDT brings valuable expertise to the partnership: the lived experience of adapting international frameworks like the FAO SSF Guidelines and the UN SDGs to community-level reality in East Africa's fishing communities is a resource that partners in Germany have found genuinely valuable.</p>

<h2>The Broader Value of International Solidarity</h2>

<p>KWDT believes that sustainable development requires connections across borders — not just within countries. The Uganda-Saxony Partnership is one expression of this belief: that communities in the Global South and Global North have as much to learn from each other as they do from development agencies, and that relationships of genuine mutual respect are the foundation of effective development cooperation.</p>
HTML,
            ],

        ];

        // ── Category lookup ───────────────────────────────────────────────────
        $slugMap = [
            'women-empowerment' => 'Women Empowerment',
            'economic-empowerment' => 'Economic Empowerment',
            'wash' => 'WASH',
            'health' => 'Health',
            'fisheries' => 'Fisheries',
            'advocacy' => 'Advocacy',
            'education' => 'Education',
            'climate-environment' => 'Climate & Environment',
        ];

        $cats = collect($slugMap)->map(
            fn ($name, $slug) => \App\Models\Category::firstOrCreate(['slug' => $slug], ['name' => $name])
        );

        // ── Insert ────────────────────────────────────────────────────────────
        foreach ($projects as $data) {
            $project = Content::updateOrCreate(
                ['slug' => $data['slug']],
                [
                    'title' => $data['title'],
                    'type' => 'project',
                    'status' => 'published',
                    'excerpt' => $data['excerpt'],
                    'body' => $data['body'],
                    'featured_image' => $data['featured_image'],
                    'author_id' => $author->id,
                    'published_at' => $data['published_at'],
                ]
            );

            $categoryIds = $cats->only($data['categories'])->pluck('id');
            $project->categories()->sync($categoryIds);
        }

        $this->command->info('✓ ProjectSeeder: '.count($projects).' projects seeded.');
    }
}
