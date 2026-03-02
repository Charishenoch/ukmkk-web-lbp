@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('proker.index', ['type' => 'rkt']) }}" class="text-decoration-none">Proker</a></li>
            <li class="breadcrumb-item active">{{ $project->nama_proker }}</li>
        </ol>
    </nav>

    <div class="row g-2 mb-4">
        <div class="col-md-3">
            <div class="p-2 border border-dark bg-light text-center fw-bold">{{ $project->nama_proker }}</div>
        </div>
        <div class="col-md-3">
            <select class="form-select border-dark">
                <option selected>SIE PANITIA</option>
                </select>
        </div>
        <div class="col-md-3">
            <select class="form-select border-dark">
                <option selected>JABATAN SIE</option>
                <option>Koordinator</option>
                <option>Anggota Sie</option>
                <option>BPH</option>
                <option>Panitia Inti</option>
            </select>
        </div>
        <div class="col-md-3 text-end">
            <a href="{{ route('proker.joblist', $project->id) }}" class="btn btn-outline-dark fw-bold w-100 border-dark">JOBLIST</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered border-dark align-middle">
            <thead class="table-secondary text-center">
                <tr>
                    <th>TANGGAL MASUK</th>
                    <th>TUGAS</th>
                    <th>INPUT</th>
                    <th>DEADLINE</th>
                    <th>STATUS</th>
                    <th>NOTES</th>
                    <th>OUTPUT</th>
                </tr>
            </thead>
            <tbody>
                @forelse($myTasks as $task)
                <tr>
                    <td>{{ $task->created_at->format('d/m/Y') }}</td>
                    <td>{{ $task->deskripsi_tugas }}</td>
                    <td>{{ $task->validator->name ?? $task->pemberi_tugas }}</td>
                    <td>{{ $task->deadline->format('d/m/Y') }}</td>
                    <td>
                        <select class="form-select form-select-sm border-0 bg-transparent fw-bold">
                            <option {{ $task->status == 'PENGERJAAN' ? 'selected' : '' }}>PENGERJAAN</option>
                            <option {{ $task->status == 'SELESAI' ? 'selected' : '' }}>SELESAI</option>
                            <option {{ $task->status == 'TIDAK SELESAI' ? 'selected' : '' }}>TIDAK SELESAI</option>
                        </select>
                    </td>
                    <td>{{ $task->keterangan }}</td>
                    <td class="text-center">
                        <span class="badge {{ $task->output == 'BAIK' ? 'bg-success' : ($task->output == 'CUKUP' ? 'bg-warning' : 'bg-danger') }}">
                            {{ $task->output ?? '-' }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-4 text-muted">Belum ada tugas. Klik JOBLIST untuk ambil tugas default atau ADD JOB untuk tugas mandiri.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="text-end mt-3">
        <button class="btn btn-outline-dark fw-bold px-4" style="border-radius: 10px;">ADD JOB</button>
    </div>
</div>

