{{--
    KWDT FOOTER — Redesigned v5.0 with Lake Victoria pattern
    ─────────────────────────────────────────────────────────────
    Design: Deep earth (#2B1A0E) base with subtle Lake Victoria
    wave pattern and Ugandan map silhouette. Orange accent bar.
    Four-column grid with logo, social icons and contact details.
--}}

<footer class="kwdt-footer" role="contentinfo" aria-label="Site footer">

    {{-- ── Top grid: brand + 3 nav columns ──────────────────── --}}
    <div class="footer-top">

        {{-- Column 1: Brand with Logo ─────────────────────────── --}}
        <div class="footer-brand">
            <a href="{{ route('home') }}" class="footer-logo-link" aria-label="KWDT – Back to homepage">
                <div class="footer-logo-wrap">
                    {{-- Logo from public/images/kwdt-logo.webp --}}
                    <img
                        src="{{ asset('images/kwdt-logo.webp') }}"
                        alt="KWDT Logo"
                        class="footer-logo-img"
                        width="70"
                        height="70"
                        loading="lazy"
                        onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='block';"
                    >
                    <span class="footer-logo-fallback" style="display: none;">KWDT</span>
                </div>
                <div class="footer-logo-text">
                    <span class="footer-brand-name-full">Katosi Women<br>Development Trust</span>
                </div>
            </a>

            <p class="footer-tagline-quote">
                "the future in our hands"
            </p>

            <p class="footer-reg">
                NGO Reg. No. S.5914/6911 &nbsp;·&nbsp; NGO Bureau Uganda
            </p>

            {{-- Social icons ──────────────────────────────────── --}}
            <div class="footer-social" role="list" aria-label="Social media links">

                <a href="https://www.facebook.com/KatosiWomenDT" target="_blank" rel="noopener"
                   class="footer-social-link" aria-label="Facebook" role="listitem">
                    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/>
                    </svg>
                </a>

                <a href="https://twitter.com/katosi_women" target="_blank" rel="noopener"
                   class="footer-social-link" aria-label="Twitter / X" role="listitem">
                    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                    </svg>
                </a>

                <a href="https://www.linkedin.com/company/katosi-women-development-trust" target="_blank" rel="noopener"
                   class="footer-social-link" aria-label="LinkedIn" role="listitem">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" aria-hidden="true">
                        <path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6z"/>
                        <rect x="2" y="9" width="4" height="12"/>
                        <circle cx="4" cy="4" r="2"/>
                    </svg>
                </a>

                <a href="https://www.youtube.com/@katosiwomendevelopmenttrust" target="_blank" rel="noopener"
                   class="footer-social-link" aria-label="YouTube" role="listitem">
                    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M22.54 6.42a2.78 2.78 0 00-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46A2.78 2.78 0 001.46 6.42 29 29 0 001 12a29 29 0 00.46 5.58 2.78 2.78 0 001.95 1.96C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 001.95-1.96A29 29 0 0023 12a29 29 0 00-.46-5.58z"/>
                        <polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" fill="var(--orange)"/>
                    </svg>
                </a>

                {{-- Instagram - commented out as not found on site --}}
                {{--
                <a href="https://instagram.com/katosi_women" target="_blank" rel="noopener"
                   class="footer-social-link" aria-label="Instagram" role="listitem">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" aria-hidden="true">
                        <rect x="2" y="2" width="20" height="20" rx="5"/>
                        <circle cx="12" cy="12" r="4"/>
                        <circle cx="17.5" cy="6.5" r="0.5" fill="currentColor" stroke="none"/>
                    </svg>
                </a>
                --}}

            </div>
        </div>

        {{-- Column 2: Organisation links ───────────────────── --}}
        <div class="footer-col">
            <h4>Organisation</h4>
            <ul>
                <li><a href="{{ route('about.index') }}">Who We Are</a></li>
                <li><a href="{{ route('about.what-we-do') }}">What We Do</a></li>
                <li><a href="{{ route('about.index') }}#team">Our Team</a></li>
                <li><a href="{{ route('about.index') }}#partners">Our Partners</a></li>
                <li><a href="{{ route('awards') }}">Awards &amp; Recognition</a></li>
                <li><a href="{{ route('reports') }}">Annual Reports</a></li>
            </ul>
        </div>

        {{-- Column 3: Programs & resources ─────────────────── --}}
        <div class="footer-col">
            <h4>Programs</h4>
            <ul>
                <li><a href="{{ route('projects.index') }}">All Projects</a></li>
                <li><a href="{{ route('about.what-we-do') }}">Economic Empowerment</a></li>
                <li><a href="{{ route('about.what-we-do') }}">WASH</a></li>
                <li><a href="{{ route('about.what-we-do') }}">Education</a></li>
                <li><a href="{{ route('about.what-we-do') }}">Environment</a></li>
            </ul>

            <h4 class="mt-6">Resources</h4>
            <ul>
                <li><a href="{{ route('blog.index') }}">Blog &amp; News</a></li>
                <li><a href="{{ route('gallery') }}">Photo Gallery</a></li>
                <li><a href="{{ route('careers') }}">Careers</a></li>
            </ul>
        </div>

        {{-- Column 4: Contact details ───────────────────────── --}}
        <div class="footer-col">
            <h4>Get In Touch</h4>

            <address style="font-style:normal">
                <div class="footer-contact-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" aria-hidden="true">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/>
                        <circle cx="12" cy="10" r="3"/>
                    </svg>
                    <span>Katosi Landing Site,<br>Mukono District, Uganda</span>
                </div>

                <div class="footer-contact-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" aria-hidden="true">
                        <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.8 19.79 19.79 0 01.07 1.18 2 2 0 012 0h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L6.91 7.91a16 16 0 006.18 6.18l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/>
                    </svg>
                    <a href="tel:+256414691842">+256 414 691 842</a>
                </div>

                <div class="footer-contact-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" aria-hidden="true">
                        <rect x="2" y="4" width="20" height="16" rx="2"/>
                        <path d="M2 7l10 7 10-7"/>
                    </svg>
                    <a href="mailto:info@katosi.org">info@katosi.org</a>
                </div>

                <div class="footer-contact-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" aria-hidden="true">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="2" y1="12" x2="22" y2="12"/>
                        <path d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"/>
                    </svg>
                    <a href="https://www.katosi.org" target="_blank" rel="noopener">www.katosi.org</a>
                </div>
            </address>

            {{-- Donate CTA ────────────────────────────────────── --}}
            <div style="margin-top:1.75rem">
                <a href="{{ route('donate') }}" class="btn-primary" style="font-size:0.88rem;padding:0.75rem 1.75rem;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2.5" stroke-linecap="round" aria-hidden="true">
                        <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
                    </svg>
                    Donate Now
                </a>
            </div>
        </div>

    </div>{{-- /.footer-top --}}

    {{-- ── Bottom bar ─────────────────────────────────────────── --}}
    <div class="footer-bottom">

        <div class="footer-bottom-left">
            <p class="footer-bottom-copy">
                &copy; {{ date('Y') }} Katosi Women Development Trust. All rights reserved.
            </p>
            <span class="footer-bottom-motto">
                "the future in our hands"
            </span>
        </div>

        <div class="footer-bottom-right">
            <nav class="footer-legal" aria-label="Legal links">
                <a href="{{ route('privacy') }}">Privacy Policy</a>
                <span aria-hidden="true">·</span>
                <a href="{{ route('terms') }}">Terms of Service</a>
                <span aria-hidden="true">·</span>
                <a href="{{ route('contact') }}">Contact</a>
            </nav>
            <p class="footer-powered">
                Powered by
                <a href="https://www.linkedin.com/in/mpanga-marvin/" target="_blank" rel="noopener" class="footer-mavn-link">
                    MAVN
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/>
                        <polyline points="15 3 21 3 21 9"/>
                        <line x1="10" y1="14" x2="21" y2="3"/>
                    </svg>
                </a>
            </p>
        </div>

    </div>

</footer>
