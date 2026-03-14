@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-2">
    {{-- Header Page --}}
    <div class="mb-8">
        <h4 class="font-black italic uppercase tracking-tighter text-[#524D71] mb-1 text-2xl">
            JOBLIST <span class="text-[#1F84DA]">({{ $project->nama_proker }})</span>
            {{-- Nampilin Lencana SIE kalau di-filter --}}
            @if($selectedSie)
                <span class="bg-[#E8D621] text-[#524D71] text-xs px-4 py-1.5 rounded-full ml-3 align-middle font-black tracking-widest">
                    SIE: {{ $selectedSie->nama }}
                </span>
            @endif
        </h4>
        <div class="h-1.5 w-20 bg-[#E8D621] rounded-full mb-6"></div>
    </div>

    {{-- Modern Table --}}
    <form action="{{ route('joblist.pick', $project->id) }}" method="POST">
        @csrf
        <input type="hidden" name="sie_id" value="{{ request()->query('sie_id') }}">
        <div class="bg-white rounded-[30px] shadow-sm border border-gray-100 overflow-hidden mb-6">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-[#524D71] uppercase text-[10px] font-black tracking-widest">
                            <th class="px-6 py-4 text-center w-16">#</th>
                            <th class="px-6 py-4">Deskripsi Tugas</th>
                            <th class="px-6 py-4 text-center">Input</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-xs font-bold text-gray-500">
                        {{-- SEKARANG PAKE VARIABEL $jobs --}}
                        @forelse($jobs as $job)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-center">
                                <input type="checkbox" name="selected_jobs[]" value="{{ $job->id }}" 
                                       class="w-5 h-5 rounded-md border-gray-300 text-[#1F84DA] focus:ring-[#1F84DA]/20 cursor-pointer">
                            </td>
                            <td class="px-6 py-4 text-[#524D71]">{{ $job->deskripsi_tugas }}</td>
                            <td class="px-6 py-4 text-center">ADMIN</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-10 text-gray-400 font-bold uppercase tracking-widest text-xs">Belum ada joblist tersedia untuk Sie ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Action Button --}}
        <div class="text-end">
            <button type="submit" 
                    class="bg-[#FF4081] text-white px-12 py-3 rounded-2xl font-black uppercase text-xs tracking-widest italic hover:scale-105 transition-all shadow-lg shadow-[#FF4081]/20">
                PICK
            </button>
        </div>
    </form>
</div>
@endsection