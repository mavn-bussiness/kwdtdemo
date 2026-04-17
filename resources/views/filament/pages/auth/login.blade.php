@php
    use Illuminate\Support\Facades\Storage;
    $images = collect(Storage::disk('public')->files('content/images'))
        ->filter(fn($f) => preg_match('/\.(jpg|jpeg|png|webp)$/i', $f))
        ->values()
        ->map(fn($f) => Storage::disk('public')->url($f))
        ->toArray();
    if (empty($images)) {
        $images = [asset('images/kwdt-logo.webp')];
    }
    $count = count($images);
    $duration = $count * 6;
@endphp

<x-filament-panels::page.simple>
    <style>
        body {
            background: #111 !important;
        }
        .fi-simple-layout {
            position: relative;
            min-height: 100vh;
        }
        .login-bg {
            position: fixed;
            inset: 0;
            z-index: 0;
            animation: bgSlide {{ $duration }}s infinite;
            background-size: cover;
            background-position: center;
        }
        @foreach($images as $i => $url)
        @php $from = round($i / $count * 100, 2); $to = round(($i + 0.85) / $count * 100, 2); @endphp
        @endforeach
        @keyframes bgSlide {
            @foreach($images as $i => $url)
            {{ round($i / $count * 100, 2) }}%,
            {{ round(($i + 0.85) / $count * 100, 2) }}% { background-image: url('{{ $url }}'); }
            @endforeach
            100% { background-image: url('{{ $images[0] }}'); }
        }
        .fi-simple-main-ctn {
            position: relative;
            z-index: 1;
        }
        .fi-simple-page {
            background: rgba(255, 255, 255, 0.92) !important;
            backdrop-filter: blur(4px);
            border-radius: 1rem !important;
        }
    </style>

    <div class="login-bg"></div>

    <x-filament-panels::auth.login />
</x-filament-panels::page.simple>
