<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HemisController,
    TeacherController,
    ThemeController,
    ProcessController,
    ProfileController,
    MudirController,
};


Route::get('login-student', [HemisController::class, 'login'])->name('login-student');
Route::post('login-student-user', [HemisController::class, 'loginUser'])->name('login-student-user');

Route::middleware('hemis')->group(function () {
    Route::get('logout-student', [HemisController::class, 'logout'])->name('logout-student');
    Route::get('profile', [HemisController::class, 'profile'])->name('profile');
    Route::get('themes', [ThemeController::class, 'index'])->name('themes');
    
    Route::resource('teachers',TeacherController::class);
    Route::get('mudir-themes', [MudirController::class, 'themes'])->name('mudir-themes');

    Route::post('store-theme', [ThemeController::class, 'store'])->name('store-theme');
    Route::post('update-theme', [ThemeController::class, 'update'])->name('update-theme');
    Route::post('delete-theme', [ThemeController::class, 'delete'])->name('delete-theme');
    Route::get('show-process/{id}', [ProcessController::class, 'showProcess'])->name('show-process');

    Route::get('get-theme/{id}', [ThemeController::class, 'getTheme'])->name('get-theme');
    Route::get('/', function () {
        if (auth()->user()->role=='mudir')
            return redirect()->route('mudir-themes');
        else
            return redirect()->route('themes');
    });
    Route::get('process', [ProcessController::class, 'student_index'])->name('process');
    Route::post('update-process', [ProcessController::class, 'update'])->name('update-process');
    


});
require_once __DIR__ . '/auth.php';


