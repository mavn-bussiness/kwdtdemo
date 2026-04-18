<x-layouts.app title="What We Do" metaDescription="KWDT works across four thematic areas — Economic Empowerment, WASH, Education, and Environment Conservation — to uplift women in Uganda's fishing communities.">

    {{-- ── Hero ──────────────────────────────────────────────── --}}
    <div class="page-hero page-hero--short">
        <div class="page-hero-content">
            <span class="section-label" style="color:var(--orange-light)">Our Programmes</span>
            <h1 class="page-title">What We Do</h1>
            <p class="page-intro">
                Four thematic areas. One mission: empowering women and youth
                in Uganda's fishing communities to shape their own futures.
            </p>
        </div>
    </div>

    {{-- ── Intro band ────────────────────────────────────────── --}}
    <div class="wwd-intro-band">
        <div class="wwd-intro-inner">
            <p>
                KWDT's programmes are built around the realities of rural fisher communities.
                Each thematic area is designed to address the root causes of poverty and inequality —
                with <strong>health, gender, youth and disability mainstreamed</strong> across all of them.
            </p>
            <div class="wwd-intro-stats">
                @foreach([['4','Thematic Areas'],['5','Cross-cutting Themes'],['3','Districts'],['30+','Years Active']] as [$n,$l])
                    <div class="wwd-intro-stat">
                        <span class="wwd-intro-stat-num">{{ $n }}</span>
                        <span class="wwd-intro-stat-label">{{ $l }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ── Thematic areas ─────────────────────────────────────── --}}
    @php
        $icons = [
            'economic-empowerment' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>',
            'water-sanitation-hygiene-wash' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2.69l5.66 5.66a8 8 0 11-11.31 0z"/></svg>',
            'education-and-knowledge-empowerment' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>',
            'environment-conservation' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17 8C8 10 5.9 16.17 3.82 19.5c1.1-1.65 3.18-3 6.18-3 3 0 5-1.5 5-4 0-1.5-.5-3-2-4z"/><path d="M3 21c0-4 2-8 6-10"/></svg>',
            'hiv-gender-disability-and-health' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>',
        ];
        $images = [
            'economic-empowerment' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/0a689bfb-2ee0-4451-ae42-f9fc54f37d71/ARCHE_UGANDA_196.jpg',
            'water-sanitation-hygiene-wash' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/f1a11664-9d66-411b-9d02-1f3158773ad9/DSC08536.JPG',
            'education-and-knowledge-empowerment' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/80995547-893f-431c-ab16-455253aee6c6/ARCHE_UGANDA_195.jpg',
            'environment-conservation' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/3ef1650d-ef5e-4b49-bc13-1b771013aa68/DSC03764.JPG',
            'hiv-gender-disability-and-health' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/c8973b94-5f49-4092-974c-26e2359d0baa/ARCHE_UGANDA_218.jpg',
        ];
        $fallbackIcon = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>';
        $fallbackImg  = 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/82eada9f-8188-4ebd-bab8-3fdcf85ca5f8/ARCHE_UGANDA_194.jpg';
    @endphp

    <section class="wwd-areas-section">
        <div class="wwd-areas-inner">

            <div class="section-header" style="margin-bottom:3.5rem">
                <span class="section-label reveal">Thematic Areas</span>
                <h2 class="section-title reveal">Four Pillars of Impact</h2>
                <p class="section-intro reveal">
                    Each programme area targets a specific barrier that holds women back —
                    together they create lasting, generational change.
                </p>
            </div>

            @forelse($areas as $i => $area)
                @php
                    $icon  = $icons[$area->slug]  ?? $fallbackIcon;
                    $img   = $images[$area->slug] ?? $fallbackImg;
                    $flip  = $i % 2 !== 0;
                @endphp

                <div class="wwd-area-row reveal {{ $flip ? 'wwd-area-row--flip' : '' }}">

                    {{-- Image panel --}}
                    <div class="wwd-area-img">
                        <img src="{{ $img }}" alt="{{ $area->name }}" loading="lazy">
                        <div class="wwd-area-num">0{{ $i + 1 }}</div>
                    </div>

                    {{-- Content panel --}}
                    <div class="wwd-area-body">
                        <div class="wwd-area-icon">{!! $icon !!}</div>
                        <h3 class="wwd-area-title">{{ $area->name }}</h3>
                        <p class="wwd-area-desc">{{ $area->description }}</p>
                        <a href="{{ route('projects.index') }}" class="wwd-area-link">
                            See related projects
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>

                </div>
            @empty
                <p style="text-align:center;color:var(--earth-muted);padding:4rem 0">No thematic areas found.</p>
            @endforelse

        </div>
    </section>

    {{-- ── Cross-cutting themes band ───────────────────────────── --}}
    <div class="wwd-cross-band">
        <div class="wwd-cross-inner">
            <div class="wwd-cross-text">
                <span class="section-label" style="color:rgba(255,255,255,.7)">Mainstreamed Across All Programmes</span>
                <h2 class="section-title" style="color:#fff;margin-top:.5rem">Cross-Cutting Themes</h2>
                <p style="color:rgba(255,255,255,.8);line-height:1.8;max-width:48ch;margin-top:.75rem">
                    These themes are not standalone programmes — they are woven into every activity
                    KWDT undertakes, ensuring no one is left behind.
                </p>
            </div>
            <div class="wwd-cross-pills">
                @foreach([
                    ['🏥', 'Health & HIV'],
                    ['⚖️', 'Gender Equality'],
                    ['♿', 'Disability Inclusion'],
                    ['👧', 'Youth Empowerment'],
                    ['🌍', 'Climate Resilience'],
                ] as [$emoji, $label])
                    <div class="wwd-cross-pill reveal">
                        <span class="wwd-cross-pill-icon" aria-hidden="true">{{ $emoji }}</span>
                        <span>{{ $label }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ── Approach section ────────────────────────────────────── --}}
    <section class="wwd-approach-section">
        <div class="wwd-approach-inner">
            <div class="section-header" style="margin-bottom:3rem">
                <span class="section-label reveal">How We Work</span>
                <h2 class="section-title reveal">Our Approach</h2>
            </div>
            <div class="wwd-approach-grid">
                @foreach([
                    ['Community-Led','Every intervention is co-designed with the communities we serve. Women are not beneficiaries — they are agents of change.'],
                    ['Rights-Based','We ground our work in human rights frameworks, ensuring women know and can claim their legal and social entitlements.'],
                    ['Evidence-Driven','Monitoring, evaluation and learning are built into every programme so we can adapt and improve continuously.'],
                    ['Collaborative','We work alongside government, NGOs, and international partners to amplify impact and avoid duplication.'],
                ] as [$title, $body])
                    <div class="wwd-approach-card reveal">
                        <div class="wwd-approach-card-accent"></div>
                        <h4 class="wwd-approach-card-title">{{ $title }}</h4>
                        <p class="wwd-approach-card-body">{{ $body }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── CTA ─────────────────────────────────────────────────── --}}
    <div class="about-bottom-cta">
        <div class="about-bottom-cta-inner reveal">
            <h2>See Our Programmes in Action</h2>
            <p>Browse the projects currently running across Mukono, Kalangala and Buvuma districts.</p>
            <div class="about-cta-btns">
                <a href="{{ route('projects.index') }}" class="btn-primary">View Projects</a>
                <a href="{{ route('about.index') }}" class="btn-outline">About KWDT</a>
            </div>
        </div>
    </div>

    <style>
        /* ── Intro band ─────────────────────────────────────────── */
        .wwd-intro-band {
            background: var(--cream-mid);
            border-bottom: 1px solid var(--cream-dark);
            padding: 3rem var(--space-md);
        }
        .wwd-intro-inner {
            max-width: 1280px; margin: 0 auto;
            display: flex; align-items: center;
            justify-content: space-between; gap: 3rem; flex-wrap: wrap;
        }
        .wwd-intro-inner > p {
            font-size: 1.05rem; color: var(--earth-mid);
            line-height: 1.8; max-width: 52ch; flex: 1;
        }
        .wwd-intro-inner strong { color: var(--orange); font-weight: 700; }
        .wwd-intro-stats {
            display: flex; gap: 2.5rem; flex-shrink: 0; flex-wrap: wrap;
        }
        .wwd-intro-stat { display: flex; flex-direction: column; align-items: center; }
        .wwd-intro-stat-num {
            font-family: var(--font-display); font-size: 2.2rem;
            font-weight: 900; color: var(--orange); line-height: 1;
        }
        .wwd-intro-stat-label {
            font-family: var(--font-mono); font-size: .65rem;
            letter-spacing: .12em; text-transform: uppercase;
            color: var(--earth-muted); margin-top: .3rem; text-align: center;
        }

        /* ── Areas section ──────────────────────────────────────── */
        .wwd-areas-section { padding: var(--space-xl) var(--space-md); }
        .wwd-areas-inner { max-width: 1280px; margin: 0 auto; }

        .wwd-area-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: clamp(2rem, 5vw, 5rem);
            align-items: center;
            padding: clamp(2.5rem, 5vw, 4.5rem) 0;
            border-bottom: 1px solid var(--cream-dark);
        }
        .wwd-area-row:last-child { border-bottom: none; }
        .wwd-area-row--flip .wwd-area-img { order: 2; }
        .wwd-area-row--flip .wwd-area-body { order: 1; }

        .wwd-area-img {
            position: relative;
            border-radius: var(--r-xl);
            overflow: hidden;
            aspect-ratio: 4 / 3;
        }
        .wwd-area-img img {
            width: 100%; height: 100%; object-fit: cover;
            transition: transform .7s var(--ease);
            display: block;
        }
        .wwd-area-row:hover .wwd-area-img img { transform: scale(1.04); }
        .wwd-area-num {
            position: absolute; bottom: 1.25rem; right: 1.25rem;
            font-family: var(--font-display); font-size: 4rem; font-weight: 900;
            color: rgba(255,255,255,.18); line-height: 1; pointer-events: none;
            user-select: none;
        }

        .wwd-area-icon {
            width: 52px; height: 52px;
            background: var(--orange-pale);
            border-radius: var(--r-md);
            display: flex; align-items: center; justify-content: center;
            color: var(--orange);
            margin-bottom: 1.25rem;
        }
        .wwd-area-icon svg { width: 26px; height: 26px; }

        .wwd-area-title {
            font-family: var(--font-display);
            font-size: clamp(1.3rem, 2.5vw, 1.75rem);
            font-weight: 800; color: var(--earth);
            line-height: 1.2; margin-bottom: 1rem;
        }
        .wwd-area-desc {
            font-size: .97rem; color: var(--earth-mid);
            line-height: 1.85; margin-bottom: 1.75rem;
        }
        .wwd-area-link {
            display: inline-flex; align-items: center; gap: .45rem;
            font-size: .88rem; font-weight: 700;
            color: var(--white) !important;
            background: var(--orange);
            border-radius: var(--r-pill);
            padding: .6rem 1.4rem;
            text-decoration: none !important;
            transition: background .2s, transform .18s;
        }
        .wwd-area-link:hover { background: var(--orange-dark); transform: translateY(-1px); }
        .wwd-area-link svg { transition: transform .2s; }
        .wwd-area-link:hover svg { transform: translateX(3px); }

        /* ── Cross-cutting band ─────────────────────────────────── */
        .wwd-cross-band {
            background: var(--orange);
            padding: clamp(3rem, 6vw, 5rem) var(--space-md);
            position: relative; overflow: hidden;
        }
        .wwd-cross-band::before {
            content: ''; position: absolute; top: -80px; right: -80px;
            width: 360px; height: 360px; border-radius: 50%;
            background: rgba(255,255,255,.07); pointer-events: none;
        }
        .wwd-cross-inner {
            max-width: 1280px; margin: 0 auto;
            display: grid; grid-template-columns: 1fr 1fr;
            gap: 4rem; align-items: center; position: relative; z-index: 1;
        }
        .wwd-cross-pills {
            display: flex; flex-direction: column; gap: 1rem;
        }
        .wwd-cross-pill {
            display: flex; align-items: center; gap: 1rem;
            background: rgba(255,255,255,.12);
            border: 1px solid rgba(255,255,255,.2);
            border-radius: var(--r-md);
            padding: 1rem 1.4rem;
            font-family: var(--font-display);
            font-size: 1rem; font-weight: 700;
            color: var(--white);
            transition: background .2s;
        }
        .wwd-cross-pill:hover { background: rgba(255,255,255,.2); }
        .wwd-cross-pill-icon { font-size: 1.4rem; flex-shrink: 0; }

        /* ── Approach section ───────────────────────────────────── */
        .wwd-approach-section {
            padding: var(--space-xl) var(--space-md);
            background: var(--cream-mid);
            border-top: 1px solid var(--cream-dark);
        }
        .wwd-approach-inner { max-width: 1280px; margin: 0 auto; }
        .wwd-approach-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
        }
        .wwd-approach-card {
            background: var(--white);
            border: 1px solid var(--cream-dark);
            border-radius: var(--r-md);
            padding: 2rem 1.75rem;
            position: relative;
            overflow: hidden;
            transition: transform .3s var(--ease), box-shadow .3s;
        }
        .wwd-approach-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 48px rgba(245,130,10,.1);
        }
        .wwd-approach-card-accent {
            position: absolute; top: 0; left: 0; right: 0; height: 3px;
            background: var(--orange);
            transform: scaleX(0); transform-origin: left;
            transition: transform .35s var(--ease);
        }
        .wwd-approach-card:hover .wwd-approach-card-accent { transform: scaleX(1); }
        .wwd-approach-card-title {
            font-family: var(--font-display);
            font-size: 1.1rem; font-weight: 800;
            color: var(--earth); margin-bottom: .75rem;
        }
        .wwd-approach-card-body {
            font-size: .9rem; color: var(--earth-muted); line-height: 1.75;
        }

        /* ── Responsive ─────────────────────────────────────────── */
        @media (max-width: 1024px) {
            .wwd-approach-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 900px) {
            .wwd-area-row { grid-template-columns: 1fr; gap: 2rem; }
            .wwd-area-row--flip .wwd-area-img { order: 0; }
            .wwd-area-row--flip .wwd-area-body { order: 0; }
            .wwd-cross-inner { grid-template-columns: 1fr; gap: 2.5rem; }
            .wwd-intro-inner { flex-direction: column; }
        }
        @media (max-width: 600px) {
            .wwd-approach-grid { grid-template-columns: 1fr; }
            .wwd-intro-stats { gap: 1.5rem; }
        }
    </style>

    <script>
        (function () {
            const obs = new IntersectionObserver(
                entries => entries.forEach(e => {
                    if (e.isIntersecting) { e.target.classList.add('visible'); obs.unobserve(e.target); }
                }),
                { threshold: 0.08 }
            );
            document.querySelectorAll('.reveal').forEach(el => obs.observe(el));
        })();
    </script>

</x-layouts.app>
