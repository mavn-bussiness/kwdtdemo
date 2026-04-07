<x-layouts.app
    title="Privacy Policy"
    metaDescription="KWDT privacy policy.">

    <div class="news-hero news-hero--slim">
        <div class="news-hero-bg">
            <img
                src="https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/82eada9f-8188-4ebd-bab8-3fdcf85ca5f8/ARCHE_UGANDA_194.jpg"
                alt="KWDT community"
                loading="eager">
        </div>
        <div class="news-hero-overlay"></div>
        <div class="news-hero-content">
            <span class="news-hero-label">Legal</span>
            <h1 class="news-hero-title">Privacy Policy</h1>
        </div>
    </div>

    <section class="section prose">
        @php
            $text = \App\Models\Content::where('type', 'privacy')->value('body')
                ?? config('kwdt.privacy')
                ?? 'Privacy policy is not available at this time.';
        @endphp

        {!! $text !!}
    </section>

</x-layouts.app>
