<div>
    @if($state === 'success')
        <div style="padding:3rem 0; text-align:center;">
            <div style="width:64px; height:64px; background:rgba(46,107,66,.1); border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 1.25rem;">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" stroke="#2e6b42" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <path d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h3 style="font-family:var(--font-display); font-size:1.5rem; font-weight:800; color:var(--earth); margin-bottom:.5rem;">Message Sent!</h3>
            <p style="color:var(--earth-muted); margin-bottom:2rem; line-height:1.65;">
                Thank you for reaching out. We'll get back to you within 2 business days.
            </p>
            <button wire:click="$set('state', 'idle')" class="btn-primary">Send Another Message</button>
        </div>
    @else

        {{-- Title — plain on the page, orange like Red Cross --}}
        <h3 class="contact-form-title">We love to hear from you</h3>

        @if($state === 'error')
            <div style="margin-bottom:1.25rem; padding:.75rem 1rem; background:#fef2f2; border-left:3px solid #ef4444; border-radius:0 var(--r-sm) var(--r-sm) 0; font-size:.875rem; color:#b91c1c;">
                <strong>Something went wrong.</strong>
                Please email us at <a href="mailto:info@katosi.org" style="font-weight:600; text-decoration:underline;">info@katosi.org</a>
            </div>
        @endif

        <form wire:submit="send" class="contact-plain-form">

            {{-- Name --}}
            <div class="cpf-field">
                <label class="cpf-label" for="name">Name <span class="cpf-req">*</span></label>
                <input type="text" id="name" wire:model="name"
                       class="cpf-input @error('name') cpf-input--error @enderror">
                @error('name')<span class="cpf-error">{{ $message }}</span>@enderror
            </div>

            {{-- Phone --}}
            <div class="cpf-field">
                <label class="cpf-label" for="phone">Phone <span class="cpf-req">*</span></label>
                <input type="tel" id="phone" wire:model="phone"
                       placeholder="+256 XXX XXX XXX"
                       class="cpf-input">
            </div>

            {{-- Email --}}
            <div class="cpf-field">
                <label class="cpf-label" for="email">Email <span class="cpf-req">*</span></label>
                <div style="position:relative;">
                    <input type="email" id="email" wire:model="email"
                           class="cpf-input @error('email') cpf-input--error @enderror"
                           style="padding-right:2.5rem;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"
                         style="position:absolute; right:.85rem; top:50%; transform:translateY(-50%); color:#999; pointer-events:none;">
                        <rect x="2" y="4" width="20" height="16" rx="2"/>
                        <path d="M2 7l10 7 10-7"/>
                    </svg>
                </div>
                @error('email')<span class="cpf-error">{{ $message }}</span>@enderror
            </div>

            {{-- Comments --}}
            <div class="cpf-field">
                <label class="cpf-label" for="message">Comments <span class="cpf-req">*</span></label>
                <textarea id="message" wire:model="message"
                          rows="7"
                          class="cpf-input cpf-textarea @error('message') cpf-input--error @enderror"></textarea>
                @error('message')<span class="cpf-error">{{ $message }}</span>@enderror
            </div>

            {{-- Submit — right-aligned --}}
            <div style="display:flex; justify-content:flex-end; margin-top:.75rem;">
                <button type="submit"
                        wire:loading.attr="disabled"
                        class="btn-primary"
                        style="min-width:150px; justify-content:center;">
                    <span wire:loading.remove>Submit Form</span>
                    <span wire:loading style="display:none; align-items:center; gap:.5rem;">
                        <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             style="animation:spin 1s linear infinite;">
                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" style="opacity:.25"/>
                            <path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" style="opacity:.75"/>
                        </svg>
                        Sending…
                    </span>
                </button>
            </div>

        </form>
    @endif
</div>
