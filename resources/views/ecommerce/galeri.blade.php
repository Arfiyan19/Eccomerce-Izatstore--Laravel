@extends('layouts.ecommerce')

@section('title')
    <title>Jual Produk Kecantikan - Ecommerce</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('content')
    <!--================Home Banner Area =================-->
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="banner_content text-center">
                    <h2>Galleri Pelanggan</h2>
                    <div class="page_link">
                        <a href="{{ route('front.index') }}">Home</a>
                        <a href="{{ route('front.galeri') }}">Galeri</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Galeri Pelanggan =================-->
    <section class="section-medium section-arrow--bottom-center section-arrow-primary-color bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-white text-center">
                    <h2 class="section-title "> Testimoni Para Reseller dan Pembeli di Izzat Store</h2>
                    <p class="section-sub-title">
                        DISTRIBUTOR RESMI PRODUK KECANTIKAN
                        <br> TERLENGKAP DAN TERBESAR DI INDONESIA
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="section-primary t-bordered">
        <div class="container">
            <div class="row testimonial-three testimonial-three--col-three">
                @forelse ($galeris as $row)
                    @php $img = $row->image ; @endphp
                <div class="col-md-4 testimonial-three-col">
                    <div class="testimonial-inner">
                        <div class="testimonial-image" itemprop="image">
                            <img src="/storage/galeris/{{$img}}" width="180px" height="180px">
                        </div>
                        <div class="testimonial-content">
                            <p>
                                {!! $row->content !!}
                            </p>
                        </div>
                        <div class="testimonial-meta">
                            <strong>{{ $row->title }}</strong>
                            <br>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                        </div>
                    </div>
                </div>







                @empty
                    <div class="col-md-12">
                        <h3 class="text-center">Tidak ada Galeri</h3>
                    </div>
        @endforelse

        </div>
        </div>

    </section>

    <!--================End =================-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <a href="https://api.whatsapp.com/send?phone=+6281285439993&text=Halo Saya Ingin Memesan Lansung Disini" class="float" target="_blank">
        <i class="fa fa-whatsapp my-float"></i>
    </a>
