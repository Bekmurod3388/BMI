<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('testlash', function () {
    \App\Services\HemisService::testLogin();
});




Route::get('login',[\App\Http\Controllers\HemisController::class,'login'])->name('login');
Route::post('login-user',[\App\Http\Controllers\HemisController::class,'loginUser'])->name('login-user');

Route::middleware('hemis')->group(function(){
    Route::get('logout',[\App\Http\Controllers\HemisController::class,'logout'])->name('logout');
    Route::get('profile',[\App\Http\Controllers\HemisController::class,'profile'])->name('profile');
    Route::get('themes',[\App\Http\Controllers\ThemeController::class,'index'])->name('themes');
    Route::post('store-theme',[\App\Http\Controllers\ThemeController::class,'store'])->name('store-theme');
    Route::get('get-theme/{id}',[\App\Http\Controllers\ThemeController::class,'getTheme'])->name('get-theme');

    Route::get('/admin', function () {
        return view('admin.master');
    })->name('admin');

});


