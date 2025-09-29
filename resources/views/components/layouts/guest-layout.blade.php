<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Metadata --}}
    <meta name="description" content="Website Kecamatan Wanea, Sulawesi Utara. Dirancang untuk sistem manajemen UMKM.">
    <meta name="keywords" content="Manajemen UMKM Wanea, sistem informasi manajemen umkm, umkm wanea">
    <meta name="author" content="Kecamatan Wanea">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:title" content="UMKM Wanea - {{ $title }}">
    <meta property="og:description" content="Website Kecamatan Wanea, Kota Manado, Sulawesi Utara.">
    <meta property="og:image" content="{{ asset('img/hero-image.webp') }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('img/application-logo.svg') }}" type="image/x-icon">

    {{-- Judul Halaman --}}
    <title>UMKM Wanea</title>

    {{-- Framework Frontend --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Script Tambahan --}}
    @stack('scripts')

    {{-- Default CSS --}}
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="antialiased">

    {{-- Layout Utama --}}
    <main>
        {{ $slot }}
    </main>

</body>

</html>
