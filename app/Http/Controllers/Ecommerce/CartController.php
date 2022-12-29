<?php

namespace App\Http\Controllers\Ecommerce;

use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Province;
use App\City;
use App\District;
use App\Customer;
use App\Order;
use App\OrderDetail;
use Illuminate\Support\Str;
use DB;
use App\Mail\CustomerRegisterMail;
use App\Pesanan;
use Mail;
use Illuminate\Support\Facades\Http;
use App\provinsi;
use PHPUnit\Util\Json;
use GuzzleHttp\RequestOptions;

class CartController extends Controller
{

    private $auth = [
        'headers' => [
            'Authorization' => 'Bearer biteship_live.eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1lIjoicGlhbiIsInVzZXJJZCI6IjYyZjc3NTY2ZjJhYTA4M2U1MTQyYThjMSIsImlhdCI6MTY2MTg1ODE0MH0.dE8jwOtbSbjbRn4uhytjwgXYwifsslX2yTeYaVunZ7w',
            'content-type' => 'application/json',
        ],

    ];


    private function getCarts()
    {
        $carts = json_decode(request()->cookie('e-carts'), true);
        $carts = $carts != '' ? $carts : [];
        return $carts;
    }

    public function addToCart(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer'
        ]);

        $carts = json_decode($request->cookie('e-carts'), true);

        if ($carts && array_key_exists($request->product_id, $carts)) {
            $carts[$request->product_id]['qty'] += $request->qty;
        } else {
            $product = Product::find($request->product_id);
            $carts[$request->product_id] = [
                'qty' => $request->qty,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'product_price' => $product->price,
                'product_image' => $product->image,
                'weight' => $product->weight
            ];
        }

        $cookie = cookie('e-carts', json_encode($carts), 2880);
        return redirect()->back()->with(['success' => 'Produk Ditambahkan ke Keranjang'])->cookie($cookie);
    }

    public function listCart()
    {
        $carts = $this->getCarts();
        $subtotal = collect($carts)->sum(function ($q) {
            return $q['qty'] * $q['product_price'];
        });

        return view('ecommerce.cart', compact('carts', 'subtotal'));
    }

    public function updateCart(Request $request)
    {
        $carts = $this->getCarts();

        if ($request->product_id == '') {
            return redirect()->route('front.product');
        } else {
            foreach ($request->product_id as $key => $row) {
                if ($request->qty[$key] == 0) {
                    unset($carts[$row]);
                } else {
                    $carts[$row]['qty'] = $request->qty[$key];
                }
            }
            $cookie = cookie('e-carts', json_encode($carts), 2880);
            return redirect()->back()->cookie($cookie);
        }
    }

    public function getCourier(Request $request)
    {

        // $this->validate($request, [
        //     'destination_postal_code' => 'required',
        //     // 'weight' => 'required|integer'
        // ]);
        $url = ('https://api.biteship.com/v1/rates/couriers');
        $headers = [
            'Authorization' => 'Bearer biteship_live.eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1lIjoicGlhbiIsInVzZXJJZCI6IjYyZjc3NTY2ZjJhYTA4M2U1MTQyYThjMSIsImlhdCI6MTY2MTg1ODE0MH0.dE8jwOtbSbjbRn4uhytjwgXYwifsslX2yTeYaVunZ7w',
            'content-type' => 'application/json',
        ];
        // $r = $request->postalcode;
        $dt = ([
            "origin_postal_code" => 17433,
            "destination_postal_code" => $request->destination_postal_code,
            "couriers" => $request->couriers,
            "items" => [
                [
                    "weight" => $request->weight
                ]
            ]
        ]);
        $requests = HTTP::withBody(json_encode($dt), 'application/json')->withOptions(['headers' => $headers])
            ->post($url);

        $responseBody = json_decode($requests->getBody()->getContents(), true);

        return response()->json(['status' => 'success', 'data' => $responseBody]);
    }

    // ===cek ongkir2====

    public function checkout(Request $request)
    {
        $areas = provinsi::orderBy('provinceName', 'DESC')->get();
        $carts = $this->getCarts();
        $subtotal = collect($carts)->sum(function ($q) {
            return $q['qty'] * $q['product_price'];
        });
        $weight = collect($carts)->sum(function ($q) {
            return $q['qty'] * $q['weight'];
        });
        $current_date = date('Y-m-d');
        $current_time = date('H:i');

        return view('ecommerce.checkout', compact('areas', 'carts', 'subtotal', 'weight', 'current_date', 'current_time'));
    }


    //Proses Checkout Api Biteshi//
    public function prosesOrders(Request $request)
    {
        // $this->validate($request, [
        //     'customer_name' => 'required|string|max:100',
        //     'customer_phone' => 'required',
        //     'email' => 'required|email',
        //     'customer_address' => 'required|string',
        //     'province_id' => 'required|exists:provinces,id',
        //     'city_id' => 'required|exists:cities,id',
        //     'district_id' => 'required|exists:districts,id',
        //     'courier' => 'required'
        // ]);

        $carts = $this->getCarts();

        // memanggil id produk dari cart//
        $id_produk = collect($carts);
        $idProduk = $id_produk->implode('product_id', ', ');

        // memanggil nama produk dari cart//
        $nm_produk = collect($carts);
        $nameProduk = $nm_produk->implode('product_name', ', ');

        // memanggil harga produk dari cart//
        $hr_produk = collect($carts);
        $hargaProduk = $hr_produk->implode('product_price', ', ');

        // memanggil berat produk dari cart//
        $brt_produk = collect($carts);
        $beratProduk = $brt_produk->implode('weight', ', ');

        // memanggil qty produk dari cart//
        $qty = collect($carts);
        $qtyproduk = $qty->implode('qty', ', ');



        $subtotal = $request->totalHarga + $request->hrg;
        //order to api//
        $url = ('https://api.biteship.com/v1/orders');
        $headers = [
            'Authorization' => 'Bearer biteship_live.eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1lIjoicGlhbiIsInVzZXJJZCI6IjYyZjc3NTY2ZjJhYTA4M2U1MTQyYThjMSIsImlhdCI6MTY2MTg1ODE0MH0.dE8jwOtbSbjbRn4uhytjwgXYwifsslX2yTeYaVunZ7w',
            'content-type' => 'application/json',
        ];


        $dt = [
            "shipper_contact_name" => "Izat Store",
            "shipper_contact_phone" => "081285439993",
            "shipper_contact_email" => "izzatstore@gmail.com",
            "shipper_organization" => "Pian Testing",
            "origin_contact_name" => "Izat Store",
            "origin_contact_phone" => "081285439993",
            "origin_address" => "Jl Cempaka X No 19 RT 08 RW 13 Jatisampurna Bekasi Cibubur,",
            "origin_note" => "Izzat Store",
            "origin_postal_code" => 17433,
            "origin_coordinate" => "",
            "destination_contact_name" => $request->customer_name,
            "destination_contact_phone" => $request->customer_phone,
            "destination_contact_email" => $request->email,
            "destination_address" => $request->customer_address,
            "destination_postal_code" => $request->postalCode,
            "destination_note" => "",
            "destination_coordinate" => "",
            "destination_cash_on_delivery" => "", // request total cod
            "destination_cash_on_delivery_type" => "",
            "destination_cash_proof_of_delivery" => true,
            "courier_company" => $request->ekspedisi, // => Request Kurir
            "courier_type" => $request->layanan, // => Request Kurir Name
            "courier_insurance" => "9000", // === Request Kurir Insurance
            "delivery_type" => "later",
            "delivery_date" => $request->current_date,  // ===> Request Date
            "delivery_time" => $request->time, // =====> Request time
            "order_note" => "Coba perbaruai",  //=========> Order NOTE
            "metadata" => [],
            "items" => [
                [
                    "id" => $idProduk,
                    "name" => $nameProduk,
                    "image" => "",
                    "description" => "Keluaran Terbaru",
                    "value" => $hargaProduk,
                    "quantity" => $qtyproduk,
                    "height" => 10,
                    "length" => 10,
                    "weight" => $beratProduk,
                    "width" => 10,
                ],
            ],
        ];


        $requests = HTTP::withBody(json_encode($dt), 'application/json')->withOptions(['headers' => $headers])
            ->post($url);
        //HASIL RESPONSE//
        $responseBody = json_decode($requests->getBody()->getContents(), true);
        $dataid = $responseBody['id'];   //=============> mengambil data id response    

        //mengambil id customer yang log in//
        if (auth()->guard('customer')->check()) {
            $id_customer = auth()->guard('customer')->user()->id;
        }
        //save to database 
        $pesanans = Pesanan::create([
            'invoice' => Str::random(4) . '-' . time(),
            'customer_id' => $id_customer,
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'subtotal' => $subtotal,
            'order_id' => $dataid,
        ]);



        $orders = Pesanan::where(
            'customer_id',
            auth()->guard('customer')->user()->id
        )->orderBy('created_at', 'DESC')->paginate(10);
        // return  response()->json(['status' => 'success', 'data' => $responseBody]);
        return view('ecommerce.orders.index', compact('orders'))->with('message', 'Terima Kasih Telah Melakukan Order');
    }

    public function getCity()
    {
        $cities = City::where('provinceId', request()->provinceId)->get();
        return response()->json(['status' => 'success', 'data' => $cities]);
    }

    public function getDistrict()
    {
        $districts = DB::table('district')->where('cityId', request()->cityId)->get();
        return response()->json(['status' => 'success', 'data' => $districts]);
    }

    public function getSubDistrict()
    {
        $Subdistricts = DB::table('subdistrict')->where('districtId', request()->districtId)->get();
        return response()->json(['status' => 'success', 'data' => $Subdistricts]);
    }


    public function processCheckout(Request $request)
    {
        $this->validate($request, [
            'customer_name' => 'required|string|max:100',
            'customer_phone' => 'required',
            'email' => 'required|email',
            'customer_address' => 'required|string',
            'province_id' => 'required|exists:provinces,id',
            'city_id' => 'required|exists:cities,id',
            'district_id' => 'required|exists:districts,id',
            'courier' => 'required'
        ]);

        //DATABASE TRANSACTION BERFUNGSI UNTUK MEMASTIKAN SEMUA PROSES SUKSES UNTUK KEMUDIAN DI COMMIT AGAR DATA BENAR BENAR DISIMPAN, JIKA TERJADI ERROR MAKA KITA ROLLBACK AGAR DATANYA SELARAS
        DB::beginTransaction();
        try {
            $customer = Customer::where('email', $request->email)->first();
            //JIKA DIA TIDAK LOGIN DAN DATA CUSTOMERNYA ADA
            if (!auth()->guard('customer')->check() && $customer) {
                return redirect()->back()->with(['error' => 'Silahkan Login Terlebih Dahulu']);
            }

            $carts = $this->getCarts();

            $subtotal = collect($carts)->sum(function ($q) {
                return $q['qty'] * $q['product_price'];
            });

            if (!auth()->guard('customer')->check()) {
                $password = Str::random(8);
                $customer = Customer::create([
                    'name' => $request->customer_name,
                    'email' => $request->email,
                    'password' => $password,
                    'phone_number' => $request->customer_phone,
                    'address' => $request->customer_address,
                    'district_id' => $request->district_id,
                    'activate_token' => Str::random(30),
                    'status' => false
                ]);
            }

            $shipping = explode('-', $request->courier);
            $order = Order::create([
                'invoice' => Str::random(4) . '-' . time(),
                'customer_id' => $customer->id,
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'customer_address' => $request->customer_address,
                'district_id' => $request->district_id,
                'subtotal' => $subtotal,
                'cost' => $shipping[2],
                'shipping' => $shipping[0] . '-' . $shipping[1]
            ]);

            foreach ($carts as $row) {
                //AMBIL DATA PRODUK BERDASARKAN PRODUCT_ID
                $product = Product::find($row['product_id']);
                //SIMPAN DETAIL ORDER
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $row['product_id'],
                    'price' => $row['product_price'],
                    'qty' => $row['qty'],
                    'weight' => $product->weight
                ]);
            }

            //TIDAK TERJADI ERROR, MAKA COMMIT DATANYA UNTUK MENINFORMASIKAN BAHWA DATA SUDAH FIX UNTUK DISIMPAN
            DB::commit();

            $carts = [];
            $cookie = cookie('e-carts', json_encode($carts), 2880);

            if (!auth()->guard('customer')->check()) {
                Mail::to($request->email)->send(new CustomerRegisterMail($customer, $password));
            }
            return redirect(route('front.finish_checkout', $order->invoice))->cookie($cookie);
        } catch (\Exception $e) {
            //JIKA TERJADI ERROR, MAKA ROLLBACK DATANYA
            DB::rollback();
            //DAN KEMBALI KE FORM TRANSAKSI SERTA MENAMPILKAN ERROR
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function checkoutFinish($invoice)
    {
        $order = Order::with(['district.city'])->where('invoice', $invoice)->first();
        if (Order::where('invoice', $invoice)->exists()) {
            return view('ecommerce.checkout_finish', compact('order'));
        } else {
            return redirect()->back();
        }
    }
}
