@extends('layouts.ecommerce')

@section('title')
<title>Jual Produk Kecantikan - Ecommerce</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
@endsection

@section('content')
<!--================Home Banner Area =================-->
<section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
        <div class="container">
            <div class="banner_content text-center">
                <h2>Bantuan Pelanggan</h2>
                <div class="page_link">
                    <a href="{{ route('front.index') }}">Home</a>
                    <a href="{{ route('front.bantuanPelanggan') }}">Bantuan</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Home Banner Area =================-->

<!--================Category Product Area =================-->
<section class="cat_product_area section_gap">
        <div class="row flex-row-reverse">
            <div class="col-lg-9">
                <div class="product_top_bar-justify">
                    <div class="left_dorp">
                    </div>
                    <div class="right_page ml-auto">
                    </div>
                </div>
                <div class="latest_product_inner row">
                    <!-- PROSES LOOPING DATA PRODUK, SAMA DENGAN CODE YANG ADDA DIHALAMAN HOME -->
                    @forelse ($bantuans as $row)
                    @php $img = $row->image ; @endphp


                    <div class="col-lg-4 col-md-3 col-sm-6">
                        <div class="w3-container w3-center w3-animate-top">
                            <div class="">
                                <img src="/storage/bantuans/{{$img}}" width="300px" height="250px">
                            </div>
                            <h4>{{ $row->title }}
                                {!! $row->content !!}
                            </h4>
                        </div>

                    </div>
                    @empty
                    <div class="col-md-12">
                        <h3 class="text-center">Tidak ada Bantuan</h3>
                    </div>
                    @endforelse
                    <!-- PROSES LOOPING DATA PRODUK, SAMA DENGAN CODE YANG ADDA DIHALAMAN HOME -->
                </div>
            </div>
        </div>

        <!-- GENERATE PAGINATION PRODUK -->
        <div class="row">
        </div>
    </div>
</section>
<!--================End Category Product Area =================-->
@endsection
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<a href="https://api.whatsapp.com/send?phone=+6281285439993&text=Halo Saya Ingin Memesan Lansung Disini" class="float" target="_blank">
    <i class="fa fa-whatsapp my-float"></i>
</a>
