<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Proker | UKM KK</title>
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

    <div class="flex h-screen overflow-hidden" x-data="{ sidebarOpen: true, prokerOpen: true }">
        
        <aside :class="sidebarOpen ? 'w-72' : 'w-24'" class="sidebar-gradient transition-all duration-300 flex flex-col shadow-2xl z-50">
            <div class="p-8 flex items-center gap-4">
                <div class="bg-white/20 p-2 rounded-2xl min-w-[45px] h-[45px] flex items-center justify-center border border-white/30 backdrop-blur-sm shadow-inner text-white">
                    <i class="bi bi-shield-shaded text-xl"></i>
                </div>
                <div x-show="sidebarOpen" class="leading-tight text-nowrap">
                    <h2 class="text-white font-black italic tracking-tighter text-xl leading-none">UKM KK</h2>
                    <p class="text-[8px] text-white/60 font-bold uppercase tracking-[0.2em] mt-1">Sistem View</p>
                </div>
            </div>

            <nav class="flex-1 px-4 space-y-3 mt-6">
                @php 
                    $dashboardRoute = Auth::user()->email === 'admin@ukmkk.org' ? 'dashboard_admin' : 'dashboard';
                @endphp
                
                <a href="{{ route($dashboardRoute) }}" class="flex items-center gap-4 p-4 rounded-3xl text-white/70 hover:bg-white/10 hover:text-white transition-all text-[11px] font-black uppercase italic tracking-widest">
                    <i class="bi bi-grid-fill text-lg"></i>
                    <span x-show="sidebarOpen">DASHBOARD</span>
                </a>

                <div class="pt-1">
                    <button @click="prokerOpen = !prokerOpen" 
                            class="w-full flex items-center gap-4 p-4 rounded-3xl bg-white text-[#1F84DA] font-black italic uppercase text-[11px] shadow-xl outline-none border-none cursor-pointer">
                        <i class="bi bi-journal-text text-lg"></i>
                        <span x-show="sidebarOpen" class="flex-1 text-left text-nowrap">PROKER</span>
                        <i x-show="sidebarOpen" class="bi bi-chevron-down text-[10px] transition-transform duration-300" :class="prokerOpen ? 'rotate-180' : ''"></i>
                    </button>
                    
                    <div x-show="prokerOpen && sidebarOpen" x-cloak class="mt-2 ml-12 space-y-2 border-l border-white/20 pl-4">
                        <a href="{{ route('proker.index', ['type' => 'rkt']) }}" 
                           class="block py-1.5 text-[10px] font-black uppercase tracking-widest transition-colors flex items-center gap-2 {{ request()->query('type') == 'rkt' ? 'text-white' : 'text-white/50 hover:text-white' }}">
                             <span class="w-1.5 h-1.5 bg-current rounded-full"></span>
                             Kegiatan RKT
                        </a>
                        <a href="{{ route('proker.index', ['type' => 'non-rkt']) }}" 
                           class="block py-1.5 text-[10px] font-black uppercase tracking-widest transition-colors flex items-center gap-2 {{ request()->query('type') == 'non-rkt' ? 'text-white' : 'text-white/50 hover:text-white' }}">
                             <span class="w-1.5 h-1.5 bg-current rounded-full"></span>
                             Kegiatan NON-RKT
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
                        <span class="text-[10px] font-black uppercase tracking-widest italic text-white group-hover:text-yellow-300 transition-colors">
                            {{ Auth::user()->name }}
                        </span>
                        <i class="bi bi-chevron-down text-[10px] text-white/70 transition-transform duration-300" :class="open ? 'rotate-180' : ''"></i>
                    </button>

                    <div x-show="open" x-transition x-cloak class="absolute right-0 mt-3 w-64 bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden z-[999]">
                        <div class="px-6 py-5 bg-gray-50 border-b border-gray-100 text-left">
                            <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest mb-1.5">Identitas Login</p>
                            <span class="text-[11px] font-black text-slate-800 block truncate">{{ Auth::user()->name }}</span>
                            <span class="text-[10px] font-medium text-slate-400 block truncate mt-1 leading-none">{{ Auth::user()->email }}</span>
                        </div>

                        <div class="p-2 space-y-1">
                            <a href="{{ route($dashboardRoute) }}" class="flex items-center gap-3 px-4 py-3 text-[10px] font-black italic tracking-widest text-slate-600 hover:bg-blue-50 hover:text-[#1F84DA] rounded-2xl transition-all">
                                <i class="bi bi-speedometer2"></i> DASHBOARD
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
                <div class="max-w-7xl mx-auto">
                    <h3 class="text-[#524D71] font-black italic uppercase tracking-[0.3em] mb-12 text-sm leading-none">
                        Daftar Kegiatan {{ strtoupper(request()->query('type', 'Proker')) }} :
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 items-stretch">
                        
                        {{-- CARD TAMBAH PROKER (Paling depan di dalam grid) --}}
                        @if(Auth::user()->email === 'admin@ukmkk.org')
                        <a href="{{ route('proker.create', ['type' => request()->query('type')]) }}" class="group block no-underline h-full">
                            <div class="h-full min-h-[420px] bg-white rounded-[55px] border-4 border-dashed border-gray-100 flex flex-col items-center justify-center p-10 transition-all duration-300 group-hover:border-[#1F84DA] group-hover:bg-blue-50/50 shadow-sm hover:shadow-xl">
                                <div class="w-24 h-24 rounded-full bg-gray-50 flex items-center justify-center mb-6 group-hover:sidebar-gradient group-hover:scale-110 transition-all duration-500 shadow-inner group-hover:text-white text-gray-300">
                                    <i class="bi bi-plus-lg text-4xl"></i>
                                </div>
                                <span class="font-black italic uppercase tracking-[0.2em] text-[#524D71] text-[11px] text-center">Buat Proker Baru</span>
                                <p class="text-[9px] font-bold text-gray-300 uppercase tracking-widest mt-3">Klik untuk tambah data</p>
                            </div>
                        </a>
                        @endif

                        {{-- LOOPING DATA PROKER --}}
                        @foreach($projects as $p)
                        <div class="bg-white rounded-[55px] shadow-sm border border-gray-100 overflow-hidden transition-all duration-500 hover:shadow-2xl hover:-translate-y-3 flex flex-col h-full min-h-[420px] group">
                            
                            {{-- Header Card / Flyer --}}
                            <div class="relative h-[240px] sidebar-gradient overflow-hidden">
                                @if($p->flyer)
                                    <img src="{{ asset('storage/' . $p->flyer) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-90">
                                @else
                                    <div class="w-full h-full flex items-center justify-center opacity-20 italic font-black text-white text-4xl tracking-tighter">UKMKK</div>
                                @endif
                                
                                <div class="absolute top-6 left-6">
                                    <span class="bg-white/20 backdrop-blur-xl text-white text-[9px] font-black px-5 py-2.5 rounded-2xl uppercase tracking-[0.2em] border border-white/30 shadow-xl">
                                        Dept. {{ $p->departemen ?? 'INTERNAL' }}
                                    </span>
                                </div>
                            </div>
                            
                            {{-- Body Card --}}
                            <div class="p-10 flex flex-col flex-grow">
                                <h5 class="font-black italic uppercase tracking-tighter text-[#524D71] text-xl mb-4 line-clamp-2 leading-[1.1]">
                                    {{ $p->nama_proker }}
                                </h5>
                                
                                <div class="mt-auto flex items-center justify-between border-t border-gray-50 pt-6">
                                    <div class="flex flex-col text-left">
                                        <span class="text-[8px] font-black text-gray-400 uppercase tracking-[0.2em] mb-1.5 text-nowrap leading-none">Tanggal Pelaksanaan:</span>
                                        <span class="text-[13px] font-black text-[#1F84DA] uppercase italic leading-none">
                                            {{ $p->tanggal ? \Carbon\Carbon::parse($p->tanggal)->format('d - m Y') : 'TBA' }}
                                        </span>
                                    </div>
                                    
                                    <a href="{{ route('proker.show', $p->id) }}" 
                                       class="w-12 h-12 rounded-[20px] bg-gray-50 flex items-center justify-center text-[#524D71] transition-all duration-300 hover:sidebar-gradient hover:text-white hover:scale-110 border border-gray-100 shadow-sm">
                                        <i class="bi bi-arrow-right text-xl"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </main>
        </div>
    </div>

</body>
</html>