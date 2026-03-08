@props(['title' => 'Home', 'metaDescription' => ''])

<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head', ['title' => $title, 'metaDescription' => $metaDescription])
</head>
<body>
    @include('partials.nav')

    <main>
        {{ $slot }}
    </main>

    @include('partials.footer')

    @stack('scripts')
</body>
</html>
