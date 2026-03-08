<x-layouts.app
    title="Thank You"
    metaDescription="Donation successful">

    <section class="section text-center" style="min-height:60vh; display:flex; flex-direction:column; align-items:center; justify-content:center">

        {{-- Animated checkmark --}}
        <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6"
             style="background:rgba(42,90,58,.1); border:2px solid rgba(42,90,58,.25);
                    animation:fadeUp .6s both">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 stroke-width="2.5" style="color:var(--forest)">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
        </div>

        <h1 style="animation:fadeUp .6s .1s both; opacity:0">
            Thank you for your donation!
        </h1>
        <p style="animation:fadeUp .6s .2s both; opacity:0">
            Your support helps us make a difference in Uganda's fishing communities.
        </p>

        <div class="flex items-center gap-3 justify-center flex-wrap mt-2"
             style="animation:fadeUp .6s .3s both; opacity:0">
            <a href="{{ route('home') }}" class="btn-primary transition-all hover:-translate-y-0.5">
                Return to Home
            </a>
            <a href="{{ route('blog.index') }}"
               class="btn-outline transition-all hover:-translate-y-0.5">
                Read Our Stories
            </a>
        </div>

    </section>

</x-layouts.app>