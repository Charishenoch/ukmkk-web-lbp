<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard | UKM KK</title>
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
                    <p class="text-[8px] text-white/60 font-bold uppercase tracking-[0.2em] mt-1">Pengurus View</p>
                </div>
            </div>

            <div x-show="sidebarOpen" class="text-white/40 text-[9px] font-black uppercase tracking-[0.4em] px-8 mt-4 italic">
                Dashboard View
            </div>

            <nav class="flex-1 px-4 space-y-2 mt-4">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-4 p-4 rounded-3xl bg-white text-[#1F84DA] font-black italic uppercase text-[11px] shadow-xl transition-all">
                    <i class="bi bi-grid-fill text-lg"></i>
                    <span x-show="sidebarOpen" class="tracking-widest">DASHBOARD</span>
                </a>

                <div class="pt-1">
                    <button @click="prokerOpen = !prokerOpen" 
                            class="w-full flex items-center gap-4 p-4 rounded-3xl text-white/70 hover:bg-white/10 hover:text-white transition-all text-[11px] font-black uppercase italic tracking-widest outline-none border-none cursor-pointer">
                        <i class="bi bi-journal-text text-lg"></i>
                        <span x-show="sidebarOpen" class="flex-1 text-left">PROKER</span>
                        <i x-show="sidebarOpen" class="bi bi-chevron-down text-[10px] transition-transform duration-300" :class="prokerOpen ? 'rotate-180 text-white' : ''"></i>
                    </button>
                    
                    <div x-show="prokerOpen && sidebarOpen" x-transition x-cloak class="mt-2 ml-12 space-y-2 border-l border-white/20 pl-4">
                        <a href="{{ route('proker.index', ['type' => 'rkt']) }}" class="block py-1.5 text-[10px] font-black uppercase tracking-widest text-white/50 hover:text-white transition-colors">
                             Kegiatan RKT
                        </a>
                        <a href="{{ route('proker.index', ['type' => 'non-rkt']) }}" class="block py-1.5 text-[10px] font-black uppercase tracking-widest text-white/50 hover:text-white transition-colors">
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
                    <button @click="open = ! open" class="bg-white/10 px-5 py-2.5 rounded-2xl border border-white/20 flex items-center gap-3 cursor-pointer hover:bg-white/20 transition-all shadow-inner outline-none group">
                        <span class="text-[10px] font-black uppercase tracking-widest italic text-white group-hover:text-yellow-300 transition-colors">
                            {{ Auth::user()->name }}
                        </span>
                        <i class="bi bi-chevron-down text-[10px] text-white/70 transition-transform duration-300" :class="open ? 'rotate-180' : ''"></i>
                    </button>

                    <div x-show="open" x-transition x-cloak class="absolute right-0 mt-3 w-64 bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden z-[999]">
                        <div class="px-6 py-5 bg-gray-50 border-b border-gray-100 text-left">
                            <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest mb-1.5">Status Login</p>
                            <span class="text-[11px] font-black text-slate-800 block truncate">{{ Auth::user()->name }}</span>
                            <span class="text-[10px] font-medium text-slate-400 block truncate leading-none mt-1">{{ Auth::user()->email }}</span>
                        </div>

                        <div class="p-2 space-y-1">
                            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-[10px] font-black italic tracking-widest text-slate-600 hover:bg-blue-50 hover:text-[#1F84DA] rounded-2xl transition-all">
                                <i class="bi bi-speedometer2"></i> DASHBOARD
                            </a>
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 text-[10px] font-black italic tracking-widest text-slate-600 hover:bg-blue-50 hover:text-[#1F84DA] rounded-2xl transition-all">
                                <i class="bi bi-person-gear"></i> PROFILE SAYA
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
                <div class="max-w-7xl mx-auto flex flex-col xl:flex-row gap-10">
                    
                    {{-- CARD KIRI: REMINDER --}}
                    <div class="w-full xl:w-5/12">
                        <div class="bg-white rounded-[60px] shadow-sm border border-gray-100 p-10 h-full flex flex-col transition-all hover:shadow-xl">
                            <h4 class="text-[#524D71] font-black italic uppercase tracking-[0.3em] text-center mb-10 text-sm">Reminder :</h4>
                            <div class="space-y-6 flex-grow">
                                @forelse($reminderDekatDL as $task)
                                    @php $isOverdue = $task->deadline && $task->deadline->isPast(); @endphp
                                    <div class="flex items-center p-6 rounded-[35px] text-white shadow-2xl transform transition-all hover:scale-[1.03]"
                                         style="background: {{ $isOverdue ? 'linear-gradient(135deg, #FF416C 0%, #FF4B2B 100%)' : 'linear-gradient(135deg, #524D71 0%, #1F84DA 100%)' }};">
                                        <div class="bg-white/20 p-4 rounded-2xl me-5 backdrop-blur-md border border-white/20">
                                            <i class="bi {{ $isOverdue ? 'bi-exclamation-triangle-fill' : 'bi-clock-fill' }} text-xl"></i>
                                        </div>
                                        <div class="min-w-0 text-left leading-tight">
                                            <h5 class="font-black italic uppercase tracking-tighter mb-1.5 text-[15px] truncate">
                                                {{ $task->deskripsi_tugas }} {{ $isOverdue ? '(Overdue)' : '' }}
                                            </h5>
                                            <p class="text-[10px] font-bold uppercase opacity-80 tracking-widest truncate">
                                                {{ $task->deadline?->format('d M Y') }} — {{ $task->project?->nama_proker }}
                                            </p>
                                        </div>
                                    </div>
                                @empty
                                    <div class="py-16 text-center text-gray-300 italic font-black uppercase tracking-widest text-xs">Kosong Bro.</div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    {{-- CARD KANAN: POIN KEAKTIFAN --}}
                    <div class="w-full xl:w-7/12">
                        <div class="bg-white rounded-[60px] shadow-sm border border-gray-100 p-10 text-center flex flex-col h-full transition-all hover:shadow-xl">
                            <h4 class="text-[#524D71] font-black italic uppercase tracking-[0.3em] mb-10 text-sm">Poin Keaktifan :</h4>
                            <div class="sidebar-gradient rounded-[45px] p-12 text-white shadow-2xl relative overflow-hidden mb-10">
                                <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
                                <p class="text-[10px] font-black uppercase tracking-[0.4em] opacity-70 mb-3">Total Score</p>
                                <h1 class="text-8xl font-black italic drop-shadow-2xl">{{ $totalPoin }}</h1>
                            </div>
                            <div class="grid grid-cols-2 gap-8">
                                <div class="flex flex-col items-center">
                                    <span class="text-gray-400 font-black text-[10px] uppercase tracking-[0.2em] mb-4 text-nowrap">Kehadiran PDM :</span>
                                    <div class="w-full bg-gray-50 border border-gray-100 rounded-[25px] py-6 shadow-inner">
                                        <span class="text-3xl font-black text-[#1F84DA] italic">{{ $countPdm }}</span>
                                    </div>
                                </div>
                                <div class="flex flex-col items-center">
                                    <span class="text-gray-400 font-black text-[10px] uppercase tracking-[0.2em] mb-4 text-nowrap">Kehadiran RKT :</span>
                                    <div class="w-full bg-gray-50 border border-gray-100 rounded-[25px] py-6 shadow-inner">
                                        <span class="text-3xl font-black text-[#1F84DA] italic">{{ $countRkt }}</span>
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