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
                            <input type="text" class="form-control" id="first" name="customer_name" required>
                            <p class="text-danger">{{ $errors->first('customer_name') }}</p>
                        </div>

                        <div class="col-md-6 form-group p_star">
                            <label for="">No Telepon</label>
                            <input type="text" class="form-control" id="number" name="customer_phone" required>
                            <p class="text-danger">{{ $errors->first('customer_phone') }}</p>
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <label for="">Email</label>
                            @if (auth()->guard('customer')->check())
                            <input type="email" class="form-control" id="email" name="email" value="{{ auth()->guard('customer')->user()->email }}" required {{ auth()->guard('customer')->check() ? 'readonly':'' }}>
                            @else
                            <input type="email" class="form-control" id="email" name="email" required>
                            @endif
                            <p class="text-danger">{{ $errors->first('email') }}</p>
                        </div>



                        <div class="col-md-12 form-group p_star">
                            <label for="">Alamat Lengkap</label>
                            <input type="text" class="form-control" id="add1" name="customer_address" required>
                            <p class="text-danger">{{ $errors->first('customer_address') }}</p>
                        </div>

                        <!-- ================awal==================== -->

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
                            <select class="form-control" name="postalCode" id="postalCode" required>
                                <option value="">Pilih Kode Pos</option>
                            </select>
                            <p class="text-danger">{{ $errors->first('postalCode') }}</p>
                        </div>


                        <!-- =========pilih kurir end========== -->

                        <input type="hidden" name="weight" id="weight" value="{{ $weight }}">
                        <!-- //pilih kurir dan layanan 2 select// -->
                        <div class="col-md-12 form-group p_star" style="width: 325px;">
                            <label for="">Pilih Ekspedisi</label>
                            <select class="form-control" name="ekspedisi" id="ekspedisi" required>
                                <option value="">Pilih Jasa Ekspedisi</option>
                                <option value="jne">Jne </option>
                                <option value="jnt">Jnt </option>
                                <option value="sicepat">Si Cepat </option>
                                <option value="anteraja">Anter Aja </option>
                                <option value="pos">Pos </option>
                                <option value="lion">Lion </option>
                            </select>
                            <p class="text-danger">{{ $errors->first('ekspedisi') }}</p>
                        </div>

                        <!-- layanan setiap ekspedisi -->

                        <div class="col-md-12 form-group p_star" style="width: 325px;">
                            <label for="">Pilih Layanan</label>
                            <select class="form-control" name="service" id="service" required>
                                <option value="">pilih layanan </option>
                            </select>
                            <p class="text-danger">{{ $errors->first('service') }}</p>
                        </div>
                        <!-- ---mengambil data waktu dari controller========== -->
                        <input type="hidden" name="current_date" id="current_date" value="{{ $current_date }}">
                        <input type="hidden" name="time" id="time" value="{{ $current_time }}">
                        <!-- end -->


                        <div class="col-md-3">
                        </div>


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
                            @foreach ($carts as $cart)
                            <li>
                                <a href="#" name="namaProduk" id="namaProduk">{{ $cart['product_name'] }}
                                    <span class="middle" name="qty">x {{ $cart['qty'] }}</span>
                                    <span class="last" name="price" id="price">Rp {{ number_format($cart['product_price']) }}</span>
                                </a>

                            </li>
                            @endforeach

                        </ul>
                        <ul class="list list_2">
                            <li>
                                <a href="#">Subtotal
                                    <span>{{$subtotal}}</span>
                                </a>
                                <input type="hidden" name="totalHarga" id="totalHarga" value="{{ $subtotal }}">
                            </li>
                            <li>
                                <a href="#">Pengiriman
                                    <span id="harga"> </span>

                                    <!-- //mengambil value dari getElement Value// -->
                                    <input type="hidden" name="hrg" id="hrg">
                                    <input type="hidden" name="layanan" id="layanan">
                                    <!-- end  -->
                                </a>
                            </li>
                            <li>
                                <a href="#">Total
                                    <span id="total" name="total">Rp {{ number_format($subtotal) }}</span>
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
    //KETIKA SELECT BOX DENGAN ID province_id DIPILIH

    $('#provinceId').on('change', function() {
        //MAKA AKAN MELAKUKAN REQUEST KE URL /API/CITY
        //DAN MENGIRIMKAN DATA PROVINCE_ID
        $.ajax({
            url: "{{ url('/api/city') }}",
            type: "GET",
            data: {
                provinceId: $(this).val()
            },
            success: function(html) {
                //SETELAH DATA DITERIMA, SELEBOX DENGAN ID CITY_ID DI KOSONGKAN
                $('#cityId').empty()
                //KEMUDIAN APPEND DATA BARU YANG DIDAPATKAN DARI HASIL REQUEST VIA AJAX
                //UNTUK MENAMPILKAN DATA KABUPATEN / KOTA
                $('#cityId').append('<option value="">Pilih Kabupaten/Kota</option>')
                $.each(html.data, function(key, item) {
                    $('#cityId').append('<option value="' + item.cityId + '">' + item.cityName + '</option>')
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
            data: {
                cityId: $(this).val()
            },
            success: function(html) {
                //SETELAH DATA DITERIMA, SELEBOX DENGAN ID CITY_ID DI KOSONGKAN
                $('#districtId').empty()
                //KEMUDIAN APPEND DATA BARU YANG DIDAPATKAN DARI HASIL REQUEST VIA AJAX
                //UNTUK MENAMPILKAN DATA KABUPATEN / KOTA
                $('#districtId').append('<option value="">Pilih Kecamatan/Kota</option>')
                $.each(html.data, function(key, item) {
                    $('#districtId').append('<option value="' + item.districtId + '">' + item.districtName + '</option>')
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
            data: {
                districtId: $(this).val()
            },
            success: function(html) {
                //SETELAH DATA DITERIMA, SELEBOX DENGAN ID CITY_ID DI KOSONGKAN
                $('#postalCode').empty()
                //KEMUDIAN APPEND DATA BARU YANG DIDAPATKAN DARI HASIL REQUEST VIA AJAX
                //UNTUK MENAMPILKAN DATA KABUPATEN / KOTA
                $('#postalCode').append('<option value="">Pilih Kode Pos Kecamatan</option>')
                $.each(html.data, function(key, item) {
                    $('#postalCode').append('<option value="' + item.postalCode + '">' +
                        item.subdistrictName + '          (' + item.postalCode + ')' + '</option>')
                })
            }
        });
    })


    // ============coba request========


    // ======tutup===//

    // $('#postalCode').on('change', function() {
    //     $('#couriers').empty()
    //     $('#couriers').append('<option value="">Loading...</option>')

    //     $.ajax({
    //         url: "{{ url('/api/cost') }}",
    //         type: "POST",
    //         data: {
    //             destination_postal_code: $('#postalCode').val(),
    //             weight: $('#weight').val()
    //         },
    //         success: function(data) {

    //             $('#couriers').empty()
    //             $('#couriers').append('<option value="">Pilih Kurir</option>')
    //             let dt = data['data'];
    //             let cr = dt['pricing'];
    //             console.log("Hasil Response: " + JSON.stringify(cr));
    //             //LOOPING DATA ONGKOS KIRIM
    //             // Menampilkan Ongkos Kirim
    //             $.each(cr, function(key, value) {
    //                 let kurir = value['courier_name'] + ' ( ' + value['courier_service_code'] + ' ) ';
    //                 let harga = value['price'];
    //                 $('#couriers')
    //                     //menampilkan data kurir
    //                     .append(
    //                         '<option value="' + harga + '">' + kurir + '</option>');

    //             });
    //         }
    //     });
    // })




    // kurir pilih dan output service 
    $('#ekspedisi').on('change', function() {
        $('#service').empty()
        $('#service').append('<option value="">Loading...</option>')

        $.ajax({
            url: "{{ url('/api/cost') }}",
            type: "POST",
            data: {
                destination_postal_code: $('#postalCode').val(),
                couriers: $('#ekspedisi').val(),
                weight: $('#weight').val()
            },
            success: function(data) {

                $('#service').empty()
                $('#service').append('<option value="">Pilih Service</option>')
                let dt = data['data'];
                let cr = dt['pricing'];
                console.log("Hasil Response: " + JSON.stringify(cr));
                //LOOPING DATA ONGKOS KIRIM
                // Menampilkan Ongkos Kirim
                $.each(cr, function(key, value) {
                    let kurir = value['courier_service_code'];
                    let harga = value['price'];
                    $('#service')
                        //menampilkan data kurir
                        .append(
                            '<option value="' + harga + '">' + kurir + '</option>');

                });
            }
        });
    })


    // price ongkir////
    $('#service').on('change', function() {
        //mengampildata value select dari kurir//
        // let split = $('[harga]').val()
        let harga = $('#service').find(":selected").val();
        let layanan = $('#service').find(":selected").text();

        // mengambil harga dan value harga //
        $('#harga').text('Rp ' + harga);
        document.getElementById("hrg").value = harga;

        // mengambil data layanan + value//
        $('#layanan').text(layanan);
        document.getElementById("layanan").value = layanan;


        let subtotal = "{{ $subtotal }}"
        let total = parseInt(subtotal) + parseInt(harga)
        $('#total').text('Rp' + total)
    })
</script>





@endsection