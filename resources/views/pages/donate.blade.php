<x-layouts.app
    title="Donate"
    metaDescription="Support KWDT's work empowering women in Uganda's fishing communities.">

    {{-- ── Page Hero ─────────────────────────────────────────── --}}
    <div class="news-hero">
        <div class="news-hero-bg">
            <img src="https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/82eada9f-8188-4ebd-bab8-3fdcf85ca5f8/ARCHE_UGANDA_194.jpg"
                 alt="KWDT community"
                 loading="eager">
        </div>
        <div class="news-hero-overlay"></div>
        <div class="news-hero-content">
            <span class="news-hero-label">Make an Impact</span>
            <h1 class="news-hero-title">Support Our Mission</h1>
            <p class="news-hero-sub">Every contribution makes a direct difference in the lives of women and communities across Uganda.</p>
        </div>
    </div>

    {{-- ── Main Content ───────────────────────────────────────── --}}
    <section class="donate-page-section">
        <div class="donate-page-grid">

            {{-- Left: Donation Form --}}
            <div class="donate-form-wrap reveal">
                <h2>Choose Your Contribution</h2>
                <p class="donate-sub">Enter any amount and select your preferred payment method.</p>
                @livewire('donation-form', ['expanded' => true])
            </div>

            {{-- Right: Trust signals + testimonial --}}
            <div class="reveal" style="animation-delay:0.15s;">

                {{-- Testimonial --}}
                <div class="donate-testimonial" style="margin-bottom:2rem;">
                    <blockquote>
                        "KWDT gave me the skills and the confidence to run my own fish-drying business.
                        My children are in school because of what we built together."
                    </blockquote>
                    <p style="font-size:.75rem; color:rgba(253,246,237,.45); font-family:var(--font-mono); letter-spacing:.08em; text-transform:uppercase; margin-top:.85rem;">
                        — Grace N., KWDT Beneficiary
                    </p>
                </div>

                {{-- Why donate --}}
                <div style="margin-bottom:2rem;">
                    <h3 style="font-family:var(--font-display); font-size:1.1rem; font-weight:700; color:var(--earth); margin-bottom:1.1rem;">Why Give to KWDT</h3>
                    <div style="display:flex; flex-direction:column; gap:.75rem;">

                        <div style="display:flex; align-items:flex-start; gap:.9rem; padding:.9rem 1rem; background:var(--white); border:1px solid var(--cream-dark); border-radius:var(--r-md);">
                            <div style="width:36px; height:36px; border-radius:var(--r-sm); background:var(--orange-pale); display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                                {{-- Users / community --}}
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--orange)" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                                    <circle cx="9" cy="7" r="4"/>
                                    <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                                </svg>
                            </div>
                            <div>
                                <p style="font-family:var(--font-display); font-size:.9rem; font-weight:700; color:var(--earth); margin-bottom:.2rem;">Community-Led</p>
                                <p style="font-size:.82rem; color:var(--earth-muted); line-height:1.55;">Programmes designed by and for women in Uganda's fishing communities.</p>
                            </div>
                        </div>

                        <div style="display:flex; align-items:flex-start; gap:.9rem; padding:.9rem 1rem; background:var(--white); border:1px solid var(--cream-dark); border-radius:var(--r-md);">
                            <div style="width:36px; height:36px; border-radius:var(--r-sm); background:var(--orange-pale); display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                                {{-- Chart / growth --}}
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--orange)" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/>
                                    <polyline points="16 7 22 7 22 13"/>
                                </svg>
                            </div>
                            <div>
                                <p style="font-family:var(--font-display); font-size:.9rem; font-weight:700; color:var(--earth); margin-bottom:.2rem;">Proven Impact</p>
                                <p style="font-size:.82rem; color:var(--earth-muted); line-height:1.55;">Over 30 years of measurable change since our founding in 1995.</p>
                            </div>
                        </div>

                        <div style="display:flex; align-items:flex-start; gap:.9rem; padding:.9rem 1rem; background:var(--white); border:1px solid var(--cream-dark); border-radius:var(--r-md);">
                            <div style="width:36px; height:36px; border-radius:var(--r-sm); background:var(--orange-pale); display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                                {{-- Shield / transparency --}}
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--orange)" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                    <path d="M9 12l2 2 4-4"/>
                                </svg>
                            </div>
                            <div>
                                <p style="font-family:var(--font-display); font-size:.9rem; font-weight:700; color:var(--earth); margin-bottom:.2rem;">Transparent &amp; Accountable</p>
                                <p style="font-size:.82rem; color:var(--earth-muted); line-height:1.55;">Annual reports published. Every shilling tracked and accounted for.</p>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Payment methods --}}
                <div class="payment-note">
                    <h4>Accepted Payment Methods</h4>
                    <div class="payment-logos">
                        {{-- PayPal badge --}}
                        <span class="payment-badge" style="display:inline-flex; align-items:center; gap:.4rem;">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor" style="color:#003087; flex-shrink:0;">
                                <path d="M7.076 21.337H2.47a.641.641 0 01-.633-.74L4.944.901C5.026.382 5.474 0 5.998 0h7.46c2.57 0 4.578.543 5.69 1.81 1.01 1.15 1.304 2.42 1.012 4.287-.983 5.05-4.349 6.797-8.647 6.797h-2.19c-.524 0-.968.382-1.05.9l-1.12 7.106zm14.146-14.42a3.35 3.35 0 00-.607-.541c-.93 4.778-4.005 7.201-9.138 7.201h-2.19a.563.563 0 00-.556.479l-1.187 7.527h-.99l-.318 2.02a.56.56 0 00.554.647h3.882c.46 0 .85-.334.922-.788l.816-5.09a.932.932 0 01.923-.788h.58c3.76 0 6.705-1.528 7.565-5.946.36-1.847.174-3.388-.219-4.975z"/>
                            </svg>
                            PayPal
                        </span>
                        {{-- MTN badge --}}
                        <span class="payment-badge" style="display:inline-flex; align-items:center; gap:.4rem;">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;">
                                <rect x="5" y="2" width="14" height="20" rx="2"/>
                                <path d="M9 7h6M9 11h6M9 15h4"/>
                                <circle cx="15.5" cy="15.5" r=".75" fill="currentColor" stroke="none"/>
                            </svg>
                            MTN Mobile Money
                        </span>
                        {{-- Airtel badge --}}
                        <span class="payment-badge" style="display:inline-flex; align-items:center; gap:.4rem;">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;">
                                <path d="M1.5 8.5a13 13 0 0121 0"/>
                                <path d="M5 12a9 9 0 0114 0"/>
                                <path d="M8.5 15.5a5 5 0 017 0"/>
                                <circle cx="12" cy="19" r=".75" fill="currentColor" stroke="none"/>
                            </svg>
                            Airtel Money
                        </span>
                    </div>
                    <p class="payment-security">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="display:inline; margin-right:.3rem; vertical-align:middle;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
                        </svg>
                        All transactions are encrypted and processed securely. KWDT never stores your payment details.
                    </p>
                </div>

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
