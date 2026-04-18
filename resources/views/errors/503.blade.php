<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="60">
    <title>Maintenance — Katosi Women Development Trust</title>
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
            --earth-muted: #9CA3AF;
            --cream-dark:  #E5E7EB;
            --white:       #FFFFFF;
        }
        body {
            font-family: 'Inter', system-ui, sans-serif;
            background: var(--orange);
            color: var(--white);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem 2rem;
            text-align: center;
            -webkit-font-smoothing: antialiased;
            position: relative;
            overflow: hidden;
        }
        body::before {
            content: '';
            position: absolute;
            top: -120px; right: -120px;
            width: 480px; height: 480px;
            border-radius: 50%;
            background: rgba(255,255,255,.07);
            pointer-events: none;
        }
        body::after {
            content: '';
            position: absolute;
            bottom: -80px; left: -80px;
            width: 320px; height: 320px;
            border-radius: 50%;
            background: rgba(255,255,255,.05);
            pointer-events: none;
        }
        .maint-inner {
            position: relative; z-index: 1;
            max-width: 520px;
        }
        .maint-logo {
            width: 64px; height: 64px;
            background: rgba(255,255,255,.15);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 2rem;
            border: 2px solid rgba(255,255,255,.25);
        }
        .maint-logo svg { width: 32px; height: 32px; }
        .maint-badge {
            font-family: 'DM Mono', monospace;
            font-size: .68rem;
            letter-spacing: .2em;
            text-transform: uppercase;
            color: rgba(255,255,255,.7);
            background: rgba(255,255,255,.12);
            border: 1px solid rgba(255,255,255,.2);
            display: inline-block;
            padding: .3rem .9rem;
            border-radius: 999px;
            margin-bottom: 1.5rem;
        }
        .maint-title {
            font-family: 'Poppins', sans-serif;
            font-size: clamp(1.75rem, 5vw, 2.75rem);
            font-weight: 900;
            color: var(--white);
            line-height: 1.15;
            margin-bottom: 1rem;
        }
        .maint-desc {
            font-size: 1rem;
            color: rgba(255,255,255,.8);
            line-height: 1.75;
            max-width: 42ch;
            margin: 0 auto 2.5rem;
        }
        .maint-divider {
            border: none;
            border-top: 1px solid rgba(255,255,255,.2);
            margin-bottom: 2rem;
        }
        .maint-contact {
            font-size: .88rem;
            color: rgba(255,255,255,.65);
            line-height: 1.65;
        }
        .maint-contact a {
            color: var(--white);
            font-weight: 600;
        }
        .maint-contact a:hover { text-decoration: underline; }
        .maint-refresh {
            font-family: 'DM Mono', monospace;
            font-size: .68rem;
            letter-spacing: .1em;
            color: rgba(255,255,255,.4);
            margin-top: 2rem;
        }
    </style>
</head>
<body>
    <div class="maint-inner">

        <div class="maint-logo">
            <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round">
                <circle cx="12" cy="12" r="3"/>
                <path d="M19.07 4.93a10 10 0 010 14.14M4.93 4.93a10 10 0 000 14.14"/>
                <path d="M22 12a10 10 0 01-10 10M2 12a10 10 0 0110-10"/>
            </svg>
        </div>

        <span class="maint-badge">Scheduled Maintenance</span>

        <h1 class="maint-title">We'll be back shortly</h1>

        <p class="maint-desc">
            The KWDT website is currently undergoing scheduled maintenance.
            We'll be back online very soon — thank you for your patience.
        </p>

        <hr class="maint-divider">

        <p class="maint-contact">
            For urgent enquiries, please contact us at<br>
            <a href="mailto:info@katosi.org">info@katosi.org</a>
            &nbsp;·&nbsp;
            <a href="tel:+256414691842">+256 414 691 842</a>
        </p>

        <p class="maint-refresh">This page will refresh automatically every 60 seconds.</p>

    </div>
</body>
</html>
