<x-layouts.app
    title="Privacy Policy"
    metaDescription="KWDT privacy policy.">

    <div class="page-hero page-hero--short">
        <div class="page-hero-content">
            <span class="section-label" style="color:var(--clay-light)">Legal</span>
            <h1 class="page-title">Privacy Policy</h1>
        </div>
    </div>

    <section class="section prose">
        @php
            $text = \App\Models\Content::where('type', 'privacy')->value('content')
                    ?? config('kwdt.privacy')
                    ?? 'Privacy policy is not available at this time.';
        @endphp

        {!! $text !!}
    </section>

</x-layouts.app>