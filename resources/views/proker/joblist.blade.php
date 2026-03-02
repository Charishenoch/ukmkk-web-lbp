@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('proker.index', ['type' => 'rkt']) }}">Proker</a></li>
            <li class="breadcrumb-item"><a href="{{ route('proker.show', $project->id) }}">{{ $project->nama_proker }}</a></li>
            <li class="breadcrumb-item active">Joblist</li>
        </ol>
    </nav>

    <h4 class="fw-bold mb-4">JOBLIST ({{ $project->nama_proker }})</h4>

    <form action="{{ route('joblist.pick', $project->id) }}" method="POST">
        @csrf
        <table class="table table-bordered border-dark">
            <thead class="table-secondary text-center">
                <tr>
                    <th width="50">#</th>
                    <th>DESKRIPSI TUGAS</th>
                    <th width="100">INPUT</th>
                </tr>
            </thead>
            <tbody>
                @foreach($project->joblistDefaults as $job)
                <tr>
                    <td class="text-center"><input type="checkbox" name="selected_jobs[]" value="{{ $job->id }}" class="form-check-input border-dark"></td>
                    <td>{{ $job->deskripsi_tugas }}</td>
                    <td class="text-center">ADMIN</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-end">
            <button type="submit" class="btn btn-danger px-5 fw-bold" style="border-radius: 10px;">PICK</button>
        </div>
    </form>
</div>
@endsection