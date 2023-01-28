<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use App\Services\HemisLoginService;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(){

        if (session()->has('loggedin')) {
            return redirect()->route('admin');
        }else{
            return view('hemis.login');
        }
    }

    public function loginUser(Request $request){
        $request->validate([
            'login'=>'required',
            'password'=>'required'
        ]);
        try {
            if(HemisLoginService::login($request->login,$request->password)){
                return view('admin.master');
            }
        }catch (\Exception $exception){
            return redirect()->route('login')->withErrors('Login yoki parol xato !');
        }

    }

}
