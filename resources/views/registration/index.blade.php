<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>
  <body>
    <div id="app">
      <div class="main-wrapper">
        <div class="main-content">
          <div class="container">
            <div class="card mt-5">
              <div class="card-header">
                <h3>List Pendaftaran</h3>
              </div>
              <div class="card-body">
                @if (session('success'))
                  <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                  <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <p>
                  <a class="btn btn-primary" href="{{ route('pendaftaran.create') }}">Pendaftaran</a>
                </p>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Foto</th>
                      <th>NIK</th>
                      <th>Nama</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($pendaftars as $pendaftar)
                      <tr>
                        <td>{{ $pendaftar->id }}</td>
                        <td class="text-center">
                          <img src="{{ asset('/storage/foto/' . $pendaftar->foto) }}" class="rounded" style="width: 150px">
                      </td>
                        <td>{{ $pendaftar->nik }}</td>
                        <td>{{ $pendaftar->nama }}</td>
                        <td class="d-flex flex-column">
                          <a href="{{ route('pendaftaran.show', ['id' => $pendaftar->id]) }}" class="btn btn-primary btn-sm btn-sm mb-1">show</a>
                          <a href="{{ route('pendaftaran.edit', ['id' => $pendaftar->id]) }}" class="btn btn-secondary btn-sm btn-sm mb-1">edit</a>
                          <a href="#" class="btn btn-sm btn-danger" onclick="
                            event.preventDefault();
                            if (confirm('Do you want to remove this?')) {
                              document.getElementById('delete-row-{{ $pendaftar->id }}').submit();
                            }">
                            delete
                          </a>
                          <form id="delete-row-{{ $pendaftar->id }}" action="{{ route('pendaftaran.destroy', ['id' => $pendaftar->id]) }}" method="POST">
                              <input type="hidden" name="_method" value="DELETE">
                              @csrf
                          </form>
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="8">
                            No record found!
                        </td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>