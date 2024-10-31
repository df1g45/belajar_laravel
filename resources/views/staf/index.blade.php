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
                <h3>List Staf</h3>
              </div>
              <div class="card-body">
                @if (session('success'))
                  <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                  <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <p>
                  <a class="btn btn-primary" href="{{ route('stafs.create') }}">Tambah Staf</a>
                </p>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nama</th>
                      <th>Alamat</th>
                      <th>Tanggal Lahir</th>
                      <th>Tempat Lahir</th>
                      <th>No hp</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($stafs as $staf)
                      <tr>
                        <td>{{ $staf->id }}</td>
                        <td>{{ $staf->nama }}</td>
                        <td>{{ $staf->alamat }}</td>
                        <td>{{ $staf->tanggal_lahir }}</td>
                        <td>{{ $staf->tempat_lahir }}</td>
                        <td>{{ $staf->no_hp }}</td>
                        <td class="d-flex flex-column">
                          <a href="{{ route('stafs.show', ['id' => $staf->id]) }}" class="btn btn-primary btn-sm btn-sm mb-1">show</a>
                          <a href="{{ route('stafs.edit', ['id' => $staf->id]) }}" class="btn btn-secondary btn-sm btn-sm mb-1">edit</a>
                          <a href="#" class="btn btn-sm btn-danger" onclick="
                            event.preventDefault();
                            if (confirm('Do you want to remove this?')) {
                              document.getElementById('delete-row-{{ $staf->id }}').submit();
                            }">
                            delete
                          </a>
                          <form id="delete-row-{{ $staf->id }}" action="{{ route('stafs.destroy', ['id' => $staf->id]) }}" method="POST">
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