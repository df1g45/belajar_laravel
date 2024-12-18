@extends('servisMotor.layouts.main')

@section('content')
<div class="container">
    <h1>Edit Data Service</h1>

    <form action="{{ route('dataServis.update', $service->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Dropdown Id Servis Pelanggan -->
        <div class="mb-3">
            <label for="id_service" class="form-label">Id Servis Pelanggan</label>
            <select name="id_service" id="id_service" class="form-control" required>
                <option value="">Pilih Servis Pelanggan</option>
                @foreach ($daftarServices as $daftarService)
                    <option value="{{ $daftarService->id_service }}" {{ $service->id_service == $daftarService->id_service ? 'selected' : '' }}>
                        {{ $daftarService->id_service }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Keluhan -->
        <div class="mb-3">
            <label for="keluhan" class="form-label">Keluhan Kendaraan</label>
            <input type="text" name="keluhan" id="keluhan" class="form-control" value="{{ $service->daftarServis->keluhan }}" disabled>
        </div>

        <!-- Estimasi Service -->
        <div class="mb-3">
            <label for="estimasi_service" class="form-label">Estimasi Service</label>
            <input type="text" name="estimasi_service" id="estimasi_service" class="form-control" value="{{ $service->estimasi_service }}" required>
        </div>

        <!-- Nama Mekanik -->
        <div class="mb-3">
            <label for="nama_mekanik" class="form-label">Nama Mekanik</label>
            <input type="text" name="nama_mekanik" id="nama_mekanik" class="form-control" value="{{ $service->nama_mekanik }}" required>
        </div>

        <!-- Sparepart Pengganti -->
        <div class="mb-3">
            <label for="sparepart_pengganti" class="form-label">Sparepart Pengganti</label>
            <input type="text" name="sparepart_pengganti" id="sparepart_pengganti" class="form-control" value="{{ $service->sparepart_pengganti }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
