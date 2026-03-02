@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item active">Proker</li>
        </ol>
    </nav>
    
    <h4 class="fw-bold mb-4">{{ strtoupper($type) }} (Program Kerja)</h4>
    
    <div class="row g-4">
        @if(auth()->user()->role == 'superadmin')
        <div class="col-md-4">
            <a href="{{ route('proker.create', ['type' => $type]) }}" class="text-decoration-none">
                <div class="card border-dark text-center" style="border-radius: 15px; min-height: 350px; background: #d9d9d9;">
                    <div class="card-header bg-white border-bottom border-dark fw-bold py-3">BUAT PROKER</div>
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <i class="bi bi-plus-lg" style="font-size: 8rem; color: #555;"></i>
                    </div>
                </div>
            </a>
        </div>
        @endif

        @foreach($projects as $p)
        <div class="col-md-4">
            <div class="card border-dark shadow-sm" style="border-radius: 15px; overflow: hidden; min-height: 350px;">
                <div style="height: 220px; background: #d9d9d9; display: flex; align-items: center; justify-content: center;">
                    @if($p->flyer)
                        <img src="{{ asset('storage/' . $p->flyer) }}" class="img-fluid object-fit-cover w-100 h-100">
                    @else
                        <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                    @endif
                </div>
                
                <div class="card-body border-top border-dark d-flex flex-column justify-content-between p-0">
                    <div class="p-3">
                        <small class="text-muted fw-bold">Dept. {{ strtoupper($p->departemen ?? 'INTERNAL') }}</small>
                        <h4 class="fw-bold text-uppercase mb-0">{{ $p->nama_proker }}</h4>
                    </div>
                    
                    <div class="border-top border-dark text-center py-2 bg-light fw-bold">
                        <a href="{{ route('proker.show', $p->id) }}" class="text-dark text-decoration-none d-block">
                            {{ $p->tanggal ? \Carbon\Carbon::parse($p->tanggal)->format('d - m Y') : '23 - 25 Desember 2025' }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection