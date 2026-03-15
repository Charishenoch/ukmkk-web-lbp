<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | UKM KK</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');
        body { font-family: 'Inter', sans-serif; }
        [x-cloak] { display: none !important; }
        .sidebar-gradient {
            background: linear-gradient(180deg, #524D71 0%, #1F84DA 100%);
        }
    </style>
</head>
<body class="bg-[#F8FAFC]">

    <div class="flex h-screen overflow-hidden" x-data="{ sidebarOpen: true, prokerOpen: false }">
        
        <aside :class="sidebarOpen ? 'w-72' : 'w-24'" class="sidebar-gradient transition-all duration-300 flex flex-col shadow-2xl z-50">
            <div class="p-8 flex items-center gap-4">
                <div class="bg-white/20 p-2 rounded-2xl min-w-[45px] h-[45px] flex items-center justify-center border border-white/30 backdrop-blur-sm shadow-inner text-white">
                    <i class="bi bi-shield-shaded text-xl"></i>
                </div>
                <div x-show="sidebarOpen" class="leading-tight text-nowrap">
                    <h2 class="text-white font-black italic tracking-tighter text-xl leading-none">UKM KK</h2>
                    <p class="text-[8px] text-white/60 font-bold uppercase tracking-[0.2em] mt-1">Tech Support</p>
                </div>
            </div>

            <div x-show="sidebarOpen" class="text-white/40 text-[9px] font-black uppercase tracking-[0.4em] px-8 mt-4 italic">
                Dashboard View
            </div>

            <nav class="flex-1 px-4 space-y-2 mt-4">
                <a href="{{ route('dashboard_admin') }}" class="flex items-center gap-4 p-4 rounded-3xl bg-white text-[#1F84DA] font-black italic uppercase text-[11px] shadow-xl transition-all">
                    <i class="bi bi-grid-fill text-lg"></i>
                    <span x-show="sidebarOpen" class="tracking-widest">DASHBOARD</span>
                </a>

                <div class="pt-1">
                    <button @click="prokerOpen = !prokerOpen" 
                            class="w-full flex items-center gap-4 p-4 rounded-3xl text-white/70 hover:bg-white/10 hover:text-white transition-all text-[11px] font-black uppercase italic tracking-widest outline-none border-none cursor-pointer">
                        <i class="bi bi-journal-bookmark text-lg"></i>
                        <span x-show="sidebarOpen" class="flex-1 text-left">PROKER</span>
                        <i x-show="sidebarOpen" class="bi bi-chevron-down text-[10px] transition-transform duration-300" :class="prokerOpen ? 'rotate-180 text-white' : ''"></i>
                    </button>
                    
                    <div x-show="prokerOpen && sidebarOpen" x-transition x-cloak class="mt-2 ml-12 space-y-2 border-l border-white/20 pl-4">
                        <a href="{{ route('proker.index') }}" class="block py-1.5 text-[10px] font-black uppercase tracking-widest text-white/50 hover:text-white transition-colors">
                             Kegiatan RKT
                        </a>
                        <a href="{{ route('proker.create') }}" class="block py-1.5 text-[10px] font-black uppercase tracking-widest text-white/50 hover:text-white transition-colors">
                             Kegiatan NON RKT
                        </a>
                    </div>
                </div>

                <a href="#" class="flex items-center gap-4 p-4 rounded-3xl text-white/70 hover:bg-white/10 hover:text-white transition-all text-[11px] font-black uppercase italic tracking-widest">
                    <i class="bi bi-calendar-check text-lg"></i>
                    <span x-show="sidebarOpen">ABSENSI</span>
                </a>

                <a href="{{ route('profile.edit') }}" class="flex items-center gap-4 p-4 rounded-3xl text-white/70 hover:bg-white/10 hover:text-white transition-all text-[11px] font-black uppercase italic tracking-widest">
                    <i class="bi bi-person-circle text-lg"></i>
                    <span x-show="sidebarOpen">PROFILE</span>
                </a>
            </nav>

            <div class="p-6 border-t border-white/10 mt-auto">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-4 p-4 text-red-300 hover:bg-red-500/20 rounded-3xl transition-all text-[11px] font-black uppercase italic tracking-widest cursor-pointer">
                        <i class="bi bi-box-arrow-right text-lg"></i>
                        <span x-show="sidebarOpen">LOGOUT</span>
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden">
            
            <header class="h-20 w-full flex items-center justify-between px-8 text-white shadow-lg z-40" 
                    style="background: linear-gradient(90deg, #524D71 0%, #1F84DA 100%);">
                
                <div class="flex items-center">
                    <button @click="sidebarOpen = !sidebarOpen" class="text-white/70 hover:text-white transition-colors cursor-pointer p-2 outline-none">
                        <i class="bi bi-text-indent-left text-2xl" :class="sidebarOpen ? '' : 'rotate-180'"></i>
                    </button>
                </div>

                <div class="relative" x-data="{ open: false }" @click.away="open = false">
                    <button @click="open = !open" class="bg-white/10 px-5 py-2.5 rounded-2xl border border-white/20 flex items-center gap-3 cursor-pointer hover:bg-white/20 transition-all shadow-inner outline-none group">
                        <div class="text-right hidden sm:block">
                            <p class="text-[10px] font-black uppercase tracking-widest italic text-white group-hover:text-yellow-300 transition-colors leading-none">{{ Auth::user()->name }}</p>
                            <p class="text-[8px] font-bold text-red-400 uppercase tracking-widest mt-1">Administrator</p>
                        </div>
                        <i class="bi bi-chevron-down text-[10px] text-white/70 transition-transform duration-300" :class="open ? 'rotate-180' : ''"></i>
                    </button>

                    <div x-show="open" x-transition x-cloak class="absolute right-0 mt-3 w-64 bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden z-[999]">
                        <div class="px-6 py-5 bg-gray-50 border-b border-gray-100 text-left">
                            <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest mb-1.5">Identitas Login</p>
                            <span class="text-[11px] font-black text-slate-800 block truncate">{{ Auth::user()->name }}</span>
                            <span class="text-[10px] font-medium text-slate-400 block truncate leading-none mt-1">{{ Auth::user()->email }}</span>
                        </div>

                        <div class="p-2 space-y-1">
                            <a href="{{ route('dashboard_admin') }}" class="flex items-center gap-3 px-4 py-3 text-[10px] font-black italic tracking-widest text-slate-600 hover:bg-blue-50 hover:text-[#1F84DA] rounded-2xl transition-all">
                                <i class="bi bi-speedometer2"></i> DASHBOARD
                            </a>
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 text-[10px] font-black italic tracking-widest text-slate-600 hover:bg-blue-50 hover:text-[#1F84DA] rounded-2xl transition-all">
                                <i class="bi bi-gear-fill"></i> PENGATURAN AKUN
                            </a>
                        </div>

                        <div class="p-2 bg-gray-50/50 border-t border-gray-100">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-[10px] font-black italic tracking-widest text-red-600 hover:bg-red-50 rounded-2xl transition-all">
                                    <i class="bi bi-box-arrow-right"></i> LOGOUT SISTEM
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-10 lg:p-14 bg-[#F8FAFC]">
                <div class="w-full max-w-7xl mx-auto">
                    <div class="flex flex-col xl:flex-row justify-center items-stretch gap-10">
                        
                        {{-- PROKER AKTIF --}}
                        <div class="w-full xl:w-1/2 flex">
                            <div class="bg-white rounded-[60px] shadow-sm border border-gray-100 p-10 w-full flex flex-col transition-all hover:shadow-xl text-left">
                                <h4 class="text-[#524D71] font-black italic uppercase tracking-[0.3em] text-center mb-12 text-sm">
                                    Proker Aktif :
                                </h4>
                                <div class="space-y-6 flex-grow">
                                    @forelse($aktifProker->take(2) as $p)
                                        <div class="flex items-center p-6 rounded-[35px] text-white shadow-2xl"
                                             style="background: linear-gradient(135deg, #524D71 0%, #1F84DA 100%);">
                                            <div class="bg-white/20 p-4 rounded-2xl me-5 backdrop-blur-md border border-white/20">
                                                <i class="bi bi-person-walking text-xl"></i>
                                            </div>
                                            <div class="min-w-0">
                                                <h5 class="font-black italic uppercase tracking-tighter mb-1.5 text-[16px] truncate">{{ $p->nama_proker }}</h5>
                                                <p class="mb-0 text-[10px] font-bold uppercase tracking-[0.15em] opacity-80 truncate">
                                                    {{ $p->tanggal }} — {{ $p->departemen ?? 'INTERNAL' }}
                                                </p>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="py-16 text-center text-gray-300 italic font-black uppercase tracking-widest text-xs">Kosong Bro.</div>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        {{-- REKAP PROKER --}}
                        <div class="w-full xl:w-1/2 flex">
                            <div class="bg-white rounded-[60px] shadow-sm border border-gray-100 p-10 text-center w-full flex flex-col transition-all hover:shadow-xl">
                                <h4 class="text-[#524D71] font-black italic uppercase tracking-[0.3em] mb-12 text-sm">
                                    Rekap Proker
                                </h4>
                                <div class="flex gap-6 px-2 pb-6 flex-grow">
                                    {{-- BOX RKT --}}
                                    <div class="w-1/2 flex flex-col">
                                        <h5 class="font-black uppercase text-[10px] tracking-[0.2em] mb-5 text-gray-400">RKT :</h5>
                                        <div class="rounded-[40px] overflow-hidden shadow-2xl bg-white flex-grow border border-gray-50">
                                            <div class="bg-[#1F84DA] py-8 text-white shadow-inner">
                                                <h1 class="font-black italic text-6xl mb-0 leading-none">{{ $totalRkt }}</h1>
                                            </div>
                                            <div class="p-5 space-y-3">
                                                @foreach($listRkt as $rkt)
                                                <div class="bg-gray-50/50 p-4 rounded-[25px] border border-gray-100 text-left shadow-sm">
                                                    <p class="text-[10px] font-black uppercase italic text-[#524D71] truncate">{{ $rkt->nama_proker }}</p>
                                                    <p class="text-[8px] font-bold text-gray-400 uppercase tracking-widest mt-1">{{ $rkt->departemen ?? 'UMUM' }}</p>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    {{-- BOX NON-RKT --}}
                                    <div class="w-1/2 flex flex-col">
                                        <h5 class="font-black uppercase text-[10px] tracking-[0.2em] mb-5 text-gray-400">NON-RKT :</h5>
                                        <div class="rounded-[40px] overflow-hidden shadow-2xl bg-white flex-grow border border-gray-50">
                                            <div class="bg-[#524D71] py-8 text-white shadow-inner">
                                                <h1 class="font-black italic text-6xl mb-0 leading-none">{{ $totalNonRkt }}</h1>
                                            </div>
                                            <div class="p-5 space-y-3">
                                                @foreach($listNonRkt as $non)
                                                <div class="bg-gray-50/50 p-4 rounded-[25px] border border-gray-100 text-left shadow-sm">
                                                    <p class="text-[10px] font-black uppercase italic text-[#524D71] truncate">{{ $non->nama_proker }}</p>
                                                    <p class="text-[8px] font-bold text-gray-400 uppercase tracking-widest mt-1">{{ $non->departemen ?? 'UMUM' }}</p>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </main>
        </div>
    </div>

</body>
</html>