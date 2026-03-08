<nav id="main-nav" class="kwdt-nav">
    <div class="nav-inner">

        {{-- ── Logo ────────────────────────────────────────────── --}}
        {{--
            LOGO SETUP — save your file to either:
              public/images/kwdt-logo.png   ← preferred (transparent background)
              public/images/kwdt-logo.webp  ← also fine
              public/images/kwdt-logo.svg   ← best quality

            The nav auto-switches between a light version on the dark
            transparent hero, and full colour once you scroll.
        --}}
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
                         alt="KWDT logo" width="42" height="42">
                    {{-- White version for dark hero background --}}
                    <img class="nav-logo-img nav-logo-img--white"
                         src="{{ asset($logoPath) }}"
                         alt="" width="42" height="42"
                         style="filter:brightness(0) invert(1)">
                @else
                    {{-- Fallback monogram — remove once you add the real logo --}}
                    <div class="nav-monogram" aria-hidden="true">
                        <svg viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg" width="42" height="42">
                            <circle cx="21" cy="21" r="21" fill="#E07818"/>
                            <text x="21" y="27" text-anchor="middle"
                                  font-family="Georgia,serif" font-size="18"
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

        {{-- ── Desktop Links ────────────────────────────────────── --}}
        <ul class="nav-links" id="nav-links">

            {{-- About Us ── with dropdown --}}
            <li class="nav-item nav-dropdown">
                <a href="{{ route('about.index') }}"
                   class="{{ request()->routeIs('about.*') ? 'active' : '' }}">
                    About Us
                    <svg class="nav-chevron" viewBox="0 0 12 12" fill="none"
                         xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M2 4l4 4 4-4" stroke="currentColor" stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
                <ul class="dropdown">
                    <li><a href="{{ route('about.index') }}">History &amp; Mission</a></li>
                    <li><a href="{{ route('about.what-we-do') }}">What We Do</a></li>
                    <li><a href="{{ route('about.index') }}#team">Meet the Team</a></li>
                    <li><a href="{{ route('about.index') }}#partners">Our Partners</a></li>
                </ul>
            </li>

            {{-- Projects --}}
            <li class="nav-item">
                <a href="{{ route('projects.index') }}"
                   class="{{ request()->routeIs('projects.*') ? 'active' : '' }}">
                    Projects
                </a>
            </li>

            {{-- Blog & News ── with dropdown --}}
            <li class="nav-item nav-dropdown">
                <a href="{{ route('blog.index') }}"
                   class="{{ request()->routeIs('blog.*') ? 'active' : '' }}">
                    Blog &amp; News
                    <svg class="nav-chevron" viewBox="0 0 12 12" fill="none"
                         xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M2 4l4 4 4-4" stroke="currentColor" stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
                <ul class="dropdown">
                    <li><a href="{{ route('blog.index') }}">All Articles</a></li>
                    <li><a href="{{ route('blog.index') }}?category=advocacy">Advocacy</a></li>
                    <li><a href="{{ route('blog.index') }}?category=health">Health</a></li>
                    <li><a href="{{ route('blog.index') }}?category=livelihoods">Livelihoods</a></li>
                </ul>
            </li>

            {{-- Resources ── with dropdown --}}
            <li class="nav-item nav-dropdown">
                <a href="{{ route('gallery') }}"
                   class="{{ request()->routeIs('gallery','reports','awards') ? 'active' : '' }}">
                    Resources
                    <svg class="nav-chevron" viewBox="0 0 12 12" fill="none"
                         xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M2 4l4 4 4-4" stroke="currentColor" stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
                <ul class="dropdown">
                    <li><a href="{{ route('gallery') }}">Photo Gallery</a></li>
                    <li><a href="{{ route('reports') }}">Annual Reports</a></li>
                    <li><a href="{{ route('awards') }}">Awards &amp; Recognition</a></li>
                </ul>
            </li>

            {{-- Careers --}}
            <li class="nav-item">
                <a href="{{ route('careers') }}"
                   class="{{ request()->routeIs('careers') ? 'active' : '' }}">
                    Careers
                </a>
            </li>

            {{-- Contact --}}
            <li class="nav-item">
                <a href="{{ route('contact') }}"
                   class="{{ request()->routeIs('contact') ? 'active' : '' }}">
                    Contact
                </a>
            </li>

            {{-- Donate CTA --}}
            <li class="nav-item">
                <a href="{{ route('donate') }}" class="nav-donate-btn">Donate</a>
            </li>

        </ul>

        {{-- ── Hamburger ────────────────────────────────────────── --}}
        <button class="nav-hamburger" id="nav-toggle"
                aria-label="Open navigation menu" aria-expanded="false"
                aria-controls="mobile-drawer">
            <span class="ham-bar"></span>
            <span class="ham-bar"></span>
            <span class="ham-bar"></span>
        </button>

    </div>
