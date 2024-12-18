@extends('servisMotor.layouts.main')

@section('content')
    <div class="container">
        <h1>Tambah Data Kendaraan</h1>

        <form action="{{ route('kendaraan.store') }}" method="POST">
            @csrf

            <!-- No Plat Kendaraan -->
            <div class="mb-3">
                <label for="no_plat" class="form-label">No Plat Kendaraan</label>
                <input type="text" name="no_plat" id="no_plat" class="form-control" required>
            </div>

            <!-- Jenis Kendaraan (Radio Button) -->
            <div class="mb-3">
                <label class="form-label">Jenis Kendaraan</label>
                <div>
                    <input type="radio" name="jenis_kendaraan" value="Matic" required> Matic
                    <input type="radio" name="jenis_kendaraan" value="Manual Transmisi" required> Manual Transmisi
                </div>
            </div>

            <!-- No STNK -->
            <div class="mb-3">
                <label for="no_stnk" class="form-label">No STNK</label>
                <input type="text" name="no_stnk" id="no_stnk" class="form-control" required>
            </div>

            <!-- Tahun Pembuatan Kendaraan -->
            <div class="mb-3">
                <label for="tahun_pembuatan" class="form-label">Tahun Pembuatan Kendaraan</label>
                <input type="number" name="tahun_pembuatan" id="tahun_pembuatan" class="form-control" required>
            </div>

            <!-- Nama Pemilik Kendaraan -->
            <div class="mb-3">
                <label for="nama_pemilik" class="form-label">Nama pemilik Kendaraan</label>
                <input type="text" name="nama_pemilik" id="nama_pemilik" class="form-control" required>
            </div>

            <!-- Warna Kendaraan -->
            <div class="mb-3">
                <label for="warna" class="form-label">Warna Kendaraan</label>
                <input type="text" name="warna" id="warna" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
