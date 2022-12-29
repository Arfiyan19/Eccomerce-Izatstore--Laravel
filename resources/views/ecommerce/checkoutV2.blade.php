@extends('layouts.ecommerce')

@section('title')
    <title>Checkout - Ecommerce</title>
@endsection

@section('content')
    <!--================Home Banner Area =================-->
	<section class="banner_area">
		<div class="banner_inner d-flex align-items-center">
			<div class="overlay"></div>
			<div class="container">
				<div class="banner_content text-center">
					<h2>Informasi Pengiriman</h2>
					<div class="page_link">
                        <a href="{{ url('/') }}">Home</a>
						<a href="#">Checkout</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Home Banner Area =================-->

	<!--================Checkout Area =================-->
	<section class="checkout_area section_gap">
		<div class="container">
			<div class="billing_details">
				<div class="row">
					<div class="col-lg-8">
                        <h3>Informasi Pengiriman</h3>          
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                                    
                        <form class="row contact_form" action="{{ route('front.store_checkout') }}" method="post" novalidate="novalidate">
                                        @csrf
                                    <div class="col-md-12 form-group p_star">
                                        <label for="">Nama Penerima</label>
                                        <input type="text" class="form-control" id="first" name="customer_name" placeholder="Masukan Nama">
                                    </div>
                                    <div class="col-md-6 form-group p_star">
                                        <label for="">No Telepon</label>
                                        <input type="text" class="form-control" id="number" name="customer_phone" placeholder="Masukan No Telepon">
                                    </div>

                                    <div class="col-md-12 form-group p_star">
                                        <form action="{{url('/testing')}}" method="get">
                                        <label for="">Alamat Lengkap</label>
                                        <input type="text" class="form-control"  name="lok" >
                                        </form> 
                                    </div>
<!-- ================awal==================== -->

<div class="col-md-12 form-group p_star">
                                        <label for="">Propinsi</label>
                                        <select class="form-control" name="province_destination" id="provinceId" required>
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
                                        <select class="form-control" name="cityName" id="cityId" required>
                                            <option value="">Pilih Kabupaten/Kota</option>
                                        </select>
                                        <p class="text-danger">{{ $errors->first('cityId') }}</p>
                                    </div>


                                    <div class="col-md-12 form-group p_star" style="width: 420px;">
                                        <label for="">Kecamatan</label>
                                        <select class="form-control" name="districtName" id="districtId" required>
                                            <option value="">Pilih Kecamatan</option>
                                        </select>
                                        <p class="text-danger">{{ $errors->first('districtId') }}</p>
                                    </div>
                                    <div class="col-md-12 form-group p_star" style="width: 325px;">
                                        <label for="">Kode Pos</label>
                                        <select class="form-control" name="subdistrictName" id="subdistrictId" required>
                                            <option value="">Pilih Kode Pos</option>
                                        </select>
                                        <p class="text-danger">{{ $errors->first('subdistrictId') }}</p>
                                    </div>


<!-- ===========bagian kurir============== -->
<div class="form-group col-md-12 form-group p_star" >
                        <label class="">PILIH JASA EKSPEDISI</label>
                        <select class="form-control" id="exampleFormControlSelect1" style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                        <option value="0">-- pilih ekspedisi --</option>
                               @foreach ($responseKurir['couriers'] as  $kurir   )
                                <option value="{{ $kurir['courier_name'] }} {{ $kurir['courier_service_name'] }} " style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                                {{ $kurir['courier_name'] }} ({{ $kurir['courier_service_name'] }}  
                                {{ $kurir['shipment_duration_range'] }} {{ $kurir['shipment_duration_unit'] }}
                                    )
                                </option>
                                @endforeach
                        </select>
                    </div>

<!-- =========pilih kurir end========== -->


                                    <!-- ADAPUN DATA KOTA DAN KECAMATAN AKAN DI RENDER SETELAH PROVINSI DIPILIH -->
                                
                                </div>
                                <div class="col-lg-4">
                                    <div class="order_box">
                                        <h2>Ringkasan Pesanan</h2>
                                        <ul class="list">
                                            <li>
                                                <a href="#">Product
                                                    <span>Total</span>
                                                </a>
                                            </li>
                                                            <li>
                                            </li>
                                        </ul>
                                        <ul class="list list_2">
                                            <li>
                                              <a href="#">Subtotal
                                              </a>
                                            </li>
                                            <li>
                                              <a href="#">Pengiriman
                                                <!-- <span id="ongkir">Rp 0</span> -->
                                              </a>
                                            </li>
                                            <li>
                                              <a href="#">Total
                                              </a>
                                            </li>
                                        </ul>
                                <button class="main_btn">Bayar Pesanan</button>
                          </form>
						</div>
					</div>
				</div>
			</div>
		</div>
        
    </section>
	<!--================End Checkout Area =================-->
@endsection


@section('js')
    <script>
        //KETIKA SELECT BOX DENGAN ID provinceId DIPILIH
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

                 //LOGICNYA SAMA DENGAN CODE DIATAS HANYA BERBEDA OBJEKNYA SAJA
                 $('#districtId').on('change', function() {
            //MAKA AKAN MELAKUKAN REQUEST KE URL /API/CITY
            //DAN MENGIRIMKAN DATA PROVINCE_ID
            $.ajax({
                url: "{{ url('/api/subdistrict') }}",
                type: "GET",
                data: { districtId: $(this).val() },
                success: function(html){
                    //SETELAH DATA DITERIMA, SELEBOX DENGAN ID CITY_ID DI KOSONGKAN
                    $('#subdistrictId').empty()
                    //KEMUDIAN APPEND DATA BARU YANG DIDAPATKAN DARI HASIL REQUEST VIA AJAX
                    //UNTUK MENAMPILKAN DATA KABUPATEN / KOTA
                    $('#subdistrictId').append('<option value="">Pilih Kode Pos Kecamatan</option>')
                    $.each(html.data, function(key, item) {
                        $('#subdistrictId').append('<option value="'+item.subdistrictId+'">'+
                        item.subdistrictName+'          ('+item.postalCode+ ')'+'</option>')
                    })
                }
            });
        })




        
        $('#district_id').on('change', function() {
            $('#courier').empty()
            $('#courier').append('<option value="">Loading...</option>')
        
            $.ajax({
                url: "{{ url('/api/cost') }}",
                type: "POST",
                data: { destination: $(this).val(), weight: $('#weight').val() },
                success: function(html){

                    $('#courier').empty()
                    $('#courier').append('<option value="">Pilih Kurir</option>')
                
                    //LOOPING DATA ONGKOS KIRIM
                    $.each(html.data.results, function(key, item) {
                        let courier = item.courier + ' - ' + item.service + ' (Rp '+ item.cost +')'
                        let value = item.courier + '-' + item.service + '-'+ item.cost
                        //DAN MASUKKAN KE DALAM OPTION SELECT BOX
                        $('#courier').append('<option value="'+value+'">' + courier + '</option>')
                    })
                }
            });
        })

    </script>

@endsection



