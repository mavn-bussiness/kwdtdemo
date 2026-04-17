{{--
    KWDT NAV — Static white, Red Cross Uganda style
    • Always white — no transparent hero overlap
    • Source Sans 3 font
    • Professional SVG icons in dropdowns
    • Orange Donate button (links to /donate)
    • Dark utility topbar
--}}

{{-- ── Utility Topbar ──────────────────────────────────────── --}}
<div class="kwdt-topbar">
    <div class="topbar-left">
        <a href="tel:+256414691842">
            {{-- Phone icon --}}
            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.8 19.79 19.79 0 01.07 1.18 2 2 0 012 0h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L6.91 7.91a16 16 0 006.18 6.18l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/>
            </svg>
            +256 414 691 842
        </a>
        <a href="mailto:info@katosi.org">
            {{-- Mail icon --}}
            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="4" width="20" height="16" rx="2"/>
                <path d="M2 7l10 7 10-7"/>
            </svg>
            info@katosi.org
        </a>
    </div>
    <div class="topbar-right">
        <div class="topbar-social">
            <a href="https://www.facebook.com/KatosiWomenDT" target="_blank" rel="noopener" aria-label="Facebook">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="rgba(255,255,255,.5)">
                    <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/>
                </svg>
            </a>
            <a href="https://twitter.com/katosi_women" target="_blank" rel="noopener" aria-label="Twitter / X">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="rgba(255,255,255,.5)">
                    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                </svg>
            </a>
            <a href="https://www.linkedin.com/company/katosi-women-development-trust" target="_blank" rel="noopener" aria-label="LinkedIn">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                     stroke="rgba(255,255,255,.5)" stroke-width="2" stroke-linecap="round">
                    <path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6z"/>
                    <rect x="2" y="9" width="4" height="12"/>
                    <circle cx="4" cy="4" r="2"/>
                </svg>
            </a>
        </div>
    </div>
</div>