</nav>

{{-- ══════════════════════════════════════════════════════════════
     MOBILE DRAWER  (slide in from right)
══════════════════════════════════════════════════════════════ --}}
<div id="mobile-drawer" class="mob-drawer" aria-hidden="true" role="dialog"
     aria-label="Navigation menu" aria-modal="true">

    <div class="mob-drawer-head">
        {{-- Logo inside drawer --}}
        <div class="mob-drawer-logo">
            <div class="nav-monogram" aria-hidden="true">
                <svg viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg" width="36" height="36">
                    <circle cx="21" cy="21" r="21" fill="#E07818"/>
                    <text x="21" y="27" text-anchor="middle"
                          font-family="Georgia,serif" font-size="18"
                          font-weight="900" fill="white">K</text>
                </svg>
            </div>
            <div>
                <span class="mob-logo-acronym">KWDT</span>
                <span class="mob-logo-name">Katosi Women Development Trust</span>
            </div>
        </div>
        <button class="mob-close" id="mob-close" aria-label="Close menu">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    <nav class="mob-nav">

        <a href="{{ route('home') }}" class="mob-link">Home</a>

        {{-- Accordion: About --}}
        <div class="mob-accordion">
            <button class="mob-link mob-acc-btn" aria-expanded="false">
                About Us
                <svg class="mob-acc-arrow" width="16" height="16" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2.5">
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

        <a href="{{ route('projects.index') }}" class="mob-link">Projects</a>

        {{-- Accordion: Blog --}}
        <div class="mob-accordion">
            <button class="mob-link mob-acc-btn" aria-expanded="false">
                Blog &amp; News
                <svg class="mob-acc-arrow" width="16" height="16" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2.5">
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

        {{-- Accordion: Resources --}}
        <div class="mob-accordion">
            <button class="mob-link mob-acc-btn" aria-expanded="false">
                Resources
                <svg class="mob-acc-arrow" width="16" height="16" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2.5">
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
            Donate Now
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
        <p class="mob-tagline">"the future in our hands"</p>
    </div>
</div>

{{-- Backdrop --}}
<div id="mob-backdrop" class="mob-backdrop"></div>

@push('scripts')
<script>
(function () {
    // ── Scroll → .scrolled
    const nav = document.getElementById('main-nav');
    function onScroll() { nav.classList.toggle('scrolled', window.scrollY > 40); }
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    // ── Mobile drawer
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
        // Focus first focusable element
        drawer.querySelector('button,a').focus();
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

    // ── Mobile accordions
    drawer.querySelectorAll('.mob-acc-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const isOpen = btn.getAttribute('aria-expanded') === 'true';
            // close all
            drawer.querySelectorAll('.mob-acc-btn').forEach(b => {
                b.setAttribute('aria-expanded', 'false');
                b.closest('.mob-accordion').classList.remove('is-open');
            });
            // open this one if it was closed
            if (!isOpen) {
                btn.setAttribute('aria-expanded', 'true');
                btn.closest('.mob-accordion').classList.add('is-open');
            }
        });
    });
})();
</script>
@endpush