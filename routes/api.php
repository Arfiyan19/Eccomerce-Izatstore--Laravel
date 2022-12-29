<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// ====perubahan==================
// Route::get('cost', 'Ecommerce\CartController@getCourier');

Route::get('city', 'Ecommerce\CartController@getCity');
Route::get('district', 'Ecommerce\CartController@getDistrict');
Route::get('subdistrict', 'Ecommerce\CartController@getSubDistrict');

Route::post('cost', 'Ecommerce\CartController@getCourier');


// ==api wilayah baru===============
Route::get('city', 'OngkirController@getCity');
Route::get('district', 'OngkirController@getDistrict');
Route::get('subdistrict', 'OngkirController@getSubDistrict'); 

// Route::get('/ongkir', 'CheckOngkirController@index');
// Route::post('/ongkir', 'CheckOngkirController@check_ongkir');
// Route::get('/cities/{province_id}', 'CheckOngkirController@getCities');
