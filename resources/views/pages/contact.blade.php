<x-layouts.app
    title="Contact Us"
    metaDescription="Get in touch with Katosi Women Development Trust — based in Uganda.">

    {{-- ── Page Hero ─────────────────────────────────────────── --}}
    <div class="page-hero page-hero--short">
        <div class="page-hero-content">
            <span class="section-label" style="color:var(--orange-light)">Get in Touch</span>
            <h1 class="page-title">Contact Us</h1>
        </div>
    </div>

    <section class="contact-section">
        <div class="contact-grid">

            <div class="contact-info reveal">
                <h2>Reach Out to KWDT</h2>
                <p>
                    Whether you're interested in partnering, volunteering, donating,
                    or simply learning more about our work — we'd love to hear from you.
                </p>

                <dl class="contact-details">
                    <dt>📍 Address</dt>
                    <dd>Katosi Landing Site, Mukono District, Uganda</dd>

                    <dt>📧 Email</dt>
                    <dd><a href="mailto:info@katosi.org">info@katosi.org</a></dd>

                    <dt>📱 Phone</dt>
                    <dd><a href="tel:+256414340852">+256 414 340 852</a></dd>

                    <dt>🕐 Office Hours</dt>
                    <dd>Monday – Friday, 8:00 AM – 5:00 PM (EAT)</dd>
                </dl>

                <div class="contact-social">
                    <a href="https://www.instagram.com/kwdt_uganda" target="_blank" rel="noopener">Instagram</a>
                    <a href="https://www.facebook.com/kwdt" target="_blank" rel="noopener">Facebook</a>
                </div>
            </div>

            <div class="contact-form-wrap reveal">
                @livewire('contact-form')
            </div>

        </div>
    </section>

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
