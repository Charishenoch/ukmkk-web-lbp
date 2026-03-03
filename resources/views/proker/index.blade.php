@extends('layouts.app')

@section('content')
<div class="w-full">
    {{-- Pakai CSS Grid murni Tailwind: Otomatis 1 kolom di HP, 2 di Tablet, 3 di Laptop --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 items-stretch">
        
        {{-- CARD BUAT PROKER (Hanya muncul untuk Superadmin) --}}
        @if(auth()->user()->role == 'superadmin')
        <a href="{{ route('proker.create', ['type' => $type]) }}" class="group block no-underline h-full">
            <div class="h-full min-h-[400px] bg-white rounded-[45px] border-4 border-dashed border-gray-100 flex flex-col items-center justify-center p-10 transition-all duration-300 group-hover:border-[#E8D621] group-hover:bg-[#E8D621]/5 shadow-sm">
                <div class="w-20 h-20 rounded-full bg-gray-50 flex items-center justify-center mb-6 group-hover:bg-[#E8D621] group-hover:scale-110 transition-all duration-500 shadow-inner">
                    <i class="bi bi-plus-lg text-3xl text-gray-300 group-hover:text-[#524D71]"></i>
                </div>
                <span class="font-black italic uppercase tracking-[0.2em] text-[#524D71] text-xs text-center">Buat Proker Baru</span>
                <p class="text-[9px] font-bold text-gray-300 uppercase tracking-widest mt-2">Klik untuk tambah data</p>
            </div>
        </a>
        @endif

        {{-- LIST DATA PROKER --}}
        @foreach($projects as $p)
        <div class="bg-white rounded-[45px] shadow-sm border border-gray-100 overflow-hidden transition-all duration-500 hover:shadow-2xl hover:shadow-[#524D71]/10 hover:-translate-y-2 flex flex-col h-full min-h-[400px]">
            
            {{-- Flyer/Header Image --}}
            <div class="relative h-[220px] bg-[#524D71] overflow-hidden">
                @if($p->flyer)
                    <img src="{{ asset('storage/' . $p->flyer) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                @else
                    <div class="w-full h-full flex items-center justify-center opacity-20 italic font-black text-white text-3xl">UKMKK</div>
                @endif
                
                {{-- Badge Dept --}}
                <div class="absolute top-5 left-5">
                    <span class="bg-white/90 backdrop-blur-md text-[#524D71] text-[9px] font-black px-4 py-2 rounded-full uppercase tracking-widest shadow-lg">
                        Dept. {{ $p->departemen ?? 'INT' }}
                    </span>
                </div>
            </div>
            
            {{-- Info Detail --}}
            <div class="p-8 flex flex-col flex-grow">
                <h5 class="font-black italic uppercase tracking-tighter text-[#524D71] text-xl mb-2 line-clamp-2 leading-tight">
                    {{ $p->nama_proker }}
                </h5>
                
                <div class="mt-auto flex items-center justify-between border-t border-gray-50 pt-5">
                    <div class="flex flex-col">
                        <span class="text-[8px] font-bold text-gray-400 uppercase tracking-[0.2em]">Pelaksanaan:</span>
                        <span class="text-xs font-black text-[#1F84DA] uppercase italic">
                            {{ $p->tanggal ? \Carbon\Carbon::parse($p->tanggal)->format('d - m Y') : 'TBA' }}
                        </span>
                    </div>
                    
                    <a href="{{ route('proker.show', $p->id) }}" 
                       class="w-11 h-11 rounded-2xl bg-gray-50 flex items-center justify-center text-[#524D71] transition-all duration-300 hover:bg-[#E8D621] hover:scale-110 border border-gray-100 shadow-sm">
                        <i class="bi bi-arrow-right text-lg"></i>
                    </a>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>
@endsection