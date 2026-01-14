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

Route::middleware(['auth'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
});