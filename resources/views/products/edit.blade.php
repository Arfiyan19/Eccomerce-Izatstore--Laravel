@extends('layouts.admin')

@section('title')
    <title>Edit Produk</title>
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
                  <li class="breadcrumb-item active">Edit Produk</li>
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
            <form action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit Produk</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Nama Produk</label>
                                    <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="description">Deskripsi</label>

                                    <!-- TAMBAHKAN ID YANG NNTINYA DIGUNAKAN UTK MENGHUBUNGKAN DENGAN CKEDITOR -->
                                    <textarea name="description" id="description" class="form-control">{{ $product->description }}</textarea>
                                    <p class="text-danger">{{ $errors->first('description') }}</p>
                                </div>

                                <div class="form-group">
                                    <label for="merek">Merek </label>
                                    <input type="text" name="merek" class="form-control" value="{{ $product->merek }}" required>
                                    <p class="text-danger">{{ $errors->first('merek') }}</p>
                                </div>

                                <div class="form-group">
                                    <label for="model">Model </label>
                                    <input type="text" name="model" class="form-control" value="{{ $product->model }}" required>
                                    <p class="text-danger">{{ $errors->first('model') }}</p>
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control" required>
                                        <option value="1" {{ $product->status == '1' ? 'selected':'' }}>Publish</option>
                                        <option value="0" {{ $product->status == '0' ? 'selected':'' }}>Draft</option>
                                    </select>
                                    <p class="text-danger">{{ $errors->first('status') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="category_id">Kategori</label>

                                    <!-- DATA KATEGORI DIGUNAKAN DISINI, SEHINGGA SETIAP PRODUK USER BISA MEMILIH KATEGORINYA -->
                                    <select name="category_id" class="form-control">
                                        <option value="">Pilih</option>
                                        @foreach ($category as $row)
                                        <option value="{{ $row->id }}" {{ $product->category_id == $row->id ? 'selected':'' }}>{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('category_id') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="price">Harga</label>
                                    <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
                                    <p class="text-danger">{{ $errors->first('price') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="weight">Berat</label>
                                    <input type="number" name="weight" class="form-control" value="{{ $product->weight }}" required>
                                    <p class="text-danger">{{ $errors->first('weight') }}</p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="image">Gambar Produk 1</label>
                                    <br>
                                  	<!--  TAMPILKAN GAMBAR SAAT INI -->
                                    <!-- <img src="{{ asset('storage/products/' . $product->image) }}" width="100px" height="100px" alt="{{ $product->name }}"> -->
                                    @php $img = explode('|', $product->image); @endphp
                                    <img class="d-block w" src="/storage/products/{{$img[0]}}" alt="{{ $product->name }}"  height="100px">


                                    <hr>
                                    <input type="file" name="image" class="form-control">
                                    <p><strong>Biarkan kosong jika tidak ingin mengganti gambar</strong></p>
                                    <p class="text-danger">{{ $errors->first('image') }}</p>
                                </div>

<!-- ====================gambar 2,3,4================= -->


                            <div class="form-group">
                                    <label for="image2">Gambar Produk 2</label>
                                    <br>
                                  	<!--  TAMPILKAN GAMBAR SAAT INI -->
                                    <!-- <img src="{{ asset('storage/products/' . $product->image) }}" width="100px" height="100px" alt="{{ $product->name }}"> -->
                                    @php $img = explode('|', $product->image2); @endphp
                                    <img class="d-block w-" src="/storage/products/{{$img[0]}}" alt="{{ $product->name }}" height="100px">


                                    <hr>
                                    <input type="file" name="image2" class="form-control">
                                    <p><strong>Biarkan kosong jika tidak ingin mengganti gambar</strong></p>
                                    <p class="text-danger">{{ $errors->first('image2') }}</p>
                                </div>




                                <div class="form-group">
                                    <label for="image3">Gambar Produk 3</label>
                                    <br>
                                  	<!--  TAMPILKAN GAMBAR SAAT INI -->
                                    <!-- <img src="{{ asset('storage/products/' . $product->image) }}" width="100px" height="100px" alt="{{ $product->name }}"> -->
                                    @php $img = explode('|', $product->image3); @endphp
                                    <img class="d-block w-" src="/storage/products/{{$img[0]}}" alt="{{ $product->name }}" height="100px">


                                    <hr>
                                    <input type="file" name="image3" class="form-control">
                                    <p><strong>Biarkan kosong jika tidak ingin mengganti gambar</strong></p>
                                    <p class="text-danger">{{ $errors->first('image3') }}</p>
                                </div>


                            <div class="form-group">
                                    <label for="image4">Gambar Produk 4</label>
                                    <br>
                                  	<!--  TAMPILKAN GAMBAR SAAT INI -->
                                    <!-- <img src="{{ asset('storage/products/' . $product->image) }}" width="100px" height="100px" alt="{{ $product->name }}"> -->
                                    @php $img = explode('|', $product->image4); @endphp
                                    <img class="d-block w" src="/storage/products/{{$img[0]}}" alt="{{ $product->name }}" height="100px">


                                    <hr>
                                    <input type="file" name="image4" class="form-control">
                                    <p><strong>Biarkan kosong jika tidak ingin mengganti gambar</strong></p>
                                    <p class="text-danger">{{ $errors->first('image4') }}</p>
                                </div>



                                <div class="form-group">
                                    <label for="image5">Gambar Produk 5</label>
                                    <br>
                                  	<!--  TAMPILKAN GAMBAR SAAT INI -->
                                    <!-- <img src="{{ asset('storage/products/' . $product->image) }}" width="100px" height="100px" alt="{{ $product->name }}"> -->
                                    @php $img = explode('|', $product->image5); @endphp
                                    <img class="d-block w" src="/storage/products/{{$img[0]}}" alt="{{ $product->name }}" height="100px">


                                    <hr>
                                    <input type="file" name="image5" class="form-control">
                                    <p><strong>Biarkan kosong jika tidak ingin mengganti gambar</strong></p>
                                    <p class="text-danger">{{ $errors->first('image5') }}</p>
                                </div>





<!-- =========================Tutup====================== -->


                                <div class="form-group">
                                    <label for="jenis_garansi">Jenis Garansi</label>
                                    <input type="text" name="jenis_garansi" class="form-control" value="{{ $product->jenis_garansi }}" required>
                                    <p class="text-danger">{{ $errors->first('jenis_garansi') }}</p>
                                </div>

                                <div class="form-group">
                                    <label for="jenis_garansi">Jenis Garansi</label>
                                    <input type="text" name="jenis_garansi" class="form-control" value="{{ $product->jenis_garansi }}" required>
                                    <p class="text-danger">{{ $errors->first('jenis_garansi') }}</p>
                                </div>

                                <div class="form-group">
                                    <label for="sku">SKU</label>
                                    <input type="text" name="sku" class="form-control" value="{{ $product->sku }}" required>
                                    <p class="text-danger">{{ $errors->first('sku') }}</p>
                                </div>

                                <div class="form-group">
                                    <label for="masa_garansi">Masa Garansi</label>
                                    <input type="text" name="masa_garansi" class="form-control" value="{{ $product->masa_garansi }}" required>
                                    <p class="text-danger">{{ $errors->first('masa_garansi') }}</p>
                                </div>

                                <div class="form-group">
                                    <label for="vidio">Vidio Produk</label>

                                    <video width="250" height="100" controls src="/storage/products/{{$product->vidio}}"
                                    type="video/mp4" autoplay>
</video>                                    <!--  TAMPILKAN GAMBAR SAAT INI -->
                                    <!-- <img src="{{ asset('storage/products/' . $product->image) }}" width="100px" height="100px" alt="{{ $product->name }}"> -->
                                    @php $vid = explode('|', $product->vidio); @endphp
                                    <hr>
                                    <input type="file" name="vidio[]" class="form-control">
                                    <p><strong>Biarkan kosong jika tidak ingin mengganti vidio</strong></p>
                                    <p class="text-danger">{{ $errors->first('$vid') }}</p>
                                </div>


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
        CKEDITOR.replace('description');
    </script>
@endsection
