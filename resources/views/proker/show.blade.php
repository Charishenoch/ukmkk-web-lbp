<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Proker | UKM KK</title>
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
                <div class="bg-white/20 p-2 rounded-2xl min-w-[45px] h-[45px] flex items-center justify-center border border-white/30 backdrop-blur-sm">
                    <i class="bi bi-shield-shaded text-white text-xl"></i>
                </div>
                <div x-show="sidebarOpen" class="leading-tight">
                    <h2 class="text-white font-black italic tracking-tighter text-xl">UKM KK</h2>
                    <p class="text-[8px] text-white/60 font-bold uppercase tracking-[0.2em]">Sistem View</p>
                </div>
            </div>

            <nav class="flex-1 px-4 space-y-2 mt-4">
                @php $dashboardRoute = Auth::user()->email === 'admin@ukmkk.org' ? 'dashboard_admin' : 'dashboard'; @endphp
                
                <a href="{{ route($dashboardRoute) }}" class="flex items-center gap-4 p-4 rounded-3xl text-white/70 hover:bg-white/10 hover:text-white transition-all text-[11px] font-black uppercase italic tracking-widest">
                    <i class="bi bi-grid-fill text-lg"></i>
                    <span x-show="sidebarOpen">DASHBOARD</span>
                </a>

                <div class="pt-1">
                    <button @click="prokerOpen = !prokerOpen" class="w-full flex items-center gap-4 p-4 rounded-3xl bg-white text-[#1F84DA] font-black italic uppercase text-[11px] shadow-xl outline-none">
                        <i class="bi bi-journal-text text-lg"></i>
                        <span x-show="sidebarOpen" class="flex-1 text-left">PROKER</span>
                        <i x-show="sidebarOpen" class="bi bi-chevron-down text-[10px] transition-transform duration-300" :class="prokerOpen ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="prokerOpen && sidebarOpen" x-cloak class="mt-2 ml-12 space-y-2 border-l border-white/20 pl-4">
                        <a href="{{ route('proker.index', ['type' => 'rkt']) }}" class="block py-1.5 text-[10px] font-black uppercase text-white/50 hover:text-white">Kegiatan RKT</a>
                        <a href="{{ route('proker.index', ['type' => 'non-rkt']) }}" class="block py-1.5 text-[10px] font-black uppercase text-white/50 hover:text-white">Kegiatan NON-RKT</a>
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

            <div class="p-6 border-t border-white/10">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-4 p-4 text-red-300 hover:bg-red-500/20 rounded-3xl text-[11px] font-black uppercase italic tracking-widest cursor-pointer">
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
                    <button @click="sidebarOpen = !sidebarOpen" class="text-white/70 hover:text-white p-2 outline-none cursor-pointer">
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

                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                         x-cloak
                         class="absolute right-0 mt-3 w-64 bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden z-[1000]">
                        
                        <div class="px-6 py-5 bg-gray-50 border-b border-gray-100 text-left">
                            <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest mb-1.5">Identitas Login</p>
                            <span class="text-[11px] font-black text-slate-800 block truncate">{{ Auth::user()->name }}</span>
                            <span class="text-[10px] font-medium text-slate-400 block truncate leading-none mt-1">{{ Auth::user()->email }}</span>
                        </div>

                        <div class="p-2 space-y-1">
                            <a href="{{ route($dashboardRoute) }}" class="flex items-center gap-3 px-4 py-3 text-[10px] font-black italic tracking-widest text-slate-600 hover:bg-blue-50 hover:text-[#1F84DA] rounded-2xl transition-all">
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
                <div class="max-w-7xl mx-auto">
                    
                    {{-- Header Page --}}
                    <div class="mb-8 flex items-center justify-between">
                        <div>
                            <h4 class="font-black italic uppercase tracking-tighter text-[#524D71] mb-1 text-2xl leading-none">
                                DETAIL PROKER: <span class="text-[#1F84DA]">{{ $project->nama_proker }}</span>
                            </h4>
                            <div class="h-1.5 w-20 bg-[#E8D621] rounded-full mt-2"></div>
                        </div>
                        <a href="{{ route('proker.index', ['type' => $type ?? 'rkt']) }}" class="text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-[#524D71] transition-all no-underline">
                            <i class="bi bi-arrow-left mr-2"></i> Kembali ke Daftar
                        </a>
                    </div>

                    {{-- Filter/Action Bar --}}
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8 bg-white p-8 rounded-[40px] shadow-sm border border-gray-100 items-end">
                        <div class="bg-gray-50 rounded-2xl py-4 px-4 font-black uppercase text-[10px] text-[#524D71] text-center italic border border-gray-100 shadow-inner">
                            {{ $project->nama_proker }}
                        </div>
                        
                        <div>
                            <label class="block text-[9px] font-black uppercase tracking-widest text-gray-400 pl-2 mb-2">Sie Panitia</label>
                            <select id="sieSelect" class="rounded-2xl border-none bg-gray-50 text-[#524D71] text-xs font-bold py-3.5 px-4 w-full focus:ring-4 focus:ring-[#1F84DA]/20 shadow-inner cursor-pointer">
                                <option value="">Pilih Sie...</option>
                                @foreach(($project->sies ?? collect())->unique('id') as $sie)
                                    <option value="{{ $sie->id }}" {{ request()->query('sie_id') == $sie->id ? 'selected' : '' }}>{{ $sie->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-[9px] font-black uppercase tracking-widest text-gray-400 pl-2 mb-2">Jabatan Sie</label>
                            <select id="jabatanSelect" class="rounded-2xl border-none bg-gray-50 text-[#524D71] text-xs font-bold py-3.5 px-4 w-full focus:ring-4 focus:ring-[#1F84DA]/20 shadow-inner cursor-pointer">
                                <option value="">Pilih Jabatan...</option>
                                <option value="Koordinator">Koordinator</option>
                                <option value="Anggota Sie">Anggota Sie</option>
                                <option value="BPH">BPH</option>
                                <option value="Panitia INTI">Panitia INTI</option>
                            </select>
                        </div>
                        
                        <a id="btnJoblist" href="{{ route('proker.joblist', $project->id) }}" 
                           class="flex items-center justify-center bg-[#524D71] text-white rounded-2xl font-black uppercase text-[11px] tracking-[0.2em] italic hover:bg-[#1F84DA] transition-all no-underline py-4 shadow-xl shadow-[#524D71]/20">
                            JOBLIST
                        </a>
                    </div>

                    {{-- Tabel LBP --}}
                    <div class="bg-white rounded-[45px] shadow-sm border border-gray-100 overflow-hidden mt-8">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse text-slate-800">
                                <thead>
                                    <tr class="bg-gray-50/80 text-[#524D71] uppercase text-[9px] font-black tracking-[0.2em] border-b border-gray-100 italic">
                                        <th class="px-8 py-5">Nama User</th>
                                        <th class="px-8 py-5">Tanggal Masuk</th>
                                        <th class="px-8 py-5">Tugas</th>
                                        <th class="px-8 py-5">Input</th>
                                        <th class="px-8 py-5">Deadline</th>
                                        <th class="px-8 py-5 text-center">Status</th>
                                        <th class="px-8 py-5">Notes</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50 text-[11px] font-bold text-gray-500">
                                    @forelse($myTasks as $task)
                                    <tr class="hover:bg-gray-50/50 transition-colors">
                                        <td class="px-8 py-5 text-[#524D71] italic">{{ $task->user->name ?? 'User' }}</td>
                                        <td class="px-8 py-5">{{ $task->created_at->format('d/m/Y') }}</td>
                                        <td class="px-8 py-5 text-[#524D71] leading-relaxed">{{ $task->deskripsi_tugas }}</td>
                                        <td class="px-8 py-5">{{ $task->pemberi_tugas }}</td>
                                        <td class="px-8 py-5 text-[#1F84DA]">{{ $task->deadline->format('d/m/Y') }}</td>
                                        <td class="px-8 py-5 text-center">
                                            <select class="rounded-xl border-none bg-gray-100 text-[9px] font-black uppercase tracking-widest p-2 focus:ring-2 focus:ring-[#1F84DA]/20 cursor-pointer">
                                                <option {{ $task->status == 'PENGERJAAN' ? 'selected' : '' }}>PENGERJAAN</option>
                                                <option {{ $task->status == 'SELESAI' ? 'selected' : '' }}>SELESAI</option>
                                            </select>
                                        </td>
                                        <td class="px-8 py-5">{{ $task->keterangan ?? '-' }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-20 text-gray-300 font-black uppercase tracking-[0.3em] text-[10px]">
                                            Belum ada tugas yang di-pick bro.
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sieSelect = document.getElementById('sieSelect');
            const jabatanSelect = document.getElementById('jabatanSelect');
            const btnJoblist = document.getElementById('btnJoblist');
            const projectId = "{{ $project->id }}";
            const baseUrl = btnJoblist.getAttribute('href').split('?')[0]; 

            const savedSie = localStorage.getItem(`proker_${projectId}_sie`);
            const savedJabatan = localStorage.getItem(`proker_${projectId}_jabatan`);

            if (savedSie) {
                sieSelect.value = savedSie;
                btnJoblist.href = `${baseUrl}?sie_id=${savedSie}`;
            }
            if (savedJabatan) { jabatanSelect.value = savedJabatan; }

            sieSelect.addEventListener('change', function() {
                const sieId = this.value;
                if (sieId) {
                    localStorage.setItem(`proker_${projectId}_sie`, sieId);
                    btnJoblist.href = `${baseUrl}?sie_id=${sieId}`;
                } else {
                    localStorage.removeItem(`proker_${projectId}_sie`);
                    btnJoblist.href = baseUrl;
                }
            });

            jabatanSelect.addEventListener('change', function() {
                const jabatan = this.value;
                if (jabatan) {
                    localStorage.setItem(`proker_${projectId}_jabatan`, jabatan);
                } else {
                    localStorage.removeItem(`proker_${projectId}_jabatan`);
                }
            });
        });
    </script>
</body>
</html>