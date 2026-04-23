<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>
    {{ filled($title ?? null) ? $title.' - '.config('app.name', 'Laravel') : config('app.name', 'Laravel') }}
</title>

<link rel="icon" href="/favicon.ico" sizes="any">
<link rel="icon" href="/images/kwdt-logo.webp" type="image/webp">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

@if(file_exists(public_path('build/manifest.json')))
    @vite(['resources/css/app.css', 'resources/css/kwdt.css', 'resources/js/app.js'])
@else
    <link rel="stylesheet" href="{{ asset('css/kwdt.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
@endif
@php
    $measurementId = config('services.google_analytics.measurement_id');
@endphp

@if($measurementId)
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $measurementId }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', '{{ $measurementId }}');
    </script>
@endif
