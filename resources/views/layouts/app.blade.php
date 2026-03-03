<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'UKMKK 2026') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600,700,800,900,900i&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'Figtree', sans-serif; background-color: #f3f4f6; margin: 0; padding: 0; }
        .sidebar { width: 260px; height: 100vh; background-color: #1a1a1a; position: fixed; left: 0; top: 0; z-index: 100; }
        
        .main-content { 
            margin-left: 260px; 
            min-height: 100vh; 
            display: flex; 
            flex-direction: column;
            /* Pastikan lebar benar-benar presisi sisa layar */
            width: calc(100% - 260px); 
        }
        
        /* Hilangkan overflow-x hidden jika ingin fleksibel, atau tetap gunakan untuk prevent horizontal scroll */
        main { flex: 1; overflow-x: hidden; width: 100%; }

        {{-- Tambahan agar row Bootstrap di dalam yield tidak terbatas --}}
        .content-wrapper { width: 100%; max-width: 100%; }
    </style>
</head>
<body x-data="{ prokerOpen: false }">
    <div class="sidebar">
        @include('layouts.partials.sidebar')
    </div>

    <div class="main-content">
        @include('layouts.partials.topbar')
        
        {{-- Padding disesuaikan agar tidak terlalu sempit --}}
        <main class="p-6 md:p-8 lg:p-10">
            {{-- Ganti container-fluid dengan div biasa yang full width --}}
            <div class="content-wrapper">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>