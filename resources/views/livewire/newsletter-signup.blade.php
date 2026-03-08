<div class="newsletter-signup {{ $compact ? 'newsletter-compact' : '' }}">

    @if($state === 'success')
    <p class="newsletter-success">✅ You're subscribed! Thanks for joining us.</p>

    @elseif($state === 'already')
    <p class="newsletter-already">You're already subscribed — thank you!</p>

    @else
    <form wire:submit="subscribe" class="newsletter-form">
        <input type="email"
               wire:model="email"
               placeholder="your@email.com"
               class="newsletter-input @error('email') input-error @enderror"
               required>

        <button type="submit"
                wire:loading.attr="disabled"
                class="newsletter-btn">
            <span wire:loading.remove>Subscribe</span>
            <span wire:loading>...</span>
        </button>
    </form>

    @error('email')
    <span class="error-msg">{{ $message }}</span>
    @enderror

    @if($state === 'error')
    <p class="newsletter-error">Something went wrong. Please try again.</p>
    @endif
    @endif

</div>
