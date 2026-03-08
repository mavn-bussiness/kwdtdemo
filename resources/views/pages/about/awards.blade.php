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

    {{-- ── Page-scoped styles ────────────────────────────────── --}}
    @push('styles')
        <style>
            .awards-band {
                background: var(--earth);
                border-bottom: 3px solid var(--orange);
            }
            .awards-band-inner {
                max-width: 1280px; margin: 0 auto;
                padding: 2.5rem var(--space-md);
                display: flex; align-items: center;
                gap: 3rem; flex-wrap: wrap;
            }
            .awards-band-stat { display: flex; flex-direction: column; gap: .15rem; }
            .awards-band-num {
                font-family: var(--font-display); font-size: 2.4rem; font-weight: 900;
                color: var(--orange-light); line-height: 1;
            }
            .awards-band-label {
                font-size: .7rem; text-transform: uppercase; letter-spacing: .14em;
                color: rgba(255,255,255,.45); font-family: var(--font-mono);
            }
            .awards-band-divider {
                width: 1px; height: 56px;
                background: rgba(255,255,255,.12); flex-shrink: 0;
            }
            .awards-band-quote {
                font-family: var(--font-display); font-style: italic;
                font-size: 1rem; color: rgba(255,255,255,.55);
                max-width: 38ch; line-height: 1.65; flex: 1;
            }
            .awards-section { padding-top: 5rem; padding-bottom: 5rem; }
            .awards-year-group { margin-bottom: 4rem; }
            .awards-year-marker {
                display: flex; align-items: center; gap: 1.25rem;
                margin-bottom: 1.75rem;
            }
            .awards-year-tag {
                font-family: var(--font-display); font-size: 1.5rem; font-weight: 900;
                color: var(--orange); white-space: nowrap; flex-shrink: 0;
            }
            .awards-year-line {
                flex: 1; height: 1px;
                background: linear-gradient(to right, var(--cream-dark), transparent);
            }
            .awards-year-count {
                font-family: var(--font-mono); font-size: .68rem;
                letter-spacing: .12em; text-transform: uppercase;
                color: var(--earth-muted); white-space: nowrap; flex-shrink: 0;
            }
            .awards-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
                gap: 1.25rem;
            }
            .award-card {
                position: relative;
                background: var(--white);
                border: 1px solid var(--cream-dark);
                border-radius: var(--r-lg);
                overflow: hidden;
                display: flex; flex-direction: column;
                transition: transform .35s var(--ease), box-shadow .35s;
            }
            .award-card:hover {
                transform: translateY(-6px);
                box-shadow: 0 20px 56px rgba(43,26,14,.12);
            }
            .award-card::before {
                content: '';
                position: absolute; top: 0; left: 0; right: 0; height: 3px;
                background: var(--orange);
                transform: scaleX(0);
                transition: transform .35s var(--ease);
                z-index: 2;
            }
            .award-card:hover::before { transform: scaleX(1); }
            .award-card-visual {
                position: relative; height: 200px; overflow: hidden;
                background: var(--cream-mid); flex-shrink: 0;
            }
            .award-card-visual img {
                width: 100%; height: 100%; object-fit: cover;
                transition: transform .6s var(--ease);
            }
            .award-card:hover .award-card-visual img { transform: scale(1.07); }
            .award-card-placeholder {
                width: 100%; height: 100%;
                display: flex; align-items: center; justify-content: center;
                background: linear-gradient(135deg, var(--cream-mid) 0%, var(--cream-dark) 100%);
                color: var(--earth-muted);
            }
            .award-card-year-badge {
                position: absolute; top: .85rem; left: .85rem;
                background: var(--orange); color: var(--white);
                font-family: var(--font-mono); font-size: .65rem; font-weight: 500;
                letter-spacing: .1em; padding: .3rem .75rem;
                border-radius: var(--r-pill);
            }
            .award-card-body { padding: 1.4rem 1.5rem 1.6rem; flex: 1; }
            .award-card-org {
                display: inline-block;
                font-family: var(--font-mono); font-size: .65rem;
                letter-spacing: .14em; text-transform: uppercase;
                color: var(--orange); margin-bottom: .5rem;
            }
            .award-card-title {
                font-family: var(--font-display); font-size: 1rem; font-weight: 700;
                color: var(--earth); line-height: 1.35; margin-bottom: .5rem;
                transition: color .2s;
            }
            .award-card:hover .award-card-title { color: var(--orange); }
            .award-card-desc {
                font-size: .865rem; color: var(--earth-muted);
                line-height: 1.65; margin-top: .4rem;
            }
            .awards-empty {
                text-align: center; padding: 5rem 1rem;
                color: var(--earth-muted);
                display: flex; flex-direction: column;
                align-items: center; gap: 1rem;
            }
            @media (max-width: 700px) {
                .awards-band-divider { display: none; }
                .awards-grid { grid-template-columns: 1fr 1fr; }
                .awards-band-quote { display: none; }
            }
            @media (max-width: 480px) {
                .awards-grid { grid-template-columns: 1fr; }
            }
        </style>
    @endpush

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
