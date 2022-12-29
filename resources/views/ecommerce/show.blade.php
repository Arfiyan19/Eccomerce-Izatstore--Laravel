@extends('layouts.ecommerce')

@section('title')
    <title>Jual {{ $product->name }}</title>
@endsection


@section('content')
    <!--================Home Banner Area =================-->
	<section class="banner_area">
		<div class="banner_inner d-flex align-items-center">
			<div class="container">
				<div class="banner_content text-center">
                    <h2>{{ $product->name }}</h2>
					<div class="page_link">
                        <a href="{{ url('/') }}">Home</a>
                        <a href="#">{{ $product->name }}</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Home Banner Area =================-->
	<div class="product_image_area">
		<div class="container">
			<div class="row s_product_inner">
				<div class="col-lg-6">
					<div class="s_product_img">

					<!-- ====lama===== -->
						<!-- <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="carousel-item active">
								@php $img = explode('|', $product->image); @endphp

									<img class="d-block w-100" src="/storage/products/{{$img[0]}}" alt="{{ $product->name }}">
								</div>
							</div>
						</div> -->

				<!-- =====mulai baru===== -->
				@php $img = explode('|', $product->image); @endphp
				@php $img2 = explode('|', $product->image2); @endphp
				@php $img3 = explode('|', $product->image3); @endphp
				@php $img4 =  $product->image4 ; @endphp
				@php $img5 = $product->image5; @endphp

				<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">

  <div class="carousel-item active">
      <img class="d-block w-100" src="/storage/products/{{$img[0]}}" alt="{{ $product->name }}">
    </div>

@if($img2!=null)
<div class="carousel-item">
	<img class="d-block w-100" src="/storage/products/{{ $product->image2}}" alt="{{ $product->name }}">
</div>
@else
<div class="carousel-item">
	<img class="d-block w-100" src="/storage/products/{{ $product->image}}" alt="{{ $product->name }}">
</div>
@endif

@if($img3==null )
<div class="carousel-item">
</div>
@else
<div class="carousel-item">
	<img class="d-block w-100" src="/storage/products/{{ $product->image3}}" alt="{{ $product->name }}">
</div>
@endif

@if($img4==null)
<div class="carousel-item-auto-next">
</div>
@else
<div class="carousel-item">
	<img class="d-block w-100" src="/storage/products/{{ $product->image4 }}" alt="{{ $product->name }}">
</div>
@endif


@if($img5==null)
<div class="carousel-item-auto-next">
</div>
@else
<div class="carousel-item">
	<img class="d-block w-100" src="/storage/products/{{ $product->image5 }}" alt="{{ $product->name }}">
</div>
@endif



<!-- ============vidio=========== -->
@php $vid = $product->vidio @endphp
@if($vid==null)
<div class="carousel-item-auto-next">
</div>
@else

<div class="carousel-item">
<div class="carousel-item active" style="margin-bottom: 80px;">
		<video class="d-block w-100" controls src="/storage/products/{{ $product->vidio }}"
		type="video/mp4" autoplay>
    </video></div>
</div>


@endif


  <a class="carousel-control-prev" href="#carouselExampleControls" style="color: black ;" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" style="color: black ;" ></span>
    <span class="sr-only" style="color: black ;">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
  </div>
</div>



						<!-- ======baru===== -->
					</div>
					<!-- =============//kolom baeru================== -->
					<div class="row">

					<div class="col-2">
						<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="carousel-item active">

									<img class="d-block w-100" src="/storage/products/{{ $product->image }}" alt="{{ $product->name }}">
								</div>
							</div>
						</div>
					</div>

					<!-- ===gambar22== -->


					<div class="col-2">
						<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="carousel-item active">
									<img class="d-block w-100" src="/storage/products/{{ $product->image2 }}" alt="{{ $product->name }}">
								</div>
							</div>
						</div>
					</div>



<!-- ===gambar 3==== -->

					<div class="col-2">
						<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="carousel-item active">
									@php $i3= $product->image3 @endphp
									@if($i3 ==null)
									@else
									<img class="d-block w-100" src="/storage/products/{{ $product->image3 }}" alt="{{ $product->name }}">
									@endif
								</div>
							</div>
						</div>
					</div>


