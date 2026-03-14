@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-2">
    {{-- Header Page --}}
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h4 class="font-black italic uppercase tracking-tighter text-[#524D71] mb-1 text-2xl">
                DETAIL PROKER: <span class="text-[#1F84DA]">{{ $project->nama_proker }}</span>
            </h4>
            <div class="h-1.5 w-20 bg-[#E8D621] rounded-full"></div>
        </div>
        <a href="{{ route('proker.index', ['type' => $type ?? 'rkt']) }}" class="text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-[#524D71] transition-all no-underline">
            <i class="bi bi-arrow-left mr-2"></i> Kembali ke Daftar
        </a>
    </div>

    {{-- Filter/Action Bar --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8 bg-white p-6 rounded-[30px] shadow-sm border border-gray-100 items-center">
        
        {{-- Nama Proker (Read-only) --}}
        <div class="bg-gray-50 rounded-2xl py-3 px-4 font-black uppercase text-xs text-[#524D71] text-center italic border border-gray-100">
            {{ $project->nama_proker }}
        </div>
        
        {{-- Sie Panitia (ID: sieSelect) --}}
        <div>
            <label class="block text-[9px] font-black uppercase tracking-widest text-gray-400 pl-2 mb-2">Sie Panitia</label>
            <select id="sieSelect" class="rounded-2xl border-none bg-gray-50 text-[#524D71] text-xs font-bold py-3 px-4 w-full focus:ring-4 focus:ring-[#1F84DA]/20 shadow-inner cursor-pointer">
                <option value="">Pilih Sie...</option>
                @foreach(($project->sies ?? collect())->unique('id') as $sie)
                    <option value="{{ $sie->id }}" {{ request()->query('sie_id') == $sie->id ? 'selected' : '' }}>
                        {{ $sie->nama }}
                    </option>
                @endforeach
            </select>
        </div>
        
        {{-- Jabatan Sie --}}
        <div>
            <label class="block text-[9px] font-black uppercase tracking-widest text-gray-400 pl-2 mb-2">Jabatan Sie</label>
            {{-- Tambahin id="jabatanSelect" di sini --}}
            <select id="jabatanSelect" class="rounded-2xl border-none bg-gray-50 text-[#524D71] text-xs font-bold py-3 px-4 w-full focus:ring-4 focus:ring-[#1F84DA]/20 shadow-inner cursor-pointer">
                <option value="">Pilih Jabatan...</option>
                <option value="Koordinator">Koordinator</option>
                <option value="Anggota Sie">Anggota Sie</option>
                <option value="BPH">BPH</option>
                <option value="Panitia INTI">Panitia INTI</option>
            </select>
        </div>
        
        {{-- Button Joblist (Dinamis via JS) --}}
        <a id="btnJoblist" href="{{ route('proker.joblist', $project->id) }}" 
           class="mt-5 flex items-center justify-center bg-[#524D71] text-white rounded-2xl font-black uppercase text-xs tracking-widest hover:bg-[#1F84DA] transition-all no-underline py-4 shadow-lg shadow-[#524D71]/20">
            JOBLIST
        </a>
    </div>

    {{-- Tabel LBP (Dibikin biar Header-nya selalu mejeng biarpun kosong) --}}
    <div class="bg-white rounded-[30px] shadow-sm border border-gray-100 overflow-hidden mt-8">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    {{-- Header dikasih border-b dan bg-gray-50 biar misah sama body --}}
                    <tr class="bg-gray-50 text-[#524D71] uppercase text-[10px] font-black tracking-widest border-b border-gray-200">
                        <th class="px-6 py-4">Nama User</th>
                        <th class="px-6 py-4">Tanggal Masuk</th>
                        <th class="px-6 py-4">Tugas</th>
                        <th class="px-6 py-4">Input</th>
                        <th class="px-6 py-4">Deadline</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4">Notes</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-xs font-bold text-gray-500">
                    @forelse($myTasks as $task)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 text-[#524D71] italic">{{ $task->user->name ?? 'User' }}</td>
                        <td class="px-6 py-4">{{ $task->created_at->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 text-[#524D71]">{{ $task->deskripsi_tugas }}</td>
                        <td class="px-6 py-4">{{ $task->pemberi_tugas }}</td>
                        <td class="px-6 py-4">{{ $task->deadline->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 text-center">
                            <select class="rounded-lg border-none bg-gray-100 text-[10px] font-black uppercase tracking-widest p-1.5 focus:ring-2 focus:ring-[#1F84DA]/20 cursor-pointer">
                                <option {{ $task->status == 'PENGERJAAN' ? 'selected' : '' }}>PENGERJAAN</option>
                                <option {{ $task->status == 'SELESAI' ? 'selected' : '' }}>SELESAI</option>
                            </select>
                        </td>
                        <td class="px-6 py-4">{{ $task->keterangan ?? '-' }}</td>
                    </tr>
                    @empty
                    {{-- Kalau kosong, ini yang muncul, tapi header tetep di atasnya --}}
                    <tr>
                        <td colspan="7" class="text-center py-12 text-gray-400 font-bold uppercase tracking-widest text-xs bg-white">
                            Belum ada tugas yang di-pick.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil elemen
        const sieSelect = document.getElementById('sieSelect');
        const jabatanSelect = document.getElementById('jabatanSelect');
        const btnJoblist = document.getElementById('btnJoblist');
        
        // Ambil ID Proker dari backend dan Base URL
        const projectId = "{{ $project->id }}";
        const baseUrl = btnJoblist.getAttribute('href').split('?')[0]; 

        // 1. CEK INGATAN BROWSER (Saat halaman dimuat)
        const savedSie = localStorage.getItem(`proker_${projectId}_sie`);
        const savedJabatan = localStorage.getItem(`proker_${projectId}_jabatan`);

        // Kalau ada ingatan Sie, pasang otomatis
        if (savedSie) {
            sieSelect.value = savedSie;
            btnJoblist.href = `${baseUrl}?sie_id=${savedSie}`;
        }

        // Kalau ada ingatan Jabatan, pasang otomatis
        if (savedJabatan) {
            jabatanSelect.value = savedJabatan;
        }

        // 2. SIMPAN INGATAN BARU (Saat user milih)
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

        // 3. OVERRIDE URL (Kalau ada redirect bawaan dari controller pickJob)
        const urlParams = new URLSearchParams(window.location.search);
        const urlSieId = urlParams.get('sie_id');
        if (urlSieId && urlSieId !== savedSie) {
            sieSelect.value = urlSieId;
            localStorage.setItem(`proker_${projectId}_sie`, urlSieId);
            btnJoblist.href = `${baseUrl}?sie_id=${urlSieId}`;
        }
    });
</script>
@endpush
@endsection