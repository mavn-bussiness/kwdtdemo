<x-layouts.app
    title="Gallery"
    metaDescription="Photos from KWDT's work across Uganda's fishing and rural communities.">

    {{-- ── Hero with background image (matching contact/news pattern) ── --}}
    <div class="news-hero">
        <div class="news-hero-bg">
            <img src="https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/82eada9f-8188-4ebd-bab8-3fdcf85ca5f8/ARCHE_UGANDA_194.jpg"
                 alt="KWDT community"
                 loading="eager">
        </div>
        <div class="news-hero-overlay"></div>
        <div class="news-hero-content">
            <span class="news-hero-label">Resources</span>
            <h1 class="news-hero-title">Gallery</h1>
            <p class="news-hero-sub">Moments from our work across Uganda's fishing and rural communities.</p>
        </div>
    </div>

    {{-- ── Main gallery section ── --}}
    <section class="section" style="padding-top: 3rem;">
        @livewire('gallery-filter')
    </section>

    {{-- ── CTA Section (matching contact page pattern) ── --}}
    <div class="about-bottom-cta">
        <div class="about-bottom-cta-inner">
            <h2>Want to see more?</h2>
            <p>Follow our journey and stay updated with our latest projects and events.</p>
            <div class="about-cta-btns">
                <a href="{{ route('contact') }}" class="btn-primary">
                    Get in Touch
                </a>
                <a href="#" class="btn-outline" style="background:transparent;">
                    Follow Us
                </a>
            </div>
        </div>
    </div>

    {{-- Scroll reveal script --}}
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
