@extends('layouts.admin')

@section('title')
    <title>List Product</title>
@endsection

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark">Product</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Product List</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="row">
                <!-- BAGIAN INI AKAN MENG-HANDLE TABLE LIST PRODUCT  -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">List Produk</h4>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                            <div class="float-left">
                                <a href="{{ route('product.bulk') }}" class="btn btn-danger">Mass Upload</a>
                                <a href="{{ route('product.create') }}" class="btn btn-primary">Tambah</a>
                            </div>
                            <!-- BUAT FORM UNTUK PENCARIAN, METHODNYA ADALAH GET -->
                            <form action="{{ route('product.index') }}" method="get">
                                <div class="input-group mb-3 col-md-3 float-right">
                                    <input type="text" name="q" class="form-control" placeholder="Cari..." value="{{ request()->q }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary" type="submit">Cari</button>
                                    </div>
                                </div>
                            </form>

                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Gambar</th>
                                            <th>Produk</th>
                                            <th>Harga</th>
                                            <th>Merek</th>
                                            <th>Model</th>
                                            <th>Jenis Garansi</th>
                                            <th>SKU</th>
                                            <th>Masa Garansi</th>
                                            <th>Vidio</th>


                                            <!-- <th>Created At</th> -->
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      	<!-- LOOPING DATA TERSEBUT MENGGUNAKAN FORELSE -->
                                        <!-- ADAPUN PENJELASAN ADA PADA ARTIKEL SEBELUMNYA -->
<!-- ==========awal latihan============= -->
                     <!-- @foreach($product as $item)
                        @foreach (explode('|', $item->image) as $imag)
                        <tr>
                                <img src="/storage/products/{{$imag}}" style="width:20%">
                                @endforeach
                                <td>
                                            </td>
                                </tr>
                                <hr style="border: 1.5px solid grey"> <br>
                          @endforeach -->
<!-- =================Code Ke atas latian============= -->

                                        @forelse ($product as $row)
                                        @php $img = explode('|', $row->image); @endphp
                                        <!-- @php $vidio = explode('|', $row->vidio); @endphp -->
                                        <tr>
                                            <td>
                                                <!-- <img src="/storage/products/{{$img[0] }}" width="100px" height="100px"> -->
                                                @foreach (explode('|', $row->image) as $imag)

                                            <img src="/storage/products/{{$imag}}" width="50px" height="50px">
                                            
                                            @endforeach
                                            <img src="/storage/products/<?php echo $row['image2'];  ?>" width="50px" height="50px">
                                            <img src="/storage/products/<?php echo $row['image3'];  ?>" width="50px" height="50px">
                                            <img src="/storage/products/<?php echo $row['image4'];  ?>" width="50px" height="50px">
                                            <img src="/storage/products/<?php echo $row['image5'];  ?>" width="50px" height="50px">

                                            
                                                <!-- TAMPILKAN GAMBAR DARI FOLDER PUBLIC/STORAGE/PRODUCTS -->
                                            </td>
                                            <td>
                                                <strong>{{ $row->name }}</strong><br>
                                                <!-- ADAPUN NAMA KATEGORINYA DIAMBIL DARI HASIL RELASI PRODUK DAN KATEGORI -->
                                                <label>Kategori: <span class="badge badge-info">{{ $row->category->name }}</span></label><br>
                                                <label>Berat: <span class="badge badge-info">{{ $row->weight }} gr</span></label>
                                            </td>
                                            <td>Rp {{ number_format($row->price) }}</td>
                                            
                                            <td> {{ $row->merek }} </td>
                                            <td>{{ $row->model }}</td>
                                            <td>{{ $row->jenis_garansi }}</td>
                                            <td>{{ $row->sku }}</td>
                                            <td>{{ $row->masa_garansi }}</td>
                            <td>            
    <video width="150" height="100" controls src="/storage/products/{{$row->vidio}}" type="video/mp4" autoplay>
    </video>
</td>

                                            <!-- <td>{{ $row->created_at->format('d-m-Y') }}</td> -->
                                            
                                            <!-- KARENA BERISI HTML MAKA KITA GUNAKAN { !! UNTUK MENCETAK DATA -->
                                            <td>{!! $row->status_label !!}</td>
                                            <td>
                                                <!-- FORM UNTUK MENGHAPUS DATA PRODUK -->
                                                <form onsubmit="return confirm('Yakin Hapus Produk ?')" action="{{ route('product.destroy', $row->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('product.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Tidak ada data</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- FUNGSI INI AKAN SECARA OTOMATIS MEN-GENERATE TOMBOL PAGINATION  -->
                            {!! $product->links() !!}
                        </div>
                    </div>
                </div>
                <!-- BAGIAN INI AKAN MENG-HANDLE TABLE LIST CATEGORY  -->
            </div>
        </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
@endsection