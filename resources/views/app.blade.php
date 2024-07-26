<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>
    <meta name="description" content="{{$meta['description'] ?? 'Website Resmi Desa Samar' }}">
    <!-- Opengraph meta -->
    <meta property="og:url" content="https://samar.desa.id">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $meta['title'] ?? 'Default Title' }}">
    <meta property="og:description" content="{{ $meta['description'] ?? 'Default Description' }}">
    <meta property="og:image" content="{{ $meta['image'] ?? asset('img/balai.jpg') }}">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="samar.desa.id">
    <meta property="twitter:url" content="https://samar.desa.id">
    <meta name="twitter:title" content="">
    <meta name="twitter:description" content="">
    <meta name="twitter:image" content="{{ $meta['image'] ?? asset('img/balai.jpg') }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>

<body class="font-sans antialiased">
    @inertia
</body>

</html>