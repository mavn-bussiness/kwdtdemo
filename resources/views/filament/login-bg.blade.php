@if(str_contains(request()->path(), 'login'))
@php
    $images = [
        'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/82eada9f-8188-4ebd-bab8-3fdcf85ca5f8/ARCHE_UGANDA_194.jpg',
        'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/0a689bfb-2ee0-4451-ae42-f9fc54f37d71/ARCHE_UGANDA_196.jpg',
        'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/d764e888-bfec-47a8-b5a6-a1f0f288a166/DSC05383.JPG',
        'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/c8973b94-5f49-4092-974c-26e2359d0baa/ARCHE_UGANDA_218.jpg',
        'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/fc6e9483-6da8-4944-b548-91aef5bb9f99/ARCHE_UGANDA_204.jpg',
        'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/f1a11664-9d66-411b-9d02-1f3158773ad9/DSC08536.JPG',
    ];
    $count    = count($images);
    $duration = 7;   // seconds each image is visible
    $total    = $count * $duration;
@endphp

<style>
    body { background: #0d0600 !important; }

    /* ── Slideshow container ─────────────────────────── */
    #kwdt-bg {
        position: fixed;
        inset: 0;
        z-index: 0;
        overflow: hidden;
    }

    /* Each slide */
    .kwdt-slide {
        position: absolute;
        inset: 0;
        opacity: 0;
        will-change: opacity, transform;
    }

    .kwdt-slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        filter: sepia(0.2) contrast(1.08) brightness(0.65) saturate(1.15);
    }

    /* ── Ken Burns keyframes — each slide gets a unique pan/zoom ── */

    /* Slide 1: slow zoom in from centre */
    .kwdt-slide:nth-child(1) img {
        animation: kb-zoom-in {{ $total }}s linear infinite;
        animation-delay: 0s;
    }
    /* Slide 2: slow zoom out + drift right */
    .kwdt-slide:nth-child(2) img {
        animation: kb-zoom-out-right {{ $total }}s linear infinite;
        animation-delay: 0s;
    }
    /* Slide 3: pan left */
    .kwdt-slide:nth-child(3) img {
        animation: kb-pan-left {{ $total }}s linear infinite;
        animation-delay: 0s;
    }
    /* Slide 4: zoom in + drift up */
    .kwdt-slide:nth-child(4) img {
        animation: kb-zoom-in-up {{ $total }}s linear infinite;
        animation-delay: 0s;
    }
    /* Slide 5: zoom out from top-left */
    .kwdt-slide:nth-child(5) img {
        animation: kb-zoom-out-tl {{ $total }}s linear infinite;
        animation-delay: 0s;
    }
    /* Slide 6: pan right + slight zoom */
    .kwdt-slide:nth-child(6) img {
        animation: kb-pan-right {{ $total }}s linear infinite;
        animation-delay: 0s;
    }

    @keyframes kb-zoom-in        { from { transform: scale(1.0) translate(0,0); }    to { transform: scale(1.18) translate(0,0); } }
    @keyframes kb-zoom-out-right { from { transform: scale(1.18) translate(-2%,0); } to { transform: scale(1.0)  translate(2%,0); } }
    @keyframes kb-pan-left       { from { transform: scale(1.12) translate(3%,0); }  to { transform: scale(1.12) translate(-3%,0); } }
    @keyframes kb-zoom-in-up     { from { transform: scale(1.0)  translate(0,2%); }  to { transform: scale(1.15) translate(0,-2%); } }
    @keyframes kb-zoom-out-tl    { from { transform: scale(1.15) translate(-2%,-2%); } to { transform: scale(1.0) translate(0,0); } }
    @keyframes kb-pan-right      { from { transform: scale(1.1)  translate(-3%,0); } to { transform: scale(1.1)  translate(3%,0); } }

    /* ── Opacity / crossfade timing per slide ─────────── */
    @php
        $fadeDuration = 1.2; // crossfade seconds
    @endphp
    @for($i = 0; $i < $count; $i++)
    @php
        $start     = ($i * $duration) / $total * 100;
        $fadeIn    = $start + ($fadeDuration / $total * 100);
        $fadeOut   = (($i + 1) * $duration - $fadeDuration) / $total * 100;
        $end       = (($i + 1) * $duration) / $total * 100;
        // Clamp to 100
        $fadeOut   = min($fadeOut, 99);
        $end       = min($end, 100);
    @endphp
    .kwdt-slide:nth-child({{ $i + 1 }}) {
        animation: slide-{{ $i }} {{ $total }}s linear infinite;
    }
    @keyframes slide-{{ $i }} {
        0%                        { opacity: 0; }
        {{ $start }}%             { opacity: 0; }
        {{ $fadeIn }}%            { opacity: 1; }
        {{ $fadeOut }}%           { opacity: 1; }
        {{ $end }}%               { opacity: 0; }
        100%                      { opacity: 0; }
    }
    @endfor

    /* ── Scanlines ───────────────────────────────────── */
    #kwdt-scanlines {
        position: fixed;
        inset: 0;
        z-index: 1;
        pointer-events: none;
        background: repeating-linear-gradient(
            to bottom,
            transparent 0px,
            transparent 3px,
            rgba(0,0,0,0.13) 3px,
            rgba(0,0,0,0.13) 4px
        );
    }

    /* ── Vignette ────────────────────────────────────── */
    #kwdt-vignette {
        position: fixed;
        inset: 0;
        z-index: 2;
        pointer-events: none;
        background: radial-gradient(
            ellipse 110% 100% at 50% 50%,
            transparent 45%,
            rgba(0,0,0,0.72) 100%
        );
    }

    /* ── Orange tint overlay ─────────────────────────── */
    #kwdt-tint {
        position: fixed;
        inset: 0;
        z-index: 3;
        pointer-events: none;
        background: radial-gradient(
            ellipse 70% 60% at 50% 50%,
            rgba(255,107,0,0.04) 0%,
            transparent 100%
        );
    }

    /* ── Form card — restore native Filament styling ─── */
    .fi-simple-layout { position: relative; z-index: 10; }
    .fi-simple-page {
        background: rgba(255,255,255,0.93) !important;
        backdrop-filter: blur(8px) !important;
        border-radius: 1rem !important;
        box-shadow: 0 25px 60px rgba(0,0,0,0.5), 0 0 0 1px rgba(255,255,255,0.1) !important;
        border: none !important;
    }

    /* ── Corner watermark ────────────────────────────── */
    #kwdt-watermark {
        position: fixed;
        bottom: 1.5rem;
        right: 1.75rem;
        z-index: 10;
        font-family: 'Courier New', monospace;
        font-size: 0.6rem;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: rgba(255,180,100,0.4);
        pointer-events: none;
        line-height: 1.7;
        text-align: right;
    }
</style>

<div id="kwdt-bg" aria-hidden="true">
    @foreach($images as $url)
        <div class="kwdt-slide">
            <img src="{{ $url }}" alt="" loading="{{ $loop->first ? 'eager' : 'lazy' }}">
        </div>
    @endforeach
</div>

<div id="kwdt-scanlines" aria-hidden="true"></div>
<div id="kwdt-vignette"  aria-hidden="true"></div>
<div id="kwdt-tint"      aria-hidden="true"></div>

<div id="kwdt-watermark" aria-hidden="true">
    KWDT &mdash; Est. 1995<br>Katosi &bull; Uganda
</div>
@endif
