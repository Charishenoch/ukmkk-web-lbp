@extends('layouts.app')

@section('content')
<div class="w-full">
    {{-- Kita pakai Flexbox murni Tailwind biar gak diganggu Bootstrap --}}
    <div class="flex flex-col lg:flex-row justify-center items-stretch gap-8 w-full">
        
        {{-- CARD KIRI: PROKER AKTIF --}}
        <div class="w-full lg:w-[45%] flex">
            <div class="bg-white rounded-[50px] shadow-sm border border-gray-100 p-8 md:p-10 w-full flex flex-col transition-all hover:shadow-md">
                <h4 class="text-[#524D71] font-black italic uppercase tracking-[0.2em] text-center mb-10">
                    Proker Aktif :
                </h4>
                
                <div class="space-y-4 flex-grow">
                    @forelse($aktifProker->take(2) as $p)
                        <div class="flex items-center p-5 rounded-[30px] text-white shadow-xl"
                             style="background: linear-gradient(135deg, #524D71 0%, #1F84DA 100%);">
                            <div class="bg-white/20 p-3 rounded-2xl me-4 backdrop-blur-md">
                                <i class="bi bi-person-walking fs-4"></i>
                            </div>
                            <div class="min-w-0">
                                <h5 class="font-black italic uppercase tracking-tighter mb-1 text-[15px] truncate">{{ $p->nama_proker }}</h5>
                                <p class="mb-0 text-[10px] font-bold uppercase tracking-[0.15em] opacity-70 truncate">
                                    {{ $p->tanggal }} — {{ $p->departemen }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="py-12 text-center text-gray-300 italic font-bold">Tidak ada proker aktif.</div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- CARD KANAN: REKAP PROKER --}}
        <div class="w-full lg:w-[45%] flex">
            <div class="bg-white rounded-[50px] shadow-sm border border-gray-100 p-8 md:p-10 text-center w-full flex flex-col transition-all hover:shadow-md">
                <h4 class="text-[#524D71] font-black italic uppercase tracking-[0.2em] mb-10">
                    Rekap Proker
                </h4>
                
                <div class="flex-grow">
                    <div class="flex flex-row justify-center gap-4 mb-10">
                        {{-- BOX RKT --}}
                        <div class="w-1/2">
                            <h5 class="font-black uppercase text-[11px] tracking-widest mb-4 text-[#524D71]">RKT :</h5>
                            <div class="rounded-[35px] overflow-hidden shadow-2xl border border-gray-50 bg-white">
                                <div class="bg-[#1F84DA] py-6 text-white text-center">
                                    <h1 class="font-black italic text-5xl mb-0">{{ $totalRkt }}</h1>
                                </div>
                                <div class="bg-white p-4 space-y-2.5">
                                    <div class="bg-gray-100 h-1.5 w-full rounded-full opacity-50"></div>
                                    <p class="text-[9px] font-black text-gray-300 uppercase tracking-widest pt-4">Daftar RKT</p>
                                </div>
                                <div class="bg-[#1F84DA] h-5 w-full"></div>
                            </div>
                        </div>

                        {{-- BOX NON-RKT --}}
                        <div class="w-1/2">
                            <h5 class="font-black uppercase text-[11px] tracking-widest mb-4 text-[#524D71]">NON-RKT :</h5>
                            <div class="rounded-[35px] overflow-hidden shadow-2xl border border-gray-50 bg-white">
                                <div class="bg-[#524D71] py-6 text-white text-center">
                                    <h1 class="font-black italic text-5xl mb-0">{{ $totalNonRkt }}</h1>
                                </div>
                                <div class="bg-white p-4 space-y-2.5">
                                    <div class="bg-gray-100 h-1.5 w-full rounded-full opacity-50"></div>
                                    <p class="text-[9px] font-black text-gray-300 uppercase tracking-widest pt-4">Daftar Non-RKT</p>
                                </div>
                                <div class="bg-[#524D71] h-5 w-full"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <div class="mt-auto">
                    <button class="bg-[#E8D621] text-[#524D71] px-12 py-3.5 rounded-2xl font-black italic uppercase tracking-[0.3em] text-[11px] shadow-xl shadow-yellow-500/20 hover:scale-105 transition-all border-none">
                        Cetak Laporan
                    </button>
                </div> -->
            </div>
        </div>

    </div>
</div>
@endsection