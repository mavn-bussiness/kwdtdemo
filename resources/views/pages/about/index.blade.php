<x-layouts.app
    title="Who We Are"
    metaDescription="Since 1995, KWDT has empowered women in Uganda's rural and fishing communities across Mukono, Kalangala and Buvuma.">

    {{-- ── Hero (matches other pages) ───────────────────────── --}}
    <div class="page-hero page-hero--short">
        <div class="page-hero-content">
            <span class="section-label" style="color:var(--orange-light)">About KWDT</span>
            <h1 class="page-title">Who We Are</h1>
            <p class="page-intro">
                Since 1995, empowering women and female youth in Uganda's
                fishing communities to shape their own futures.
            </p>
        </div>
    </div>

    {{-- ── History ─────────────────────────────────────────── --}}
    <section class="section about-split" id="history">
        <div class="about-split-inner">

            {{-- Left: image + timeline --}}
            <div class="about-split-left reveal">
                <div class="about-img-stack">
                    <img class="about-img-main"
                         src="/images/static/arche-uganda-194.jpg"
                         alt="KWDT community members at Lake Victoria">
                    <img class="about-img-float"
                         src="/images/static/2023-kwdt-coordinator-receives-evolving-women.jpeg"
                         alt="KWDT Coordinator receives award">
                </div>

                <div class="about-timeline">
                    @foreach([
                        ['1996', 'Founded at Katosi Landing Site as Katosi Women Fishing Group with 26 women'],
                        ['2000', 'Fishing ban prompted diversification; renamed Katosi Women Fishing & Development Association'],
                        ['2004', 'Community growth led to formation of Katosi Women Development Trust (KWDT)'],
                        ['2012', 'Received 3rd Kyoto World Water Grand Prize & Rio+20 Best Practice Award'],
                        ['2019', 'Represented Uganda at UN Water Conference'],
                        ['2025', '1,235 women across 52 community groups in 3 districts'],
                    ] as [$yr, $ev])
                        <div class="timeline-item">
                            <span class="timeline-year">{{ $yr }}</span>
                            <div class="timeline-dot"></div>
                            <p class="timeline-text">{{ $ev }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Right: prose + mission/vision --}}
            <div class="about-split-right reveal">
                <span class="section-label">Our Story</span>
                <h2 class="section-title" style="margin-bottom:1.5rem">
                    Born from the <em>shores of Lake Victoria</em>
                </h2>

                <div class="about-prose">
                    @if($history)
                        {!! nl2br(e($history)) !!}
                    @else
                        <p>
                            <strong>Katosi Women Development Trust (KWDT)</strong> was established in 1995 at
                            Katosi Landing Site on the shores of Lake Victoria. We are a registered non-profit
                            improving living standards of poor and rural fisher communities in Uganda by
                            empowering them to engage in their own social, economic and political development.
                        </p>
                        <p>
                            Our programmes reach across Mukono, Kalangala and Buvuma Districts, working directly
                            through 52 organised women's groups. We support women whose livelihoods are derived
                            from agriculture, fisheries and micro-businesses.
                        </p>
                    @endif
                </div>

                <div class="mv-cards">
                    <div class="mv-card mv-card--vision">
                        <div class="mv-card-label">Vision</div>
                        <p>"Empowered women and youth with healthy and productive livelihoods in a sustainable environment"</p>
                    </div>
                    <div class="mv-card mv-card--mission">
                        <div class="mv-card-label">Mission</div>
                        <p>"Enabling women and female youth in rural communities to effectively engage in their social, economic and political development"</p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- ── Values strip ────────────────────────────────────── --}}
    <div class="values-strip">
        @foreach([
            ['🌊', 'Community-Led',  'Every intervention is designed with and by the communities we serve.'],
            ['⚖️', 'Gender Justice', 'We challenge the norms that hold women and girls back.'],
            ['🌱', 'Sustainable',    'Building resilience that outlasts any single programme.'],
            ['🤝', 'Accountable',    'Transparent in our finances, our methods and our results.'],
        ] as [$icon, $title, $body])
            <div class="value-item reveal">
                <span class="value-icon" aria-hidden="true">{{ $icon }}</span>
                <h4 class="value-title">{{ $title }}</h4>
                <p class="value-body">{{ $body }}</p>
            </div>
        @endforeach
    </div>

    {{-- ── Impact numbers ───────────────────────────────────── --}}
    <div class="impact-diagonal">
        <div class="impact-diagonal-inner">
            @foreach([
                ['1,235', 'Women Directly Supported'],
                ['52',    'Community Groups'],
                ['30+',   'Years Active'],
                ['4',     'Thematic Areas'],
            ] as [$num, $label])
                <div class="impact-diagonal-item reveal">
                    <span class="impact-diagonal-num">{{ $num }}</span>
                    <span class="impact-diagonal-label">{{ $label }}</span>
                </div>
            @endforeach
        </div>
    </div>

    {{-- ── Team ─────────────────────────────────────────────── --}}
    @if($members->isNotEmpty())
    <section class="team-section" id="team">
        <div class="team-inner">
            <div class="section-header" style="margin-bottom:3.5rem">
                <span class="section-label reveal">The People</span>
                <h2 class="section-title reveal">Meet the Team</h2>
                <p class="section-intro reveal">
                    Dedicated professionals and community leaders working every day to realise KWDT's vision.
                </p>
            </div>
            <div class="team-grid">
                @foreach($members as $member)
                    <div class="team-card reveal">
                        <div class="team-card-img">
                            @if($member->photo_url)
                                <img src="{{ $member->photo_url }}" alt="{{ $member->name }}" loading="lazy">
                            @else
                                <div class="team-initials">
                                    {{ collect(explode(' ', $member->name))->map(fn($w) => strtoupper($w[0]))->take(2)->join('') }}
                                </div>
                            @endif
                            <div class="team-card-overlay">
                                @if($member->bio)
                                    <p class="team-card-bio">{{ Str::limit($member->bio, 140) }}</p>
                                @endif
                                @if($member->email)
                                    <a href="mailto:{{ $member->email }}" class="team-card-email">
                                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                        Email
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="team-card-info">
                            <h3>{{ $member->name }}</h3>
                            @if($member->title) <p class="team-card-title">{{ $member->title }}</p> @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ── Partners ─────────────────────────────────────────── --}}
    <section class="partners-full-section" id="partners">
        <div class="partners-full-inner">
            <div class="section-header" style="margin-bottom:3rem">
                <span class="section-label reveal">Collaboration</span>
                <h2 class="section-title reveal">Our Partners &amp; Funders</h2>
                <p class="section-intro reveal">
                    KWDT's work is made possible through a network of dedicated institutional and individual partners.
                </p>
            </div>
            <div class="partners-card-grid">
                @if($partners->isNotEmpty())
                    @foreach($partners as $partner)
                        <div class="partner-card reveal">
                            @if($partner->logo_url)
                                <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}" loading="lazy">
                            @else
                                <span class="partner-name-text">{{ $partner->name }}</span>
                            @endif
                            @if($partner->website)
                                <a href="{{ $partner->website }}" target="_blank" rel="noopener"
                                   class="partner-card-link" aria-label="Visit {{ $partner->name }}">
                                    <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6m0 0v6m0-6L10 14"/>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    @endforeach
                @else
                    @foreach(['GIZ', 'ARCHE NOVA', 'FIAN Uganda', 'Fokus Frauen', 'EU Delegation', 'FAO', 'NGO Bureau Uganda', 'UN Women'] as $p)
                        <div class="partner-card reveal">
                            <span class="partner-name-text">{{ $p }}</span>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    {{-- ── Bottom CTA ───────────────────────────────────────── --}}
    <div class="about-bottom-cta">
        <div class="about-bottom-cta-inner reveal">
            <h2>Want to see our programmes in action?</h2>
            <p>Explore our thematic areas and the projects running right now across Uganda's fishing communities.</p>
            <div class="about-cta-btns">
                <a href="{{ route('about.what-we-do') }}" class="btn-primary">What We Do</a>
                <a href="{{ route('projects.index') }}" class="btn-outline">Current Projects</a>
            </div>
        </div>
    </div>

    {{-- ── Page styles ───────────────────────────────────────── --}}
    <style>
        /* Two-column history split */
        .about-split { padding-top: 5rem; padding-bottom: 5rem; }
        .about-split-inner {
            display: grid; grid-template-columns: 1fr 1fr;
            gap: 5rem; align-items: start;
        }

        /* Stacked images */
        .about-img-stack {
            position: relative; height: 340px; margin-bottom: 2.5rem;
        }
        .about-img-main {
            position: absolute; top: 0; left: 0;
            width: 78%; height: 100%;
            object-fit: cover; border-radius: var(--r-xl);
            box-shadow: 0 20px 56px rgba(43,26,14,.22);
        }
        .about-img-float {
            position: absolute; bottom: -24px; right: 0;
            width: 50%; height: 55%;
            object-fit: cover; border-radius: var(--r-lg);
            border: 4px solid var(--white);
            box-shadow: 0 12px 36px rgba(43,26,14,.2);
        }

        @media (max-width: 900px) {
            .about-split-inner { grid-template-columns: 1fr; gap: 3rem; }
            .about-img-stack { height: 260px; }
        }
        @media (max-width: 600px) {
            .about-img-float { display: none; }
            .about-img-main { width: 100%; }
        }
    </style>

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