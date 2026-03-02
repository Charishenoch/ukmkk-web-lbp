@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <h4 class="fw-bold">Proker Aktif :</h4>
            @foreach($aktifProker as $p)
                <div class="card text-white bg-warning p-3 mb-3" style="border-radius: 10px;">
                    <h5 class="fw-bold"><i class="bi bi-person-walking"></i> {{ $p->nama_proker }}</h5>
                    <p class="mb-0">{{ $p->tanggal }} -- {{ $p->departemen }}</p>
                </div>
            @endforeach
        </div>

        <div class="col-md-6">
            <h4 class="fw-bold">Rekap Proker :</h4>
            <div class="card p-4" style="border-radius: 10px;">
                <div class="row text-center">
                    <div class="col-6">
                        <h5>RKT :</h5>
                        <h1 class="display-3 fw-bold text-primary">{{ $totalRkt }}</h1>
                    </div>
                    <div class="col-6">
                        <h5>NON-RKT :</h5>
                        <h1 class="display-3 fw-bold text-danger">{{ $totalNonRkt }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection