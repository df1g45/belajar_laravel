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
                <h3>Daftar Obat</h3>
              </div>
              <div class="card-body">
                @if (session('success'))
                  <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                  <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <p>
                  <a class="btn btn-primary" href="{{ route('obats.create') }}">Tambah Obat</a>
                </p>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Kode Obat</th>
                      <th>Nama</th>
                      <th>Stock</th>
                      <th>Kadaluarsa</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($obats as $obat)
                      <tr>
                        <td>{{ $obat->id }}</td>
                        <td>{{ $obat->nama }}</td>
                        <td>{{ $obat->stock }}</td>
                        <td>{{ $obat->kadaluarsa }}</td>
                        <td class="d-flex flex-column">
                          <a href="{{ route('obats.show', ['id' => $obat->id]) }}" class="btn btn-primary btn-sm btn-sm mb-1">show</a>
                          <a href="{{ route('obats.edit', ['id' => $obat->id]) }}" class="btn btn-secondary btn-sm btn-sm mb-1">edit</a>
                          <a href="#" class="btn btn-sm btn-danger" onclick="
                            event.preventDefault();
                            if (confirm('Do you want to remove this?')) {
                              document.getElementById('delete-row-{{ $obat->id }}').submit();
                            }">
                            delete
                          </a>
                          <form id="delete-row-{{ $obat->id }}" action="{{ route('obats.destroy', ['id' => $obat->id]) }}" method="POST">
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