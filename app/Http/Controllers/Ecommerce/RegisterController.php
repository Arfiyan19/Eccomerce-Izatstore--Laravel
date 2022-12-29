<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;
use App\Province;
use App\Mail\CustomerRegisterMail;
use App\provinsi;
use Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function registerForm()
    {
        if (auth()->guard('customer')->check()) return redirect(route('customer.dashboard'));

        $areas = provinsi::orderBy('provinceName', 'DESC')->get();
        return view('ecommerce.register', compact('areas'));
    }


    public function register(Request $request){
        
        $this->validate($request, [
            'customer_name' => 'required|string|max:100',
            'customer_phone' => 'required',
            'email' => 'required|email',
            'customer_address' => 'required|string',
            'provinceId' => 'required|exists:provinsi,provinceId',
            'cityId' => 'required|exists:cities,cityId',
            'districtId' => 'required|exists:district,districtId'
        ]);

        try {
            if (!auth()->guard('customer')->check()) {
                $password = Str::random(8); 
                $customer = Customer::create([
                    'name' => $request->customer_name,
                    'email' => $request->email,
                    'password' => $password, 
                    'phone_number' => $request->customer_phone,
                    'address' => $request->customer_address,
                    'districtId' => $request->districtId,
                    'activate_token' => Str::random(30),
                    'status' => false
                ]);
            }

            if (!auth()->guard('customer')->check()) {
                Mail::to($request->email)->send(new CustomerRegisterMail($customer, $password));
            }
            return redirect()->back()->with(['success' => 'Registrasi Member Berhasil']);

        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
