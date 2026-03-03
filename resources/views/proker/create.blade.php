@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-2">
    {{-- Header Page --}}
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h4 class="font-black italic uppercase tracking-tighter text-[#524D71] mb-1 text-2xl">
                BUAT PROKER <span class="text-[#1F84DA]">{{ strtoupper($type) }}</span>
            </h4>
            <div class="h-1.5 w-20 bg-[#E8D621] rounded-full"></div>
        </div>
        <a href="{{ route('proker.index', ['type' => $type]) }}" class="text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-[#524D71] transition-all no-underline">
            <i class="bi bi-arrow-left mr-2"></i> Kembali ke Daftar
        </a>
    </div>

    <form action="{{ route('proker.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        <input type="hidden" name="type" value="{{ $type }}">
        
        {{-- Section 1: Informasi Utama (Selalu Muncul) --}}
        <div class="bg-white rounded-[40px] shadow-sm border border-gray-100 p-8 md:p-10 transition-all hover:shadow-md">
            <div class="flex items-center gap-3 mb-8">
                <div class="p-2 bg-[#524D71] rounded-xl shadow-lg shadow-[#524D71]/20">
                    <i class="bi bi-journal-plus text-white text-lg"></i>
                </div>
                <h5 class="font-black uppercase tracking-widest text-[#524D71] text-sm italic">Informasi Utama</h5>
            </div>

            <div class="row g-4">
                <div class="col-md-12">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-1">Nama Proker</label>
                    <input type="text" name="nama_proker" required
                           class="w-full rounded-2xl border-none bg-gray-50 text-[#524D71] py-4 px-6 focus:ring-4 focus:ring-[#1F84DA]/20 transition-all font-bold placeholder-gray-300 shadow-inner"
                           placeholder="Contoh: Natal UKMKK 2026">
                </div>

                <div class="col-md-6">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-1">Jenis Proker</label>
                    <select name="jenis" class="w-full rounded-2xl border-none bg-gray-50 text-[#524D71] py-4 px-6 focus:ring-4 focus:ring-[#1F84DA]/20 transition-all font-bold shadow-inner cursor-pointer">
                        <option value="RKT" {{ strtolower($type) == 'rkt' ? 'selected' : '' }}>RKT</option>
                        <option value="Non-RKT" {{ strtolower($type) == 'non-rkt' ? 'selected' : '' }}>Non-RKT</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-1">Departemen</label>
                    <input type="text" name="departemen" class="w-full rounded-2xl border-none bg-gray-50 text-[#524D71] py-4 px-6 focus:ring-4 focus:ring-[#1F84DA]/20 transition-all font-bold shadow-inner" placeholder="Misal: Internal">
                </div>

                <div class="col-md-6">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-1">Tanggal</label>
                    <input type="date" name="tanggal" required class="w-full rounded-2xl border-none bg-gray-50 text-[#524D71] py-4 px-6 focus:ring-4 focus:ring-[#1F84DA]/20 transition-all font-bold shadow-inner">
                </div>

                <div class="col-md-6">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-1">Tempat</label>
                    <input type="text" name="tempat" class="w-full rounded-2xl border-none bg-gray-50 text-[#524D71] py-4 px-6 focus:ring-4 focus:ring-[#1F84DA]/20 transition-all font-bold shadow-inner" placeholder="Lokasi kegiatan">
                </div>

                <div class="col-md-12">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-1">Link Lokasi (G-Maps)</label>
                    <input type="text" name="link_lokasi" class="w-full rounded-2xl border-none bg-gray-50 text-[#524D71] py-4 px-6 focus:ring-4 focus:ring-[#1F84DA]/20 transition-all font-bold shadow-inner" placeholder="Tempel link maps di sini...">
                </div>

                <div class="col-md-12">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-1">Flyer Kegiatan</label>
                    <div class="relative group">
                        <input type="file" name="flyer" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div class="w-full rounded-[30px] border-2 border-dashed border-gray-100 bg-gray-50 py-10 px-6 text-center group-hover:border-[#1F84DA] group-hover:bg-[#1F84DA]/5 transition-all duration-300">
                            <i class="bi bi-cloud-arrow-up text-4xl text-gray-300 group-hover:text-[#1F84DA] transition-colors mb-3 block"></i>
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest group-hover:text-[#524D71]">Klik atau Tarik file Flyer ke sini</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Section 2: Struktur Kepanitiaan (HANYA MUNCUL JIKA RKT) --}}
        @if(strtolower($type) === 'rkt')
        <div class="bg-white rounded-[40px] shadow-sm border border-gray-100 p-8 md:p-10 animate-fadeIn">
            <div class="flex items-center gap-3 mb-8">
                <div class="p-2 bg-[#1F84DA] rounded-xl shadow-lg shadow-[#1F84DA]/20">
                    <i class="bi bi-people text-white text-lg"></i>
                </div>
                <h5 class="font-black uppercase tracking-widest text-[#524D71] text-sm italic">Struktur Kepanitiaan</h5>
            </div>

            <div class="row g-4">
                @foreach($defaultSies as $sie)
                <div class="col-md-6 col-lg-4" id="sie-card-{{ $sie->id }}">
                    <div class="bg-gray-50 rounded-[35px] p-6 border border-gray-50 h-full flex flex-col transition-all hover:bg-white hover:shadow-xl hover:shadow-gray-200/50">
                        <label class="flex items-center gap-3 mb-5 cursor-pointer">
                            <input type="checkbox" name="selected_sie[]" value="{{ $sie->id }}" 
                                   class="w-5 h-5 rounded-lg border-none text-[#1F84DA] focus:ring-[#1F84DA]/20 bg-gray-200 cursor-pointer">
                            <span class="font-black uppercase tracking-tighter text-[#524D71] italic">{{ $sie->nama }}</span>
                        </label>
                        
                        <div class="joblist-wrapper space-y-3 flex-grow">
                            <input type="text" name="joblist[{{ $sie->id }}][]" 
                                   class="w-full rounded-xl border-none bg-white py-3.5 px-4 text-[11px] font-bold text-[#524D71] shadow-sm placeholder-gray-300" 
                                   placeholder="Joblist 1...">
                        </div>

                        <button type="button" class="mt-5 w-full py-2.5 bg-[#B9B3D4]/20 text-[#524D71] rounded-xl font-black uppercase text-[9px] tracking-[0.2em] transition-all hover:bg-[#B9B3D4]/40 btn-tambah-sel" data-sie-id="{{ $sie->id }}">
                            <i class="bi bi-plus-circle-dotted mr-1"></i> Tambah Joblist
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Action Buttons --}}
        <div class="flex items-center gap-4 pt-6">
            <button type="submit" 
                    class="px-14 py-4 rounded-2xl bg-[#E8D621] text-[#524D71] font-black uppercase text-xs tracking-[0.3em] italic shadow-xl shadow-[#E8D621]/30 transition-all hover:scale-[1.05] active:scale-95 border-none">
                Simpan Proker {{ strtoupper($type) }}
            </button>
            <a href="{{ route('proker.index', ['type' => $type]) }}" 
               class="px-8 py-4 rounded-2xl bg-white text-gray-400 font-black uppercase text-xs tracking-widest transition-all hover:text-red-500 no-underline">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('btn-tambah-sel')) {
            const sieId = e.target.getAttribute('data-sie-id');
            const wrapper = document.querySelector(`#sie-card-${sieId} .joblist-wrapper`);
            
            const divBaru = document.createElement('div');
            divBaru.className = 'animate-fadeIn';
            divBaru.innerHTML = `
                <input type="text" name="joblist[${sieId}][]" 
                       class="w-full rounded-xl border-none bg-white py-3.5 px-4 text-[11px] font-bold text-[#524D71] shadow-sm placeholder-gray-300 mb-3" 
                       placeholder="Joblist baru...">
            `;
            
            wrapper.appendChild(divBaru);
        }
    });
</script>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn { animation: fadeIn 0.4s ease-out; }
    
    /* Chrome, Safari, Edge, Opera - Remove focus outline */
    input:focus, select:focus { outline: none; }

    /* Custom style for date & select */
    input[type="date"]::-webkit-calendar-picker-indicator {
        filter: invert(30%) sepia(20%) saturate(1000%) hue-rotate(210deg) brightness(90%) contrast(90%);
        cursor: pointer;
    }
</style>
@endpush