@php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Facades\Request;

    if (!str_contains(Request::path(), 'login')) return '';

    $images = collect(Storage::disk('public')->files('content/images'))
        ->filter(fn($f) => preg_match('/\.(jpg|jpeg|png|webp)$/i', $f))
        ->map(fn($f) => Storage::disk('public')->url($f))
        ->values()
        ->toArray();

    if (empty($images)) {
        $images = [asset('images/kwdt-logo.webp')];
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

<div id="login-bg" style="position:fixed;inset:0;z-index:0;background-size:cover;background-position:center;animation:bgSlide {{ $duration }}s infinite;"></div>
<style>
    .fi-simple-layout { position: relative; }
    .fi-simple-main-ctn { position: relative; z-index: 1; }
    .fi-simple-page { background: rgba(255,255,255,0.92) !important; backdrop-filter: blur(4px); border-radius: 1rem !important; }
    @keyframes bgSlide { {!! $keyframes !!} }
</style>
