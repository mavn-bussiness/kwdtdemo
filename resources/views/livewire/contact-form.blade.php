<div class="contact-form-component">

    <style>
        /* ── Contact form component ────────────────────────────── */
        .contact-form-component {
            width: 100%;
        }

        /* Success state */
        .form-success-state {
            display: flex; flex-direction: column; align-items: flex-start;
            gap: 1rem; padding: 2.5rem;
            background: var(--orange-pale);
            border: 1px solid var(--cream-dark);
            border-left: 4px solid var(--forest-mid);
            border-radius: var(--r-lg);
        }
        .success-icon { font-size: 2rem; }
        .form-success-state h3 {
            font-family: var(--font-display); font-size: 1.4rem; font-weight: 700;
            color: var(--earth);
        }
        .form-success-state p {
            font-size: .95rem; color: var(--earth-muted); line-height: 1.7;
        }
        .mt-4 { margin-top: 1rem; }

        /* Error banner */
        .form-error {
            background: #fef2f2; border: 1px solid #fecaca;
            border-left: 4px solid #ef4444;
            border-radius: var(--r-sm);
            padding: .85rem 1.1rem;
            font-size: .9rem; color: #b91c1c;
            margin-bottom: 1.25rem;
        }
        .form-error a { color: #b91c1c; text-decoration: underline; }

        /* Form layout */
        .contact-form {
            display: flex; flex-direction: column; gap: 1.25rem;
        }
        .form-row {
            display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;
        }
        .form-group {
            display: flex; flex-direction: column; gap: .4rem;
        }
        .form-group label {
            font-size: .8rem; font-weight: 600;
            color: var(--earth-mid);
            text-transform: uppercase; letter-spacing: .08em;
        }
        .required { color: var(--orange); }

        /* Inputs */
        .form-input {
            width: 100%;
            font-family: var(--font-body); font-size: .95rem;
            padding: .75rem 1rem;
            background: var(--white);
            border: 1.5px solid var(--cream-dark);
            border-radius: var(--r-md);
            color: var(--earth);
            outline: none;
            transition: border-color .2s, box-shadow .2s;
            -webkit-appearance: none;
        }
        .form-input::placeholder { color: var(--earth-muted); opacity: .6; }
        .form-input:focus {
            border-color: var(--orange);
            box-shadow: 0 0 0 3px rgba(224,120,24,.1);
        }
        .form-input.input-error {
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239,68,68,.08);
        }
        .form-textarea {
            resize: vertical; min-height: 140px;
        }

        /* Validation error text */
        .error-msg {
            font-size: .78rem; color: #ef4444;
            margin-top: -.1rem;
        }

        /* Submit button loading state */
        .btn-loading { opacity: .7; cursor: not-allowed; }

        @media (max-width: 600px) {
            .form-row { grid-template-columns: 1fr; }
        }
    </style>

    @if($state === 'success')
        <div class="form-success-state">
            <div class="success-icon">✅</div>
            <h3>Message sent!</h3>
            <p>Thank you for reaching out. We'll get back to you within 2 business days.</p>
            <button wire:click="$set('state', 'idle')" class="btn-outline mt-4">
                Send another message
            </button>
        </div>

    @else
        <form wire:submit="send" class="contact-form">

            @if($state === 'error')
                <div class="form-error">
                    Something went wrong. Please email us directly at
                    <a href="mailto:info@katosi.org">info@katosi.org</a>.
                </div>
            @endif

            <div class="form-row">
                <div class="form-group">
                    <label for="name">Full Name <span class="required">*</span></label>
                    <input type="text"
                           id="name"
                           wire:model="name"
                           placeholder="Your full name"
                           class="form-input @error('name') input-error @enderror">
                    @error('name') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email Address <span class="required">*</span></label>
                    <input type="email"
                           id="email"
                           wire:model="email"
                           placeholder="your@email.com"
                           class="form-input @error('email') input-error @enderror">
                    @error('email') <span class="error-msg">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="subject">Subject <span class="required">*</span></label>
                <input type="text"
                       id="subject"
                       wire:model="subject"
                       placeholder="What's this about?"
                       class="form-input @error('subject') input-error @enderror">
                @error('subject') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="message">Message <span class="required">*</span></label>
                <textarea id="message"
                          wire:model="message"
                          placeholder="Tell us how we can help…"
                          rows="6"
                          class="form-input form-textarea @error('message') input-error @enderror"></textarea>
                @error('message') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <button type="submit"
                    wire:loading.attr="disabled"
                    wire:loading.class="btn-loading"
                    class="btn-primary">
                <span wire:loading.remove>
                    Send Message
                    <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5" style="display:inline-block;vertical-align:middle;margin-left:.25rem">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </span>
                <span wire:loading>Sending…</span>
            </button>

        </form>
    @endif

</div>