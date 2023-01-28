<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('testlash', function () {
    \App\Services\HemisLoginService::testLogin();
});




Route::get('login',[\App\Http\Controllers\LoginController::class,'login'])->name('login');
Route::post('login-user',[\App\Http\Controllers\LoginController::class,'loginUser'])->name('login-user');

Route::middleware('hemis')->group(function(){
    Route::get('/', function () {
        return view('welcome');
    })->name('/');

    Route::get('/admin', function () {
        return view('admin.master');
    })->name('admin');

});


