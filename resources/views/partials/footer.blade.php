<footer class="kwdt-footer" role="contentinfo" aria-label="Site footer">

    {{-- ── Ugandan crane SVG pattern overlay ──────────────────── --}}
    <div class="footer-pattern" aria-hidden="true">
        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
            <defs>
                <pattern id="ugandaPattern" x="0" y="0" width="80" height="80" patternUnits="userSpaceOnUse">
                    {{-- Simplified crane silhouette --}}
                    <g fill="rgba(255,255,255,0.06)" transform="translate(10,10)">
                        <ellipse cx="30" cy="28" rx="12" ry="6"/>
                        <ellipse cx="30" cy="22" rx="5" ry="8"/>
                        <ellipse cx="30" cy="14" rx="3" ry="5"/>
                        <rect x="28" y="34" width="4" height="14" rx="2"/>
                        <ellipse cx="22" cy="30" rx="10" ry="3" transform="rotate(-20 22 30)"/>
                        <ellipse cx="38" cy="30" rx="10" ry="3" transform="rotate(20 38 30)"/>
                        <rect x="27" y="48" width="3" height="8" rx="1"/>
                        <rect x="32" y="48" width="3" height="8" rx="1"/>
                    </g>
                    {{-- Small diamond accent --}}
                    <rect x="60" y="60" width="8" height="8" rx="1" fill="rgba(255,255,255,0.04)" transform="rotate(45 64 64)"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#ugandaPattern)"/>
        </svg>
    </div>

    {{-- ── Top grid ─────────────────────────────────────────────── --}}
    <div class="footer-top">

        {{-- Brand --}}
        <div class="footer-brand">
            <a href="{{ route('home') }}" class="footer-logo-link" aria-label="KWDT – Home">
                <div class="footer-logo-wrap">
                    <img src="{{ asset('images/kwdt-logo.webp') }}" alt="KWDT Logo"
                         class="footer-logo-img" width="64" height="64" loading="lazy"
                         onerror="this.style.display='none'">
                </div>
                <div class="footer-logo-text">
                    <span class="footer-brand-name-full">Katosi Women<br>Development Trust</span>
                </div>
            </a>

            <p class="footer-tagline-quote">"the future in our hands"</p>

            <p class="footer-reg">NGO Reg. No. S.5914/6911 · NGO Bureau Uganda</p>

            <div class="footer-social">
                <a href="https://www.facebook.com/KatosiWomenDT" target="_blank" rel="noopener" class="footer-social-link" aria-label="Facebook">
                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
                </a>
                <a href="https://twitter.com/katosi_women" target="_blank" rel="noopener" class="footer-social-link" aria-label="X / Twitter">
                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                </a>
                <a href="https://www.linkedin.com/company/katosi-women-development-trust" target="_blank" rel="noopener" class="footer-social-link" aria-label="LinkedIn">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-4 0v7h-4v-7a6 6 0 016-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
                </a>
                <a href="https://www.instagram.com/katosi_women_development_trust/" target="_blank" rel="noopener" class="footer-social-link" aria-label="Instagram">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="0.5" fill="currentColor" stroke="none"/></svg>
                </a>
            </div>
        </div>

        {{-- About --}}
        <div class="footer-col">
            <h4>About Us</h4>
            <ul>
                <li><a href="{{ route('about.index') }}">Who We Are</a></li>
                <li><a href="{{ route('about.what-we-do') }}">What We Do</a></li>
                <li><a href="{{ route('about.index') }}#team">Meet the Team</a></li>
                <li><a href="{{ route('about.index') }}#partners">Our Partners</a></li>
                <li><a href="{{ route('awards') }}">Awards &amp; Recognition</a></li>
                <li><a href="{{ route('reports') }}">Annual Reports</a></li>
            </ul>
        </div>

        {{-- Programs --}}
        <div class="footer-col">
            <h4>Our Work</h4>
            <ul>
                <li><a href="{{ route('projects.index') }}">All Projects</a></li>
                <li><a href="{{ route('about.what-we-do') }}#economic">Economic Empowerment</a></li>
                <li><a href="{{ route('about.what-we-do') }}#wash">WASH Programme</a></li>
                <li><a href="{{ route('about.what-we-do') }}#education">Education</a></li>
                <li><a href="{{ route('about.what-we-do') }}#environment">Environment</a></li>
                <li><a href="{{ route('blog.index') }}">News &amp; Blog</a></li>
                <li><a href="{{ route('gallery') }}">Photo Gallery</a></li>
                <li><a href="{{ route('careers') }}">Careers</a></li>
            </ul>
        </div>

        {{-- Contact + Newsletter --}}
        <div class="footer-col">
            <h4>Get In Touch</h4>
            <address style="font-style:normal">
                <div class="footer-contact-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    <span>Katosi Landing Site, Mukono District, Uganda</span>
                </div>
                <div class="footer-contact-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.8 19.79 19.79 0 01.07 1.18 2 2 0 012 0h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L6.91 7.91a16 16 0 006.18 6.18l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
                    <a href="tel:+256414691842">+256 414 691 842</a>
                </div>
                <div class="footer-contact-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M2 7l10 7 10-7"/></svg>
                    <a href="mailto:info@katosi.org">info@katosi.org</a>
                </div>
                <div class="footer-contact-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"/></svg>
                    <a href="https://www.katosi.org" target="_blank" rel="noopener">www.katosi.org</a>
                </div>
            </address>

            {{-- Compact newsletter --}}
            <div class="footer-newsletter-inline" id="newsletter">
                <p class="footer-newsletter-label">Get our updates</p>
                @livewire('newslettersignup', ['compact' => true])
            </div>
        </div>

    </div>

    {{-- ── Bottom bar ──────────────────────────────────────────── --}}
    <div class="footer-bottom">
        <div class="footer-bottom-left">
            <p class="footer-bottom-copy">&copy; {{ date('Y') }} Katosi Women Development Trust. All rights reserved.</p>
        </div>
        <div class="footer-bottom-right">
            <nav class="footer-legal" aria-label="Legal links">
                <a href="{{ route('privacy') }}">Privacy</a>
                <span>·</span>
                <a href="{{ route('terms') }}">Terms</a>
                <span>·</span>
                <a href="{{ route('contact') }}">Contact</a>
                <span>·</span>
                <a href="{{ route('donate') }}">Donate</a>
            </nav>
            <p class="footer-powered">
                Powered by
                <a href="https://www.linkedin.com/in/mpanga-marvin/" target="_blank" rel="noopener" class="footer-mavn-link">MAVN</a>
            </p>
        </div>
    </div>

</footer>
