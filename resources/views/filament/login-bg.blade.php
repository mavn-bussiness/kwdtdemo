@php
    use Illuminate\Support\Facades\Request;
    if (!str_contains(Request::path(), 'login')) return '';

    $images = [
        'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/82eada9f-8188-4ebd-bab8-3fdcf85ca5f8/ARCHE_UGANDA_194.jpg?format=1500w',
        'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/0a689bfb-2ee0-4451-ae42-f9fc54f37d71/ARCHE_UGANDA_196.jpg?format=1500w',
        'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/3ef1650d-ef5e-4b49-bc13-1b771013aa68/DSC03764.JPG?format=1500w',
        'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/d764e888-bfec-47a8-b5a6-a1f0f288a166/DSC05383.JPG?format=1500w',
        'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/c8973b94-5f49-4092-974c-26e2359d0baa/ARCHE_UGANDA_218.jpg?format=1500w',
        'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/fc6e9483-6da8-4944-b548-91aef5bb9f99/ARCHE_UGANDA_204.jpg?format=1500w',
        'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/f1a11664-9d66-411b-9d02-1f3158773ad9/DSC08536.JPG?format=1500w',
        'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/80995547-893f-431c-ab16-455253aee6c6/ARCHE_UGANDA_195.jpg?format=1500w',
        'https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/f3fce0f7-c4b3-4e55-ba3e-04c48e8ee2c6/DSC01464+2.JPG?format=1500w',
    ];

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
