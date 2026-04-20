<x-layouts.app title="Testimonials" metaDescription="Hear from the women and communities whose lives have been transformed by KWDT's work across Uganda.">

    <div class="inner-page-header">
        <div class="inner-page-header-inner">
            <span class="inner-back-link">About</span>
            <h1 class="inner-page-title">Community Voices</h1>
            <p class="inner-page-sub">Hear from the women and communities whose lives have been transformed by KWDT's work.</p>
        </div>
    </div>

    <section class="section" style="padding-top: 3rem; padding-bottom: 4rem;">

        @php
            $fallback = [
                ['quote' => 'KWDT changed my life. I now run my own fish-processing business and can pay school fees for all my children.', 'name' => 'Fatuma N.', 'community' => 'Katosi Landing Site, Mukono', 'photo_url' => null],
                ['quote' => 'Before KWDT, I had no voice in my community. Today I lead a women\'s savings group of 40 members.', 'name' => 'Grace A.', 'community' => 'Kalangala District', 'photo_url' => null],
                ['quote' => 'The clean water project brought a borehole to our village. Our children no longer miss school due to waterborne illness.', 'name' => 'Sarah K.', 'community' => 'Buvuma Island', 'photo_url' => null],
                ['quote' => 'Through KWDT\'s education programme, I completed my tailoring certificate. I now employ two other women in my shop.', 'name' => 'Prossy M.', 'community' => 'Mukono District', 'photo_url' => null],
                ['quote' => 'KWDT taught us how to save together. Our group now has a loan fund that has helped 15 families start businesses.', 'name' => 'Harriet B.', 'community' => 'Kalangala Island', 'photo_url' => null],
                ['quote' => 'I used to walk 5 km for water every morning. Now with the new borehole, I have time to tend my garden and earn income.', 'name' => 'Juliet N.', 'community' => 'Buvuma District', 'photo_url' => null],
            ];
            $items = $testimonials->count() ? $testimonials : collect($fallback);
        @endphp

        <div class="testimonials-page-grid">
            @foreach($items as $t)
                @php
                    $isModel = is_object($t);
                    $quote     = $isModel ? $t->quote     : $t['quote'];
                    $name      = $isModel ? $t->name      : $t['name'];
                    $community = $isModel ? $t->community : $t['community'];
                    $photo     = $isModel ? $t->photo_url : $t['photo_url'];
                @endphp
                <div class="testimonial-page-card reveal">
                    <div class="testimonial-page-quote-mark" aria-hidden="true">&ldquo;</div>
                    <blockquote class="testimonial-page-quote">{{ $quote }}</blockquote>
                    <div class="testimonial-page-author">
                        @if($photo)
                            <img src="{{ $photo }}" alt="{{ $name }}" class="testimonial-page-photo" loading="lazy">
                        @else
                            <div class="testimonial-page-photo testimonial-page-photo--placeholder" aria-hidden="true">
                                <svg width="26" height="26" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                        @endif
                        <div class="testimonial-page-meta">
                            <span class="testimonial-page-name">{{ $name }}</span>
                            @if($community)
                                <span class="testimonial-page-community">{{ $community }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </section>

    <div class="about-bottom-cta">
        <div class="about-bottom-cta-inner">
            <h2>Be Part of the Story</h2>
            <p>Your support helps more women build the lives they deserve.</p>
            <div class="about-cta-btns">
                <a href="{{ route('donate') }}" class="btn-primary">Donate Now</a>
                <a href="{{ route('contact') }}" class="btn-outline" style="background:transparent;">Get in Touch</a>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
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
