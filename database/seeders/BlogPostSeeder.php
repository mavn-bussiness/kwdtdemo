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
        // Clear existing blog posts
        Content::where('type', 'blog')->delete();

        $user = User::first() ?? User::factory()->create();

        $blogPosts = [
            [
                'title' => '🌍 Our Theory of Change: Empowering Rural Women, Transforming Communities',
                'slug' => 'hahhyp5x0jf0h81jkzpvuavqu5gusj',
                'published_at' => '2025-08-21',
                'excerpt' => 'Explore KWDT\'s comprehensive theory of change that empowers rural women and transforms communities.',
                'categories' => ['women-empowerment'],
            ],
            [
                'title' => 'Reclaiming the Narrative: KWDT at the UN Headquarters. A Voice for Rural Communities in Global Water Dialogues',
                'slug' => 'reclaiming-the-narrative-kwdt-at-the-un-headquarters-a-voice-for-rural-communities-in-global-water-dialogues',
                'published_at' => '2025-07-15',
                'excerpt' => 'KWDT represents rural communities at the UN Headquarters to amplify voices in global water dialogues.',
                'categories' => ['water-sanitation', 'news'],
            ],
            [
                'title' => 'KWDT Champions a #PeriodFriendlyWorld Through Community Driven Menstrual Health Solutions',
                'slug' => 'kwdt-champions-a-periodfriendlyworld-through-community-driven-menstrual-health-solutions',
                'published_at' => '2025-05-28',
                'excerpt' => 'KWDT takes the lead in promoting menstrual health through community-driven solutions.',
                'categories' => ['menstrual-health', 'women-empowerment'],
            ],
            [
                'title' => 'Safe Water for Katuba Landing Site, Buikwe!',
                'slug' => 'safe-water-for-katuba-landing-site-buikwe',
                'published_at' => '2025-05-07',
                'excerpt' => 'KWDT brings safe water access to Katuba Landing Site, improving lives in Buikwe district.',
                'categories' => ['water-sanitation'],
            ],
            [
                'title' => 'Uganda\'s National Plan of Action for Small-Scale Fisheries',
                'slug' => 'ugandas-national-plan-of-action-for-small-scale-fisheries-a-milestone-in-sustainable-fisheries-management',
                'published_at' => '2025-03-17',
                'excerpt' => 'A milestone in sustainable fisheries management for Uganda\'s small-scale fishing communities.',
                'categories' => ['fisheries', 'news'],
            ],
            [
                'title' => 'Navigating Sustainable Fisheries: A Call for Balanced Co-existence in Uganda\'s Water Bodies',
                'slug' => 'navigating-sustainable-fisheries-a-call-for-balanced-co-existence-in-ugandas-water-bodies',
                'published_at' => '2024-09-30',
                'excerpt' => 'KWDT calls for balanced co-existence in sustainable fisheries management in Uganda.',
                'categories' => ['fisheries'],
            ],
            [
                'title' => 'Closure of the GIZ Responsible Fisheries Business Chain Project',
                'slug' => 'closure-of-the-giz-responsible-fisheries-business-chain-project',
                'published_at' => '2024-09-27',
                'excerpt' => 'Updates on the closure of the GIZ Responsible Fisheries Business Chain Project.',
                'categories' => ['fisheries', 'news'],
            ],
            [
                'title' => 'Ms. Margaret Nakato Scoops the Margarita Lizárraga Medal 2020-2021',
                'slug' => 'ms-margaret-nakato-scoops-the-margarita-lizrraga-medal-2020-2021',
                'published_at' => '2023-10-27',
                'excerpt' => 'Margaret Nakato receives the prestigious Margarita Lizárraga Medal from FAO.',
                'categories' => ['news', 'women-empowerment'],
            ],
            [
                'title' => 'Resilience and Risks: Insights from Uganda\'s Fishing Communities',
                'slug' => 'community-managed-disaster-risk-reduction',
                'published_at' => '2023-09-18',
                'excerpt' => 'Exploring disaster risk reduction in Uganda\'s fishing communities.',
                'categories' => ['fisheries'],
            ],
            [
                'title' => 'Unleashing the Potential of Aquatic Food Systems',
                'slug' => 'unleashing-the-potential-of-aquatic-food-systems-a-path-to-sustainable-and-equitable-food-security',
                'published_at' => '2023-09-07',
                'excerpt' => 'How aquatic food systems can provide sustainable and equitable food security.',
                'categories' => ['fisheries', 'news'],
            ],
            [
                'title' => 'Empowering Resilience: The Inspirational Journey of Nakalyango Prossy',
                'slug' => 'empowering-resilience-the-inspirational-journey-of-nakalyango-prossy',
                'published_at' => '2023-08-14',
                'excerpt' => 'The inspirational story of how Nakalyango Prossy is empowered through KWDT.',
                'categories' => ['women-empowerment'],
            ],
            [
                'title' => 'The 2023 UN Water Conference: A Turning Point for Global Water Security',
                'slug' => 'pph44q25nespju1m8ygbv7j0knutf4',
                'published_at' => '2023-04-03',
                'excerpt' => 'The 2023 UN Water Conference marks a turning point for global water security.',
                'categories' => ['water-sanitation', 'news'],
            ],
            [
                'title' => 'International Day of Rural Women 2022',
                'slug' => 'blog-post-title-three-3kwny',
                'published_at' => '2022-10-21',
                'excerpt' => 'KWDT celebrates the International Day of Rural Women in 2022.',
                'categories' => ['women-empowerment', 'events'],
            ],
            [
                'title' => 'Katosi Women Development Trust Celebrates IYAFA 2022',
                'slug' => 'katosi-women-development-trust-celebrates-iyafa-2022',
                'published_at' => '2022-10-10',
                'excerpt' => 'KWDT celebrates the International Year of Artisanal Fisheries and Aquaculture 2022.',
                'categories' => ['fisheries', 'events'],
            ],
            [
                'title' => 'Training Women Cooperatives In Soap & Candle Making',
                'slug' => 'blog-post-title-one-lj54t',
                'published_at' => '2019-03-11',
                'excerpt' => 'KWDT trains women cooperatives in soap and candle making for economic empowerment.',
                'categories' => ['women-empowerment'],
            ],
            [
                'title' => 'The Seeds of a Mother',
                'slug' => 'blog-post-title-two-fh7sc',
                'published_at' => '2019-03-11',
                'excerpt' => 'A touching story about the impact of KWDT\'s programs on mothers and their families.',
                'categories' => ['women-empowerment', 'news'],
            ],
            [
                'title' => 'Building Local Small-Scale Fisher Capacities To Secure Sustainable Fisheries',
                'slug' => 'blog-post-title-four-ljepr',
                'published_at' => '2019-03-11',
                'excerpt' => 'KWDT builds capacities of local small-scale fishers for sustainable fisheries management.',
                'categories' => ['fisheries', 'women-empowerment'],
            ],
        ];

        foreach ($blogPosts as $post) {
            $categories = $post['categories'];
            unset($post['categories']);

            $content = Content::create([
                'title' => $post['title'],
                'slug' => $post['slug'],
                'type' => 'blog',
                'status' => 'published',
                'excerpt' => $post['excerpt'],
                'body' => $post['excerpt'], // Placeholder - can be updated later
                'author_id' => $user->id,
                'published_at' => $post['published_at'],
            ]);

            // Attach categories
            $categoryIds = Category::whereIn('slug', $categories)->pluck('id');
            $content->categories()->attach($categoryIds);
        }
    }
}

