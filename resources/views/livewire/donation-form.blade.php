<div class="donation-form-card donate-form-wrap"
     x-data="{
         get step() { return $wire.step },
         popup: null,
         openPayPal(url) {
             const mobile = /Mobi|Android|iPhone|iPad/i.test(navigator.userAgent);
             if (mobile) {
                 window.location.href = url;
                 return;
             }
             const w = 500, h = 650;
             const left = (screen.width / 2) - (w / 2);
             const top  = (screen.height / 2) - (h / 2);
             this.popup = window.open(url, 'paypal_checkout',
                 'width=' + w + ',height=' + h + ',top=' + top + ',left=' + left + ',scrollbars=yes');
             if (!this.popup) {
                 // Popup blocked — fall back to redirect
                 window.location.href = url;
             }
         }
     }"
     x-on:open-paypal.window="openPayPal($event.detail.url)"
     x-on:paypal-success.window="$wire.paymentSuccess()"
     x-on:paypal-failed.window="$wire.paymentFailed()">

    {{-- ── Card header ────────────────────────────────────────── --}}
    <div class="donation-form-header">
        <div style="display:flex; align-items:center; justify-content:space-between;">
            <div style="display:flex; align-items:center; gap:.65rem;">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" style="color:var(--orange-light); flex-shrink:0;">
                    <path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z"/>
                </svg>
                <span style="font-family:var(--font-display); font-weight:700; font-size:1rem; color:var(--white);">Make a Donation</span>
            </div>
            <span style="font-family:var(--font-mono); font-size:.68rem; letter-spacing:.1em; color:rgba(255,255,255,.45); background:rgba(255,255,255,.08); padding:.22rem .65rem; border-radius:var(--r-pill);">
                <span x-show="step === 'amount'">Step 1 of 2</span>
                <span x-show="step === 'details'" x-cloak>Step 2 of 2</span>
            </span>
        </div>
        <div style="margin-top:.9rem; height:2px; background:rgba(255,255,255,.12); border-radius:2px; overflow:hidden;">
            <div style="height:100%; background:var(--orange); border-radius:2px; transition:width .4s ease;"
                 :style="step === 'amount' ? 'width:50%' : 'width:100%'"></div>
        </div>
    </div>

    <div class="donation-form-body">

        {{-- ══ STEP: AMOUNT ══════════════════════════════════════════ --}}
        <div x-show="step === 'amount'" x-transition:enter="transition duration-300 ease-out" x-cloak>

            <p style="font-family:var(--font-mono); font-size:.68rem; letter-spacing:.18em; text-transform:uppercase; color:var(--orange); margin-bottom:1.5rem;">Enter Your Amount</p>

            <div class="df-field" style="margin-bottom:1.5rem;">
                <div style="position:relative;">
                    <span style="position:absolute; left:1rem; top:50%; transform:translateY(-50%); font-family:var(--font-display); font-weight:700; font-size:1.2rem; color:var(--earth-muted); pointer-events:none; line-height:1;">
                        {{ $currency === 'USD' ? '$' : 'USh' }}
                    </span>
                    <input type="number"
                           wire:model.live.debounce.400ms="customAmount"
                           class="df-input"
                           style="padding-left:2.75rem; font-size:1.25rem; font-family:var(--font-display); font-weight:700; height:3.25rem;"
                           placeholder="0.00"
                           min="1" step="0.01">
                </div>
                @error('customAmount')
                <span class="df-field-err">{{ $message }}</span>
                @enderror
            </div>

            @if($errorMessage)
                <div class="df-error" style="margin-bottom:1rem;">{{ $errorMessage }}</div>
            @endif

            <button type="button" wire:click="proceedToDetails" class="df-submit">
                Continue to Details
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <path d="M5 12h14M12 5l7 7-7 7"/>
                </svg>
            </button>

            <p class="df-secure" style="justify-content:center; margin-top:.85rem;">
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
                </svg>
                Secured &amp; encrypted. We never store payment details.
            </p>
        </div>

        {{-- ══ STEP: DETAILS ══════════════════════════════════════════ --}}
        <div x-show="step === 'details'" x-transition:enter="transition duration-300 ease-out" x-cloak>

            <div class="df-summary" style="margin-bottom:1.25rem;">
                <div class="df-summary-left">
                    <span class="df-summary-via">Donation summary</span>
                    <span class="df-summary-amt">{{ $currency }} {{ number_format($this->finalAmount, 2) }}</span>
                    <span class="df-summary-via">via PayPal</span>
                </div>
                <button type="button" wire:click="$set('step','amount')" class="df-change">Change</button>
            </div>

            <label class="df-check-row" style="margin-bottom:1.25rem; padding:.85rem 1rem; background:var(--cream-mid); border-radius:var(--r-md);">
                <input type="checkbox" wire:model.live="isAnonymous" class="df-checkbox">
                <div>
                    <span style="font-weight:600; display:block;">Donate anonymously</span>
                    <span style="font-size:.78rem; color:var(--earth-muted);">Your name won't be listed publicly</span>
                </div>
            </label>

            @unless($isAnonymous)
                <div class="df-field" style="margin-bottom:1rem;">
                    <label class="df-label" for="donor-name">Full Name <span class="df-req">*</span></label>
                    <input id="donor-name" type="text" wire:model="donorName" placeholder="Your full name"
                           class="df-input @error('donorName') is-error @enderror">
                    @error('donorName')<span class="df-field-err">{{ $message }}</span>@enderror
                </div>

                <div class="df-field" style="margin-bottom:1rem;">
                    <label class="df-label" for="donor-email">Email Address <span class="df-req">*</span></label>
                    <input id="donor-email" type="email" wire:model="donorEmail" placeholder="you@example.com"
                           class="df-input @error('donorEmail') is-error @enderror">
                    @error('donorEmail')<span class="df-field-err">{{ $message }}</span>@enderror
                </div>
            @endunless

            @if($expanded)
                <div class="df-field" style="margin-bottom:1rem;">
                    <label class="df-label" for="reason">Message <span class="df-hint">(optional)</span></label>
                    <textarea id="reason" wire:model="reason" placeholder="Tell us what inspired your donation..."
                              rows="3" maxlength="500" class="df-input df-textarea"></textarea>
                </div>
            @endif

            @if($errorMessage)
                <div class="df-error" style="margin-bottom:1rem;">{{ $errorMessage }}</div>
            @endif

            <button type="button" wire:click="submitDonation" wire:loading.attr="disabled" class="df-submit">
                <span wire:loading.remove class="df-loading-label">
                    Complete Donation
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z"/>
                    </svg>
                </span>
                <span wire:loading class="df-loading-label" style="display:none;">
                    <svg class="df-spin" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" style="opacity:.25"/>
                        <path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" style="opacity:.75"/>
                    </svg>
                    Processing…
                </span>
            </button>

            <p class="df-secure" style="justify-content:center; margin-top:.75rem;">
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
                </svg>
                Secured &amp; encrypted. We never store payment details.
            </p>
        </div>

        {{-- ══ STEP: PROCESSING ══════════════════════════════════════ --}}
        <div x-show="step === 'processing'" x-transition:enter="transition duration-300 ease-out" x-cloak
             style="padding:3.5rem 0; text-align:center;">
            <svg class="df-spin df-spin--lg" style="margin:0 auto 1.25rem; display:block;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" style="opacity:.25"/>
                <path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" style="opacity:.75"/>
            </svg>
            <p class="df-state-title" style="text-align:center;">Complete your payment</p>
            <p class="df-state-sub" style="text-align:center; margin-top:.35rem;">A PayPal window has opened. Complete your payment there.</p>
            <p class="df-state-sub" style="text-align:center; margin-top:.5rem; font-size:.78rem; opacity:.7;">Didn't see it? <button type="button" style="background:none;border:none;color:var(--orange);cursor:pointer;font-size:.78rem;text-decoration:underline;" x-on:click="popup && popup.focus()">Click here to bring it back.</button></p>
        </div>

        {{-- ══ STEP: SUCCESS ══════════════════════════════════════════ --}}
        <div x-show="step === 'success'" x-transition:enter="transition duration-300 ease-out" x-cloak
             style="padding:2.5rem 0; text-align:center;">
            <div style="width:52px;height:52px;border-radius:50%;background:rgba(34,197,94,.15);border:2px solid rgba(34,197,94,.3);display:flex;align-items:center;justify-content:center;margin:0 auto 1.25rem;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="#22c55e" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <p class="df-state-title" style="text-align:center;">Thank you!</p>
            <p class="df-state-sub" style="text-align:center; margin-top:.35rem; margin-bottom:1.5rem;">Your donation has been received. We'll send a confirmation to your email.</p>
            <button type="button" wire:click="resetForm" class="df-submit" style="width:auto; padding:.75rem 2rem;">
                Donate Again
            </button>
        </div>

        {{-- ══ STEP: FAILED ══════════════════════════════════════════ --}}
        <div x-show="step === 'failed'" x-transition:enter="transition duration-300 ease-out" x-cloak
             style="padding:2.5rem 0; text-align:center;">
            <div class="df-state-icon df-state-icon--fail" style="margin:0 auto 1.25rem;">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </div>
            <p class="df-state-title" style="text-align:center;">Something went wrong</p>
            <p class="df-state-sub" style="text-align:center; margin-top:.35rem; margin-bottom:1.5rem;">
                {{ $errorMessage ?: "We couldn't process your donation. Please try again." }}
            </p>
            <button type="button" wire:click="resetForm" class="df-submit" style="width:auto; padding:.75rem 2rem;">
                Try Again
            </button>
        </div>

    </div>
</div>
