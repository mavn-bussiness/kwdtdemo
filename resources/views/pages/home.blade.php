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
                            '/storage/images/static/arche-uganda-194.jpg',
                            '/storage/images/static/arche-uganda-196.jpg',
                            '/storage/images/static/dsc05383.jpg',
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
                    ['src' => '/storage/images/static/arche-uganda-194.jpg', 'alt' => 'KWDT women community'],
                    ['src' => '/storage/images/static/arche-uganda-196.jpg', 'alt' => 'Economic Empowerment'],
                    ['src' => '/storage/images/static/dsc03764.jpg',          'alt' => 'Community field work'],
                    ['src' => '/storage/images/static/dsc05383.jpg',          'alt' => 'Clean water project'],
                    ['src' => '/storage/images/static/arche-uganda-204.jpg',  'alt' => 'Fisheries forum'],
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
    <div class="mission-band" style="background: var(--panel); border-top: 1px solid rgba(255,160,0,0.1); border-bottom: 1px solid rgba(255,160,0,0.1);">
        <p>"Empowered women and youth with healthy and productive livelihoods in a sustainable environment"</p>
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
                    <img src="/storage/images/static/dsc08536.jpg"
                         alt="KWDT community" loading="lazy">
                </div>
                <div class="collage-float">
                    <img src="/storage/images/static/arche-uganda-195.jpg"
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
                    Rooted in Community,<br>Driven by <em style="color:var(--orange-light)">Purpose</em>
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
                    @foreach([['1996','Founded'],['1,235','Women Reached'],['3','Districts']] as $s)
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
                        ['src' => '/storage/images/static/arche-uganda-194.jpg',  'cap' => 'Women at Katosi Landing Site'],
                        ['src' => '/storage/images/static/arche-uganda-196.jpg',  'cap' => 'Economic Empowerment Programme'],
                        ['src' => '/storage/images/static/dsc03764.jpg',           'cap' => 'Community Field Work'],
                        ['src' => '/storage/images/static/dsc05383.jpg',           'cap' => 'Clean Water Access Project'],
                        ['src' => '/storage/images/static/arche-uganda-218.jpg',  'cap' => 'CFS Gender Equality Programme'],
                        ['src' => '/storage/images/static/dsc01464-2.jpg',        'cap' => 'UN Headquarters Advocacy'],
                        ['src' => '/storage/images/static/arche-uganda-204.jpg', 'cap' => 'Justice Forum on Fisheries'],
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
                <path d="M0,36 C360,0 1080,72 1440,36 L1440,0 L0,0 Z" fill="var(--orange)"/>
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
                ['img' => '/storage/images/static/arche-uganda-196.jpg', 'num' => '01', 'title' => 'Economic Empowerment', 'body' => 'Supporting women in agriculture, fisheries and micro-businesses to build financial independence and long-term stability.'],
                ['img' => '/storage/images/static/dsc08536.jpg',           'num' => '02', 'title' => 'WASH',                  'body' => 'Improving access to clean water, sanitation and hygiene in rural and fishing landing sites across three districts.'],
                ['img' => '/storage/images/static/arche-uganda-195.jpg', 'num' => '03', 'title' => 'Education',             'body' => 'Providing formal and non-formal education opportunities that unlock leadership and participation for women and girls.'],
                ['img' => '/storage/images/static/dsc03764.jpg',           'num' => '04', 'title' => 'Environment Conservation','body' => 'Promoting sustainable practices to protect Lake Victoria ecosystems and secure livelihoods for future generations.'],
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
         PROJECTS — Red Cross style: 3-col image-top cards
    ══════════════════════════════════════════════════════════ --}}
    <section class="hp-projects-section">
        <div class="hp-section-head">
            <div>
                <span class="section-label reveal">Our Work</span>
                <h2 class="hp-section-title reveal">Featured Projects</h2>
            </div>
            <a href="{{ route('projects.index') }}" class="hp-see-all reveal">
                All Projects
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>

        <div class="hp-projects-grid">
            @forelse($featuredProjects as $project)
                @php
                    $url   = $project->content?->slug ? route('projects.show', $project->content->slug) : route('projects.index');
                    $img   = $project->content?->featuredImageUrl() ?? '/storage/images/static/dsc05383.jpg';
                    $title = $project->content?->title ?? 'Project';
                    $cat   = $project->statusLabel();
                    $loc   = $project->location ?? 'Uganda';
                @endphp
                <a href="{{ $url }}" class="hp-project-card reveal">
                    <div class="hp-project-img">
                        <img src="{{ $img }}" alt="{{ $title }}" loading="lazy">
                        <span class="hp-project-tag">{{ $cat }}</span>
                    </div>
                    <div class="hp-project-body">
                        <h3 class="hp-project-title">{{ $title }}</h3>
                        <p class="hp-project-loc">
                            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            {{ $loc }}
                        </p>
                        <span class="hp-card-arrow">Read more →</span>
                    </div>
                </a>
            @empty
                @foreach([
                    ['img'=>'/storage/images/static/dsc05383.jpg','tag'=>'WASH','title'=>'Clean Water Access at Katooke Landing Site','loc'=>'Buikwe District'],
                    ['img'=>'/storage/images/static/arche-uganda-204.jpg','tag'=>'Human Rights','title'=>'Justice Forum on Fisheries & Human Rights','loc'=>'Kalangala'],
                    ['img'=>'/storage/images/static/arche-uganda-218.jpg','tag'=>'Regional','title'=>'CFS Gender Equality & Food Security Guidelines','loc'=>'Regional Africa'],
                ] as $p)
                    <a href="{{ route('projects.index') }}" class="hp-project-card reveal">
                        <div class="hp-project-img">
                            <img src="{{ $p['img'] }}" alt="{{ $p['title'] }}" loading="lazy">
                            <span class="hp-project-tag">{{ $p['tag'] }}</span>
                        </div>
                        <div class="hp-project-body">
                            <h3 class="hp-project-title">{{ $p['title'] }}</h3>
                            <p class="hp-project-loc">
                                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                {{ $p['loc'] }}
                            </p>
                            <span class="hp-card-arrow">Read more →</span>
                        </div>
                    </a>
                @endforeach
            @endforelse
        </div>
    </section>

    {{-- ══════════════════════════════════════════════════════════
         LATEST NEWS — Red Cross style: stacked horizontal cards
         Large image left, text right, bold orange left-border accent
    ══════════════════════════════════════════════════════════ --}}
    <section class="hp-news-section" aria-label="Latest News">

        <div class="hp-section-head">
            <div>
                <span class="section-label reveal">Updates</span>
                <h2 class="hp-section-title reveal">Latest News</h2>
            </div>
            <a href="{{ route('blog.index') }}" class="hp-see-all reveal">
                All News
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>

        <div class="hp-news-list">
            @forelse($latestBlogs as $post)
                <article class="hp-news-item reveal">
                    <a href="{{ route('blog.show', $post->slug) }}" class="hp-news-img-wrap">
                        <img src="{{ $post->featuredImageUrl() ?? '/storage/images/static/arche-uganda-196.jpg' }}" alt="{{ $post->title }}" loading="lazy">
                    </a>
                    <div class="hp-news-body">
                        <div class="hp-news-meta">
                            <span class="hp-news-tag">{{ $post->categories->first()?->name ?? 'News' }}</span>
                            @if($post->published_at)
                                <span class="hp-news-date">{{ $post->published_at->format('d M Y') }}</span>
                            @endif
                        </div>
                        <h3 class="hp-news-title">
                            <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                        </h3>
                        <p class="hp-news-excerpt">{{ Str::limit(strip_tags($post->excerpt ?? $post->body ?? ''), 160) }}</p>
                        <a href="{{ route('blog.show', $post->slug) }}" class="hp-card-arrow">Read more →</a>
                    </div>
                </article>
            @empty
                @foreach([
                    ['img'=>'/storage/images/static/arche-uganda-196.jpg','tag'=>'Union','date'=>'12 Jun 2025','title'=>'Katosi Women Fish Processors and Traders Union','excerpt'=>'Empowering women in the fish processing and trading sector to build sustainable livelihoods and economic independence across Lake Victoria\'s fishing communities.'],
                    ['img'=>'/storage/images/static/dsc01464-2.jpg','tag'=>'Advocacy','date'=>'03 May 2025','title'=>'Reclaiming the Narrative: KWDT at the UN Headquarters','excerpt'=>'A powerful voice for rural communities at global water and fisheries dialogues at the United Nations — advocating for the rights of women in artisanal fisheries.'],
                    ['img'=>'/storage/images/static/arche-uganda-195.jpg','tag'=>'Health','date'=>'20 Mar 2025','title'=>'KWDT Champions a #PeriodFriendlyWorld','excerpt'=>'Community-driven menstrual health and hygiene solutions making a lasting difference in rural fishing communities across Mukono, Kalangala, and Buvuma.'],
                ] as $n)
                    <article class="hp-news-item reveal">
                        <a href="{{ route('blog.index') }}" class="hp-news-img-wrap">
                            <img src="{{ $n['img'] }}" alt="{{ $n['title'] }}" loading="lazy">
                        </a>
                        <div class="hp-news-body">
                            <div class="hp-news-meta">
                                <span class="hp-news-tag">{{ $n['tag'] }}</span>
                                <span class="hp-news-date">{{ $n['date'] }}</span>
                            </div>
                            <h3 class="hp-news-title"><a href="{{ route('blog.index') }}">{{ $n['title'] }}</a></h3>
                            <p class="hp-news-excerpt">{{ $n['excerpt'] }}</p>
                            <a href="{{ route('blog.index') }}" class="hp-card-arrow">Read more →</a>
                        </div>
                    </article>
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
                src="/storage/images/static/arche-uganda-194.jpg"
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
            </div>

        </div>

    </section>
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
            })();

            // ── News slider ──────────────────────────────────────
            (function () {
                const track    = document.getElementById('newsSliderTrack');
                const dotsWrap = document.getElementById('newsSliderDots');
                const prev     = document.getElementById('newsSliderPrev');
                const next     = document.getElementById('newsSliderNext');
                if (!track) return;
                const slides = track.querySelectorAll('.hp-news-slide');
                let idx = 0;

                slides.forEach(function (_, i) {
                    const d = document.createElement('button');
                    d.className = 'hp-news-dot' + (i === 0 ? ' active' : '');
                    d.setAttribute('aria-label', 'Slide ' + (i + 1));
                    d.addEventListener('click', function () { goTo(i); });
                    dotsWrap.appendChild(d);
                });

                function goTo(n) {
                    idx = (n + slides.length) % slides.length;
                    track.style.transform = 'translateX(-' + (idx * 100) + '%)';
                    Array.from(dotsWrap.children).forEach(function (d, i) {
                        d.classList.toggle('active', i === idx);
                    });
                }

                prev.addEventListener('click', function () { goTo(idx - 1); });
                next.addEventListener('click', function () { goTo(idx + 1); });

                setInterval(function () { goTo(idx + 1); }, 6000);
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