{{-- ── Main Nav — always white ─────────────────────────────── --}}
<nav id="main-nav" class="kwdt-nav" role="navigation" aria-label="Main navigation">
    <div class="nav-inner">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="nav-logo" aria-label="KWDT – Home">
            <div class="nav-logo-img-wrap">
                @php
                    $logoPath = collect(['kwdt-logo.svg','kwdt-logo.webp','kwdt-logo.png'])
                        ->map(fn($f) => 'images/'.$f)
                        ->first(fn($p) => file_exists(public_path($p)));
                @endphp

                @if($logoPath)
                    <img class="nav-logo-img nav-logo-img--colour"
                         src="{{ asset($logoPath) }}"
                         alt="KWDT logo" width="52" height="52">
                @else
                    {{-- Orange monogram fallback --}}
                    <div class="nav-monogram" aria-hidden="true">
                        <svg viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg" width="52" height="52">
                            <circle cx="26" cy="26" r="26" fill="var(--orange)"/>
                            <text x="26" y="33" text-anchor="middle"
                                  font-family="var(--font-display)" font-size="22"
                                  font-weight="900" fill="white">K</text>
                        </svg>
                    </div>
                @endif
            </div>
            <div class="nav-logo-text">
                <span class="logo-acronym">KWDT</span>
                <span class="logo-name">Katosi Women<br>Development Trust</span>
            </div>
        </a>

        {{-- Desktop links --}}
        <ul class="nav-links" id="nav-links" role="list">

            <li class="nav-item">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                    Home
                </a>
            </li>

            {{-- About dropdown --}}
            <li class="nav-item nav-dropdown">
                <a href="{{ route('about.index') }}"
                   class="{{ request()->routeIs('about.*') ? 'active' : '' }}"
                   aria-haspopup="true">
                    About
                    <svg class="nav-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2.5" stroke-linecap="round" aria-hidden="true">
                        <path d="M6 9l6 6 6-6"/>
                    </svg>
                </a>
                <ul class="dropdown" role="menu">
                    <li role="none"><a href="{{ route('about.index') }}" role="menuitem">
                            {{-- Info icon --}}
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                                <circle cx="12" cy="12" r="10"/><path d="M12 8v4m0 4h.01"/>
                            </svg>
                            History &amp; Mission
                        </a></li>
                    <li role="none"><a href="{{ route('about.what-we-do') }}" role="menuitem">
                            {{-- Clipboard icon --}}
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                                <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            What We Do
                        </a></li>
                    <li role="none"><a href="{{ route('about.index') }}#team" role="menuitem">
                            {{-- Users icon --}}
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 000 8z"/>
                            </svg>
                            Meet the Team
                        </a></li>
                    <li role="none"><a href="{{ route('about.index') }}#partners" role="menuitem">
                            {{-- Handshake / link icon --}}
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                                <path d="M10 13a5 5 0 007.54.54l3-3a5 5 0 00-7.07-7.07l-1.72 1.71"/>
                                <path d="M14 11a5 5 0 00-7.54-.54l-3 3a5 5 0 007.07 7.07l1.71-1.71"/>
                            </svg>
                            Our Partners
                        </a></li>
                </ul>
            </li>

            {{-- Programs dropdown --}}
            <li class="nav-item nav-dropdown">
                <a href="{{ route('projects.index') }}"
                   class="{{ request()->routeIs('projects.*') ? 'active' : '' }}"
                   aria-haspopup="true">
                    Programs
                    <svg class="nav-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2.5" stroke-linecap="round" aria-hidden="true">
                        <path d="M6 9l6 6 6-6"/>
                    </svg>
                </a>
                <ul class="dropdown" role="menu">
                    <li role="none"><a href="{{ route('projects.index') }}" role="menuitem">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                                <rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/>
                            </svg>
                            All Projects
                        </a></li>
                    <li role="none"><a href="{{ route('about.what-we-do') }}" role="menuitem">
                            {{-- Dollar icon --}}
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                                <line x1="12" y1="1" x2="12" y2="23"/>
                                <path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/>
                            </svg>
                            Economic Empowerment
                        </a></li>
                    <li role="none"><a href="{{ route('about.what-we-do') }}" role="menuitem">
                            {{-- Droplet icon --}}
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                                <path d="M12 2.69l5.66 5.66a8 8 0 11-11.31 0z"/>
                            </svg>
                            WASH
                        </a></li>
                    <li role="none"><a href="{{ route('about.what-we-do') }}" role="menuitem">
                            {{-- Graduation cap icon --}}
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                                <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                                <path d="M6 12v5c3 3 9 3 12 0v-5"/>
                            </svg>
                            Education
                        </a></li>
                    <li role="none"><a href="{{ route('about.what-we-do') }}" role="menuitem">
                            {{-- Leaf icon --}}
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                                <path d="M12 22V12M12 12C12 7 17 3 22 2c0 5-3 9-7 10M12 12C12 7 7 3 2 2c0 5 3 9 7 10"/>
                            </svg>
                            Environment
                        </a></li>
                </ul>
            </li>

            {{-- Blog & News dropdown --}}
            <li class="nav-item nav-dropdown">
                <a href="{{ route('blog.index') }}"
                   class="{{ request()->routeIs('blog.*') ? 'active' : '' }}"
                   aria-haspopup="true">
                    Blog &amp; News
                    <svg class="nav-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2.5" stroke-linecap="round" aria-hidden="true">
                        <path d="M6 9l6 6 6-6"/>
                    </svg>
                </a>
                <ul class="dropdown" role="menu">
                    <li role="none"><a href="{{ route('blog.index') }}" role="menuitem">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                                <polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/>
                            </svg>
                            All Articles
                        </a></li>
                    <li role="none"><a href="{{ route('blog.index') }}?category=advocacy" role="menuitem">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                                <path d="M3 11l19-9-9 19-2-8-8-2z"/>
                            </svg>
                            Advocacy
                        </a></li>
                    <li role="none"><a href="{{ route('blog.index') }}?category=health" role="menuitem">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                                <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
                            </svg>
                            Health
                        </a></li>
                    <li role="none"><a href="{{ route('blog.index') }}?category=livelihoods" role="menuitem">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                                <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/>
                            </svg>
                            Livelihoods
                        </a></li>
                </ul>
            </li>

            {{-- Resources dropdown --}}
            <li class="nav-item nav-dropdown">
                <a href="{{ route('gallery') }}"
                   class="{{ request()->routeIs('gallery','reports','awards') ? 'active' : '' }}"
                   aria-haspopup="true">
                    Resources
                    <svg class="nav-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2.5" stroke-linecap="round" aria-hidden="true">
                        <path d="M6 9l6 6 6-6"/>
                    </svg>
                </a>
                <ul class="dropdown" role="menu">
                    <li role="none"><a href="{{ route('gallery') }}" role="menuitem">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                                <rect x="3" y="3" width="18" height="18" rx="2"/>
                                <circle cx="8.5" cy="8.5" r="1.5"/>
                                <polyline points="21 15 16 10 5 21"/>
                            </svg>
                            Photo Gallery
                        </a></li>
                    <li role="none"><a href="{{ route('reports') }}" role="menuitem">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                                <polyline points="14 2 14 8 20 8"/>
                            </svg>
                            Annual Reports
                        </a></li>
                    <li role="none"><a href="{{ route('awards') }}" role="menuitem">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                                <circle cx="12" cy="8" r="6"/>
                                <path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"/>
                            </svg>
                            Awards &amp; Recognition
                        </a></li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="{{ route('careers') }}" class="{{ request()->routeIs('careers') ? 'active' : '' }}">
                    Careers
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">
                    Contact
                </a>
            </li>

        </ul>

        {{-- Right actions: search + donate --}}
        <div class="nav-actions">
            <button class="nav-search-btn" aria-label="Search">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="2.2" stroke-linecap="round">
                    <circle cx="11" cy="11" r="8"/>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
            </button>
            <a href="{{ route('donate') }}" class="nav-donate-btn" aria-label="Donate to KWDT">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="2" stroke-linecap="round" aria-hidden="true">
                    <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
                </svg>
                Donate
            </a>

            {{-- Hamburger --}}
            <button class="nav-hamburger" id="nav-toggle"
                    aria-label="Open navigation menu" aria-expanded="false"
                    aria-controls="mobile-drawer">
                <span class="ham-bar"></span>
                <span class="ham-bar"></span>
                <span class="ham-bar"></span>
            </button>
        </div>

    </div>
