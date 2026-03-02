@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <h4 class="fw-bold">Reminder :</h4>
            @foreach($reminderDekatDL as $task)
                <div class="alert alert-warning">
                    <strong>{{ $task->deskripsi_tugas }} dekat DL</strong><br>
                    Deadline: {{ $task->deadline?->format('d M Y') ?? 'Tanpa Deadline' }} -- {{ $task->project?->nama_proker ?? 'Proker Tidak Ditemukan' }}
                </div>
            @endforeach
        </div>
        
        <div class="col-md-6">
            <h4 class="fw-bold">Poin Keaktifan :</h4>
            <div class="card p-5 text-center mb-3">
                <h1 class="display-1 fw-bold">{{ $totalPoin }}</h1>
            </div>
            <div class="d-flex gap-3">
                <div class="card p-3 flex-fill">Kehadiran PDM: <strong>{{ $countPdm }}</strong></div>
                <div class="card p-3 flex-fill">Kehadiran RKT: <strong>{{ $countRkt }}</strong></div>
            </div>
        </div>
    </div>
</div>
@endsection