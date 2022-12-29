<section>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.3.2/dist/select2-bootstrap4.min.css" rel="stylesheet" />
    <!-- <title>Laravel Raja Ongkir - SantriKoding.com</title> -->
</head>
<body style="background: #f3f3f3">

<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <h3>ORIGIN</h3>
                   
            <form action="{{url('/testing')}}" method="get" >
                    <label class="font-weight-bold">BERAT (GRAM)</label>
                    @csrf
                    <input type="search" class="form-control" class="button is-link"  name="name" placeholder="Masukkan Kecamatan/Kabupaten/Kota" >
                    <button class="btn btn-secondary" type="submit">Cari</button>                    
            </form>

                    <div class="form-group" >
                        <label class="font-weight-bold">KOTA ASAL</label>
                        <select class="form-control" id="exampleFormControlSelect1">
 
      @foreach ($response['areas'] as  $kurir)
                                <option value="{{ $kurir['administrative_division_level_1_name'] }} {{ $kurir['administrative_division_level_2_name'] }} {{ $kurir['administrative_division_level_3_name'] }} {{ $kurir['postal_code'] }}">
                                {{ $kurir['administrative_division_level_1_name'] }} 
                                {{ $kurir['administrative_division_level_2_name'] }} 
                                {{ $kurir['administrative_division_level_3_name'] }} 
                                {{ $kurir['postal_code'] }} 
                                </option>
                            @endforeach
    </select>
                    </div>
                    <hr>




        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <h3>KURIR</h3>
                    <hr>
                    <div class="form-group">
                        <label>PROVINSI TUJUAN</label>
                        <select class="form-control kurir" name="courier">
                            <option value="0">-- pilih kurir --</option>
                            <option value="jne">JNE</option>
                            <option value="pos">POS</option>
                            <option value="tiki">TIKI</option>
                        </select>
                    </div>
 
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <button class="btn btn-md btn-primary btn-block btn-check">CEK ONGKOS KIRIM</button>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card d-none ongkir">
                <div class="card-body">
                    <ul class="list-group" id="ongkir"></ul>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" ></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

</body>
</html>