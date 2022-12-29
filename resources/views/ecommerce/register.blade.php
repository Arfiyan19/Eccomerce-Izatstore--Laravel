@extends('layouts.ecommerce')

@section('title')
    <title>Register Member - Ecommerce</title>
@endsection

@section('content')
    <!--================Home Banner Area =================-->
	<section class="banner_area">
		<div class="banner_inner d-flex align-items-center">
			<div class="container">
				<div class="banner_content text-center">
					<h2>Register</h2>
					<div class="page_link">
                        <a href="{{ url('/') }}">Home</a>
                        <a href="{{ route('customer.login') }}">Register</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Home Banner Area =================-->

	<!--================Login Box Area =================-->
	<section class="login_box_area p_120">
		<div class="container">
			<div class="row">
				<div class="offset-md-3 col-lg-6">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

					<div class="login_form_inner">
						<h3>Register Member</h3>
                        <form class="row login_form" action="{{ route('customer.post_register') }}" method="post" id="contactForm" novalidate="novalidate">
                            @csrf
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="first" name="customer_name" placeholder="Full Name" required>
                                <p class="text-danger">{{ $errors->first('customer_name') }}</p>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="number" name="customer_phone" placeholder="Number Phone" required>
                                <p class="text-danger">{{ $errors->first('customer_phone') }}</p>
                            </div>
                            <div class="col-md-12 form-group">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
                                <p class="text-danger">{{ $errors->first('email') }}</p>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="add1" name="customer_address" placeholder="Full Adress" required>
                                <p class="text-danger">{{ $errors->first('customer_address') }}</p>
                            </div>



                            
<div class="col-md-12 form-group p_star">
                                        <label for="">Propinsi</label>
                                        <select class="form-control" name="provinceId" id="provinceId" required>
                                            <option value="">Pilih Propinsi</option>
                                            <!-- LOOPING DATA PROVINCE UNTUK DIPILIH OLEH CUSTOMER -->
                                            @foreach ($areas as $row)
                                            <option value="{{ $row->provinceId }}">{{ $row->provinceName }}</option>
                                            @endforeach
                                        </select>
                                        <p class="text-danger">{{ $errors->first('provinceId') }}</p>
                                    </div>


                            <!-- ADAPUN DATA KOTA DAN KECAMATAN AKAN DI RENDER SETELAH PROVINSI DIPILIH -->
                            <div class="col-md-12 form-group p_star">
                                        <label for="">Kabupaten / Kota</label>
                                        <select class="form-control" name="cityId" id="cityId" required>
                                            <option value="">Pilih Kabupaten/Kota</option>
                                        </select>
                                        <p class="text-danger">{{ $errors->first('cityId') }}</p>
                                    </div>


                                    <div class="col-md-12 form-group p_star" style="width: 420px;">
                                        <label for="">Kecamatan</label>
                                        <select class="form-control" name="districtId" id="districtId" required>
                                            <option value="">Pilih Kecamatan</option>
                                        </select>
                                        <p class="text-danger">{{ $errors->first('districtId') }}</p>
                                    </div>




							<div class="col-md-12 form-group">
								<button type="submit" value="submit" class="btn submit_btn">Register</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection

@section('js')
    <script>
        //KETIKA SELECT BOX DENGAN ID province_id DIPILIH
        $('#provinceId').on('change', function() {
            //MAKA AKAN MELAKUKAN REQUEST KE URL /API/CITY
            //DAN MENGIRIMKAN DATA PROVINCE_ID
            $.ajax({
                url: "{{ url('/api/city') }}",
                type: "GET",
                data: { provinceId: $(this).val() },
                success: function(html){
                    //SETELAH DATA DITERIMA, SELEBOX DENGAN ID CITY_ID DI KOSONGKAN
                    $('#cityId').empty()
                    //KEMUDIAN APPEND DATA BARU YANG DIDAPATKAN DARI HASIL REQUEST VIA AJAX
                    //UNTUK MENAMPILKAN DATA KABUPATEN / KOTA
                    $('#cityId').append('<option value="">Pilih Kabupaten/Kota</option>')
                    $.each(html.data, function(key, item) {
                        $('#cityId').append('<option value="'+item.cityId+'">'+item.cityName+'</option>')
                    })
                }
            });
        })

        //LOGICNYA SAMA DENGAN CODE DIATAS HANYA BERBEDA OBJEKNYA SAJA
         //LOGICNYA SAMA DENGAN CODE DIATAS HANYA BERBEDA OBJEKNYA SAJA
         $('#cityId').on('change', function() {
            //MAKA AKAN MELAKUKAN REQUEST KE URL /API/CITY
            //DAN MENGIRIMKAN DATA PROVINCE_ID
            $.ajax({
                url: "{{ url('/api/district') }}",
                type: "GET",
                data: { cityId: $(this).val() },
                success: function(html){
                    //SETELAH DATA DITERIMA, SELEBOX DENGAN ID CITY_ID DI KOSONGKAN
                    $('#districtId').empty()
                    //KEMUDIAN APPEND DATA BARU YANG DIDAPATKAN DARI HASIL REQUEST VIA AJAX
                    //UNTUK MENAMPILKAN DATA KABUPATEN / KOTA
                    $('#districtId').append('<option value="">Pilih Kecamatan/Kota</option>')
                    $.each(html.data, function(key, item) {
                        $('#districtId').append('<option value="'+item.districtId+'">'+item.districtName+'</option>')
                    })
                }
            });
        })

    </script>
@endsection