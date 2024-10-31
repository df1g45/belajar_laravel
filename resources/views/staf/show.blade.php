<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Data Post - SantriKoding.com</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{url('/stafs')}}">kembali</a>
                        <hr>
                        
                        <h4>Nama : {{ $staf->nama }}</h4>
                        <p class="tmt-3">
                            Alamat : {{ $staf->alamat }}
                        </p>
                        <p class="tmt-3">
                            Tanggal Lahir : {{ $staf->tanggal_lahir }}
                        </p>
                        <p class="tmt-3">
                            Tempat Lahir : {{ $staf->tempat_lahir }}
                        </p>
                        <p class="tmt-3">
                            NO HP : {{ $staf->no_hp }} 
                        </p>
                        
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>