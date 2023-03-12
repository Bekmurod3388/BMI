<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HemisController,
    TeacherController,
    ThemeController,
    ProcessController,
    ProfileController,
    MudirController,
    StatisticController
};

Route::get('/', function () {
    if (auth()->check()){
        if (auth()->user()->role=='mudir')
            return redirect()->route('mudir-themes');
        else
            return redirect()->route('themes');
    }
    else
        return redirect()->route('student-themes');
});

Route::get('login-student', [HemisController::class, 'login'])->name('login-student');
Route::post('login-student-user', [HemisController::class, 'loginUser'])->name('login-student-user');

Route::middleware('hemis')->group(function () {

    Route::middleware('without_mudir')->group(function (){
        Route::get('logout-student', [HemisController::class, 'logout'])->name('logout-student');
        Route::get('profile', [HemisController::class, 'profile'])->name('profile');
        Route::get('student-themes', [ThemeController::class, 'themes'])->name('student-themes');
        Route::get('filtered-student-themes', [ThemeController::class, 'themesFilter'])->name('filtered-student-themes');
        Route::get('get-theme/{id}', [ThemeController::class, 'getTheme'])->name('get-theme');
        Route::get('process', [ProcessController::class, 'student_index'])->name('process');
        Route::post('update-process', [ProcessController::class, 'update'])->name('update-process');
        Route::get('show-process/{id}', [ProcessController::class, 'showProcess'])->name('show-process');
    });


    Route::middleware('mudir')->group(function(){
        Route::resource('teachers',TeacherController::class);
        Route::get('mudir-themes', [MudirController::class, 'themes'])->name('mudir-themes');
        Route::get('filtered-themes', [MudirController::class, 'filteredThemes'])->name('filtered-themes');
        Route::get('statistics-teacher', [StatisticController::class, 'teachers'])->name('statistics-teacher');
        Route::get('statistics-student', [StatisticController::class, 'students'])->name('statistics-student');

    });

    Route::middleware('teacher')->group(function(){
        Route::get('themes', [ThemeController::class, 'index'])->name('themes');
        Route::get('filtered-teacher-themes', [ThemeController::class, 'filter'])->name('filtered-teacher-themes');
        Route::post('store-theme', [ThemeController::class, 'store'])->name('store-theme');
        Route::post('update-theme', [ThemeController::class, 'update'])->name('update-theme');
        Route::post('delete-theme', [ThemeController::class, 'delete'])->name('delete-theme');
    });



});
require_once __DIR__ . '/auth.php';


