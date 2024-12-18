@extends('servisMotor.layouts.main')

@section('content')
<div class="container">
    <h1>Data Kendaraan</h1>
    <a href="{{ route('kendaraan.create') }}" class="btn btn-success mb-3">Tambah Kendaraan</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>No Plat</th>
                <th>Jenis Kendaraan</th>
                <th>No STNK</th>
                <th>Tahun Pembuatan</th>
                <th>Nama Pemilik</th>
                <th>Warna</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kendaraans as $kendaraan)
                <tr>
                    <td>{{ $kendaraan->no_plat }}</td>
                    <td>{{ $kendaraan->jenis_kendaraan }}</td>
                    <td>{{ $kendaraan->no_stnk }}</td>
                    <td>{{ $kendaraan->tahun_pembuatan }}</td>
                    <td>{{ $kendaraan->nama_lengkap }}</td>
                    <td>{{ $kendaraan->warna }}</td>
                    <td>
                        <a href="{{ route('kendaraan.edit', $kendaraan->no_plat) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('kendaraan.destroy', $kendaraan->no_plat) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
