<?php

namespace App\Http\Controllers;

use Facade\FlareClient\Http\Client as HttpClient;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\New_;
use App\City;
use App\provinsi;

use function GuzzleHttp\json_encode;

class OngkirController extends Controller
{
   private $auth = [
        'headers' => [
            'Authorization' => 'Bearer biteship_live.eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1lIjoicGlhbiIsInVzZXJJZCI6IjYyZjc3NTY2ZjJhYTA4M2U1MTQyYThjMSIsImlhdCI6MTY2MTg1ODE0MH0.dE8jwOtbSbjbRn4uhytjwgXYwifsslX2yTeYaVunZ7w',
            'content-type' => 'application/json',
        ],
    ];
    public function index (Request $request){

        $client = new Client();
        $input= $request->name;
        $param='countries=ID'.'&input='.$input.'&type=single';
        $areas= DB::table('t_area')->get();
        $response = $client->get('https://api.biteship.com/v1/maps/areas/?'.$param,$this->auth); 
        // $responseBody = json_decode($response->getBody(), true);
        $responseBody = json_decode($response->getBody()->getContents(), true);
        // $responseBody->curiers[] = json_decode($responseBody->curiers[],true);
        // ==menampilkan nama kurir berdasarkan kurirname==
        // foreach($responseBody['couriers'] as $mydata)
// dd($areas);
        // {
        //      echo $mydata['courier_name']. "\n : ";
        //      echo $mydata['courier_service_name']. "</br>";
      
        // }   
        
        return view('ecommerce.view2', compact('responseBody','areas'));
        // $data = $responseBody;

        // view2.blade.php


    }

    public function getLocation (Request $request){
 
        $client = new Client();
        $paramKurir='couriers=jne,jnt,sicepat,grab,gojek,tiki';
        $response2 = $client->get('https://api.biteship.com/v1/couriers?'.$paramKurir,$this->auth); 
        $responseKurir = json_decode($response2->getBody()->getContents(), true);

        // $areas= DB::table('t_area')->get();
        $areas = provinsi::orderBy('provinceName', 'DESC')->get();
        // // $responseBody = json_decode($response->getBody(), true);

    // dd($response);

        return view('ecommerce.checkoutV2', compact('areas','responseKurir'));



    }

    public function getCity()
    {
        $cities = City::where('provinceId', request()->provinceId)->get();
        return response()->json(['status' => 'success', 'data' => $cities]);
    }

    public function getDistrict()
    {
        $districts =DB::table('district')->where('cityId', request()->cityId)->get();
        return response()->json(['status' => 'success', 'data' => $districts]);
    }

    public function getSubDistrict()
    {
        $Subdistricts =DB::table('subdistrict')->where('districtId', request()->districtId)->get();
        return response()->json(['status' => 'success', 'data' => $Subdistricts]);
    }


}
