<div class="newsletter-signup {{ $compact ? 'newsletter-compact' : '' }}">

    @if($state === 'success')
        <div class="newsletter-state newsletter-state--success" role="status">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" aria-hidden="true"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            <span>You're subscribed! Thank you for joining KWDT.</span>
        </div>

    @elseif($state === 'already')
        <div class="newsletter-state newsletter-state--info" role="status">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            <span>You're already subscribed — thank you!</span>
        </div>

    @else
        <form wire:submit="subscribe" class="newsletter-form" novalidate>

            <div class="newsletter-input-row">
                <input type="email"
                       wire:model="email"
                       placeholder="your@email.com"
                       class="newsletter-input @error('email') input-error @enderror"
                       autocomplete="email"
                       aria-label="Email address">

                <button type="submit"
                        wire:loading.attr="disabled"
                        class="newsletter-btn">
                    <span wire:loading.remove>Subscribe</span>
                    <span wire:loading aria-live="polite">Subscribing…</span>
                </button>
            </div>

            @error('email')
                <p class="newsletter-field-error" role="alert">{{ $message }}</p>
            @enderror

            <label class="newsletter-consent">
                <input type="checkbox"
                       wire:model="consent"
                       class="newsletter-consent-checkbox @error('consent') input-error @enderror">
                <span>
                    I agree to receive updates from KWDT. You can
                    <a href="{{ route('privacy') }}" target="_blank" rel="noopener">unsubscribe</a>
                    at any time.
                </span>
            </label>

            @error('consent')
                <p class="newsletter-field-error" role="alert">{{ $message }}</p>
            @enderror

            @if($state === 'error')
                <p class="newsletter-field-error" role="alert">Something went wrong. Please try again.</p>
            @endif

        </form>
    @endif

</div>
