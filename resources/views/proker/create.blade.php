<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Proker Baru | UKM KK</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');
        body { font-family: 'Inter', sans-serif; }
        [x-cloak] { display: none !important; }
        .sidebar-gradient { background: linear-gradient(180deg, #524D71 0%, #1F84DA 100%); }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fadeIn { animation: fadeIn 0.4s ease-out; }
        input:focus, select:focus { outline: none; }
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

            <nav class="flex-1 px-4 space-y-2 mt-4 text-nowrap">
                @php $dashboardRoute = Auth::user()->email === 'admin@ukmkk.org' ? 'dashboard_admin' : 'dashboard'; @endphp
                <a href="{{ route($dashboardRoute) }}" class="flex items-center gap-4 p-4 rounded-3xl text-white/70 hover:bg-white/10 hover:text-white transition-all text-[11px] font-black uppercase italic tracking-widest">
                    <i class="bi bi-grid-fill text-lg"></i>
                    <span x-show="sidebarOpen">DASHBOARD</span>
                </a>
                <div class="pt-1">
                    <button @click="prokerOpen = !prokerOpen" class="w-full flex items-center gap-4 p-4 rounded-3xl bg-white text-[#1F84DA] font-black italic uppercase text-[11px] shadow-xl outline-none border-none cursor-pointer">
                        <i class="bi bi-journal-text text-lg"></i>
                        <span x-show="sidebarOpen" class="flex-1 text-left">PROKER</span>
                        <i x-show="sidebarOpen" class="bi bi-chevron-down text-[10px]" :class="prokerOpen ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="prokerOpen && sidebarOpen" x-transition x-cloak class="mt-2 ml-12 space-y-2 border-l border-white/20 pl-4 text-nowrap">
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

            <div class="p-6 border-t border-white/10 mt-auto">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-4 p-4 text-red-300 hover:bg-red-500/20 rounded-3xl text-[11px] font-black uppercase italic tracking-widest cursor-pointer leading-none">
                        <i class="bi bi-box-arrow-right text-lg"></i>
                        <span x-show="sidebarOpen">LOGOUT</span>
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="h-20 w-full flex items-center justify-between px-8 text-white shadow-lg z-40" style="background: linear-gradient(90deg, #524D71 0%, #1F84DA 100%);">
                <button @click="sidebarOpen = !sidebarOpen" class="text-white/70 hover:text-white p-2 outline-none cursor-pointer">
                    <i class="bi bi-text-indent-left text-2xl" :class="sidebarOpen ? '' : 'rotate-180'"></i>
                </button>
                <div class="relative" x-data="{ open: false }" @click.away="open = false">
                    <button @click="open = !open" class="bg-white/10 px-5 py-2.5 rounded-2xl border border-white/20 flex items-center gap-3 cursor-pointer hover:bg-white/20 transition-all shadow-inner group">
                        <span class="text-[10px] font-black uppercase tracking-widest italic text-white group-hover:text-yellow-300">{{ Auth::user()->name }}</span>
                        <i class="bi bi-chevron-down text-[10px]" :class="open ? 'rotate-180' : ''"></i>
                    </button>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-10 lg:p-14 bg-[#F8FAFC]">
                <div class="max-w-6xl mx-auto">
                    <div class="mb-10 text-left">
                        <h4 class="font-black italic uppercase tracking-tighter text-[#524D71] mb-1 text-2xl leading-none">
                            BUAT PROKER <span class="text-[#1F84DA]">{{ strtoupper($type) }}</span>
                        </h4>
                        <div class="h-1.5 w-20 bg-[#E8D621] rounded-full mt-2"></div>
                    </div>

                    <form action="{{ route('proker.store') }}" method="POST" enctype="multipart/form-data" class="space-y-10">
                        @csrf
                        <input type="hidden" name="type" value="{{ $type }}">
                        
                        <div class="bg-white rounded-[50px] shadow-sm border border-gray-100 p-10 text-left transition-all hover:shadow-xl">
                            <div class="flex items-center gap-3 mb-10">
                                <div class="p-3 sidebar-gradient rounded-2xl shadow-lg text-white">
                                    <i class="bi bi-journal-plus text-xl"></i>
                                </div>
                                <h5 class="font-black uppercase tracking-widest text-[#524D71] text-sm italic leading-none">INFORMASI UTAMA</h5>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                                <div class="md:col-span-2">
                                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-1 italic">Nama Proker :</label>
                                    <input type="text" name="nama_proker" required class="w-full rounded-2xl border border-gray-100 bg-gray-50 text-[#524D71] py-3.5 px-6 font-bold shadow-inner" placeholder="Contoh: Natal UKMKK 2026">
                                </div>

                                <div>
                                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-1 italic">Jenis Proker :</label>
                                    <select name="jenis" class="w-full rounded-2xl border border-gray-200 bg-gray-50 text-[#524D71] py-3.5 px-6 font-bold shadow-inner cursor-pointer appearance-none">
                                        <option value="RKT" {{ strtolower($type) == 'rkt' ? 'selected' : '' }}>RKT</option>
                                        <option value="Non-RKT" {{ strtolower($type) == 'non-rkt' ? 'selected' : '' }}>Non-RKT</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-1 italic">Departemen :</label>
                                    <input type="text" name="departemen" class="w-full rounded-2xl border border-gray-200 bg-gray-50 text-[#524D71] py-3.5 px-6 font-bold shadow-inner">
                                </div>

                                <div>
                                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-1 italic">Tanggal :</label>
                                    <input type="date" name="tanggal" required class="w-full rounded-2xl border border-gray-200 bg-gray-50 text-[#524D71] py-3.5 px-6 font-bold shadow-inner">
                                </div>
                                <div></div>

                                <div>
                                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-1 italic">Tempat :</label>
                                    <input type="text" name="tempat" class="w-full rounded-2xl border border-gray-200 bg-gray-50 text-[#524D71] py-3.5 px-6 font-bold shadow-inner">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-1 italic">Link Lokasi :</label>
                                    <input type="text" name="link_lokasi" class="w-full rounded-2xl border border-gray-200 bg-gray-50 text-[#524D71] py-3.5 px-6 font-bold shadow-inner">
                                </div>

                                <div class="md:col-span-2 mt-4">
                                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-1 italic">Flyer Kegiatan :</label>
                                    <div class="relative group">
                                        <input type="file" name="flyer" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                        <div class="w-full rounded-[40px] border-2 border-dashed border-gray-200 bg-gray-50 py-14 px-6 text-center group-hover:border-[#1F84DA] group-hover:bg-blue-50 transition-all duration-300">
                                            <i class="bi bi-cloud-arrow-up text-5xl text-gray-300 group-hover:text-[#1F84DA] mb-3 block"></i>
                                            <span class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 group-hover:text-[#524D71]">Tarik file Flyer ke sini atau klik untuk pilih</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if(strtolower($type) === 'rkt')
                        <div class="bg-white rounded-[50px] shadow-sm border border-gray-100 p-10 animate-fadeIn text-left">
                            <div class="flex items-center gap-3 mb-10">
                                <div class="p-3 bg-[#1F84DA] rounded-2xl shadow-lg text-white">
                                    <i class="bi bi-people text-xl"></i>
                                </div>
                                <h5 class="font-black uppercase tracking-widest text-[#524D71] text-sm italic leading-none">STRUKTUR KEPANITIAAN</h5>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 text-left">
                                @php $allSies = ['Ketua Pelaksana', 'Sekretaris Acara', 'Bendahara Acara', 'Sie ACARA', 'Sie KONSUMSI', 'Sie TRANSKAP', 'Sie PDD', 'Sie SEKRETARIAT', 'Sie HUMAS', 'Sie SPONSOR', 'Sie KESEHATAN', 'Sie KEAMANAN', 'BPH', 'Sie LOMBA', 'Sie GAMES']; @endphp
                                @foreach($allSies as $index => $sieName)
                                <div class="h-full">
                                    <div class="bg-gray-50 rounded-[40px] p-8 border border-gray-50 h-full flex flex-col transition-all hover:bg-white hover:shadow-2xl hover:-translate-y-2">
                                        <label class="flex items-center gap-4 mb-6 cursor-pointer group">
                                            <input type="checkbox" name="selected_sie[]" value="{{ $sieName }}" class="w-6 h-6 rounded-xl border-none text-[#1F84DA] focus:ring-blue-100 bg-gray-200 cursor-pointer">
                                            <span class="font-black uppercase tracking-tighter text-[#524D71] italic group-hover:text-[#1F84DA] transition-colors leading-none">{{ $sieName }}</span>
                                        </label>
                                        <div class="joblist-wrapper-{{ $index }} space-y-4 flex-grow">
                                            <input type="text" name="joblist[{{ $sieName }}][]" class="w-full rounded-xl border border-gray-200 bg-white py-4 px-5 text-[11px] font-bold text-[#524D71] shadow-sm" placeholder="Joblist 1...">
                                        </div>
                                        <button type="button" class="mt-6 w-full py-3 bg-white text-[#1F84DA] border border-[#1F84DA]/10 rounded-2xl font-black uppercase text-[9px] tracking-widest transition-all hover:sidebar-gradient hover:text-white btn-tambah-job" data-wrapper=".joblist-wrapper-{{ $index }}" data-name="{{ $sieName }}">
                                            <i class="bi bi-plus-circle mr-1"></i> Tambah Joblist
                                        </button>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <div class="pb-20 text-left">
                            <button type="submit" class="px-16 py-5 rounded-[25px] sidebar-gradient text-white font-black uppercase text-xs tracking-[0.3em] italic shadow-2xl hover:scale-105 active:scale-95 border-none cursor-pointer leading-none">
                                Simpan Proker Baru
                            </button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.btn-tambah-job');
            if (btn) {
                const wrapperSelector = btn.getAttribute('data-wrapper');
                const sieName = btn.getAttribute('data-name');
                const wrapper = document.querySelector(wrapperSelector);
                if (wrapper) {
                    const divBaru = document.createElement('div');
                    divBaru.className = 'animate-fadeIn mb-3';
                    divBaru.innerHTML = `<input type="text" name="joblist[${sieName}][]" class="w-full rounded-xl border border-gray-200 bg-white py-4 px-5 text-[11px] font-bold text-[#524D71] shadow-sm" placeholder="Joblist baru...">`;
                    wrapper.appendChild(divBaru);
                }
            }
        });
    </script>
</body>
</html>