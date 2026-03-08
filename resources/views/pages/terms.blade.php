<x-layouts.app
    title="Terms of Service"
    metaDescription="Terms of use for the KWDT website.">

    <div class="page-hero page-hero--short">
        <div class="page-hero-content">
            <span class="section-label" style="color:var(--clay-light)">Legal</span>
            <h1 class="page-title">Terms of Service</h1>
        </div>
    </div>

    <section class="section prose">
        @php
            $text = \App\Models\Content::where('type', 'terms')->value('content')
                    ?? config('kwdt.terms')
                    ?? 'Terms of service not provided.';
        @endphp

        {!! $text !!}
    </section>

</x-layouts.app>