<x-layouts.app
    title="Donation Failed"
    metaDescription="Error processing donation">

    <section class="section text-center" style="min-height:60vh; display:flex; flex-direction:column; align-items:center; justify-content:center">

        {{-- Icon --}}
        <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6"
             style="background:rgba(200,90,42,.1); border:2px solid rgba(200,90,42,.2)">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 stroke-width="2" style="color:var(--clay)">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </div>

        <h1>Something went wrong</h1>
        <p>We were unable to process your donation. Please try again or contact us for help.</p>

        <div class="flex items-center gap-3 justify-center flex-wrap mt-2">
            <a href="{{ route('donate') }}" class="btn-primary">
                Retry Donation
            </a>
            <a href="{{ route('contact') }}"
               class="btn-outline transition-all hover:-translate-y-0.5">
                Contact Us
            </a>
        </div>

    </section>

</x-layouts.app>