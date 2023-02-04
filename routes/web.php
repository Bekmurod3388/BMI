<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('testlash', function () {
    \App\Services\HemisService::testLogin();
});




Route::get('login-student',[\App\Http\Controllers\HemisController::class,'login'])->name('login-student');
Route::post('login-student-user',[\App\Http\Controllers\HemisController::class,'loginUser'])->name('login-student-user');

Route::middleware('hemis')->group(function(){
    Route::get('logout-student',[\App\Http\Controllers\HemisController::class,'logout'])->name('logout-student');
    Route::get('profile',[\App\Http\Controllers\HemisController::class,'profile'])->name('profile');
    Route::get('themes',[\App\Http\Controllers\ThemeController::class,'index'])->name('themes');
    Route::post('store-theme',[\App\Http\Controllers\ThemeController::class,'store'])->name('store-theme');
    Route::post('update-theme',[\App\Http\Controllers\ThemeController::class,'update'])->name('update-theme');
    Route::post('delete-theme',[\App\Http\Controllers\ThemeController::class,'delete'])->name('delete-theme');
    Route::get('get-theme/{id}',[\App\Http\Controllers\ThemeController::class,'getTheme'])->name('get-theme');
    Route::get('/', function () { return redirect()->route('themes'); });
    Route::get('processes',[\App\Http\Controllers\ProcessController::class,'index'])->name('processes');
    Route::get('process',[\App\Http\Controllers\ProcessController::class,'student_index'])->name('process');


});
require_once __DIR__.'/auth.php';


