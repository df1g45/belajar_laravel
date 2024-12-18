@extends('servisMotor.layouts.main')

@section('content')
    <div class="container">
        <h1>Edit Daftar Service</h1>
        <form action="{{ route('daftarServis.update', $daftarService->id_service) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Id Servis Pelanggan -->
            <div class="mb-3">
                <label for="id_pelanggan" class="form-label">Pelanggan</label>
                <select name="id_pelanggan" id="id_pelanggan" class="form-control" required>
                    <option value="" disabled>Pilih Pelanggan</option>
                    @foreach ($pelanggans as $pelanggan)
                        <option value="{{ $pelanggan->id_pelanggan }}" {{ $pelanggan->id_pelanggan == $daftarService->id_pelanggan ? 'selected' : '' }}>
                            {{ $pelanggan->nama_lengkap }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Kendaraan -->
            <div class="mb-3">
                <label for="no_plat" class="form-label">Kendaraan</label>
                <select name="no_plat" id="no_plat" class="form-control" required>
                    <option value="" disabled>Pilih Kendaraan</option>
                    @foreach ($kendaraans as $kendaraan)
                        <option value="{{ $kendaraan->no_plat }}" {{ $kendaraan->no_plat == $daftarService->no_plat ? 'selected' : '' }}>
                            {{ $kendaraan->no_plat }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Keluhan -->
            <div class="mb-3">
                <label for="keluhan" class="form-label">Keluhan Kendaraan</label>
                <textarea name="keluhan" id="keluhan" class="form-control" required>{{ $daftarService->keluhan }}</textarea>
            </div>

            <!-- Tanggal Servis -->
            <div class="mb-3">
                <label for="tanggal_service" class="form-label">Tanggal Servis</label>
                <input type="date" name="tanggal_service" id="tanggal_service" class="form-control" value="{{ $daftarService->tanggal_service }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
