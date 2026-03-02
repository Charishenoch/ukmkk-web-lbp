@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h4 class="fw-bold mb-4">BUAT PROKER</h4>
    <form action="{{ route('proker.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="card p-4 mb-4 border-dark">
            <h5 class="fw-bold mb-3">PROGRAM KERJA</h5>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label>Nama Proker</label>
                    <input type="text" name="nama_proker" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Jenis Proker</label>
                    <select name="jenis" class="form-control">
                        <option value="RKT">RKT</option>
                        <option value="Non-RKT">Non-RKT</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Departemen</label>
                    <input type="text" name="departemen" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Tempat</label>
                    <input type="text" name="tempat" class="form-control">
                </div>
                <div class="col-md-12 mb-3">
                    <label>Link Lokasi</label>
                    <input type="text" name="link_lokasi" class="form-control">
                </div>
                <div class="col-md-12 mb-3">
                    <label>Upload Flyer</label>
                    <input type="file" name="flyer" class="form-control">
                </div>
            </div>
        </div>

        <div class="card p-4 mb-4 border-dark">
            <h5 class="fw-bold mb-3">KEPANITIAAN</h5>
            @foreach($defaultSies as $sie)
            <div class="card p-3 mb-3 border-secondary" id="sie-card-{{ $sie->id }}">
                <label class="fw-bold">
                    <input type="checkbox" name="selected_sie[]" value="{{ $sie->id }}"> {{ $sie->nama }}
                </label>
                
                <div class="joblist-wrapper mt-2">
                    <input type="text" name="joblist[{{ $sie->id }}][]" class="form-control mb-2" placeholder="Tulis joblist...">
                </div>

                <button type="button" class="btn btn-sm btn-outline-secondary mt-2 btn-tambah-sel" data-sie-id="{{ $sie->id }}">
                    + Tambah Sel
                </button>
            </div>
            @endforeach
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success px-5 fw-bold">CREATE</button>
            <a href="{{ route('proker.index') }}" class="btn btn-secondary px-4">CANCEL</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('btn-tambah-sel')) {
            const sieId = e.target.getAttribute('data-sie-id');
            const wrapper = document.querySelector(`#sie-card-${sieId} .joblist-wrapper`);
            
            const inputBaru = document.createElement('input');
            inputBaru.type = 'text';
            inputBaru.name = `joblist[${sieId}][]`;
            inputBaru.className = 'form-control mb-2';
            inputBaru.placeholder = 'Tulis joblist baru...';
            
            wrapper.appendChild(inputBaru);
        }
    });
</script>
@endpush