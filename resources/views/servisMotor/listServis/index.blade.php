@extends('servisMotor.layouts.main')

@section('content')
<div class="container">
    <h1>Data Service</h1>
    <a href="{{ route('dataServis.create') }}" class="btn btn-success mb-3">Tambah Service</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Servis</th>
                <th>Keluhan</th>
                <th>Estimasi Servis</th>
                <th>Nama Mekanik</th>
                <th>Sparepart Pengganti</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($services as $service)
                <tr>
                    <td>{{ $service->id }}</td>
                    <td>{{ $service->id_service }}</td>
                    <td>{{ $service->daftarServis->keluhan }}</td>
                    <td>{{ $service->estimasi_service }}</td>
                    <td>{{ $service->nama_mekanik }}</td>
                    <td>{{ $service->sparepart_pengganti }}</td>
                    <td>
                        <a href="{{ route('dataServis.edit', $service->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('dataServis.destroy', $service->id) }}" method="POST" style="display:inline;">
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
