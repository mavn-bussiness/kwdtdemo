<x-layouts.app title="Home" metaDescription="Empowering women and youth in Uganda's rural and fisher communities since 1995.">

    {{-- ══════════════════════════════════════════════════════════
         HERO — Dynamic content-driven slideshow
         Slides: 2 latest news articles + 1 featured project.
         Falls back to static photography when no CMS content exists yet.
    ══════════════════════════════════════════════════════════ --}}
    <section class="hero">

        {{-- ── Slideshow background ─────────────────────────────────── --}}
        <div class="hero-slideshow" id="heroSlideshow" aria-hidden="true">

            @if(isset($heroSlides) && count($heroSlides))

                {{-- Dynamic slides: one image per CMS item --}}
                @foreach($heroSlides as $i => $slide)
                    @php
                        $fallbacks = [
                            'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/82eada9f-8188-4ebd-bab8-3fdcf85ca5f8/ARCHE_UGANDA_194.jpg',
                            'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/0a689bfb-2ee0-4451-ae42-f9fc54f37d71/ARCHE_UGANDA_196.jpg',
                            'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/d764e888-bfec-47a8-b5a6-a1f0f288a166/DSC05383.JPG',
                        ];
                        $imgSrc = $slide['image'] ?? $fallbacks[$i % count($fallbacks)];
                    @endphp
                    <img class="hero-slide {{ $i === 0 ? 'active' : '' }}"
                         src="{{ $imgSrc }}"
                         alt="{{ $slide['title'] }}"
                        {{ $i === 0 ? 'loading=eager' : 'loading=lazy' }}>
                @endforeach

            @else

                {{-- Static fallback when DB is empty / seeding ──────── --}}
                @foreach([
                    ['src' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/82eada9f-8188-4ebd-bab8-3fdcf85ca5f8/ARCHE_UGANDA_194.jpg', 'alt' => 'KWDT women community'],
                    ['src' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/0a689bfb-2ee0-4451-ae42-f9fc54f37d71/ARCHE_UGANDA_196.jpg', 'alt' => 'Economic Empowerment'],
                    ['src' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/3ef1650d-ef5e-4b49-bc13-1b771013aa68/DSC03764.JPG',          'alt' => 'Community field work'],
                    ['src' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/d764e888-bfec-47a8-b5a6-a1f0f288a166/DSC05383.JPG',          'alt' => 'Clean water project'],
                    ['src' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/fc6e9483-6da8-4944-b548-91aef5bb9f99/ARCHE_UGANDA_204.jpg',  'alt' => 'Fisheries forum'],
                ] as $i => $slide)
                    <img class="hero-slide {{ $i === 0 ? 'active' : '' }}"
                         src="{{ $slide['src'] }}" alt="{{ $slide['alt'] }}"
                        {{ $i === 0 ? 'loading=eager' : 'loading=lazy' }}>
                @endforeach

            @endif
        </div>

        {{-- Dark gradient overlay --}}
        <div class="hero-overlay" aria-hidden="true"></div>

        {{-- Scroll indicator --}}
        <div class="hero-scroll-hint" aria-hidden="true">
            <div class="scroll-line"></div>
            <span>Scroll</span>
        </div>

        {{-- Slide dots --}}
        <div class="hero-slide-dots" id="heroSlideDots" aria-hidden="true"></div>

        {{-- ── Dynamic slide content panels — one per CMS item ──────── --}}
        {{--
            Each panel IS the hero content for that slide.
            JS toggles .is-active to crossfade between them.
            Static fallback panel shown when no CMS data exists.
        --}}
        <div class="hero-slides-content" id="heroSlidesContent">

            @if(isset($heroSlides) && count($heroSlides))

                @foreach($heroSlides as $i => $slide)
                    <div class="hero-content hero-content--slide {{ $i === 0 ? 'is-active' : '' }}"
                         data-slide-content="{{ $i }}">

                        {{-- Organisation tag + type badge ──────────────── --}}
                        <div class="hero-tag-row">
                            <span class="hero-tag">Katosi Women Development Trust</span>
                            <span class="hero-content-type hero-content-type--{{ $slide['type'] }}">
                                @if($slide['type'] === 'news')
                                    <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l6 6v8a2 2 0 01-2 2z"/><path stroke-linecap="round" stroke-linejoin="round" d="M17 20v-8H7v8M7 4v4h8"/></svg>
                                    Latest News
                                @elseif($slide['type'] === 'project')
                                    <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                    Featured Project
                                @elseif($slide['type'] === 'event')
                                    <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2" stroke-linecap="round"/><path stroke-linecap="round" stroke-linejoin="round" d="M16 2v4M8 2v4M3 10h18"/></svg>
                                    Upcoming Event
                                @endif
                            </span>
                        </div>

                        {{-- Main headline — the article/project title ───── --}}
                        <h1 class="hero-headline">
                            {{ Str::limit($slide['title'], 80) }}
                        </h1>

                        {{-- Meta line (date / location / status) ─────────── --}}
                        @if($slide['meta'])
                            <p class="hero-sub hero-sub--meta">{{ $slide['meta'] }}</p>
                        @endif

                        {{-- CTAs ─────────────────────────────────────────── --}}
                        <div class="hero-actions">
                            <a href="{{ $slide['url'] }}" class="btn-primary">
                                @if($slide['type'] === 'news') Read Article
                                @elseif($slide['type'] === 'project') View Project
                                @else Learn More
                                @endif
                                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </a>
                            <a href="{{ route('about.index') }}" class="btn-ghost">About KWDT</a>
                        </div>

                    </div>
                @endforeach

            @else

                {{-- Static fallback ──────────────────────────────────── --}}
                <div class="hero-content hero-content--slide is-active" data-slide-content="0">
                    <div class="hero-tag-row">
                        <span class="hero-tag">Katosi Women Development Trust</span>
                        <span class="hero-content-type hero-content-type--project">Established 1995</span>
                    </div>
                    <h1 class="hero-headline">
                        Empowering Women<br>in Fisher Communities
                    </h1>
                    <p class="hero-sub hero-sub--meta">
                        Mukono · Kalangala · Buvuma
                    </p>
                    <div class="hero-actions">
                        <a href="{{ route('projects.index') }}" class="btn-primary">Our Projects →</a>
                        <a href="{{ route('about.index') }}" class="btn-ghost">About KWDT</a>
                    </div>
                </div>

            @endif

        </div>{{-- /.hero-slides-content --}}

        {{-- Stats bar at the very bottom --}}
        <div class="hero-stats">
            @foreach([
                ['num' => '1,235', 'label' => 'Women Supported'],
                ['num' => '52',    'label' => 'Community Groups'],
                ['num' => '3',     'label' => 'Districts Covered'],
                ['num' => '30+',   'label' => 'Years of Impact'],
            ] as $stat)
                <div class="stat-item">
                    <span class="stat-num">{{ $stat['num'] }}</span>
                    <span class="stat-label">{{ $stat['label'] }}</span>
                </div>
            @endforeach
        </div>

    </section>

    {{-- ══════════════════════════════════════════════════════════
         MISSION BAND
    ══════════════════════════════════════════════════════════ --}}
    <div class="mission-band">
        <p>"Empowered women and youth with healthy and productive livelihoods in a sustainable environment"</p>
        <div class="mission-divider"></div>
        <p>"Enabling women and female youth in rural communities to effectively engage in their social, economic and political development"</p>
    </div>

    {{-- ══════════════════════════════════════════════════════════
         ABOUT — orange wave section with image collage + slider
    ══════════════════════════════════════════════════════════ --}}
    <section class="about-wave-section">

        <div class="wave-top" aria-hidden="true">
            <svg viewBox="0 0 1440 72" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,36 C360,72 1080,0 1440,36 L1440,72 L0,72 Z" fill="var(--orange)"/>
            </svg>
        </div>

        <div class="about-wave-inner">

            {{-- Image collage with shapes --}}
            <div class="about-collage reveal">
                <div class="collage-main">
                    <img src="https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/f1a11664-9d66-411b-9d02-1f3158773ad9/DSC08536.JPG"
                         alt="KWDT community" loading="lazy">
                </div>
                <div class="collage-float">
                    <img src="https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/80995547-893f-431c-ab16-455253aee6c6/ARCHE_UGANDA_195.jpg"
                         alt="Women empowerment" loading="lazy">
                </div>
                <div class="collage-circle" aria-hidden="true"></div>
                <div class="collage-dots" aria-hidden="true">
                    @for($i = 0; $i < 25; $i++) <span></span> @endfor
                </div>
                <div class="collage-stat-badge">
                    <span class="collage-stat-num">52</span>
                    <span class="collage-stat-label">Women's Groups</span>
                </div>
            </div>

            {{-- Text --}}
            <div class="about-wave-content">
                <span class="section-label reveal" style="color:rgba(255,255,255,0.8)">Who We Are</span>
                <h2 class="section-title reveal" style="color:#fff">
                    Rooted in Community,<br>Driven by <em style="color:var(--earth)">Purpose</em>
                </h2>
                <p class="reveal" style="color:rgba(255,255,255,0.95);line-height:1.8;margin-bottom:1rem">
                    <strong style="color:#fff">Katosi Women Development Trust (KWDT)</strong> is a registered non-profit
                    improving living standards of poor and rural fisher communities in Uganda by empowering
                    them to empower themselves.
                </p>
                <p class="reveal" style="color:rgba(255,255,255,0.8);line-height:1.8;margin-bottom:2rem;font-size:0.96rem">
                    Recognising women as critical agents of development, KWDT addresses the challenges
                    that hinder their participation — from gender-based violence to limited access to
                    healthcare, education, and economic opportunity.
                </p>
                <div class="about-inline-stats reveal">
                    @foreach([['1995','Founded'],['1,235','Women Reached'],['3','Districts']] as $s)
                        <div class="about-inline-stat">
                            <span>{{ $s[0] }}</span>
                            <span>{{ $s[1] }}</span>
                        </div>
                    @endforeach
                </div>
                <div class="reveal" style="margin-top:2rem">
                    <a href="{{ route('about.index') }}" class="btn-outline-sand">Our Full Story →</a>
                </div>
            </div>
        </div>

        {{-- Photo slider --}}
        <div class="about-slider-wrap">
            <div class="about-slider-header">
                <span class="about-slider-label">Life &amp; Work in Uganda's Fisher Communities</span>
                <div class="slider-nav-btns">
                    <button class="slider-arrow-btn" id="photoPrev" aria-label="Previous">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>
                    <button class="slider-arrow-btn" id="photoNext" aria-label="Next">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="about-slider-viewport">
                <div class="about-slider-track" id="photoSliderTrack">
                    @foreach([
                        ['src' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/82eada9f-8188-4ebd-bab8-3fdcf85ca5f8/ARCHE_UGANDA_194.jpg',  'cap' => 'Women at Katosi Landing Site'],
                        ['src' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/0a689bfb-2ee0-4451-ae42-f9fc54f37d71/ARCHE_UGANDA_196.jpg',  'cap' => 'Economic Empowerment Programme'],
                        ['src' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/3ef1650d-ef5e-4b49-bc13-1b771013aa68/DSC03764.JPG',           'cap' => 'Community Field Work'],
                        ['src' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/d764e888-bfec-47a8-b5a6-a1f0f288a166/DSC05383.JPG',           'cap' => 'Clean Water Access Project'],
                        ['src' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/c8973b94-5f49-4092-974c-26e2359d0baa/ARCHE_UGANDA_218.jpg',  'cap' => 'CFS Gender Equality Programme'],
                        ['src' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/f3fce0f7-c4b3-4e55-ba3e-04c48e8ee2c6/DSC01464+2.JPG',        'cap' => 'UN Headquarters Advocacy'],
                        ['src' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/fc6e9483-6da8-4944-b548-91aef5bb9f99/ARCHE_UGANDA_204.jpg', 'cap' => 'Justice Forum on Fisheries'],
                    ] as $slide)
                        <div class="about-slide">
                            <img src="{{ $slide['src'] }}" alt="{{ $slide['cap'] }}" loading="lazy">
                            <div class="about-slide-cap">{{ $slide['cap'] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="about-slider-dots" id="photoSliderDots"></div>
        </div>

        <div class="wave-bottom" aria-hidden="true">
            <svg viewBox="0 0 1440 72" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,36 C360,0 1080,72 1440,36 L1440,0 L0,0 Z" fill="#E07818"/>
            </svg>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════════════════
         THEMATIC AREAS
    ══════════════════════════════════════════════════════════ --}}
    <section class="themes-section">
        <div class="section-header">
            <span class="section-label reveal">What We Do</span>
            <h2 class="section-title reveal">Four Pillars of<br><em>Community Impact</em></h2>
            <p class="section-intro reveal">
                KWDT intervenes across four thematic areas, with health, gender,
                youth and disability mainstreamed throughout all programmes.
            </p>
        </div>
        <div class="themes-grid">
            @foreach([
                ['img' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/0a689bfb-2ee0-4451-ae42-f9fc54f37d71/ARCHE_UGANDA_196.jpg', 'num' => '01', 'title' => 'Economic Empowerment', 'body' => 'Supporting women in agriculture, fisheries and micro-businesses to build financial independence and long-term stability.'],
                ['img' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/f1a11664-9d66-411b-9d02-1f3158773ad9/DSC08536.JPG',           'num' => '02', 'title' => 'WASH',                  'body' => 'Improving access to clean water, sanitation and hygiene in rural and fishing landing sites across three districts.'],
                ['img' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/80995547-893f-431c-ab16-455253aee6c6/ARCHE_UGANDA_195.jpg', 'num' => '03', 'title' => 'Education',             'body' => 'Providing formal and non-formal education opportunities that unlock leadership and participation for women and girls.'],
                ['img' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/3ef1650d-ef5e-4b49-bc13-1b771013aa68/DSC03764.JPG',           'num' => '04', 'title' => 'Environment Conservation','body' => 'Promoting sustainable practices to protect Lake Victoria ecosystems and secure livelihoods for future generations.'],
            ] as $theme)
                <div class="theme-card reveal">
                    <div class="theme-img">
                        <img src="{{ $theme['img'] }}" alt="{{ $theme['title'] }}" loading="lazy">
                        <div class="theme-num-badge">{{ $theme['num'] }}</div>
                    </div>
                    <div class="theme-body">
                        <h3>{{ $theme['title'] }}</h3>
                        <p>{{ $theme['body'] }}</p>
                        <a href="{{ route('about.what-we-do') }}" class="theme-link">
                            Learn more
                            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div style="margin-top:3rem;text-align:center" class="reveal">
            <a href="{{ route('about.what-we-do') }}" class="btn-outline">See All Programmes →</a>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════════════════
         IMPACT DIAGONAL BAND
    ══════════════════════════════════════════════════════════ --}}
    <div class="impact-diagonal">
        <div class="impact-diagonal-inner">
            @foreach([
                ['num' => '1,235', 'label' => 'Women Directly Supported'],
                ['num' => '52',    'label' => 'Women\'s Groups Coordinated'],
                ['num' => '3',     'label' => 'Districts: Mukono, Kalangala, Buvuma'],
                ['num' => '30+',   'label' => 'Years of Community Impact'],
            ] as $item)
                <div class="impact-diagonal-item reveal">
                    <span class="impact-diagonal-num">{{ $item['num'] }}</span>
                    <span class="impact-diagonal-label">{{ $item['label'] }}</span>
                </div>
            @endforeach
        </div>
    </div>

    {{-- ══════════════════════════════════════════════════════════
         FEATURED PROJECTS
    ══════════════════════════════════════════════════════════ --}}
    <section class="projects-section bg-[radial-gradient(#e5e7eb_1px,transparent_1px)] [background-size:32px_32px]">
        <div class="section-header">
            <span class="section-label reveal">Our Work</span>
            <h2 class="section-title reveal">Featured Projects</h2>
            <p class="section-intro reveal">Tangible impact across Uganda's fishing communities — exploring our recent initiatives.</p>
        </div>
        <div class="projects-grid">
            @forelse($featuredProjects as $project)
                <x-project-card :project="$project" />
            @empty
                @foreach([
                    ['img' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/d764e888-bfec-47a8-b5a6-a1f0f288a166/DSC05383.JPG',           'status' => 'Ongoing', 'title' => 'Clean Water Access at Katooke Landing Site', 'desc' => '718 people across 123 households now have access to 10,000 litres of safe water per day.', 'loc' => 'Buikwe District', 'bene' => '718 beneficiaries'],
                    ['img' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/fc6e9483-6da8-4944-b548-91aef5bb9f99/ARCHE_UGANDA_204.jpg', 'status' => 'Ongoing', 'title' => 'Justice Forum on Fisheries & Human Rights',       'desc' => 'Creating platforms for fisherfolk to engage with duty bearers on rights and livelihoods.', 'loc' => 'Kalangala', 'bene' => null],
                    ['img' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/c8973b94-5f49-4092-974c-26e2359d0baa/ARCHE_UGANDA_218.jpg',  'status' => 'Ongoing', 'title' => 'CFS Gender Equality & Food Security Guidelines',   'desc' => 'Implementing FAO guidelines on gender equality in food security with women from 12 African countries.', 'loc' => 'Regional', 'bene' => null],
                ] as $p)
                    <a href="{{ route('projects.index') }}" class="project-card reveal">
                        <div class="project-card-img-wrap">
                            <img class="project-card-bg" src="{{ $p['img'] }}" alt="{{ $p['title'] }}" loading="lazy">
                            <div class="project-card-overlay"></div>
                        </div>
                        <div class="project-card-content">
                            <h3>{{ $p['title'] }}</h3>
                            <p>{{ Str::limit($p['desc'], 90) }}</p>
                            <div class="project-meta">
                                <span>📍 {{ $p['loc'] }}</span>
                                @if($p['bene']) <span>👥 {{ $p['bene'] }}</span> @endif
                            </div>
                            <span class="project-cta-link">
                                View project
                                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </span>
                        </div>
                    </a>
                @endforeach
            @endforelse
        </div>
        <div style="margin-top:3rem;text-align:center" class="reveal">
            <a href="{{ route('projects.index') }}" class="btn-outline">View All Projects →</a>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════════════════
         LATEST BLOG
    ══════════════════════════════════════════════════════════ --}}
    <section class="blog-section">
        <div class="blog-header">
            <div>
                <span class="section-label reveal">Blog & News</span>
                <h2 class="section-title reveal">Stories from the Field</h2>
            </div>
            <a href="{{ route('blog.index') }}" class="see-all reveal">
                All articles
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
        <div class="blog-grid">
            @forelse($latestBlogs as $post)
                <x-blog-card :post="$post" />
            @empty
                @foreach([
                    ['img' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/82eada9f-8188-4ebd-bab8-3fdcf85ca5f8/ARCHE_UGANDA_194.jpg', 'category' => 'Theory of Change', 'title' => 'Our Theory of Change: Empowering Rural Women, Transforming Communities', 'excerpt' => 'How KWDT\'s integrated approach creates lasting change across Uganda\'s fishing communities.', 'date' => 'Aug 21, 2025'],
                    ['img' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/f3fce0f7-c4b3-4e55-ba3e-04c48e8ee2c6/DSC01464+2.JPG',        'category' => 'Advocacy',        'title' => 'Reclaiming the Narrative: KWDT at the UN Headquarters',                         'excerpt' => 'A voice for rural communities in global water dialogues at the United Nations.',                          'date' => 'Jul 15, 2025'],
                    ['img' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/80995547-893f-431c-ab16-455253aee6c6/ARCHE_UGANDA_195.jpg', 'category' => 'Health',          'title' => 'KWDT Champions a #PeriodFriendlyWorld Through Community Solutions',              'excerpt' => 'Community-driven menstrual health solutions making a real difference.',                                   'date' => 'May 28, 2025'],
                ] as $post)
                    <a href="{{ route('blog.index') }}" class="blog-card reveal">
                        <div class="blog-img">
                            <img src="{{ $post['img'] }}" alt="{{ $post['title'] }}" loading="lazy">
                        </div>
                        <span class="blog-category">{{ $post['category'] }}</span>
                        <h3>{{ $post['title'] }}</h3>
                        <p>{{ $post['excerpt'] }}</p>
                        <div class="blog-card-footer">
                            <span class="blog-date" style="margin:0">{{ $post['date'] }}</span>
                            <span class="blog-read-more">
                                Read
                                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </span>
                        </div>
                    </a>
                @endforeach
            @endforelse
        </div>
    </section>

    {{-- ══════════════════════════════════════════════════════════
         DONATE SECTION
    ══════════════════════════════════════════════════════════ --}}
    <section class="donate-section" id="donate">

        {{-- Left: Community photo --}}
        <div class="donate-img-panel">
            <img
                src="https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/82eada9f-8188-4ebd-bab8-3fdcf85ca5f8/ARCHE_UGANDA_194.jpg"
                alt="KWDT women community members at Katosi"
                loading="lazy">
            <div class="donate-img-panel-overlay" aria-hidden="true"></div>
        </div>

        {{-- Right: Orange content panel --}}
        <div class="donate-content-panel">

            <span class="section-label">Make an Impact</span>

            <h2 class="section-title reveal">
                Support a Woman,<br>Transform a Community
            </h2>

            <p class="donate-body-text reveal">
                Every contribution directly supports women and their families
                in Uganda's most vulnerable fishing communities. Your gift
                creates lasting, generational change.
            </p>

            <ul class="donate-impact-list reveal" aria-label="What your donation achieves">
                <li>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
                        <path d="M12 2.69l5.66 5.66a8 8 0 11-11.31 0z"/>
                    </svg>
                    <span><strong>$25</strong> provides clean water access for a family for one month</span>
                </li>
                <li>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
                        <path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/>
                    </svg>
                    <span><strong>$50</strong> funds a girl's school term, keeping her in education</span>
                </li>
                <li>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
                        <line x1="12" y1="1" x2="12" y2="23"/>
                        <path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/>
                    </svg>
                    <span><strong>$100</strong> helps a woman launch her own micro-enterprise</span>
                </li>
            </ul>

            <a href="{{ route('donate') }}" class="btn-donate-page reveal" aria-label="Go to the donation page">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" aria-hidden="true">
                    <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
                </svg>
                Donate Now
            </a>

            <div class="donate-pay-row reveal">
                <span class="donate-pay-label">Pay via</span>
                <span class="donate-pay-pill">PayPal</span>
                <span class="donate-pay-pill">MTN MoMo</span>
                <span class="donate-pay-pill">Airtel Money</span>
            </div>

        </div>

    </section>

    {{-- ══════════════════════════════════════════════════════════
         PARTNERS — Auto-scrolling carousel
    ══════════════════════════════════════════════════════════ --}}
    <section class="partners-section">
        <div class="pattern-dots" aria-hidden="true"></div>

        <p class="partners-label">Trusted Partners &amp; Funders</p>

        <div class="partners-carousel">
            <div class="partners-track-container">
                <div class="partners-track" id="partnersTrack">

                    {{-- ── Primary set ── --}}
                    @forelse($partners as $partner)
                        <div class="partner-item">
                            <a href="{{ $partner->website ?? '#' }}"
                               target="{{ $partner->website ? '_blank' : '_self' }}"
                               rel="noopener"
                               title="{{ $partner->name }}">

                                @if($partner->has_logo)
                                    <img
                                        class="partner-logo-img"
                                        src="{{ $partner->logo_url }}"
                                        alt="{{ $partner->name }} logo"
                                        loading="lazy"
                                        data-fallback="{{ e($partner->short_name) }}"
                                        onerror="
                                            this.onerror = null;
                                            var s = document.createElement('span');
                                            s.className = 'partner-fallback';
                                            s.textContent = this.dataset.fallback;
                                            this.parentNode.replaceChild(s, this);
                                        "
                                    >
                                @else
                                    <span class="partner-fallback">{{ $partner->short_name }}</span>
                                @endif

                                <span class="partner-tooltip">{{ $partner->name }}</span>
                            </a>
                        </div>
                    @empty
                        {{-- Fallback when DB is empty --}}
                        @foreach([
                            'World Forum for Fish Workers',
                            'Gender Water Alliance',
                            'Uganda National NGO Forum',
                            'UWONET',
                            'WOUGNET',
                            'UNWFO',
                        ] as $name)
                            <div class="partner-item">
                                <span class="partner-fallback">{{ $name }}</span>
                            </div>
                        @endforeach
                    @endforelse

                    {{-- ── Duplicate set for seamless loop ── --}}
                    @if($partners->count() > 0)
                        @foreach($partners as $partner)
                            <div class="partner-item" aria-hidden="true">
                                <a href="{{ $partner->website ?? '#' }}"
                                   target="_blank"
                                   rel="noopener"
                                   tabindex="-1"
                                   title="{{ $partner->name }}">

                                    @if($partner->has_logo)
                                        <img
                                            class="partner-logo-img"
                                            src="{{ $partner->logo_url }}"
                                            alt=""
                                            loading="lazy"
                                            data-fallback="{{ e($partner->short_name) }}"
                                            onerror="
                                                this.onerror = null;
                                                var s = document.createElement('span');
                                                s.className = 'partner-fallback';
                                                s.textContent = this.dataset.fallback;
                                                this.parentNode.replaceChild(s, this);
                                            "
                                        >
                                    @else
                                        <span class="partner-fallback">{{ $partner->short_name }}</span>
                                    @endif
                                </a>
                            </div>
                        @endforeach
                    @endif

                </div>{{-- /.partners-track --}}
            </div>{{-- /.partners-track-container --}}
        </div>{{-- /.partners-carousel --}}
    </section>

    @push('scripts')
        <script>
            // ── Hero slideshow with dots + synced content panels ─────
            (function () {
                const slides   = document.querySelectorAll('#heroSlideshow .hero-slide');
                const panels   = document.querySelectorAll('[data-slide-content]');
                const dotsWrap = document.getElementById('heroSlideDots');
                if (!slides.length) return;
                let current = 0, timer;

                // Build dots
                slides.forEach(function (_, i) {
                    const d = document.createElement('button');
                    d.className = 'hero-dot' + (i === 0 ? ' active' : '');
                    d.setAttribute('aria-label', 'Go to slide ' + (i + 1));
                    d.addEventListener('click', function () { go(i); reset(); });
                    dotsWrap.appendChild(d);
                });

                function go(n) {
                    // Background image swap
                    slides[current].classList.remove('active');
                    dotsWrap.children[current] && dotsWrap.children[current].classList.remove('active');

                    // Content panel swap — deactivate old, activate new
                    const oldPanel = document.querySelector('[data-slide-content="' + current + '"]');
                    if (oldPanel) oldPanel.classList.remove('is-active');

                    current = n;
                    slides[current].classList.add('active');
                    dotsWrap.children[current] && dotsWrap.children[current].classList.add('active');

                    const newPanel = document.querySelector('[data-slide-content="' + current + '"]');
                    if (newPanel) newPanel.classList.add('is-active');
                }

                function reset() {
                    clearInterval(timer);
                    timer = setInterval(function () { go((current + 1) % slides.length); }, 6000);
                }

                reset();
            })();

            // ── About / community photo slider ──────────────────────
            (function () {
                const track    = document.getElementById('photoSliderTrack');
                const dotsWrap = document.getElementById('photoSliderDots');
                if (!track) return;

                const slides = track.querySelectorAll('.about-slide');
                const total  = slides.length;
                let idx = 0, timer;

                function vis() {
                    return window.innerWidth <= 700 ? 1 : window.innerWidth <= 1024 ? 2 : 3;
                }

                slides.forEach(function (_, i) {
                    const d = document.createElement('button');
                    d.className = 'photo-dot' + (i === 0 ? ' active' : '');
                    d.setAttribute('aria-label', 'Slide ' + (i + 1));
                    d.addEventListener('click', function () { goTo(i); reset(); });
                    dotsWrap.appendChild(d);
                });

                function goTo(n) {
                    const max = Math.max(0, total - vis());
                    idx = Math.max(0, Math.min(n, max));
                    track.style.transform = 'translateX(-' + (100 / vis() * idx) + '%)';
                    Array.from(dotsWrap.children).forEach(function (d, i) {
                        d.classList.toggle('active', i === idx);
                    });
                }

                function reset() {
                    clearInterval(timer);
                    timer = setInterval(function () {
                        goTo(idx + 1 > total - vis() ? 0 : idx + 1);
                    }, 4200);
                }

                document.getElementById('photoPrev').addEventListener('click', function () { goTo(idx - 1); reset(); });
                document.getElementById('photoNext').addEventListener('click', function () { goTo(idx + 1); reset(); });

                let tx = 0;
                track.addEventListener('touchstart', function (e) { tx = e.changedTouches[0].clientX; }, { passive: true });
                track.addEventListener('touchend', function (e) {
                    const d = tx - e.changedTouches[0].clientX;
                    if (Math.abs(d) > 40) { goTo(d > 0 ? idx + 1 : idx - 1); reset(); }
                });

                window.addEventListener('resize', function () { goTo(idx); });
                reset();
            })();

            // ── Scroll reveal ────────────────────────────────────────
            (function () {
                const obs = new IntersectionObserver(function (entries) {
                    entries.forEach(function (e) {
                        if (e.isIntersecting) { e.target.classList.add('visible'); obs.unobserve(e.target); }
                    });
                }, { threshold: 0.1 });

                document.querySelectorAll('.reveal').forEach(function (el) { obs.observe(el); });
            })();
        </script>
    @endpush

</x-layouts.app>
