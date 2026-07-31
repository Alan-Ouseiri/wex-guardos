<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ResponsivaController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

//Ruta Raiz
Route::get('/', [AuthController::class, 'showLogin'])->name('login');

//Rutas del login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name("auth");
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


//Pagina de Incio
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

//Ruta de Maestros
Route::middleware(['auth'])->group(function () {
    Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index'); //Incio y listado de docentes
    Route::get('/teachers/all', [TeacherController::class, 'all'])->name('teachers.all');
    Route::get('/teachers/new', [TeacherController::class, 'new'])->name('teachers.new'); //Formulario para crear
    Route::post('/teachers', [TeacherController::class, 'create'])->name('teachers.create'); //Funcion de crear
    Route::get('/teachers/{teacher}/edit', [TeacherController::class, 'edit'])->name('teachers.edit'); //Formulario para editar
    Route::put('/teachers/{teacher}', [TeacherController::class, 'update'])->name('teachers.update'); //Funcion para editar
    Route::delete('/teachers/{teacher}', [TeacherController::class, 'destroy'])->name('teachers.destroy'); //Funcion para eliminar
});

//Ruta de Dispositivos
Route::middleware(["auth"])->group(function () {
    Route::get('/devices', [DeviceController::class, 'index'])->name('devices.index'); //Incio y listado de dispositivos
    Route::get("/devices/new", [DeviceController::class, 'new'])->name('devices.new'); //Formulario para crear
    Route::post("/devices", [DeviceController::class, 'create'])->name('devices.create'); //Funcion de crear
    Route::get('/devices/{device}/edit', [DeviceController::class, 'edit'])->name('devices.edit'); //Formulario para editar
    Route::put('/devices/{device}', [DeviceController::class, 'update'])->name('devices.update'); //Funcion para editar
    Route::delete('/devices/{device}', [DeviceController::class, 'destroy'])->name('devices.destroy'); //Funcion para eliminar
    Route::get('/devices/all', [DeviceController::class, 'all'])->name('devices.all');
});

//Ruta para Responsivas
Route::middleware(['auth'])->group(function () {
    Route::get('/responsivas', [ResponsivaController::class, 'index'])->name('responsivas.index');
    Route::get('/responsivas/trash', [ResponsivaController::class, 'trash'])->name('responsivas.trash');
    Route::get('/responsivas/active', [ResponsivaController::class, 'active'])->name('responsivas.active');
    Route::get('/responsivas/create', [ResponsivaController::class, 'create'])->name('responsivas.create');
    Route::post('/responsivas', [ResponsivaController::class, 'store'])->name('responsivas.store');
    Route::put('/responsivas/{responsiva}/return', [ResponsivaController::class, 'returnDevice'])->name('responsivas.return');
    Route::get('/responsivas/{responsiva}/history', [ResponsivaController::class, 'history'])->name('responsivas.history');
    Route::get('/responsivas/create-full', [ResponsivaController::class, 'createFull'])->name('responsivas.create.full');
    Route::post('/responsivas/store-full', [ResponsivaController::class, 'storeFull'])->name('responsivas.store.full');
    Route::get('/responsivas/{responsiva}/edit', [ResponsivaController::class, 'edit'])->name('responsivas.edit');
    Route::post('/responsivas/{responsiva}', [ResponsivaController::class, 'update'])->name('responsivas.update');
    Route::get('/responsivas/{responsiva}', [ResponsivaController::class, 'show'])->name('responsivas.show');
    Route::delete('/responsivas/{responsiva}', [ResponsivaController::class, 'destroy'])->name('responsivas.destroy');
    Route::delete('/responsivas/{id}/force', [ResponsivaController::class, 'forceDelete'])->name('responsivas.forceDelete');
    Route::post('/responsivas/{id}/restore', [ResponsivaController::class, 'restore'])->name('responsivas.restore');
});

//Ruta PDF
Route::get('/responsivas/{responsiva}/pdf', [ResponsivaController::class, 'pdf'])->name('responsivas.pdf');

//Ruta de Prestamo
Route::prefix('loans')->name('loans.')->group(function () {
    Route::get('/', [LoanController::class, 'index'])->name('index');
    Route::get('/create', [LoanController::class, 'create'])->name('create');
    Route::post('/', [LoanController::class, 'store'])->name('store');
    Route::patch('/{loan}/return', [LoanController::class, 'return'])->name('return');
});
