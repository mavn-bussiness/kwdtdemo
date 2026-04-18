<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server Error — Katosi Women Development Trust</title>
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700;800;900&family=Inter:wght@400;500&family=DM+Mono:wght@400&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --orange:      #FF6B00;
            --orange-dark: #E05A00;
            --orange-pale: #FFF0E6;
            --earth:       #1F2937;
            --earth-mid:   #374151;
            --earth-muted: #9CA3AF;
            --cream:       #FFFFFF;
            --cream-mid:   #F7F7F7;
            --cream-dark:  #E5E7EB;
            --white:       #FFFFFF;
        }
        html { font-size: 16px; }
        body {
            font-family: 'Inter', system-ui, sans-serif;
            background: var(--cream-mid);
            color: var(--earth);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            -webkit-font-smoothing: antialiased;
        }
        a { color: inherit; text-decoration: none; }

        /* ── Minimal nav bar ── */
        .err-nav {
            background: var(--white);
            border-bottom: 1px solid var(--cream-dark);
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            gap: .75rem;
        }
        .err-nav-logo {
            width: 40px; height: 40px;
            background: var(--orange);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .err-nav-logo svg { width: 22px; height: 22px; }
        .err-nav-name {
            font-family: 'Poppins', sans-serif;
            font-size: .9rem;
            font-weight: 700;
            color: var(--earth);
            line-height: 1.2;
        }
        .err-nav-name span {
            display: block;
            font-size: .7rem;
            font-weight: 400;
            color: var(--earth-muted);
        }

        /* ── Main ── */
        .err-main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 5rem 2rem;
        }
        .err-card {
            background: var(--white);
            border-radius: 24px;
            border: 1px solid var(--cream-dark);
            padding: clamp(2.5rem, 6vw, 4rem) clamp(2rem, 6vw, 4rem);
            max-width: 600px;
            width: 100%;
            text-align: center;
            box-shadow: 0 8px 48px rgba(0,0,0,.06);
        }
        .err-icon {
            width: 72px; height: 72px;
            background: var(--orange-pale);
            border-radius: 20px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1.75rem;
            color: var(--orange);
        }
        .err-icon svg { width: 36px; height: 36px; }
        .err-code {
            font-family: 'DM Mono', monospace;
            font-size: .72rem;
            letter-spacing: .2em;
            text-transform: uppercase;
            color: var(--orange);
            background: var(--orange-pale);
            display: inline-block;
            padding: .3rem .9rem;
            border-radius: 999px;
            margin-bottom: 1.25rem;
        }
        .err-title {
            font-family: 'Poppins', sans-serif;
            font-size: clamp(1.5rem, 4vw, 2.2rem);
            font-weight: 800;
            color: var(--earth);
            line-height: 1.2;
            margin-bottom: 1rem;
        }
        .err-desc {
            font-size: .97rem;
            color: var(--earth-muted);
            line-height: 1.75;
            max-width: 44ch;
            margin: 0 auto 2.25rem;
        }
        .err-actions {
            display: flex;
            gap: .75rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 2.5rem;
        }
        .err-btn-primary {
            display: inline-flex; align-items: center; gap: .45rem;
            background: var(--orange);
            color: var(--white);
            font-family: 'Inter', sans-serif;
            font-weight: 700; font-size: .9rem;
            padding: .75rem 1.75rem;
            border-radius: 999px;
            transition: background .2s, transform .15s;
        }
        .err-btn-primary:hover { background: var(--orange-dark); transform: translateY(-1px); }
        .err-btn-outline {
            display: inline-flex; align-items: center; gap: .45rem;
            border: 2px solid var(--cream-dark);
            color: var(--earth-mid);
            font-family: 'Inter', sans-serif;
            font-weight: 600; font-size: .9rem;
            padding: .75rem 1.75rem;
            border-radius: 999px;
            transition: border-color .2s, color .2s;
        }
        .err-btn-outline:hover { border-color: var(--orange); color: var(--orange); }
        .err-divider {
            border: none;
            border-top: 1px solid var(--cream-dark);
            margin-bottom: 1.75rem;
        }
        .err-contact {
            font-size: .85rem;
            color: var(--earth-muted);
            line-height: 1.65;
        }
        .err-contact a {
            color: var(--orange);
            font-weight: 600;
        }
        .err-contact a:hover { text-decoration: underline; }

        /* ── Footer ── */
        .err-footer {
            text-align: center;
            padding: 1.5rem 2rem;
            font-size: .78rem;
            color: var(--earth-muted);
            border-top: 1px solid var(--cream-dark);
            background: var(--white);
        }

        @media (max-width: 480px) {
            .err-actions { flex-direction: column; align-items: center; }
            .err-btn-primary, .err-btn-outline { width: 100%; justify-content: center; }
        }
    </style>
</head>
<body>

    <header class="err-nav">
        <a href="/" class="err-nav-logo" aria-label="KWDT Home">
            <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round">
                <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                <polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
        </a>
        <div class="err-nav-name">
            KWDT
            <span>Katosi Women Development Trust</span>
        </div>
    </header>

    <main class="err-main">
        <div class="err-card">

            <div class="err-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                    <line x1="12" y1="9" x2="12" y2="13"/>
                    <line x1="12" y1="17" x2="12.01" y2="17"/>
                </svg>
            </div>

            <span class="err-code">500 — Server Error</span>

            <h1 class="err-title">Something went wrong</h1>

            <p class="err-desc">
                We're sorry — our server encountered an unexpected error.
                Our team has been notified and we're working to fix it.
                Please try again in a few moments.
            </p>

            <div class="err-actions">
                <a href="/" class="err-btn-primary">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" aria-hidden="true"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    Go to Homepage
                </a>
                <a href="javascript:location.reload()" class="err-btn-outline">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" aria-hidden="true"><polyline points="23 4 23 10 17 10"/><path d="M20.49 15a9 9 0 11-2.12-9.36L23 10"/></svg>
                    Try Again
                </a>
            </div>

            <hr class="err-divider">

            <p class="err-contact">
                If the problem persists, please contact us at
                <a href="mailto:info@katosi.org">info@katosi.org</a>
                or call <a href="tel:+256414691842">+256 414 691 842</a>.
            </p>

        </div>
    </main>

    <footer class="err-footer">
        &copy; {{ date('Y') }} Katosi Women Development Trust &nbsp;·&nbsp;
        <a href="/" style="color:inherit">katosi.org</a>
    </footer>

</body>
</html>