<!-- ===gambar 3==== -->

			<div class="col-2">
						<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="carousel-item active">
									@php $i4= $product->image4 @endphp
									@if($i4 ==null)
									@else
									<img class="d-block w-100" src="/storage/products/{{ $product->image4 }}" alt="{{ $product->name }}">
									@endif
								</div>
							</div>
						</div>
					</div>


					<!-- ===collom gambar===== -->


					<!-- ===colom gambat]]]]]]] -->

					<!-- =========col2======= -->
					<div class="col-2">
						<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="carousel-item active">
									@php $vid = explode('|', $product->vidio); @endphp
								<video class="d-block w-50" controls src="/storage/products/{{$vid[0] }}"
								 type="video/mp4" autoplay>
    </video>
								</div>
							</div>
						</div>
					</div>
				<!-- ===tutup==== -->
				</div>

					<!-- ======kolom -->





				</div>
				<div class="col-lg-5 offset-lg-1">
					<div class="s_product_text">
						<h3>{{ $product->name }}</h3>
                        <h2>Rp {{ number_format($product->price) }}</h2>

		<div id="container" style="visibility: visible;">
    <p style="font-size: 15px">Penilian 95
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<span class="heading"> Rating</span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star"></span>
</p>
</div>
						<ul class="list">
							<li>
								<a class="active" href="{{ url('/category/' . $product->category->slug) }}">
                                    <span>Kategori</span> : {{ $product->category->name }}</a>
							<br>
								</li>
                        <!-- ===========Tambahan Commming Soon================ -->
							<li>
								<a >
                                    <span>Merk  </span> : {{ $product->merek }}
								</a>
								<br>
							</li>
							<li>
							<a >
                		         <span>Model  </span> : {{ $product->model }}
								</a><br>
							</li>
							<li> <a >
                                    <span>Jenis Garansi</span> : {{ $product->jenis_garansi }} </a> <br>
							</li>
							<li> <a >
                                    <span>SKU</span> : {{ $product->sku }} </a><br>
							</li>

							<li> <a >
                                    <span>Masa Garansi</span> : {{ $product->masa_garansi }} </a>
							</li>


							<li> <a >
                                    <span>Berat</span> : {{ $product->weight }} gram </a>
							</li>


						</ul>
						<p></p>
						<!-- TAMBAHKAN FORM ACTION -->
						<form action="{{ route('front.cart') }}" method="POST">
						@csrf
							<div class="product_count">
								<label for="qty">Quantity:</label>
								<input type="text" name="qty" id="sst" maxlength="12" value="1" title="Quantity:" class="input-text qty">

								<!-- BUAT INPUTAN HIDDEN YANG BERISI ID PRODUK -->
								<input type="hidden" name="product_id" value="{{ $product->id }}" class="form-control">

								<button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
								class="increase items-count" type="button">
								<i class="lnr lnr-chevron-up"></i>
								</button>
								<button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )  ) result.value--;return false;"
								class="reduced items-count" type="button">
								<i class="lnr lnr-chevron-down"></i>
								</button>
							</div>
							<div class="card_area">
								<button class="main_btn">Add to Cart</button>
							</div>
						</form>

						@if(auth()->guard('customer')->check())
							<br>
								@if($wishlist != NULL)
									@if($product->id == $wishlist->product_id)
										<form action="{{ route('customer.deleteWishlist', $wishlist->id) }}" onsubmit="return confirm('Kamu Yakin Menghapus Produk ini dari Daftar Wishlist ?');" method="post">
											@csrf
											@method('DELETE')
											<div class="card_area">
												<button class="gray_btn">Hapus Wishlist</button>
											</div>
										</form>
									@endif
								@else
									<form action="{{ route('customer.save_wishlist') }}" method="POST">
										@csrf
										<input type="hidden" name="product_id" value="{{ $product->id }}" class="form-control">
										<div class="card_area">
											<button class="main_btn">Add To Wishlist</button>
										</div>
									</form>
								@endif
						@endif

						@if (session('success'))
							<div class="alert alert-success mt-2">{{ session('success') }}</div>
						@elseif(session('error'))
							<div class="alert alert-danger mt-2">{{ session('error') }}</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--================End Single Product Area =================-->

	<!--================Product Description Area =================-->
	<section class="product_description_area">
		<div class="container">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active show" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Description</a>
				</li>

			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab" style="color: black">
					{!! $product->description !!}
				</div>
				<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
					<div class="table-responsive">
						<table class="table">
							<tbody>
							<tr>
									<td>
										<h5>Kategori</h5>
									</td>
									<td>
										<h5>{{ $product->category->name }}</h5>
									</td>
								</tr>
								<tr>
									<td>
										<h5>Merek</h5>
									</td>
									<td>
										<h5>{{ $product->merek }}</h5>
									</td>
								</tr>

								<tr>
									<td>
										<h5>Berat</h5>
									</td>
									<td>
                                        <h5>{{ $product->weight }} gr</h5>
									</td>
								</tr>
								<tr>
									<td>
										<h5>Harga</h5>
									</td>
									<td>
										<h5>Rp {{ number_format($product->price) }}</h5>
									</td>
								</tr>


								<tr>
									<td>
										<h5>SKU</h5>
									</td>
									<td>
										<h5>{{ $product->sku }}</h5>
									</td>
								</tr>



							</tbody>
						</table>
					</div>
				</div>
			</div>


            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
            <a href="https://api.whatsapp.com/send?phone=+6281285439993&text=Halo Saya Ingin Memesan Lansung Disini" class="float" target="_blank">
                <i class="fa fa-whatsapp my-float"></i>
            </a>

	</section>

	<!--================End Product Description Area =================-->
@endsection
