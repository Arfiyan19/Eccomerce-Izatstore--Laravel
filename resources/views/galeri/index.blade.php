<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Bantuan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body style="background: lightgray">

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <a href="{{ route('galeri.create') }}" class="btn btn-md btn-success mb-3">TAMBAH GALERI</a>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">GAMBAR</th>
                            <th scope="col">JUDUL</th>
                            <th scope="col">CONTENT</th>
                            <th scope="col">AKSI</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                                <td class="text-center">
                                 </td>
                                <td>Galeri</td>
                                <td>konten</td>
                                <td class="text-center">
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="" method="POST">
                                        <a href="" class="btn btn-sm btn-primary">EDIT</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                    </form>
                                </td>
                            </tr>
                            <div class="alert alert-danger">
                                Data Blog belum Tersedia.
                            </div>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    message with toastr
    @if(session()->has('success'))

    toastr.success('{{ session('success') }}', 'BERHASIL!');

    @elseif(session()->has('error'))

    toastr.error('{{ session('error') }}', 'GAGAL!');

    @endif
</script>

</body>
</html>