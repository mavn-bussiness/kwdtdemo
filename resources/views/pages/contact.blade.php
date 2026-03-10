<x-layouts.app
    title="Contact Us"
    metaDescription="Get in touch with Katosi Women Development Trust — based in Uganda.">

    {{-- ── Page Hero ─────────────────────────────────────────── --}}
    <div class="news-hero">
        <div class="news-hero-bg">
            <img src="https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/82eada9f-8188-4ebd-bab8-3fdcf85ca5f8/ARCHE_UGANDA_194.jpg"
                 alt="KWDT community" loading="eager">
        </div>
        <div class="news-hero-overlay"></div>
        <div class="news-hero-content">
            <span class="news-hero-label">Get in Touch</span>
            <h1 class="news-hero-title">Contact Us</h1>
            <p class="news-hero-sub">We're here to answer your questions and discuss how you can support our mission.</p>
        </div>
    </div>

    {{-- ── Main Content ───────────────────────────────────────── --}}
    <div class="contact-section">
        <div class="contact-grid">

            {{-- ── Left: Physical address details + map ─────────── --}}
            <div class="reveal">
                <h2 class="contact-col-title">Physical Address</h2>

                <div class="contact-rows">

                    {{-- Address --}}
                    <div class="contact-row">
                        <div class="contact-row-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/>
                                <circle cx="12" cy="9" r="2.5"/>
                            </svg>
                        </div>
                        <div class="contact-row-body">
                            <p>Katosi Landing Site</p>
                            <p>Mukono District, Uganda.</p>
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="contact-row">
                        <div class="contact-row-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="4" width="20" height="16" rx="2"/>
                                <path d="M2 7l10 7 10-7"/>
                            </svg>
                        </div>
                        <div class="contact-row-body">
                            <a href="mailto:info@katosi.org">info@katosi.org</a>
                        </div>
                    </div>

                    {{-- Main phone --}}
                    <div class="contact-row">
                        <div class="contact-row-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.09 12a19.79 19.79 0 01-3.07-8.67A2 2 0 012 1.24h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/>
                            </svg>
                        </div>
                        <div class="contact-row-body">
                            <a href="tel:+256414340852">+256 414 340 852</a>
                        </div>
                    </div>

                    {{-- Office hours --}}
                    <div class="contact-row">
                        <div class="contact-row-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"/>
                                <path d="M12 6v6l4 2"/>
                            </svg>
                        </div>
                        <div class="contact-row-body">
                            <p>Monday – Friday</p>
                            <p>8:00 AM – 5:00 PM (EAT)</p>
                        </div>
                    </div>

                </div>

                {{-- Social links --}}
                <div class="contact-social" style="margin-top:1.75rem;">
                    <a href="https://www.facebook.com/KatosiWomenDT" target="_blank" rel="noopener">Facebook</a>
                    <a href="https://twitter.com/katosi_women" target="_blank" rel="noopener">X (Twitter)</a>
                    <a href="https://www.linkedin.com/company/katosi-women-development-trust" target="_blank" rel="noopener">LinkedIn</a>
                </div>

                {{-- Embedded map --}}
                <div class="contact-map">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.7589092256367!2d32.54749867568237!3d0.312676664030051!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x177dbca66cc09f0d%3A0x541c67d995d760a4!2sKatosi%20Women%20Development%20Trust!5e0!3m2!1sen!2sug!4v1773083527947!5m2!1sen!2sug"
                        width="100%" height="100%"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Katosi Women Development Trust">
                    </iframe>
                </div>
            </div>

            {{-- ── Right: Contact form ───────────────────────────── --}}
            <div class="reveal" style="animation-delay:0.15s;">
                @livewire('contact-form')
            </div>

        </div>
    </div>

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
