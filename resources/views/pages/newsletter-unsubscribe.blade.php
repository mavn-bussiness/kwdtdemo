<x-layouts.app
    title="Newsletter Unsubscribe"
    metaDescription="Manage your KWDT newsletter subscription">

    <section class="section text-center" style="min-height:60vh; display:flex; flex-direction:column; align-items:center; justify-content:center; gap:1.5rem">

        @if($status === 'success')

            <div style="width:4rem; height:4rem; border-radius:50%; background:rgba(22,163,74,.1); border:2px solid rgba(22,163,74,.25); display:flex; align-items:center; justify-content:center; margin:0 auto">
                <svg width="28" height="28" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5" style="color:#16a34a">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
            </div>

            <h1>You've been unsubscribed</h1>
            <p style="max-width:36rem; margin:0 auto">
                <strong>{{ $email }}</strong> has been removed from the KWDT newsletter.
                You won't receive any further emails from us.
            </p>
            <p style="color:var(--text-muted, #64748b); font-size:.9rem">
                Changed your mind?
                <a href="{{ route('home') }}#newsletter" style="color:var(--orange, #F5820A)">Re-subscribe here</a>.
            </p>

        @else

            <div style="width:4rem; height:4rem; border-radius:50%; background:rgba(220,38,38,.1); border:2px solid rgba(220,38,38,.25); display:flex; align-items:center; justify-content:center; margin:0 auto">
                <svg width="28" height="28" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5" style="color:#dc2626">
                    <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
            </div>

            <h1>Link not found</h1>
            <p style="max-width:36rem; margin:0 auto">
                This unsubscribe link is invalid or has already been used.
                If you're still receiving emails, please
                <a href="{{ route('contact') }}" style="color:var(--orange, #F5820A)">contact us</a>.
            </p>

        @endif

        <a href="{{ route('home') }}" class="btn-primary" style="margin-top:.5rem">
            Back to Home
        </a>

    </section>

</x-layouts.app>