</nav>

{{-- ══════════════════════════════════════════════════════════════
     MOBILE DRAWER
══════════════════════════════════════════════════════════════ --}}
<div id="mobile-drawer" class="mob-drawer" aria-hidden="true" role="dialog"
     aria-label="Navigation menu" aria-modal="true">

    <div class="mob-drawer-head">
        <div class="mob-drawer-logo">
            <svg viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg" width="36" height="36" aria-hidden="true">
                <circle cx="21" cy="21" r="21" fill="#E07818"/>
                <text x="21" y="27" text-anchor="middle" font-family="Georgia,serif" font-size="18" font-weight="900" fill="white">K</text>
            </svg>
            <div>
                <span class="mob-logo-acronym">KWDT</span>
                <span class="mob-logo-name">Katosi Women Development Trust</span>
            </div>
        </div>
        <button class="mob-close" id="mob-close" aria-label="Close menu">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    <nav class="mob-nav">
        <a href="{{ route('home') }}" class="mob-link">Home</a>

        <div class="mob-accordion">
            <button class="mob-link mob-acc-btn" aria-expanded="false">
                About
                <svg class="mob-acc-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div class="mob-acc-body">
                <a href="{{ route('about.index') }}" class="mob-sub">History &amp; Mission</a>
                <a href="{{ route('about.what-we-do') }}" class="mob-sub">What We Do</a>
                <a href="{{ route('about.index') }}#team" class="mob-sub">Meet the Team</a>
                <a href="{{ route('about.index') }}#partners" class="mob-sub">Our Partners</a>
            </div>
        </div>

        <div class="mob-accordion">
            <button class="mob-link mob-acc-btn" aria-expanded="false">
                Programs
                <svg class="mob-acc-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div class="mob-acc-body">
                <a href="{{ route('projects.index') }}" class="mob-sub">All Projects</a>
                <a href="{{ route('about.what-we-do') }}" class="mob-sub">Economic Empowerment</a>
                <a href="{{ route('about.what-we-do') }}" class="mob-sub">WASH</a>
                <a href="{{ route('about.what-we-do') }}" class="mob-sub">Education</a>
                <a href="{{ route('about.what-we-do') }}" class="mob-sub">Environment</a>
            </div>
        </div>

        <div class="mob-accordion">
            <button class="mob-link mob-acc-btn" aria-expanded="false">
                Blog &amp; News
                <svg class="mob-acc-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div class="mob-acc-body">
                <a href="{{ route('blog.index') }}" class="mob-sub">All Articles</a>
                <a href="{{ route('blog.index') }}?category=advocacy" class="mob-sub">Advocacy</a>
                <a href="{{ route('blog.index') }}?category=health" class="mob-sub">Health</a>
                <a href="{{ route('blog.index') }}?category=livelihoods" class="mob-sub">Livelihoods</a>
            </div>
        </div>

        <div class="mob-accordion">
            <button class="mob-link mob-acc-btn" aria-expanded="false">
                Resources
                <svg class="mob-acc-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div class="mob-acc-body">
                <a href="{{ route('gallery') }}" class="mob-sub">Photo Gallery</a>
                <a href="{{ route('reports') }}" class="mob-sub">Annual Reports</a>
                <a href="{{ route('awards') }}" class="mob-sub">Awards &amp; Recognition</a>
            </div>
        </div>

        <a href="{{ route('careers') }}" class="mob-link">Careers</a>
        <a href="{{ route('contact') }}" class="mob-link">Contact</a>
    </nav>

    <div class="mob-drawer-foot">
        <a href="{{ route('donate') }}" class="btn-primary" style="width:100%;justify-content:center;">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
            </svg>
            Donate Now
        </a>
        <p class="mob-tagline">"the future in our hands"</p>
    </div>
