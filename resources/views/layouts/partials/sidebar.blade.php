<div class="p-4">
    {{-- Label Dashboard View --}}
    <div class="text-gray-500 text-[10px] font-black uppercase tracking-[0.4em] mb-10 pl-2 italic">
        Dashboard View
    </div>
    
    <nav class="space-y-2">
        {{-- Menu Dashboard (Active Style) --}}
        <a href="{{ route('dashboard') }}" 
           class="flex items-center p-3 rounded-2xl bg-[#E8D621] text-[#524D71] font-black uppercase text-xs tracking-[0.2em] shadow-lg italic transition-all hover:scale-105">
            <i class="bi bi-grid-fill mr-3 text-lg"></i> DASHBOARD
        </a>

        {{-- Dropdown Proker --}}
        <div class="pt-2">
            <button @click="prokerOpen = !prokerOpen" 
                    class="w-full flex items-center justify-between p-3 rounded-2xl text-gray-400 hover:bg-white/5 transition-all font-black uppercase text-xs tracking-widest outline-none border-none">
                <span class="flex items-center">
                    <i class="bi bi-journal-text mr-3 text-lg"></i> PROKER
                </span>
                <i class="bi bi-chevron-down text-[10px] transition-transform duration-300" 
                   :class="prokerOpen ? 'rotate-180 text-[#E8D621]' : ''"></i>
            </button>
            
            {{-- Isi Dropdown (RKT & NON-RKT) --}}
            <div x-show="prokerOpen" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 transform -translate-y-2"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 class="mt-2 ml-9 space-y-2 border-l-2 border-white/5 pl-4">
                
                <a href="{{ route('proker.index', ['type' => 'rkt']) }}" 
                class="block py-1.5 text-[10px] font-black text-gray-500 hover:text-[#E8D621] hover:no-underline uppercase tracking-widest transition-colors flex items-center gap-2">
                    <span class="w-1.5 h-1.5 bg-current rounded-full"></span>
                    Kegiatan RKT
                </a>
                
                <a href="{{ route('proker.index', ['type' => 'non-rkt']) }}" 
                class="block py-1.5 text-[10px] font-black text-gray-500 hover:text-[#E8D621] hover:no-underline uppercase tracking-widest transition-colors flex items-center gap-2">
                    <span class="w-1.5 h-1.5 bg-current rounded-full"></span>
                    Kegiatan NON-RKT
                </a>
            </div>
        </div>

        {{-- Menu Absensi --}}
        <a href="#" class="flex items-center p-3 rounded-2xl text-gray-400 hover:bg-white/5 transition-all font-black uppercase text-xs tracking-widest">
            <i class="bi bi-calendar-check mr-3 text-lg"></i> ABSENSI
        </a>

        {{-- Menu Profile --}}
        <a href="#" class="flex items-center p-3 rounded-2xl text-gray-400 hover:bg-white/5 transition-all font-black uppercase text-xs tracking-widest">
            <i class="bi bi-person-circle mr-3 text-lg"></i> PROFILE
        </a>
    </nav>

    {{-- Logout Section (Opsional tapi berguna) --}}
    <div class="mt-20 pt-10 border-t border-white/5">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center p-3 rounded-2xl text-red-400/60 hover:text-red-400 hover:bg-red-400/5 transition-all font-black uppercase text-[10px] tracking-widest italic">
                <i class="bi bi-box-arrow-right mr-3 text-lg"></i> LOGOUT
            </button>
        </form>
    </div>
</div>