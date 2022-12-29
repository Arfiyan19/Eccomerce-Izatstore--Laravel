@extends('layouts.admin')

@section('title')
    <title>Tambah Data Bantuan</title>
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
                  <li class="breadcrumb-item active">Tambah Galeri</li>
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
            <form action="{{ route('galeri.store') }}" method="post" enctype="multipart/form-data" >
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Tambah Galeri</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Masukan Judul</label>
                                    <input type="text" name="title" class="form-control" required placeholder="Masukan Judul Bantuan">
                                    <p class="text-danger">{{ $errors->first('title') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="content">Konten</label>

                                    <!-- TAMBAHKAN ID YANG NNTINYA DIGUNAKAN UTK MENGHUBUNGKAN DENGAN CKEDITOR -->
                                    <textarea name="content" id="content" class="form-control" placeholder="Masukan Konten...."></textarea>
                                    <p class="text-danger">{{ $errors->first('content') }}</p>
                                </div>

                                <div class="form-group">
                                    <label for="image">Gambar</label>
                                    <input type="file" name="image[]" class="form-control"
                                    multiple="true"
                                    required>
                                    <p class="text-danger">{{ $errors->first('image') }}</p>
                                </div>

                                <!-- ====End GAMBAR 2-5====== -->

                                <div class="form-group">
                                    <button class="btn btn-primary float-right">Tambah</button>
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
        //TERAPKAN CKEDITOR PADA TEXTAREA DENGAN ID DESCRIPTION
        CKEDITOR.replace('content');
    </script>
@endsection
