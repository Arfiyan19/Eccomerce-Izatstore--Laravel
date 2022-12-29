@extends('layouts.admin')

@section('title')
    <title>Tambah Produk</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark">Produk</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Tambah Produk</li>
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
            <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data" >
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Tambah Produk</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Nama Produk</label>
                                    <input type="text" name="name" class="form-control" required placeholder="Masukan nama produk....">
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="description">Deskripsi</label>
                                  
                                    <!-- TAMBAHKAN ID YANG NNTINYA DIGUNAKAN UTK MENGHUBUNGKAN DENGAN CKEDITOR -->
                                    <textarea name="description" id="description" class="form-control" placeholder="Masukan Deskripsi produk...."></textarea>
                                    <p class="text-danger">{{ $errors->first('description') }}</p>
                                </div>
                                <h4 class="card-title">Spesifikasi</h4>
<br>
<br>

                                <div class="form-group">
                                    <label for="merek">Merek</label>
                                    <input type="text" name="merek"  class="form-control" required placeholder="Masukan Merk produk....">
                                    <p class="text-danger">{{ $errors->first('merek') }}</p>
                                </div>

                                <div class="form-group">
                                    <label for="model">Model</label>
                                    <input type="text" name="model" class="form-control" required placeholder="Masukan Model....">
                                    <p class="text-danger">{{ $errors->first('model') }}</p>
                                </div>


                                <div class="form-group">
                                    <label for="sku">Sku</label>
                                    <input type="text" name="sku"  class="form-control" required placeholder="Masukan SKU produk....">
                                    <p class="text-danger">{{ $errors->first('sku') }}</p>
                                </div>

                                <div class="form-group">
                                    <label for="jenis_garansi">Jenis Garansi</label>
                                    <input type="text"  name="jenis_garansi" class="form-control" required placeholder="Masukan jenis garansi....">
                                    <p class="text-danger">{{ $errors->first('jenis_garansi') }}</p>
                                </div>

                                <div class="form-group">
                                    <label for="masa_garansi">Masa Garansi</label>
                                    <input type="text" name="masa_garansi" class="form-control" required placeholder="Masukan masa garansi....">
                                    <p class="text-danger">{{ $errors->first('masa_garansi') }}</p>
                                </div>

                                


                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control" required>
                                        <option value="1">Publish</option>
                                        <option value="0">Draft</option>
                                    </select>
                                    <p class="text-danger">{{ $errors->first('status') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="category_id">Kategori</label>
                                    
                                    <!-- DATA KATEGORI DIGUNAKAN DISINI, SEHINGGA SETIAP PRODUK USER BISA MEMILIH KATEGORINYA -->
                                    <select name="category_id" class="form-control">
                                        <option value="">Pilih</option>
                                        @foreach ($category as $row)
                                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('category_id') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="price">Harga</label>
                                    <input type="number" name="price" class="form-control" required placeholder="Masukan harga....">
                                    <p class="text-danger">{{ $errors->first('price') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="weight">Berat</label>
                                    <input type="number" name="weight" class="form-control" required placeholder="Masukan Berat produk....">
                                    <p class="text-danger">{{ $errors->first('weight') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="image">Gambar Produk 1</label>
                                    <input type="file" name="image[]" class="form-control" 
                                    multiple="true"
                                    required>
                                    <p class="text-danger">{{ $errors->first('image') }}</p>
                                </div>
<!-- ====TAMBAH GAMBAR 2-5====== -->
<div class="form-group">
                                    <label for="image2">Gambar Produk 2</label>
                                    <input type="file" name="image2[]" class="form-control" 
                                    multiple="true"
                                    >
                                    <p class="text-danger">{{ $errors->first('image2') }}</p>
                                </div>

                                <div class="form-group">
                                    <label for="image3">Gambar Produk 3</label>
                                    <input type="file" name="image3[]" class="form-control" 
                                    multiple="true"
                                    >
                                    <p class="text-danger">{{ $errors->first('image3') }}</p>
                                </div>

                                <div class="form-group">
                                    <label for="image4">Gambar Produk 4</label>
                                    <input type="file" name="image4[]" class="form-control" 
                                    multiple="true"
                                    >
                                    <p class="text-danger">{{ $errors->first('image4') }}</p>
                                </div>

                                <div class="form-group">
                                    <label for="image5">Gambar Produk 5</label>
                                    <input type="file" name="image5[]" class="form-control" 
                                    multiple="true"
                                    >
                                    <p class="text-danger">{{ $errors->first('image5') }}</p>
                                </div>



<!-- ==========END GAMBAR 2345========== -->



                                <div class="form-group">
                                    <label for="vidio">Vidio Produk</label>
                                    <input type="file" name="vidio[]" class="form-control" 
                                    multiple="true">
                                    <p class="text-danger">{{ $errors->first('vidio') }}</p>
                                </div>

<!-- =================belum jadi====== -->


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
        CKEDITOR.replace('description');
    </script>
@endsection