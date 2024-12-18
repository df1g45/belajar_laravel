@extends('servisMotor.layouts.main')

@section('content')
    <div class="container">
        <h1>Tambah Daftar Service</h1>
        <form action="{{ route('daftarServis.store') }}" method="POST">
            @csrf

            <!-- Id Servis Pelanggan -->
            <div class="mb-3">
                <label for="id_pelanggan" class="form-label">Id Servis Pelanggan</label>
                <select name="id_pelanggan" id="id_pelanggan" class="form-control" required>
                    <option value="" disabled selected>Pilih Pelanggan</option>
                    @foreach ($pelanggans as $pelanggan)
                        <option value="{{ $pelanggan->id_pelanggan }}">{{ $pelanggan->id_pelanggan }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Nama Pelanggan (Muncul Otomatis) -->
            <div class="mb-3">
                <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                <input type="text" id="nama_pelanggan" class="form-control" disabled>
            </div>

            <!-- No Plat Kendaraan -->
            <div class="mb-3">
                <label for="no_plat" class="form-label">No Plat Kendaraan</label>
                <select name="no_plat" id="no_plat" class="form-control" required>
                    <option value="" disabled selected>Pilih Kendaraan</option>
                    @foreach ($kendaraans as $kendaraan)
                        <option value="{{ $kendaraan->no_plat }}">{{ $kendaraan->no_plat }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Keluhan Kendaraan -->
            <div class="mb-3">
                <label for="keluhan" class="form-label">Keluhan Kendaraan</label>
                <textarea name="keluhan" id="keluhan" class="form-control" required></textarea>
            </div>

            <!-- Tanggal Servis -->
            <div class="mb-3">
                <label for="tanggal_service" class="form-label">Tanggal Servis</label>
                <input type="date" name="tanggal_service" id="tanggal_service" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>

    <script>
        // JavaScript untuk mengisi nama pelanggan secara otomatis
        const pelanggans = @json($pelanggans);
        const pelangganDropdown = document.getElementById('id_pelanggan');
        const namaPelangganInput = document.getElementById('nama_pelanggan');

        pelangganDropdown.addEventListener('change', function() {
            const selectedId = this.value;
            const pelanggan = pelanggans.find(p => p.id_pelanggan == selectedId);
            namaPelangganInput.value = pelanggan ? pelanggan.nama_lengkap : '';
        });
    </script>
@endsection
