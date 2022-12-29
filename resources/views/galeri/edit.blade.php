@extends('layouts.admin')

@section('title')
    <title>Edit Galeri</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark">Galeri</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Edit Galeri</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container">
            <!-- TAMBAHKAN ENCTYPE="" KETIKA MENGIRIMKAN FILE PADA FORM -->
            <form action="{{ route('galeri.update', $galeris->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-11">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Galeri</h4>
                            </div>




                                <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Judul Galeri</label>
                                    <input type="text" name="title" class="form-control" value="{{ $galeris->title }}" required>
                                    <p class="text-danger">{{ $errors->first('title') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="content">Konten</label>

                                    <!-- TAMBAHKAN ID YANG NNTINYA DIGUNAKAN UTK MENGHUBUNGKAN DENGAN CKEDITOR -->
                                    <textarea name="content" id="content" class="form-control">{{ $galeris->content }}</textarea>
                                    <p class="text-danger">{{ $errors->first('content') }}</p>
                                </div>


                                <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="image">Gambar</label>
                                    <br>
                                  	<!--  TAMPILKAN GAMBAR SAAT INI -->
                                    @php $img = explode('|', $galeris->image); @endphp
                                    <img class="d-block w" src="/storage/galeris/{{$img[0]}}" alt="{{ $galeris->image }}"  height="450px">


                                    <hr>
                                    <input type="file" name="image" class="form-control">
                                    <p><strong>Biarkan kosong jika tidak ingin mengganti gambar</strong></p>
                                    <p class="text-danger">{{ $errors->first('image') }}</p>
                                </div>
                                </div>


                                <div class="form-group">
                                    <button class="btn btn-primary float-right">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
@endsection

@section('js')
    <!-- LOAD CKEDITOR -->
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
@endsection
