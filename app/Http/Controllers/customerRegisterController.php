<?php

namespace App\Http\Controllers;

use App\Models\customerRegister;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class customerRegisterController extends Controller
{
    function customer_register(Request $request){
        $image = "default.png";
        if(customerRegister::where('email',$request->email)->exists()){
            return back()->with('success', 'email already registered');

        }else{

        
        customerRegister::insert([
            'name'=>$request->name,
            'password'=>bcrypt($request->password),
            'email'=>$request->email,
            'image'=>$image,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('success', 'you registered successfully!');
        }
    }

    function login_customer(Request $request){
        if(Auth::guard('customerlogin')->attempt(['email'=>$request->email, 'password'=> $request->password])){
            return redirect('/home');
        }else{
            return redirect()->route('customer.login')->with('success', 'email and password not match');
        }
    }

    function user_logout(){
        Auth::guard('customerlogin')->logout();
        return redirect()->route('customer.login');
    }

}
