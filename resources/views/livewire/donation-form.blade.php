<div class="df" x-data="{ step: @entangle('step') }">

    {{-- ══ STEP: AMOUNT ══════════════════════════════════════════ --}}
    <div x-show="step === 'amount'" x-transition:enter="df-fade-in" x-cloak>

        {{-- Amount pills --}}
        <div class="df-amounts">
            @foreach($amounts as $value => $label)
                <button
                    type="button"
                    wire:click="selectAmount('{{ $value }}')"
                    class="df-amt {{ $selectedAmount === $value ? 'is-active' : '' }}"
                    aria-pressed="{{ $selectedAmount === $value ? 'true' : 'false' }}"
                >{{ $value === 'custom' ? 'Custom' : '$'.number_format((float)$value) }}</button>
            @endforeach
        </div>

        {{-- Custom input --}}
        @if($selectedAmount === 'custom')
            <div class="df-custom">
                <div class="df-custom-currency">
                    <button type="button" wire:click="$set('currency','USD')"
                        class="df-curr {{ $currency === 'USD' ? 'is-active' : '' }}">USD</button>
                    <button type="button" wire:click="$set('currency','UGX')"
                        class="df-curr {{ $currency === 'UGX' ? 'is-active' : '' }}">UGX</button>
                </div>
                <input type="number" wire:model.live.debounce.400ms="customAmount"
                    class="df-input" min="1" step="1"
                    placeholder="{{ $currency === 'USD' ? 'Amount in USD' : 'Amount in UGX' }}"
                    autofocus>
            </div>
        @endif

        {{-- Impact text --}}
        <div class="df-impact">
            <span class="df-impact-dot" aria-hidden="true">💛</span>
            <span>{{ $this->impactText }}</span>
        </div>

        {{-- Payment method --}}
        <div class="df-methods-wrap">
            <span class="df-methods-label">Pay with</span>
            <div class="df-methods">
                <button type="button" wire:click="$set('paymentMethod','paypal')"
                    class="df-method {{ $paymentMethod === 'paypal' ? 'is-active' : '' }}">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M7.076 21.337H2.47a.641.641 0 01-.633-.74L4.944.901C5.026.382 5.474 0 5.998 0h7.46c2.57 0 4.578.543 5.69 1.81 1.01 1.15 1.304 2.42 1.012 4.287-.983 5.05-4.349 6.797-8.647 6.797h-2.19c-.524 0-.968.382-1.05.9l-1.12 7.106zm14.146-14.42a3.35 3.35 0 00-.607-.541c-.93 4.778-4.005 7.201-9.138 7.201h-2.19a.563.563 0 00-.556.479l-1.187 7.527h-.99l-.318 2.02a.56.56 0 00.554.647h3.882c.46 0 .85-.334.922-.788l.816-5.09a.932.932 0 01.923-.788h.58c3.76 0 6.705-1.528 7.565-5.946.36-1.847.174-3.388-.219-4.975z"/>
                    </svg>
                    PayPal
                </button>
                <button type="button" wire:click="$set('paymentMethod','mtn_momo')"
                    class="df-method {{ $paymentMethod === 'mtn_momo' ? 'is-active' : '' }}">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <rect x="5" y="2" width="14" height="20" rx="2"/>
                        <circle cx="12" cy="17" r="1" fill="currentColor" stroke="none"/>
                    </svg>
                    MTN MoMo
                </button>
                <button type="button" wire:click="$set('paymentMethod','airtel_money')"
                    class="df-method {{ $paymentMethod === 'airtel_money' ? 'is-active' : '' }}">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <rect x="5" y="2" width="14" height="20" rx="2"/>
                        <circle cx="12" cy="17" r="1" fill="currentColor" stroke="none"/>
                    </svg>
                    Airtel Money
                </button>
            </div>
        </div>

        @if($errorMessage)
            <p class="df-error" role="alert">⚠ {{ $errorMessage }}</p>
        @endif

        <button type="button" wire:click="proceedToDetails" class="df-submit">
            Continue
            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </button>

    </div>

    {{-- ══ STEP: DETAILS ══════════════════════════════════════════ --}}
    <div x-show="step === 'details'" x-transition:enter="df-fade-in" x-cloak>

        {{-- Summary bar --}}
        <div class="df-summary">
            <span class="df-summary-left">
                <span class="df-summary-amt">
                    {{ $currency }} {{ number_format($this->finalAmount) }}
                </span>
                <span class="df-summary-via">
                    via {{ match($paymentMethod) { 'paypal' => 'PayPal', 'mtn_momo' => 'MTN MoMo', 'airtel_money' => 'Airtel Money', default => $paymentMethod } }}
                </span>
            </span>
            <button type="button" wire:click="$set('step','amount')" class="df-change">← Change</button>
        </div>

        {{-- Anonymous --}}
        <label class="df-check-row">
            <input type="checkbox" wire:model.live="isAnonymous" class="df-checkbox">
            <span>Donate anonymously</span>
        </label>

        @unless($isAnonymous)
            <div class="df-field">
                <label class="df-label" for="df-name">Full Name <span class="df-req">*</span></label>
                <input id="df-name" type="text" wire:model="donorName"
                    class="df-input @error('donorName') is-error @enderror"
                    placeholder="Your full name" autocomplete="name">
                @error('donorName')<span class="df-field-err">{{ $message }}</span>@enderror
            </div>
            <div class="df-field">
                <label class="df-label" for="df-email">Email <span class="df-req">*</span></label>
                <input id="df-email" type="email" wire:model="donorEmail"
                    class="df-input @error('donorEmail') is-error @enderror"
                    placeholder="you@email.com" autocomplete="email">
                @error('donorEmail')<span class="df-field-err">{{ $message }}</span>@enderror
            </div>
        @endunless

        @if(in_array($paymentMethod, ['mtn_momo', 'airtel_money']))
            <div class="df-field">
                <label class="df-label" for="df-phone">
                    Mobile Number <span class="df-req">*</span>
                    <span class="df-hint">(registered with {{ $paymentMethod === 'mtn_momo' ? 'MTN' : 'Airtel' }})</span>
                </label>
                <div class="df-phone">
                    <span class="df-phone-code">+256</span>
                    <input id="df-phone" type="tel" wire:model="donorPhone"
                        class="df-input df-phone-input @error('donorPhone') is-error @enderror"
                        placeholder="7XX XXX XXX" autocomplete="tel">
                </div>
                @error('donorPhone')<span class="df-field-err">{{ $message }}</span>@enderror
            </div>
        @endif

        @if($expanded)
            <div class="df-field">
                <label class="df-label" for="df-reason">
                    Message <span class="df-hint">(optional)</span>
                </label>
                <textarea id="df-reason" wire:model="reason"
                    class="df-input df-textarea"
                    placeholder="Tell us what inspired your donation…"
                    rows="3" maxlength="500"></textarea>
            </div>
        @endif

        @if($errorMessage)
            <p class="df-error" role="alert">⚠ {{ $errorMessage }}</p>
        @endif

        <button type="button" wire:click="submitDonation"
            wire:loading.attr="disabled" wire:loading.class="is-loading"
            class="df-submit">
            <span wire:loading.remove wire:target="submitDonation">
                Donate {{ $currency }} {{ number_format($this->finalAmount) }}
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </span>
            <span wire:loading wire:target="submitDonation" class="df-loading-label">
                <svg class="df-spin" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/>
                </svg>
                Processing…
            </span>
        </button>

        <p class="df-secure">
            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
            Secured &amp; encrypted. We never store payment details.
        </p>

    </div>

    {{-- ══ STEP: PROCESSING ══════════════════════════════════════ --}}
    <div x-show="step === 'processing'" x-transition:enter="df-fade-in" x-cloak class="df-state">
        <svg class="df-spin df-spin--lg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/>
        </svg>
        <p class="df-state-title">Redirecting to payment…</p>
        <p class="df-state-sub">Please wait, do not close this window.</p>
    </div>

    {{-- ══ STEP: FAILED ══════════════════════════════════════════ --}}
    <div x-show="step === 'failed'" x-transition:enter="df-fade-in" x-cloak class="df-state">
        <div class="df-state-icon df-state-icon--fail">
            <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </div>
        <p class="df-state-title">Something went wrong</p>
        <p class="df-state-sub">{{ $errorMessage ?: "We couldn't process your donation. Please try again." }}</p>
        <button type="button" wire:click="resetForm" class="df-submit" style="margin-top:1rem">
            Try Again
        </button>
    </div>

</div>