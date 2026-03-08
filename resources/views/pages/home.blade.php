<x-layouts.app title="Home" metaDescription="Empowering women and youth in Uganda's rural and fisher communities since 1995.">

    {{-- ══════════════════════════════════════════════════════════
         HERO
    ══════════════════════════════════════════════════════════ --}}
    <section class="hero">
        <div class="hero-left">
            <div class="hero-shape hero-shape--1" aria-hidden="true"></div>
            <div class="hero-shape hero-shape--2" aria-hidden="true"></div>

            <span class="hero-tag">Established 1995 · Uganda</span>

            <h1 class="hero-headline">
                Empowering<br>
                <em>Women</em><br>
                in Fisher<br>Communities
            </h1>

            <p class="hero-sub">
                KWDT works with rural and fishing communities across Mukono,
                Kalangala and Buvuma — enabling women to lead their own
                social, economic and political development.
            </p>

            <div class="hero-actions">
                <a href="{{ route('projects.index') }}" class="btn-primary">Our Projects</a>
                <a href="{{ route('about.index') }}" class="btn-ghost">Learn Our Story →</a>
            </div>

            <div class="hero-badge" aria-hidden="true">
                <span class="hero-badge-num">30+</span>
                <span class="hero-badge-label">Years<br>of Impact</span>
            </div>
        </div>

        <div class="hero-right">
            <div class="hero-slideshow" id="heroSlideshow">
                @foreach([
                    ['src' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/82eada9f-8188-4ebd-bab8-3fdcf85ca5f8/ARCHE_UGANDA_194.jpg', 'alt' => 'KWDT women community'],
                    ['src' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/0a689bfb-2ee0-4451-ae42-f9fc54f37d71/ARCHE_UGANDA_196.jpg', 'alt' => 'Economic Empowerment'],
                    ['src' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/3ef1650d-ef5e-4b49-bc13-1b771013aa68/DSC03764.JPG',           'alt' => 'Community field work'],
                    ['src' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/d764e888-bfec-47a8-b5a6-a1f0f288a166/DSC05383.JPG',           'alt' => 'Clean water project'],
                    ['src' => 'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/fc6e9483-6da8-4944-b548-91aef5bb9f99/ARCHE_UGANDA_204.jpg', 'alt' => 'Fisheries forum'],
                ] as $i => $slide)
                    <img class="hero-slide {{ $i === 0 ? 'active' : '' }}"
                         src="{{ $slide['src'] }}" alt="{{ $slide['alt'] }}">
                @endforeach
            </div>
            <div class="hero-overlay"></div>
            <div class="hero-slide-dots" id="heroSlideDots"></div>
            <div class="hero-stats">
                @foreach([
                    ['num' => '1,235', 'label' => 'Women Supported'],
                    ['num' => '52',    'label' => 'Community Groups'],
                    ['num' => '3',     'label' => 'Districts Covered'],
                ] as $stat)
                    <div class="stat-item">
                        <span class="stat-num">{{ $stat['num'] }}</span>
                        <span class="stat-label">{{ $stat['label'] }}</span>
                    </div>
                @endforeach
            </div>
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
                <path d="M0,36 C360,72 1080,0 1440,36 L1440,72 L0,72 Z" fill="#E07818"/>
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
                <span class="section-label reveal" style="color:rgba(255,255,255,0.7)">Who We Are</span>
                <h2 class="section-title reveal" style="color:#fff">
                    Rooted in Community,<br>Driven by <em style="color:var(--earth)">Purpose</em>
                </h2>
                <p class="reveal" style="color:rgba(255,255,255,0.88);line-height:1.8;margin-bottom:1rem">
                    <strong style="color:#fff">Katosi Women Development Trust (KWDT)</strong> is a registered non-profit
                    improving living standards of poor and rural fisher communities in Uganda by empowering
                    them to engage in their own development processes.
                </p>
                <p class="reveal" style="color:rgba(255,255,255,0.75);line-height:1.8;margin-bottom:2rem;font-size:0.96rem">
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
    <section class="projects-section">
        <div class="section-header">
            <span class="section-label reveal">Our Work</span>
            <h2 class="section-title reveal">Ongoing Projects</h2>
            <p class="section-intro reveal">Real change in real communities — here's what we're working on right now.</p>
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
                        <img class="project-card-bg" src="{{ $p['img'] }}" alt="{{ $p['title'] }}" loading="lazy">
                        <div class="project-card-overlay"></div>
                        <div class="project-card-content">
                            <span class="project-status">● {{ $p['status'] }}</span>
                            <h3>{{ $p['title'] }}</h3>
                            <p>{{ $p['desc'] }}</p>
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
            <a href="{{ route('projects.index') }}" class="btn-outline-sand">View All Projects →</a>
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
         DONATE — orange with clearer payment UI
    ══════════════════════════════════════════════════════════ --}}
    <section class="donate-section">
        <div class="donate-left">
            <div class="donate-shape" aria-hidden="true"></div>
            <span class="section-label" style="color:rgba(255,255,255,0.65)">Make an Impact</span>
            <h2 class="section-title reveal">Support a Woman,<br>Transform a Community</h2>
            <p class="reveal">Every contribution directly supports women and their families in Uganda's most vulnerable fishing communities.</p>
            @livewire('donation-form')
        </div>
        <div class="donate-right reveal">
            @foreach([
                ['initial' => 'N', 'quote' => 'KWDT gave me the skills and confidence to run my own fish trading business. I can now educate all four of my children and have a voice in my community.', 'name' => 'Namutebi Florence', 'location' => 'Katosi Landing Site, Mukono'],
                ['initial' => 'A', 'quote' => 'Before KWDT, our community had no clean water. Today, 718 of us have safe water every day. Our children are no longer getting sick.', 'name' => 'Akello Grace', 'location' => 'Katooke Landing Site, Buikwe'],
            ] as $t)
                <div class="testimonial-card">
                    <svg style="margin-bottom:0.75rem;opacity:0.22" width="24" height="18" viewBox="0 0 24 18" fill="white">
                        <path d="M0 18V10.8C0 4.68 3.36.6 10.08 0l1.44 2.64C8.4 3.84 6.72 6.12 6.48 10.8H10.8V18H0zm13.2 0V10.8C13.2 4.68 16.56.6 23.28 0l1.44 2.64c-3.12 1.2-4.8 3.48-5.04 8.16H24V18H13.2z"/>
                    </svg>
                    <blockquote>"{{ $t['quote'] }}"</blockquote>
                    <div class="testimonial-author">
                        <div class="author-avatar">{{ $t['initial'] }}</div>
                        <div class="author-info">
                            <span class="author-name">{{ $t['name'] }}</span>
                            <span class="author-location">{{ $t['location'] }}</span>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="donate-payment-bar">
                <span class="donate-payment-label">
                    <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display:inline;vertical-align:middle;margin-right:3px"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    Secure payments accepted via
                </span>
                <div class="donate-payment-pills">
                    <span class="donate-pill">PayPal</span>
                    <span class="donate-pill">MTN MoMo</span>
                    <span class="donate-pill">Airtel Money</span>
                </div>
            </div>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════════════════
         PARTNERS
    ══════════════════════════════════════════════════════════ --}}
    <section class="partners-section">
        <p class="partners-label">Trusted partners &amp; funders</p>
        <div class="partners-row">
            @forelse($partners as $partner)
                <a href="{{ $partner->website ?? '#' }}" target="_blank" rel="noopener" class="partner-logo" title="{{ $partner->name }}">
                    @if($partner->logo_url)
                        <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}">
                    @else
                        {{ $partner->name }}
                    @endif
                </a>
            @empty
                @foreach(['GIZ', 'ARCHE NOVA', 'FIAN Uganda', 'Fokus Frauen', 'EU Delegation', 'FAO', 'NGO Bureau Uganda'] as $p)
                    <span class="partner-logo">{{ $p }}</span>
                @endforeach
            @endforelse
        </div>
    </section>

    @push('scripts')
    <script>
    // ── Hero slideshow with dots
    (function() {
        const slides   = document.querySelectorAll('#heroSlideshow .hero-slide');
        const dotsWrap = document.getElementById('heroSlideDots');
        if (!slides.length) return;
        let current = 0;
        slides.forEach((_, i) => {
            const d = document.createElement('button');
            d.className = 'hero-dot' + (i === 0 ? ' active' : '');
            d.setAttribute('aria-label', 'Slide ' + (i+1));
            d.addEventListener('click', () => go(i));
            dotsWrap.appendChild(d);
        });
        function go(n) {
            slides[current].classList.remove('active');
            dotsWrap.children[current].classList.remove('active');
            current = n;
            slides[current].classList.add('active');
            dotsWrap.children[current].classList.add('active');
        }
        setInterval(() => go((current + 1) % slides.length), 4500);
    })();

    // ── About / community photo slider
    (function() {
        const track    = document.getElementById('photoSliderTrack');
        const dotsWrap = document.getElementById('photoSliderDots');
        if (!track) return;
        const slides = track.querySelectorAll('.about-slide');
        const total  = slides.length;
        let idx = 0, timer;
        const vis = () => window.innerWidth <= 700 ? 1 : window.innerWidth <= 1024 ? 2 : 3;

        slides.forEach((_, i) => {
            const d = document.createElement('button');
            d.className = 'photo-dot' + (i === 0 ? ' active' : '');
            d.setAttribute('aria-label', 'Slide ' + (i+1));
            d.addEventListener('click', () => { goTo(i); reset(); });
            dotsWrap.appendChild(d);
        });

        function goTo(n) {
            const max = Math.max(0, total - vis());
            idx = Math.max(0, Math.min(n, max));
            track.style.transform = 'translateX(-' + (100 / vis() * idx) + '%)';
            Array.from(dotsWrap.children).forEach((d,i) => d.classList.toggle('active', i === idx));
        }
        function reset() {
            clearInterval(timer);
            timer = setInterval(() => goTo(idx + 1 > total - vis() ? 0 : idx + 1), 4200);
        }

        document.getElementById('photoPrev').addEventListener('click', () => { goTo(idx-1); reset(); });
        document.getElementById('photoNext').addEventListener('click', () => { goTo(idx+1); reset(); });

        let tx = 0;
        track.addEventListener('touchstart', e => tx = e.changedTouches[0].clientX, { passive:true });
        track.addEventListener('touchend', e => {
            const d = tx - e.changedTouches[0].clientX;
            if (Math.abs(d) > 40) { goTo(d > 0 ? idx+1 : idx-1); reset(); }
        });
        window.addEventListener('resize', () => goTo(idx));
        reset();
    })();

    // ── Scroll reveal
    (function() {
        const obs = new IntersectionObserver(
            entries => entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); obs.unobserve(e.target); } }),
            { threshold: 0.1 }
        );
        document.querySelectorAll('.reveal').forEach(el => obs.observe(el));
    })();
    </script>
    @endpush

</x-layouts.app>