
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $metaDescription ?? 'Katosi Women Development Trust — Empowering women and youth in Ugandas rural and fisher communities.' }}">
    <title>{{ $title ?? 'KWDT' }} — Katosi Women Development Trust</title>

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/images/kwdt-logo.webp" type="image/webp">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,700&family=DM+Sans:wght@300;400;500&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/css/kwdt.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-cream text-earth antialiased">

@include('partials.nav')

<main>
    {{ $slot }}
</main>

@include('partials.footer')

@livewireScripts

<script>
    // Scroll reveal — used across all pages
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry, i) => {
            if (entry.isIntersecting) {
                setTimeout(() => entry.target.classList.add('visible'), i * 80);
                revealObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));

    // Nav scroll shadow
    window.addEventListener('scroll', () => {
        document.querySelector('nav')?.classList.toggle('nav-scrolled', window.scrollY > 60);
    });
</script>

@stack('scripts')
</body>
</html>
