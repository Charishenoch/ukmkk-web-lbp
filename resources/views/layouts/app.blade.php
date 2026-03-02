<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LBP UKMKK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #f4f4f4; margin: 0; padding-top: 60px; } /* Kasih space buat header */
        
        /* HEADER: Logo di kiri, Profile/Logout di kanan */
        .main-header {
            position: fixed;
            top: 0;
            width: 100%;
            height: 60px;
            background-color: #d9d9d9;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            z-index: 1030;
            border-bottom: 2px solid #999;
        }
        .logo-placeholder { 
            border: 1px solid #000; 
            border-radius: 20px; 
            padding: 2px 25px; 
            font-weight: bold; 
        }

        /* SIDEBAR: Di bawah header */
        .wrapper { display: flex; }
        .sidebar {
            width: 250px;
            height: calc(100vh - 60px);
            background-color: #555555;
            position: fixed;
            top: 60px;
            left: 0;
        }
        .nav-link { 
            color: #ffffff; 
            padding: 15px 25px; 
            border-bottom: 1px solid #666; 
            text-decoration: none;
            display: flex;
            justify-content: space-between;
        }
        .nav-link:hover, .nav-link.active { background-color: #d9d9d9; color: #000 !important; }

        /* KONTEN UTAMA */
        .content-area {
            margin-left: 250px;
            width: calc(100% - 250px);
            padding: 30px;
        }
        .profile-box { background: #333; color: white; padding: 5px 10px; border-radius: 5px; font-weight: bold; }
    </style>
</head>
<body>
    <header class="main-header">
        <div class="logo-placeholder">LOGO</div>
        <div class="d-flex align-items-center gap-3">
            <form method="POST" action="{{ route('logout') }}" class="m-0">
                @csrf
                <button type="submit" class="btn btn-sm fw-bold border-0">LOGOUT</button>
            </form>
            <div class="profile-box">AD</div>
        </div>
    </header>

    <div class="wrapper">
        <nav class="sidebar">
            <div class="nav flex-column mt-2">
                <a href="/dashboard" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">DASHBOARD</a>
                <a href="#menuProker" data-bs-toggle="collapse" class="nav-link d-flex justify-content-between align-items-center {{ request()->is('proker*') ? 'active' : '' }}">
                        PROKER <i class="bi bi-chevron-down"></i>
                    </a>
                    <div id="menuProker" class="collapse {{ request()->is('proker*') ? 'show' : '' }}">
                        <a href="{{ route('proker.index', ['type' => 'rkt']) }}" class="nav-link {{ request()->is('proker/rkt*') ? 'active' : '' }}" style="padding-left: 40px; font-size: 0.9em;">- RKT</a>
                        <a href="{{ route('proker.index', ['type' => 'non-rkt']) }}" class="nav-link {{ request()->is('proker/non-rkt*') ? 'active' : '' }}" style="padding-left: 40px; font-size: 0.9em;">- NON-RKT</a>
                    </div>
                <a href="#" class="nav-link">ABSENSI</a>
                <a href="#" class="nav-link">PROFILE</a>
            </div>
        </nav>

        <main class="content-area">
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html> 