<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Content;
use App\Models\User;
use Illuminate\Database\Seeder;

class BlogPostSeeder extends Seeder
{
    public function run(): void
    {
        // ── Author ────────────────────────────────────────────────────────────
        $author = User::first() ?? User::factory()->create([
            'name' => 'KWDT Admin',
            'email' => 'admin@kwdt.org',
        ]);

        // ── Categories / tags ─────────────────────────────────────────────────
        $cats = collect([
            'Fisheries' => 'fisheries',
            'Women Empowerment' => 'women-empowerment',
            'WASH' => 'wash',
            'Climate & Environment' => 'climate-environment',
            'Advocacy' => 'advocacy',
            'Economic Empowerment' => 'economic-empowerment',
            'Health' => 'health',
            'Education' => 'education',
        ])->map(fn ($slug, $name) => Category::firstOrCreate(['slug' => $slug], ['name' => $name]));

        // ── Squarespace CDN images already used by KWDT ───────────────────────
        $imgs = [
            'community' => 'images/content/arche-uganda-194.jpg',
            'women'     => 'images/content/arche-uganda-196.jpg',
            'field'     => 'images/static/dsc03764.jpg',
            'water'     => 'images/content/dsc05383.jpg',
            'lake'      => 'images/content/arche-uganda-218.jpg',
            'meeting'   => 'images/content/dsc01464-2.jpg',
            'fisheries' => 'images/content/img-9742-edited.jpg',
            'forum'     => 'images/content/2-img-9851.jpg',
            'group'     => 'images/content/arche-uganda-204.jpg',
        ];

        // ── Blog posts ────────────────────────────────────────────────────────
        $posts = [

            // ── 1 ─────────────────────────────────────────────────────────────
            [
                'title' => 'Navigating Sustainable Fisheries: A Call for Balanced Co-existence in Uganda\'s Water Bodies',
                'slug' => 'navigating-sustainable-fisheries-balanced-coexistence',
                'excerpt' => 'On September 27, 2024, stakeholders gathered for a crucial dialogue on fisheries sustainability, human rights, and the livelihoods of women who depend on Lake Victoria.',
                'featured_image' => $imgs['fisheries'],
                'published_at' => now()->subMonths(5),
                'categories' => ['fisheries', 'advocacy', 'women-empowerment'],
                'body' => <<<'HTML'
<p>The waters of Lake Victoria are a treasure trove of biodiversity and a lifeline for many communities. On September 27, 2024, stakeholders gathered for a crucial dialogue titled <strong>"Fisheries at the Crossroads: Unveiling the Myths and Realities for Sustainable Co-existence,"</strong> where experts, government officials, and local fishers came together to tackle the pressing issues surrounding the country's multi-species fisheries.</p>

<p>The event, organized by the National Fisheries Resources Research Institute (NaFIRRI), FIAN Uganda and KWDT, highlighted the delicate balance between the ecological preservation of fisheries and the livelihoods of the communities that depend on them. With small pelagic species like Mukene becoming an increasingly dominant part of Uganda's fish catch, questions about sustainability, policy, and human rights came into sharp focus.</p>

<h2>Why Fisheries Matter to Uganda</h2>

<p>Uganda's fisheries are not just an economic powerhouse but a crucial pillar of food security and employment — especially for women and youth. Dr. Winnie Nkalubo, Director of Research at NaFIRRI, opened the event with a reminder that fisheries are Uganda's second-largest export earner after coffee, contributing 3% to the national GDP and 12% to the agricultural sector.</p>

<p>The health of this sector is vital, not only to the national economy but to millions of Ugandans who depend on fish for their daily sustenance.</p>

<h2>The Silverfish Ban: Balancing Ecology and Livelihoods</h2>

<p>One of the most debated issues was the ban on the "hurry-up" method used for silverfish catching — a directive from Uganda's Ministry of Fisheries intended to curb bycatch and overfishing. The ban was met with strong resistance from fishers who saw it as a direct threat to their livelihoods. Fishers were advised to use the "scoop net" method, yet this too faced criticism for being impractical in certain conditions.</p>

<blockquote>"This method is associated with illegal fishing because it requires using smaller boats, which is illegal as the fisheries directives state we should only use the 28 ft. vessels!" — Christine, silverfish fisher and processor</blockquote>

<p>Dr. Nkalubo and other experts pointed out the need for policies that do more than protect fish stocks — they must also safeguard the rights and livelihoods of fishers and processors. The economic potential of fisheries is immense, with annual production valued at over UGX 585 billion (approximately US$158 million), supporting artisanal fishers across Uganda's major lakes.</p>

<h2>Women Bear the Heaviest Burden</h2>

<p>The dialogue spotlighted the disproportionate impact that current fisheries regulations have had on women. Many women are processors and traders of small pelagic species, and with the ban on certain fishing methods, they have been left without livelihoods. This has led to rising poverty, increased school dropouts, and greater domestic instability in fishing communities.</p>

<blockquote>"We can no longer afford to send our children to school because we are not working. The silver fish business was our primary source of income. There is also a rise in domestic violence, as men no longer contribute financially to their families!" — Teopista, fisherwoman from Nangoma Landing Site</blockquote>

<h2>A Call for Human Rights-Based Fisheries Policy</h2>

<p>Prof. Christopher Mbazira argued that Uganda's policies must balance ecological concerns with the rights of those who rely on these resources for their survival. He emphasized that fishers should not be left behind in the quest for sustainability, as their economic access to fish is also a basic human right.</p>

<p>Participants called for the Ministry of Fisheries to lift the ban on silverfish operations under conditions that support both ecological sustainability and economic viability. There was also a strong call for better consultation with fishing communities before any further directives are imposed, ensuring future policies are based on scientific evidence and fishers' lived experiences.</p>
HTML,
            ],

            // ── 2 ─────────────────────────────────────────────────────────────
            [
                'title' => 'KWDT at the UN Headquarters: Reclaiming the Narrative on Rights-Holder-Led Water Governance',
                'slug' => 'kwdt-un-headquarters-water-governance-2025',
                'excerpt' => 'On July 9, 2025, KWDT joined the Butterfly Effect coalition at the UN General Assembly to shape themes for the 2026 UN Water Conference, advocating that participation without power is not participation.',
                'featured_image' => $imgs['meeting'],
                'published_at' => now()->subMonths(1),
                'categories' => ['advocacy', 'wash', 'women-empowerment'],
                'body' => <<<'HTML'
<p>On July 9, 2025, the President of the United Nations General Assembly convened a preparatory meeting to shape the themes of the 2026 UN Water Conference. KWDT, as part of the <strong>Butterfly Effect coalition</strong>, participated in these high-level deliberations to amplify and affirm the urgency of rights-holder-led water governance.</p>

<p>Our message was unequivocal: <em>Fair involvement of rights holders must take precedence over tokenistic inclusivity. Participation without power is not participation.</em></p>

<h2>Water as a Survival Issue, Not Just a Development Issue</h2>

<p>The Youth Forum and stakeholder consultations brought to the forefront a long-standing reality for the Global South: water is not just a development issue — it is a survival issue. It is the pulse of all Sustainable Development Goals, enabling access to food, education, gender equality, climate resilience, and peace. Despite this, the global water agenda remains underfunded and disconnected from grassroots priorities.</p>

<p>KWDT's Catherine Joséphine Nalugga advocated for rights-holder-led governance rather than superficial inclusion. Echoing voices from the Global South, her message was clear: water is a matter of survival, justice, and equity.</p>

<h2>Bridging the Gap Between Global Frameworks and Community Reality</h2>

<p>For civil society organizations, partnerships forged at these forums represent pathways to scale community-based water monitoring, youth-led watershed governance, and the integration of indigenous knowledge. Yet the most persistent barrier remains political inertia — not a lack of innovation or intent.</p>

<p>The sector must address the financing gap with precision through timely information, strategic investment, and institutional preparedness. The Special Rapporteur on the Human Rights to Water and Sanitation, alongside the UN Special Envoy for Water, underscored the value of multi-stakeholder collaboration and mutual accountability.</p>

<h2>What This Means for Communities on Lake Victoria</h2>

<p>For the women and fisher communities KWDT serves across Mukono, Kalangala, and Buvuma, clean water access is not an abstract policy goal. It is the difference between a child attending school and staying home sick, between a woman spending two hours at the borehole or spending those hours on her business, between a community thriving and one barely surviving.</p>

<p>Our engagement in New York reaffirmed KWDT's commitment to amplifying community perspectives at the highest levels of dialogue. Though rural women and fisher communities may not occupy diplomatic seats, their stories, expertise, and resilience hold transformative power.</p>

<p>As we prepare for the 2026 UN Water Conference, KWDT stands ready — not just to advocate, but to act.</p>
HTML,
            ],

            // ── 3 ─────────────────────────────────────────────────────────────
            [
                'title' => 'Justice Forum on Fisheries and Human Rights: Bringing International Instruments to the Grassroots in Kalangala',
                'slug' => 'justice-forum-fisheries-human-rights-kalangala-2025',
                'excerpt' => 'The 1st Justice Forum on Fisheries and Human Rights in Kalangala created a platform for fisherfolk to engage directly with duty-bearers and explore how CFS Guidelines can work for those on the frontlines of food production.',
                'featured_image' => $imgs['forum'],
                'published_at' => now()->subMonths(3),
                'categories' => ['fisheries', 'advocacy', 'women-empowerment'],
                'body' => <<<'HTML'
<p>In November 2025, KWDT organized the <strong>1st Justice Forum on Fisheries and Human Rights</strong> in Kalangala district, held in light of World Fisheries Day. The forum created a meaningful platform for fisher communities to engage directly with duty-bearers on the rights they are entitled to — and too often denied.</p>

<h2>Why a Justice Forum?</h2>

<p>Fisher communities in Uganda's island districts — Kalangala and Buvuma — face a unique set of challenges. Geographical isolation, limited legal literacy, and structural exclusion from policy processes leave women and small-scale fishers particularly vulnerable to exploitation, land grabbing, and regulatory decisions made without their input.</p>

<p>The forum brought together women fishers and farmers from 12 African countries to discuss how the CFS Voluntary Guidelines on Gender Equality and Women and Girls' Empowerment can truly work for those on the frontlines of food production.</p>

<h2>Key Issues Raised by Community Members</h2>

<p>Participants surfaced a range of interconnected concerns during the forum's open dialogues:</p>

<ul>
<li>Arbitrary enforcement of fishing regulations without community consultation</li>
<li>Women's exclusion from Beach Management Unit (BMU) leadership positions</li>
<li>Limited access to credit for fish processing equipment and storage</li>
<li>Lack of legal support when land rights are violated</li>
<li>Climate-related fish stock changes affecting seasonal incomes</li>
</ul>

<h2>From Principles to Practice: CFS Guidelines at the Landing Site</h2>

<p>One of the forum's distinctive contributions was translating the language of international human rights frameworks into practical tools that community members can use in their daily advocacy. KWDT facilitators worked with women's groups to map their rights under the CFS Guidelines against the reality they face — identifying specific duty-bearers responsible for each gap.</p>

<p>This process of "bringing international instruments to the grassroots" has been central to KWDT's advocacy model since its collaboration with FIAN Uganda began. When women understand that their right to participate in fisheries governance is recognized in international law, it changes how they engage with local authorities.</p>

<h2>Moving Forward</h2>

<p>The forum concluded with a community action plan, including commitments to document human rights violations in fisheries, establish legal aid referral pathways, and engage the district fisheries office in quarterly consultations with women's groups.</p>

<p>KWDT will use the forum's findings to inform national-level advocacy ahead of Uganda's review of its National Plan of Action for Small-Scale Fisheries in 2026.</p>
HTML,
            ],

            // ── 4 ─────────────────────────────────────────────────────────────
            [
                'title' => 'From the Shores of Lake Victoria to Business Owners: How KWDT\'s Revolving Scheme is Changing Lives',
                'slug' => 'revolving-scheme-economic-empowerment-lake-victoria',
                'excerpt' => 'Through a self-sustaining revolving fund model, over 596 women in KWDT\'s network now practice integrated agriculture, own dairy cows, and run viable small businesses — breaking a cycle of dependency on declining fish stocks.',
                'featured_image' => $imgs['women'],
                'published_at' => now()->subMonths(4),
                'categories' => ['economic-empowerment', 'women-empowerment'],
                'body' => <<<'HTML'
<p>When Grace Namutebi first joined a KWDT women's group in Mpunge sub-county, she was surviving on UGX 3,000 a day — barely enough to feed her four children. Two years later, she owns two dairy cows, has installed a biogas plant, and is training other women in her village on organic farming. Her story is not unique. It is the story of KWDT's revolving scheme.</p>

<h2>What Is the Revolving Scheme?</h2>

<p>The revolving scheme is a self-financing mechanism at the heart of KWDT's economic empowerment model. First beneficiaries receive assets — a cow, a biosand water filter, fruit trees, a rainwater harvesting tank, or fish processing equipment — and repay an agreed, affordable instalment over time. Those repayments are pooled to enable the next group of beneficiaries to access the same assets.</p>

<p>Unlike grants that create one-time impact, the revolving model creates a perpetual cycle of access. It has enabled KWDT to scale its reach without proportional increases in donor funding.</p>

<h2>What the Numbers Show</h2>

<p>Across KWDT's 52 women's groups spanning Mukono, Kalangala, and Buvuma districts:</p>

<ul>
<li><strong>596 women</strong> now practice integrated agriculture, increasing yields and sustainable resource use for over 5,300 people</li>
<li><strong>113 women</strong> have been supported to acquire dairy cows</li>
<li><strong>27 women</strong> generate and use biogas from cow dung, reducing dependence on firewood</li>
<li><strong>390 women</strong> use energy-saving stoves, cutting household fuel costs by up to 40%</li>
<li><strong>275 women</strong> have diversified away from fishing, reducing pressure on Lake Victoria's fish stocks</li>
<li><strong>86 women</strong> in five groups use energy-saving fish smoking kilns, dramatically reducing charcoal use in fish processing</li>
</ul>

<h2>Beyond Income: The Multiplier Effect on Community Health</h2>

<p>KWDT's experience confirms what development economists have long argued: when you invest in a woman, you invest in her entire community. Income gains from the revolving scheme have translated directly into higher school enrolment rates among children of members, reduced incidences of gender-based violence, and improved nutrition in households.</p>

<p>The organic manure produced by biogas plants has improved soil fertility on plots where chemical fertilizers were once unaffordable. The 2,641 multipurpose trees planted by members have begun restoring degraded lakeside ecosystems that communities depend on for their water security.</p>

<h2>Scaling What Works</h2>

<p>KWDT's revolving scheme model has been replicated across women's groups as the network has grown. The key to its success is simplicity: community members design the repayment terms themselves, making the scheme locally owned rather than externally imposed. When women feel that the system belongs to them, repayment rates remain high and social pressure to honour commitments is built into the group structure.</p>

<p>We are currently exploring how to extend the revolving scheme to solar energy access and digital financial tools — the next frontier for fisher community empowerment.</p>
HTML,
            ],

            // ── 5 ─────────────────────────────────────────────────────────────
            [
                'title' => 'Clean Water, Healthy Communities: KWDT\'s WASH Programme in Mukono\'s Fisher Communities',
                'slug' => 'wash-programme-clean-water-mukono-fisher-communities',
                'excerpt' => 'Access to safe water is the foundation of everything KWDT does. Here is how our WASH programme has transformed daily life for families across six sub-counties in Mukono District.',
                'featured_image' => $imgs['water'],
                'published_at' => now()->subMonths(6),
                'categories' => ['wash', 'health', 'women-empowerment'],
                'body' => <<<'HTML'
<p>In the early 2000s, the women of Katosi faced a daily crisis: the water hyacinth that had invaded Lake Victoria's shores was blocking access to what had once been the community's primary water source. Families were walking hours to find clean water. Children were falling sick. Women — who bear the primary responsibility for water collection in Uganda — were spending their most productive hours in exhausting, fruitless searches.</p>

<p>That crisis is what galvanized KWDT's Water, Sanitation and Hygiene (WASH) programme. Two decades later, that programme has become one of the most demonstrably impactful elements of KWDT's work.</p>

<h2>Rainwater Harvesting: Women Building Their Own Solutions</h2>

<p>One of KWDT's most celebrated innovations has been training women to construct their own rainwater harvesting tanks. What began as a practical response to water scarcity became a powerful symbol of women's capability in a community where gender norms had traditionally confined women to domestic roles.</p>

<p>Lydia Kateregga, one of the first women trained in tank construction, now earns over UGX 190,000 from each tank she constructs and builds three to four tanks a year. Her own household no longer walks hours in search of water.</p>

<blockquote>"My children are safe from the sexual harassment that takes place when girls go to fetch water late in the evening. That alone is worth more than the money." — Lydia Kateregga, KWDT member</blockquote>

<h2>Biosand Filters: Transforming Contaminated Water at the Household Level</h2>

<p>For communities where rainwater harvesting alone is insufficient, KWDT has deployed biosand water filters — low-cost, locally maintainable filters that remove pathogens from contaminated surface water. Women's groups are trained not just to use the filters but to manufacture and repair them, creating a local supply chain that does not depend on external suppliers.</p>

<p>Studies within KWDT communities have documented significant reductions in waterborne illnesses — particularly diarrhoea in children under five — in households using biosand filters consistently.</p>

<h2>Sanitation and Hygiene: Changing Behaviour, Not Just Infrastructure</h2>

<p>KWDT's WASH programme recognises that hardware alone does not change health outcomes. Community-Led Total Sanitation (CLTS) approaches are used to trigger collective behaviour change around open defecation, handwashing, and food hygiene. Women's group leaders are trained as community hygiene promoters, building the social infrastructure needed to sustain behaviour change.</p>

<p>Currently, 82% of Uganda's population lacks access to proper sanitation facilities. In KWDT communities, targeted interventions have helped reverse this trend — but much work remains, particularly on the islands of Kalangala and Buvuma where infrastructure challenges are most acute.</p>

<h2>The Connection Between Water and Everything Else</h2>

<p>KWDT's WASH programme has taught us that water is not a standalone issue. When women spend less time collecting water, they have more time for economic activities. When children are not sick with waterborne diseases, they attend school. When sanitation improves, women's dignity and safety improve. Water is, truly, the pulse of all other development goals.</p>
HTML,
            ],

            // ── 6 ─────────────────────────────────────────────────────────────
            [
                'title' => 'How Digital Tools Are Connecting Uganda\'s Fisherswomen to Markets and Financial Services',
                'slug' => 'digital-tools-fisherswomen-markets-financial-services',
                'excerpt' => 'KWDT has trained over 600 women in digital tools including the Abavubi app for fish marketing and record-keeping, helping bridge the digital divide in Uganda\'s most remote fishing communities.',
                'featured_image' => $imgs['group'],
                'published_at' => now()->subMonths(2),
                'categories' => ['economic-empowerment', 'fisheries', 'education'],
                'body' => <<<'HTML'
<p>Standing at the edge of a landing site in Buvuma, Harriet Nakyeyune pulls out her phone and checks the Abavubi app. She has three orders for dried Nile perch from buyers in Kampala, and the app shows her the current market rate per kilogram — 14% higher than what the middleman who visited yesterday offered her. She declines the middleman's offer and ships directly.</p>

<p>This scene, unimaginable five years ago in one of Uganda's most remote island districts, is becoming increasingly common in KWDT communities. Digital financial tools and market-access platforms are changing the economics of small-scale fish trading — if women can access and use them.</p>

<h2>The Digital Divide in Fishing Communities</h2>

<p>Uganda's digital economy has grown rapidly, but the benefits have been deeply unequal. Women in rural and island fishing communities face compounding barriers: low literacy rates, limited smartphone ownership, unreliable mobile network coverage, and deep-rooted social norms that have historically kept women away from financial decision-making.</p>

<p>With support from GIZ's Responsible Fisheries Business Chain (RFBCP) project, KWDT trained and graduated 600 participants in Business Development Services (BDS) — combining financial literacy, marketing skills, and digital tool training in a programme designed around the realities of women in the fish value chain.</p>

<h2>Abavubi: A Digital Platform Built for Fisherfolk</h2>

<p>The Abavubi app — developed with input from fishing communities — allows women to record their catches and sales, access real-time market prices, connect with verified buyers, and track their business performance over time. KWDT's role has been to train women to use the platform confidently and integrate it into their existing group management practices.</p>

<p>Over 80% of BDS training participants reported applying the content to their businesses within three months of completing the programme. Women who adopted digital record-keeping reported greater confidence in negotiations with buyers and money lenders — a direct impact on their economic autonomy.</p>

<h2>Mobile Money: Banking the Unbanked</h2>

<p>Mobile money platforms like MTN MoMo have transformed access to financial services for KWDT members who previously had no safe way to save, receive payments, or access credit. KWDT's groups have increasingly adopted mobile money as their primary mechanism for managing revolving scheme repayments and group savings pools.</p>

<p>This shift has improved financial transparency within groups and reduced the risk of embezzlement — a practical governance benefit that has strengthened trust and cohesion in women's groups.</p>

<h2>What Comes Next: Scaling Digital Empowerment</h2>

<p>KWDT is exploring partnerships to bring solar-powered community connectivity hubs to its most remote landing sites — removing the network coverage barrier that remains the single greatest constraint on digital adoption in island communities.</p>

<p>We are also working with partners to develop a digital dashboard that allows KWDT members to track their collective impact data — from fish volumes sold to school enrolment rates — giving communities ownership over the evidence of their own transformation.</p>
HTML,
            ],

            // ── 7 ─────────────────────────────────────────────────────────────
            [
                'title' => 'Celebrating 28 Years: KWDT\'s Journey from 26 Women to 1,235 Members Across Three Districts',
                'slug' => 'kwdt-28-years-journey-26-women-1235-members',
                'excerpt' => 'In 1996, 26 women on the shores of Lake Victoria decided to organise. Today, KWDT coordinates 1,235 members in 52 groups across Mukono, Kalangala, and Buvuma — and the work is far from over.',
                'featured_image' => $imgs['community'],
                'published_at' => now()->subMonths(7),
                'categories' => ['women-empowerment', 'economic-empowerment'],
                'body' => <<<'HTML'
<p>In 1996, twenty-six women on the shores of Lake Victoria in Katosi made a decision that would change their community — and eventually, the communities of over a thousand others across three Ugandan districts. They decided to organise.</p>

<p>The group they formed — initially the Katosi Women Fishing Group — had a simple mission: to help women enter the male-dominated fishing sector and secure a share of the economic opportunities the lake offered. What it became is something far more expansive.</p>

<h2>The Early Years: Surviving Crises, Building Resilience</h2>

<p>The early years were shaped by crisis as much as aspiration. In 2000, the government banned fishing in several zones due to the use of poison — a devastating blow to a community whose entire economy centred on the lake. Rather than collapse, the group adapted. Women diversified into agriculture, livestock, and micro-finance. The group changed its name to Katosi Women Fishing and Development Association (KWFDA), reflecting its broader mandate.</p>

<p>When the group's model began attracting other communities, a new structure was needed. In 2004, four women's groups came together to form Katosi Women Development Trust (KWDT) — an umbrella organisation designed to equitably share resources, skills, and knowledge across a growing network.</p>

<h2>Growth That Stayed Rooted in Community</h2>

<p>What distinguishes KWDT's growth is that it has remained genuinely community-led. Groups are not recruited by KWDT — they apply to join, motivated by the transformation they observe in households of existing members. This demand-driven model has ensured that expansion has never outpaced the organisation's capacity to support quality programming.</p>

<p>Since 2018, KWDT has extended its reach to women's groups in fisheries in the island districts of Kalangala and Buvuma — communities facing the most acute vulnerabilities but with the least access to development support.</p>

<h2>The Numbers Behind the Story</h2>

<p>Today, KWDT coordinates:</p>
<ul>
<li><strong>1,235 members</strong> organised in 52 women's groups</li>
<li>Groups spanning six sub-counties in Mukono District, plus Kalangala and Buvuma islands</li>
<li><strong>526 fisher women</strong> organised in 11 groups across 11 landing sites in Buvuma and Kalangala</li>
<li>Programmes spanning economic empowerment, WASH, education, environmental conservation, health, and advocacy</li>
</ul>

<h2>Awards That Belong to the Women</h2>

<p>In 2012, KWDT received the third Kyoto World Water Grand Prize at the World Water Forum in Marseille — and the RIO+20 Women Good Practice Award in Rio de Janeiro. KWDT Coordinator Margaret Nakato has served as Co-President of the World Forum of Fish Harvesters and Fish Workers, representing Uganda's fishing communities on the global stage.</p>

<p>These are not KWDT's awards. They belong to the women who constructed rainwater tanks in the early mornings before fishing, who planted fruit trees on degraded lakeside land, who stayed up late managing group accounts by lamplight. The awards are theirs.</p>

<h2>Looking Ahead</h2>

<p>Twenty-eight years on, the work is not finished. Climate change is intensifying the pressures that KWDT was founded to address. Fish stocks are declining. Water security is becoming more fragile. Gender-based violence remains deeply embedded in fishing communities under economic stress.</p>

<p>But so is the resilience of the women KWDT works with. And that, above all, is what the next 28 years will be built on.</p>
HTML,
            ],

            // ── 8 ─────────────────────────────────────────════────────────────
            [
                'title' => 'Climate Change on the Lake: How Rising Temperatures are Threatening Fish Stocks and Fisher Livelihoods',
                'slug' => 'climate-change-lake-victoria-fish-stocks-livelihoods',
                'excerpt' => 'Lake Victoria is warming faster than the global average, disrupting fish breeding cycles and pushing communities deeper into poverty. KWDT communities are on the frontlines — and they are already adapting.',
                'featured_image' => $imgs['lake'],
                'published_at' => now()->subMonths(8),
                'categories' => ['climate-environment', 'fisheries', 'women-empowerment'],
                'body' => <<<'HTML'
<p>Lake Victoria — the world's largest tropical lake and Africa's largest — is in trouble. Surface water temperatures have risen by nearly 1°C over the past century, a rate faster than the global average for large water bodies. This warming, combined with nutrient pollution and overfishing, is disrupting the delicate ecological systems that make the lake the productive resource it has always been.</p>

<p>For the women and communities KWDT works with, this is not a future risk. It is a present reality.</p>

<h2>What the Science Shows</h2>

<p>Research by the National Fisheries Resources Research Institute (NaFIRRI) documents several concerning trends in Lake Victoria's ecology:</p>

<ul>
<li>Increasing frequency of hypoxic (low-oxygen) zones in the lake's deeper waters, killing bottom-dwelling species</li>
<li>Shifts in fish breeding seasons, making traditional fishing calendars unreliable</li>
<li>Declining Nile perch populations in some zones, affecting the lake's most commercially important species</li>
<li>Changes in the distribution and abundance of Mukene (silverfish), a critical food security species</li>
</ul>

<p>Uganda's fisheries contribute approximately 3% of national GDP and provide livelihoods for an estimated 1.2 million people. Any significant decline in fish stocks translates directly into household food insecurity and lost income for some of Uganda's most vulnerable communities.</p>

<h2>How KWDT Communities Are Adapting</h2>

<p>KWDT's approach to climate adaptation is grounded in a principle that shapes all our work: communities are not passive victims of climate change — they are active problem-solvers when given the tools, knowledge, and social infrastructure to respond.</p>

<p>Practical adaptation strategies being adopted across KWDT's women's groups include:</p>

<ul>
<li><strong>Diversification from fishing:</strong> 275 women have diversified their livelihoods away from exclusive dependence on fishing, reducing community-wide vulnerability to fish stock fluctuations</li>
<li><strong>Energy-saving fish smoking kilns:</strong> Reducing the charcoal required in fish processing cuts both costs and deforestation pressure on lakeside watersheds</li>
<li><strong>Integrated agriculture:</strong> Combining crop farming with livestock and fruit trees creates multiple income streams that buffer against the seasonality of fishing</li>
<li><strong>Reforestation:</strong> KWDT groups have planted 2,641 multipurpose trees, beginning the process of restoring degraded lakeside buffers that filter run-off into the lake</li>
</ul>

<h2>The Gendered Dimensions of Climate Risk</h2>

<p>Climate impacts on fisheries are not gender-neutral. Women who work as fish processors and traders are particularly exposed to climate variability: when fish are scarce, the first casualties are the processing and trading stages — where women predominate — rather than the fishing stage, which remains male-dominated.</p>

<p>KWDT's climate adaptation work therefore centres explicitly on women's economic diversification and resilience — not because the lake's ecology is a women's issue, but because the distribution of climate risk is deeply gendered, and effective responses must be too.</p>

<h2>Advocacy Beyond the Lake</h2>

<p>KWDT's participation in global water and fisheries governance forums — from the World Water Forum to the UN General Assembly preparatory meetings — reflects our belief that community-level adaptation is necessary but not sufficient. The policy environment that shapes how Lake Victoria is managed must also change.</p>

<p>We will continue to bring the voices of women on the lake's shores into international conversations — until those conversations produce policies that actually serve the communities most at risk.</p>
HTML,
            ],

        ];

        // ── Insert posts ──────────────────────────────────────────────────────
        foreach ($posts as $data) {
            $post = Content::updateOrCreate(
                ['slug' => $data['slug']],
                [
                    'title' => $data['title'],
                    'type' => 'blog',
                    'status' => 'published',
                    'excerpt' => $data['excerpt'],
                    'body' => $data['body'],
                    'featured_image' => $data['featured_image'],
                    'author_id' => $author->id,
                    'published_at' => $data['published_at'],
                ]
            );

            $categoryIds = $cats->only($data['categories'])->pluck('id');
            $post->categories()->sync($categoryIds);
        }

        $this->command->info('✓ BlogPostSeeder: '.count($posts).' posts seeded.');
    }
}
