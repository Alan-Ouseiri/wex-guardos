<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\ResponsivaController;
use App\Http\Controllers\TeacherController;
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
Route::middleware(['auth'])->group(function () {
    Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index'); //Incio y listado de docentes
    Route::get('/teachers/new', [TeacherController::class, 'new'])->name('teachers.new'); //Formulario para crear
    Route::post('/teachers', [TeacherController::class, 'create'])->name('teachers.create'); //Funcion de crear
    Route::get('/teachers/{teacher}/edit', [TeacherController::class, 'edit'])->name('teachers.edit'); //Formulario para editar
    Route::put('/teachers/{teacher}', [TeacherController::class, 'update'])->name('teachers.update'); //Funcion para editar
});

//Ruta de Dispositivos
Route::middleware(["auth"])->group(function () {
    Route::get('/devices', [DeviceController::class, 'index'])->name('devices.index'); //Incio y listado de dispositivos
    Route::get("/devices/new", [DeviceController::class, 'new'])->name('devices.new'); //Formulario para crear
    Route::post("/devices", [DeviceController::class, 'create'])->name('devices.create'); //Funcion de crear
    Route::get('/devices/{device}/edit', [DeviceController::class, 'edit'])->name('devices.edit'); //Formulario para editar
    Route::put('/devices/{device}', [DeviceController::class, 'update'])->name('devices.update'); //Funcion para editar
});

Route::middleware(['auth'])->group(function () {
    Route::get('/responsivas', [ResponsivaController::class, 'index'])->name('responsivas.index');
    Route::get('/responsivas/create', [ResponsivaController::class, 'create'])->name('responsivas.create');
    Route::post('/responsivas', [ResponsivaController::class, 'store'])->name('responsivas.store');
});
