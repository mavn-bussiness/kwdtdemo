<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found — Katosi Women Development Trust</title>
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800;900&family=Inter:wght@400;500;600&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    @if(file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/kwdt.css'])
    @else
        <link rel="stylesheet" href="{{ asset('css/kwdt.css') }}">
    @endif
    <style>
        .error-page {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: var(--cream);
        }
        .error-main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 6rem var(--space-md);
        }
        .error-inner {
            max-width: 680px;
            width: 100%;
            text-align: center;
        }
        .error-code {
            font-family: var(--font-display);
            font-size: clamp(6rem, 18vw, 12rem);
            font-weight: 900;
            line-height: 1;
            color: var(--cream-dark);
            letter-spacing: -.04em;
            margin-bottom: 0;
            position: relative;
            display: inline-block;
        }
        .error-code::after {
            content: '404';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, var(--orange) 0%, var(--orange-dark) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            opacity: .18;
        }
        .error-icon {
            width: 72px;
            height: 72px;
            background: var(--orange-pale);
            border-radius: var(--r-xl);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            color: var(--orange);
        }
        .error-icon svg { width: 36px; height: 36px; }
        .error-title {
            font-family: var(--font-display);
            font-size: clamp(1.6rem, 4vw, 2.4rem);
            font-weight: 800;
            color: var(--earth);
            line-height: 1.2;
            margin-bottom: 1rem;
        }
        .error-desc {
            font-size: 1.05rem;
            color: var(--earth-muted);
            line-height: 1.75;
            max-width: 48ch;
            margin: 0 auto 2.5rem;
        }
        .error-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 3.5rem;
        }
        .error-divider {
            border: none;
            border-top: 1px solid var(--cream-dark);
            margin-bottom: 2.5rem;
        }
        .error-links-label {
            font-family: var(--font-mono);
            font-size: .68rem;
            letter-spacing: .18em;
            text-transform: uppercase;
            color: var(--earth-muted);
            margin-bottom: 1.25rem;
        }
        .error-links {
            display: flex;
            gap: .75rem;
            justify-content: center;
            flex-wrap: wrap;
        }
        .error-link {
            font-size: .88rem;
            font-weight: 600;
            color: var(--earth-mid);
            border: 1.5px solid var(--cream-dark);
            border-radius: var(--r-pill);
            padding: .5rem 1.2rem;
            text-decoration: none;
            transition: border-color .2s, color .2s, background .2s;
        }
        .error-link:hover {
            border-color: var(--orange);
            color: var(--orange);
            background: var(--orange-pale);
        }
        @media (max-width: 480px) {
            .error-actions { flex-direction: column; align-items: center; }
            .error-actions a { width: 100%; justify-content: center; }
        }
    </style>
</head>
<body>
<div class="error-page">

    @include('partials.nav')

    <main class="error-main">
        <div class="error-inner">

            <div class="error-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    <line x1="11" y1="8" x2="11" y2="11"/>
                    <circle cx="11" cy="14" r=".5" fill="currentColor" stroke="none"/>
                </svg>
            </div>

            <div class="error-code" aria-hidden="true">404</div>

            <h1 class="error-title">Page not found</h1>

            <p class="error-desc">
                The page you're looking for doesn't exist or may have been moved.
                Try heading back to the homepage or exploring our programmes.
            </p>

            <div class="error-actions">
                <a href="{{ route('home') }}" class="btn-primary">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    Back to Homepage
                </a>
                <a href="{{ route('contact') }}" class="btn-outline">Contact Us</a>
            </div>

            <hr class="error-divider">

            <p class="error-links-label">You might be looking for</p>
            <div class="error-links">
                <a href="{{ route('about.index') }}" class="error-link">About KWDT</a>
                <a href="{{ route('projects.index') }}" class="error-link">Our Projects</a>
                <a href="{{ route('blog.index') }}" class="error-link">Blog &amp; News</a>
                <a href="{{ route('about.what-we-do') }}" class="error-link">What We Do</a>
                <a href="{{ route('donate') }}" class="error-link">Donate</a>
                <a href="{{ route('reports') }}" class="error-link">Reports</a>
            </div>

        </div>
    </main>

    @include('partials.footer')

</div>
@stack('scripts')
</body>
</html>
