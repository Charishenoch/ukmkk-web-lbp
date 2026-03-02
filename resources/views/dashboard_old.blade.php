@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row g-4">
        <div class="col-md-5">
            <div class="card card-custom p-4 mb-4">
                <h5 class="fw-bold text-center border-bottom pb-2 mb-3">Reminder :</h5>
                
                @forelse($reminderSudahDL as $task)
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-3 fs-4"></i>
                    <div>
                        <strong>{{ $task->deskripsi_tugas }} sudah DL</strong><br>
                        <small>Tanggal Deadline: {{ $task->deadline->format('d M Y') }} -- NATAL</small>
                    </div>
                </div>
                @empty
                @endforelse

                @forelse($reminderDekatDL as $task)
                <div class="alert alert-warning d-flex align-items-center" role="alert">
                    <i class="bi bi-clock-history me-3 fs-4"></i>
                    <div>
                        <strong>{{ $task->deskripsi_tugas }} dekat DL</strong><br>
                        <small>Tanggal Deadline: {{ $task->deadline->format('d M Y') }} -- NATAL</small>
                    </div>
                </div>
                @empty
                @endforelse

                @if($reminderSudahDL->isEmpty() && $reminderDekatDL->isEmpty())
                <p class="text-center text-muted py-3">Tidak ada tugas mendesak.</p>
                @endif
            </div>

            <div class="row g-2">
                <div class="col-6">
                    <div class="card p-3 card-custom text-center bg-white">
                        <small class="text-muted">Nama Proker</small>
                        <h6 class="fw-bold mb-0">Sebagai Sie</h6>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card p-3 card-custom text-center bg-white">
                        <small class="text-muted">Natal</small>
                        <h6 class="fw-bold mb-0">Ketua Pelaksana</h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card card-custom p-5 text-center bg-white mb-4 border border-dark">
                <h5 class="text-start fw-bold mb-4">Poin Keaktifan :</h5>
                <h1 class="display-1 fw-bold my-4">{{ $totalPoin }}</h1>
            </div>

            <div class="row g-3">
                <div class="col-6">
                    <div class="card card-custom p-3 border border-dark">
                        <p class="mb-1">Kehadiran PDM :</p>
                        <h3 class="fw-bold mb-0 text-center">{{ $countPdm }}</h3>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card card-custom p-3 border border-dark">
                        <p class="mb-1">Kehadiran RKT :</p>
                        <h3 class="fw-bold mb-0 text-center">{{ $countRkt }}</h3>
                    </div>
                </div>
            </div>

            <div class="card card-custom mt-4 p-4 border border-dark">
                <h6 class="fw-bold">Input Logbook Cepat</h6>
                <form action="{{ route('tasks.store') }}" method="POST" class="row g-2">
                    @csrf
                    <div class="col-8">
                        <input type="text" name="deskripsi_tugas" class="form-control form-control-sm" placeholder="Tugas baru..." required>
                    </div>
                    <div class="col-4 text-end">
                        <input type="hidden" name="pemberi_tugas" value="Self">
                        <input type="hidden" name="output_score" value="3">
                        <button type="submit" class="btn btn-sm btn-primary w-100">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection