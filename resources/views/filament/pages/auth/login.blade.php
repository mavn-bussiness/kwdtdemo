@php
    use Illuminate\Support\Facades\Storage;
    try {
        $images = collect(Storage::disk('public')->files('content/images'))
            ->filter(fn($f) => preg_match('/\.(jpg|jpeg|png|webp)$/i', $f))
            ->values()
            ->map(fn($f) => Storage::disk('public')->url($f))
            ->toArray();
    } catch (\Throwable $e) {
        $images = [];
    }
    if (empty($images)) {
        $images = [
            'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/82eada9f-8188-4ebd-bab8-3fdcf85ca5f8/ARCHE_UGANDA_194.jpg',
            'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/0a689bfb-2ee0-4451-ae42-f9fc54f37d71/ARCHE_UGANDA_196.jpg',
            'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/d764e888-bfec-47a8-b5a6-a1f0f288a166/DSC05383.JPG',
        ];
    }
    $count = count($images);
    $duration = $count * 6;

    $keyframes = '';
    foreach ($images as $i => $url) {
        $from = round($i / $count * 100, 2);
        $to   = round(($i + 0.85) / $count * 100, 2);
        $keyframes .= "{$from}%, {$to}% { background-image: url('{$url}'); }\n";
    }
    $keyframes .= "100% { background-image: url('{$images[0]}'); }";
@endphp

<x-filament-panels::page.simple>
    <style>
        body { background: #111 !important; }
        .login-bg {
            position: fixed;
            inset: 0;
            z-index: 0;
            animation: bgSlide {{ $duration }}s infinite;
            background-size: cover;
            background-position: center;
        }
        @-webkit-keyframes bgSlide { {!! $keyframes !!} }
        @keyframes bgSlide { {!! $keyframes !!} }
        .fi-simple-main-ctn { position: relative; z-index: 1; }
        .fi-simple-page {
            background: rgba(255,255,255,0.92) !important;
            backdrop-filter: blur(4px);
            border-radius: 1rem !important;
        }
    </style>

    <div class="login-bg"></div>

    <x-filament-panels::auth.login />
</x-filament-panels::page.simple>