</div>
<div id="mob-backdrop" class="mob-backdrop"></div>

@push('scripts')
    <script>
        (function () {
            // Nav no longer needs scroll detection — it's always white/static
            // Kept here only for mobile drawer

            const toggle   = document.getElementById('nav-toggle');
            const drawer   = document.getElementById('mobile-drawer');
            const backdrop = document.getElementById('mob-backdrop');
            const closeBtn = document.getElementById('mob-close');

            function openDrawer() {
                drawer.classList.add('is-open');
                drawer.setAttribute('aria-hidden', 'false');
                backdrop.classList.add('is-visible');
                toggle.setAttribute('aria-expanded', 'true');
                toggle.classList.add('is-open');
                document.body.style.overflow = 'hidden';
                const first = drawer.querySelector('button,a');
                if (first) first.focus();
            }
            function closeDrawer() {
                drawer.classList.remove('is-open');
                drawer.setAttribute('aria-hidden', 'true');
                backdrop.classList.remove('is-visible');
                toggle.setAttribute('aria-expanded', 'false');
                toggle.classList.remove('is-open');
                document.body.style.overflow = '';
                toggle.focus();
            }

            toggle.addEventListener('click', () =>
                drawer.classList.contains('is-open') ? closeDrawer() : openDrawer());
            closeBtn.addEventListener('click', closeDrawer);
            backdrop.addEventListener('click', closeDrawer);
            document.addEventListener('keydown', e => { if (e.key === 'Escape') closeDrawer(); });

            // Mobile accordions (single open)
            drawer.querySelectorAll('.mob-acc-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    const isOpen = btn.getAttribute('aria-expanded') === 'true';
                    drawer.querySelectorAll('.mob-acc-btn').forEach(b => {
                        b.setAttribute('aria-expanded', 'false');
                        b.closest('.mob-accordion').classList.remove('is-open');
                    });
                    if (!isOpen) {
                        btn.setAttribute('aria-expanded', 'true');
                        btn.closest('.mob-accordion').classList.add('is-open');
                    }
                });
            });
        })();
    </script>
@endpush
