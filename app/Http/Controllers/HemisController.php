<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use App\Services\HemisService;
use Illuminate\Http\Request;

class HemisController extends Controller
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
            if(HemisService::login($request->login,$request->password)){
                return redirect()->route('profile');
            }
        }catch (\Exception $exception){
            return redirect()->route('login')->withErrors('Login yoki parol xato !');
        }

    }
    public function logout(){
        session()->flush();
        return redirect()->route('login');
    }
    public function profile(){
        try {
            HemisService::getMe();
            return view('admin.profile');
        }catch (\Exception $exception){
            return redirect()->route('login')->withErrors('Talaba ma\'lumotlarini olishda xatolik, iltimos qayta urinib ko\'ring !');
        }

    }

}
