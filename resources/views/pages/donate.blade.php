<x-layouts.app
    title="Donate"
    metaDescription="Support KWDT's work empowering women in Uganda's fishing communities.">

    <div class="page-hero page-hero--short">
        <div class="page-hero-content">
            <span class="section-label" style="color:var(--orange-light)">Make an Impact</span>
            <h1 class="page-title">Support Our Mission</h1>
            <p class="page-intro">Every contribution makes a direct difference.</p>
        </div>
    </div>

    <section class="donate-page-section">
        <div class="donate-page-grid">

            <div class="donate-form-wrap reveal">
                <h2>Choose Your Contribution</h2>
                <p class="donate-sub">Select an amount and payment method below.</p>
                @livewire('donation-form', ['expanded' => true])
            </div>

            <div class="donate-meta reveal">
                <div class="payment-note">
                    <h4>Payment Methods Accepted</h4>
                    <div class="payment-logos">
                        <span class="payment-badge">💳 PayPal</span>
                        <span class="payment-badge">📱 MTN Mobile Money</span>
                        <span class="payment-badge">📱 Airtel Money</span>
                    </div>
                    <p class="payment-security">
                        🔒 All transactions are encrypted and processed securely.
                        KWDT never stores your payment details.
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
