<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'UKMKK 2026') }}</title>

        {{-- Font Bunny: Ditambahkan varian italic dan weight 700, 800, 900 --}}
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900,400i,700i,900i&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        {{-- Custom CSS untuk Gradasi Halus & Transisi --}}
        <style>
            body {
                /* Supaya transisi antar halaman halus */
                transition: background-color 0.3s ease;
            }
            /* Custom Scrollbar biar makin kece */
            ::-webkit-scrollbar {
                width: 8px;
            }
            ::-webkit-scrollbar-thumb {
                background: #524D71;
                border-radius: 10px;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased selection:bg-[#E8D621] selection:text-[#524D71]">
        
        {{-- Slot Konten Login --}}
        <main>
            {{ $slot }}
        </main>

    </body>
</html>