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
            <form method="post" action="{{ route('pendaftaran.store') }}" enctype="multipart/form-data">
            @csrf
              <div class="card mt-5">
                <div class="card-header">
                  <h3>Pendaftaran</h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                      <div class="alert alert-danger">
                        <div class="alert-title"><h4>Whoops!</h4></div>
                          There are some problems with your input.
                          <ul>
                            @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                            @endforeach
                          </ul>
                      </div> 
                    @endif

                    @if (session('success'))
                      <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if (session('error'))
                      <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <div class="form-group mb-3">
                      <div class="form-row">
                          <div class="col">
                              <div class="form-group">
                                  <label for="image">Foto</label>
                                  <input type="file" name="foto" class="form-control-file mb-3" id="image" onchange="previewImage(event)">
                                  
                                  <div id="image-preview">
                                    <img id="image-output" src="" alt="Image Preview" height="200" style="display:none;">
                                </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  
                  <script>
                      function previewImage(event) {
                          const imageOutput = document.getElementById('image-output');
                          imageOutput.src = URL.createObjectURL(event.target.files[0]);
                          imageOutput.style.display = 'block';
                      }
                  </script>

                    <div class="mb-3">
                      <label class="form-label">Nama</label>
                      <input type="text" class="form-control" name="nama" placeholder="#Nama">
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Nik</label>
                      <input type="text" class="form-control" name="nik" placeholder="Nik">
                    </div>
                    <div class="mb-3">
                      <label class="form-label">NO HP</label>
                      <input type="text" class="form-control" name="no_hp" placeholder="NO HP">
                    </div>
                    
                    <div class="mb-3">
                      <label class="form-label">Email</label>
                      <input type="email" class="form-control" name="email" placeholder="Email">
                    </div>
                    
                    <div class="mb-3">
                      <label class="form-label">Tanggal Lahir</label>
                      <input type="date" class="form-control" name="tanggal_lahir" placeholder="Tanggal Lahir">
                    </div>

                    <div class="mb-3">
                      <label class="form-label">Tempat Lahir</label>
                      <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir">
                    </div>

                    <div class="mb-3">
                      <label class="form-label">Alamat</label>
                      <input type="text" class="form-control" name="alamat" placeholder="alamat">
                    </div>

                    <div class="mb-3">
                      <label class="form-label">Nama Ayah</label>
                      <input type="text" class="form-control" name="nama_ayah" placeholder="nama_ayah">
                    </div>

                    <div class="mb-3">
                      <label class="form-label">Asal Sekolah</label>
                      <input type="text" class="form-control" name="asal_sekolah" placeholder="asal_sekolah">
                    </div>

                    <div class="mb-3">
                      <label class="form-label">HOBI</label>
                      <input type="text" class="form-control" name="hobi"  placeholder="HOBI">
                    </div>
                    
                  </div>
                </div>
                <div class="card-footer">
                  <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>