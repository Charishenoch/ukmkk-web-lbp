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
        
        /* 1. TOPBAR FULL WIDTH DI ATAS */
        .topbar-wrapper { position: fixed; top: 0; left: 0; width: 100%; height: 70px; z-index: 200; }
        
        /* 2. SIDEBAR DI BAWAH TOPBAR */
        .sidebar { width: 260px; height: calc(100vh - 70px); background-color: #1a1a1a; position: fixed; left: 0; top: 70px; z-index: 100; overflow-y: auto; }
        
        /* 3. MAIN CONTENT MINGGIR & TURUN */
        .main-content { 
            margin-left: 260px; 
            padding-top: 70px; /* Jarak biar konten gak ketutup topbar */
            min-height: 100vh; 
            display: flex; 
            flex-direction: column;
            width: calc(100% - 260px); 
        }
        
        [x-cloak] { display: none !important; }
        main { flex: 1; overflow-x: hidden; width: 100%; }
        .content-wrapper { width: 100%; max-width: 100%; }
    </style>
</head>
<body x-data="{ prokerOpen: window.location.pathname.includes('/proker') }">
    
    <div class="topbar-wrapper">
        @include('layouts.partials.topbar')
    </div>

    <div class="sidebar">
        @include('layouts.partials.sidebar')
    </div>

    <div class="main-content">
        <main class="p-6 md:p-8 lg:p-10">
            <div class="content-wrapper">
                @yield('content')
            </div>
        </main>
    </div>
    
    @stack('scripts')
</body>
</html>