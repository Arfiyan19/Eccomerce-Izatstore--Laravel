@extends('layouts.ecommerce')

@section('title')
<title>E-Commerce - Pusat Belanja Produk Kecantikan</title>
@endsection
]
@section('content')


<!--================Home Banner Area =================-->
<section class="home_banner_area">
	<div class="overlay"></div>
	<div class="banner_inner d-flex align-items-center">
		<div class="container">
			<div class="banner_content row">
				<div class="offset-lg-2 col-lg-8">
					<a class="white_bg_btn" href="{{route('front.product')}}">Lihat Produk</a>
				</div>
			</div>
		</div>
	</div>
</section>
<!--================End Home Banner Area =================-->

<!--================Hot Deals Area =================-->
<section class="hot_deals_area section_gap">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-6">
				<div class="hot_deal_box">
					<img class="img-fluid" src="{{ asset('ecommerce/img/product/hot_deals/deal1.jpg') }}" alt="">
					<div class="content">
						<h2>Hot Deals of this Month</h2>
						<p>shop now</p>
					</div>
					<a class="hot_deal_link" href="#"></a>
				</div>
			</div>

			<div class="col-lg-6">
				<div class="hot_deal_box">
					<img class="img-fluid" src="{{ asset('ecommerce/img/product/hot_deals/deal2.png') }}" alt="">
					<div class="content">
						<h2>Hot Deals of this Month</h2>
						<p>shop now</p>
					</div>
					<a class="hot_deal_link" href="#"></a>
				</div>
			</div>
		</div>
	</div>
</section>
<!--================End Hot Deals Area =================-->
<section class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-lg-3">
			<div class="hot_deal_box">
			<img src="{{ asset('ecommerce/img/Brand/Marwah.png') }}" style="width: 150;" style="hight: 150;">
				<a class="hot_deal_link" href="#"></a>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="hot_deal_box">
				<img src="{{ asset('ecommerce/img/Brand/Msglow.png') }}" style="width: 150;" style="hight: 150;">
				<a class="hot_deal_link" href="#"></a>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="hot_deal_box">
				<img src="{{ asset('ecommerce/img/Brand/justmine.png') }}" style="width: 150;" style="hight: 150;">
				<a class="hot_deal_link" href="#"></a>
			</div>
        </div>
    </div>


    <div class="row justify-content-center">
            <div class="col-lg-3">
                <div class="hot_deal_box">
                    <img src="{{ asset('ecommerce/img/Brand/roromedut.png') }}" style="width: 150;" style="hight: 150;">
                    <a class="hot_deal_link" href="#"></a>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="hot_deal_box">
                    <img src="{{ asset('ecommerce/img/Brand/logo-libon.png') }}" style="width: 150;" style="hight: 150;">
                    <a class="hot_deal_link" href="#"></a>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="hot_deal_box">
                    <img src="{{ asset('ecommerce/img/Brand/WhiteLab.png') }}" style="width: 150;" style="hight: 150;">
                    <a class="hot_deal_link" href="#"></a>
                </div>
            </div>
		</div>



	<!--
	<div class="container-fluid">
		<div class="hot_deal_box">
			<img src="{{ asset('ecommerce/img/Brand/Msglow.png') }}" style="width: 150;">
			<img src="{{ asset('ecommerce/img/Brand/justmine.png') }}" style="width: 150;">
		</div>
	</div> -->
</section>



<!--================Feature Product Area =================-->
<section class="feature_product_area section_gap">
	<div class="main_box">
		<div class="container-fluid">
			<div class="row">
				<div class="main_title">
					<h2>Flash Sale</h2>
					<p>Tampil Cantik Dengan Harga Terjangkau</p>
				</div>
			</div>
			<div class="row">

				<!-- PERHATIAKAN BAGIAN INI, LOOPING DATA PRODUK -->
				@forelse($products as $row)

				@php $img = explode('|', $row->image); @endphp


				<div class="col col1">
					<div class="f_p_item">
						<div class="f_p_img">
							<img class="img-fluid" src="/storage/products/{{$img[0]}}" alt="{{ $row->name }}">
							<div class="p_icon">
								<a href="{{ url('/product/' . $row->slug) }}">
									<i class="lnr lnr-cart"></i>
								</a>
							</div>
						</div>

						<a href="{{ url('/product/' . $row->slug) }}">
							<h4>{{ $row->name }}</h4>
						</a>

						<h5>Rp {{ number_format($row->price) }}</h5>
					</div>
				</div>
				@empty

				@endforelse
			</div>

			<section class="feature_product_area section_gap">
				<div class="main_box">
					<div class="container-fluid">
						<div class="row">
							<div class="main_title">
								<h2>Produk Terbaru</h2>
								<p>Tampil Cantik Dengan Produk Kami</p>
							</div>
						</div>
						<div class="row">

							<!-- PERHATIAKAN BAGIAN INI, LOOPING DATA PRODUK -->
							@forelse($products as $row)

							@php $img = explode('|', $row->image); @endphp


							<div class="col col1">
								<div class="f_p_item">
									<div class="f_p_img">
										<img class="img-fluid" src="/storage/products/{{$img[0]}}" alt="{{ $row->name }}">
										<div class="p_icon">
											<a href="{{ url('/product/' . $row->slug) }}">
												<i class="lnr lnr-cart"></i>
											</a>
										</div>
									</div>

									<a href="{{ url('/product/' . $row->slug) }}">
										<h4>{{ $row->name }}</h4>
									</a>

									<h5>Rp {{ number_format($row->price) }}</h5>
								</div>
							</div>
							@empty

							@endforelse
						</div>

						<!-- GENERATE PAGINATION UNTUK MEMBUAT NAVIGASI DATA SELANJUTNYA JIKA ADA -->
						<div class="row">
							{{ $products->links() }}
						</div>
					</div>
				</div>

			</section>
			<!--================End Feature Product Area =================-->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
            <a href="https://api.whatsapp.com/send?phone=+6281285439993&text=Halo Saya Ingin Memesan Lansung Disini" class="float" target="_blank">
                <i class="fa fa-whatsapp my-float"></i>
            </a>

			@endsection
