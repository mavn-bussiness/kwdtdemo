<x-layouts.app
    title="Awards & Recognition"
    metaDescription="Honours and recognition received by Katosi Women Development Trust for our work in communities.">

    {{-- ── Page Hero ─────────────────────────────────────────── --}}
    <div class="page-hero page-hero--short">
        <div class="page-hero-content">
            <span class="section-label" style="color:var(--orange-light)">About KWDT</span>
            <h1 class="page-title">Awards &amp; Recognition</h1>
            <p class="page-intro">
                Over the decades, our work has been recognised by governments, international
                bodies and civil-society organisations across the globe.
            </p>
        </div>
    </div>

    {{-- ── Intro stat band ──────────────────────────────────── --}}
    <div class="awards-band">
        <div class="awards-band-inner">
            <div class="awards-band-stat">
                <span class="awards-band-num">{{ $awards->count() }}</span>
                <span class="awards-band-label">Awards &amp; Honours</span>
            </div>
            <div class="awards-band-divider"></div>
            @php
                $earliest = $awards->min('year');
                $latest   = $awards->max('year');
            @endphp
            <div class="awards-band-stat">
                <span class="awards-band-num">{{ $earliest }}–{{ $latest }}</span>
                <span class="awards-band-label">Years of Recognition</span>
            </div>
            <div class="awards-band-divider"></div>
            <p class="awards-band-quote">
                "Recognition earned through decades of community-led transformation."
            </p>
        </div>
    </div>

    {{-- ── Awards Grid ───────────────────────────────────────── --}}
    <section class="section awards-section">

        @if($awards->isEmpty())
            <div class="awards-empty">
                <svg width="48" height="48" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.562.562 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.562.562 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/>
                </svg>
                <p>No awards listed yet. Check back soon.</p>
            </div>
        @else

            {{-- Group by year, most recent first --}}
            @php $grouped = $awards->groupBy('year')->sortKeysDesc(); @endphp

            @foreach($grouped as $year => $yearAwards)
                <div class="awards-year-group reveal">

                    <div class="awards-year-marker">
                        <span class="awards-year-tag">{{ $year }}</span>
                        <div class="awards-year-line"></div>
                        <span class="awards-year-count">
                            {{ $yearAwards->count() }}
                            {{ Str::plural('award', $yearAwards->count()) }}
                        </span>
                    </div>

                    <div class="awards-grid">
                        @foreach($yearAwards as $award)
                            <article class="award-card">

                                <div class="award-card-visual">
                                    @if($award->image_url)
                                        <img src="{{ $award->image_url }}"
                                             alt="{{ $award->title }}"
                                             loading="lazy">
                                    @else
                                        <div class="award-card-placeholder">
                                            <svg width="40" height="40" fill="none" stroke="currentColor"
                                                 viewBox="0 0 24 24" stroke-width="1.2" style="opacity:.35">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.562.562 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.562.562 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/>
                                            </svg>
                                        </div>
                                    @endif
                                    <span class="award-card-year-badge">{{ $award->year }}</span>
                                </div>

                                <div class="award-card-body">
                                    @if($award->awarding_organization)
                                        <span class="award-card-org">{{ $award->awarding_organization }}</span>
                                    @endif
                                    <h3 class="award-card-title">{{ $award->title }}</h3>
                                    @if($award->description)
                                        <p class="award-card-desc">{{ $award->description }}</p>
                                    @endif
                                </div>

                            </article>
                        @endforeach
                    </div>

                </div>
            @endforeach

        @endif
    </section>

    {{-- ── Bottom CTA ───────────────────────────────────────── --}}
    <div class="about-bottom-cta">
        <div class="about-bottom-cta-inner reveal">
            <h2>Want to partner with us?</h2>
            <p>
                These recognitions are a testament to what community-led action can achieve.
                Join us in continuing this work.
            </p>
            <div class="about-cta-btns">
                <a href="{{ route('donate') }}" class="btn-primary">
                    Support Our Work
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
                <a href="{{ route('contact') }}" class="btn-outline">Get in Touch</a>
            </div>
        </div>
    </div>

    <script>
        (function () {
            const obs = new IntersectionObserver(
                entries => entries.forEach(e => {
                    if (e.isIntersecting) { e.target.classList.add('visible'); obs.unobserve(e.target); }
                }),
                { threshold: 0.1 }
            );
            document.querySelectorAll('.reveal').forEach(el => obs.observe(el));
        })();
    </script>

</x-layouts.app>
