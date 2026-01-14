<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

//Ruta Raiz
Route::get('/', function () {
    return view('welcome');
});

//Rutas del login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name("auth");
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


//Pagina de Incio
Route::middleware(['auth'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
});


//Ruta de Maestros
use App\Http\Controllers\TeacherController;

Route::middleware(['auth'])->group(function () {
    Route::get('/teachers/new', [TeacherController::class, 'new'])->name('teachers.new');
    Route::post('/teachers', [TeacherController::class, 'create'])->name('teachers.create');
});
