@extends('layouts.app')

@section('title', 'Panel de Inicio')

@section('content')

<div class='d-flex justify-content-center h-100 mt-4 pb-4'>
    <div class='col-xl-10 col-11'>
        <!-- Mensajes de Exito -->
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <!-- Titulo -->
        <h4 class="mb-4 fw-bold">Crear Responsivas</h4>

        <!-- Crear Responsivas -->
        <div class="row mx-auto justify-content-center g-4 row-cols-lg-3 row-cols-md-2 row-cols-1">
            <!-- Crear Responsiva -->
            <div class="col">
                <a href="{{ route("responsivas.create") }}" class="text-decoration-none text-black menu-card" style="--hover-color:#4630DD;">
                    <div class="bg-white shadow rounded-4 h-100 py-3 card-hover">
                        <!-- Icono -->
                        <div class="col-12 d-flex justify-content-center align-items-center">
                            <span class="p-3 rounded-circle h4 text-white" style="background: linear-gradient(135deg,rgba(79, 57, 246, 0.5) 0%, rgba(68, 45, 216, 1) 100%);">
                                <i class="fa-solid fa-plus"></i>
                            </span>
                        </div>
                        <!-- Texto -->
                        <div class="col-12 text-center">
                            <p class="h5 fw-bold">
                                Nueva Responsiva
                            </p>
                            <p class="text-body-tertiary mb-0" style="font-size: 14px;">
                                Crear Responsiva para un dispositivo
                            </p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Crear Responsiva Blanca -->
            <div class="col">
                <a href="{{ route("responsivas.create.full") }}" class="text-decoration-none text-black menu-card" style="--hover-color:#35C86E;">
                    <div class="bg-white shadow rounded-4 h-100 py-3 card-hover">
                        <!-- Icono -->
                        <div class="col-12 d-flex justify-content-center align-items-center">
                            <span class="p-3 rounded-circle h4 text-white" style="background: linear-gradient(135deg,rgba(0, 173, 65, 0.5) 0%, rgba(0, 191, 75, 1) 100%);">
                                <i class="fa-regular fa-file-lines"></i>
                            </span>
                        </div>
                        <!-- Texto -->
                        <div class="col-12 text-center">
                            <p class="h5 fw-bold">
                                Nueva Responsiva en Blanco
                            </p>
                            <p class="text-body-tertiary mb-0" style="font-size: 14px;">
                                Llena los datos del usuario y del dispositivo
                            </p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Crear Prestamo -->
            <div class="col">
                <a href="{{ route("loans.index") }}" class="text-decoration-none text-black menu-card" style="--hover-color:#BF36C2;">
                    <div class="bg-white shadow rounded-4 h-100 py-3 card-hover">
                        <!-- Icono -->
                        <div class="col-12 d-flex justify-content-center align-items-center">
                            <span class="p-3 rounded-circle h4 text-white" style="background: linear-gradient(135deg,rgba(173, 0, 144, 0.5) 0%, rgb(175, 0, 191) 100%);">
                                <i class="fa-regular fa-clock"></i>
                            </span>
                        </div>
                        <!-- Texto -->
                        <div class="col-12 text-center">
                            <p class="h5 fw-bold">
                                Prestamo de equipos
                            </p>
                            <p class="text-body-tertiary mb-0" style="font-size: 14px;">
                                Crea un prestamo temporal de un equipo
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <h4 class="my-4 fw-bold">Panel de Control</h4>

        <!-- Panel de Control -->
        <div class="row mx-auto g-4 row-cols-xl-3 row-cols-md-2 row-cols-1">
            <!-- Responsivas Activas -->
            <div class="col">
                <a href="{{ route('responsivas.active') }}" class="text-decoration-none text-black menu-card" style="--hover-color:#336BF0;">
                    <div class="bg-white shadow rounded-4 h-100 p-4 card-hover">
                        <!-- Icono -->
                        <div class="col-12 d-flex justify-content-between align-items-center">
                            <span class="p-2 rounded-3 h4 text-white" style="background: linear-gradient(135deg,rgba(37, 116, 254, 0.7), rgba(20, 76, 232, 1));">
                                <i class="fa-solid fa-file-circle-check"></i>
                            </span>
                            <span class="rounded-pill fw-bold px-3 py-1" style="background-color: #EFF6FF;">
                                {{ $responsivasActivas }}
                            </span>
                        </div>
                        <!-- Texto -->
                        <div class="col-12">
                            <p class="h5 fw-bold">
                                Responsivas Activas
                            </p>
                            <p class="text-body-tertiary mb-0" style="font-size: 14px;">
                                Documentos vigentes
                            </p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Todas las Responsivas -->
            <div class="col">
                <a href="{{ route("responsivas.index") }}" class="text-decoration-none text-black menu-card" style="--hover-color:#A340EF;">
                    <div class="bg-white shadow rounded-4 h-100 p-4 card-hover">
                        <!-- Icono -->
                        <div class="col-12 d-flex justify-content-between align-items-center">
                            <span class="p-2 rounded-3 h4 text-white" style="background: linear-gradient(135deg,rgba(166, 63, 255, 0.7), rgba(136, 13, 224, 1));">
                                <i class="fa-solid fa-clock-rotate-left"></i>
                            </span>
                            <span class="rounded-pill fw-bold px-3 py-1" style="background-color: #FAF5FF;">
                                {{ $totalResponsivas }}
                            </span>
                        </div>
                        <!-- Texto -->
                        <div class="col-12">
                            <p class="h5 fw-bold">
                                Todas las Responsivas
                            </p>
                            <p class="text-body-tertiary mb-0" style="font-size: 14px;">
                                Registro Completo
                            </p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Papelera de Responsivas -->
            <div class="col">
                <a href="{{ route("responsivas.trash") }}" class="text-decoration-none text-black menu-card" style="--hover-color:#8B8B8B;">
                    <div class="bg-white shadow rounded-4 h-100 p-4 card-hover">
                        <!-- Icono -->
                        <div class="col-12 d-flex justify-content-between align-items-center">
                            <span class="p-2 rounded-3 h4 text-white" style="background: linear-gradient(135deg,rgba(209, 209, 209, 0.7), rgb(119, 119, 119));">
                                <i class="fa-regular fa-trash-can"></i>
                            </span>
                            <span class="rounded-pill fw-bold px-3 py-1" style="background-color: #dbdbdb;">
                                {{ $responsivasPapelera }}
                            </span>
                        </div>
                        <!-- Texto -->
                        <div class="col-12">
                            <p class="h5 fw-bold">
                                Papelera de Responsivas
                            </p>
                            <p class="text-body-tertiary mb-0" style="font-size: 14px;">
                                Todas las Responsivas eliminadas
                            </p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Gestion de Maestros -->
            <div class="col">
                <a href="{{ route("teachers.index") }}" class="text-decoration-none text-black menu-card" style="--hover-color:#DF612A;">
                    <div class="bg-white shadow rounded-4 h-100 p-4 card-hover">
                        <!-- Icono -->
                        <div class="col-12 d-flex justify-content-between align-items-center">
                            <span class="p-2 rounded-3 h4 text-white" style="background: linear-gradient(135deg,rgba(250, 96, 0, 0.5), rgba(209, 59, 0, 1));">
                                <i class="fa-solid fa-people-group"></i>
                            </span>
                            <span class="rounded-pill fw-bold px-3 py-1" style="background-color: #FFF7ED;">
                                {{ $totalUsuarios }}
                            </span>
                        </div>
                        <!-- Texto -->
                        <div class="col-12">
                            <p class="h5 fw-bold">
                                Gestion de Usuarios
                            </p>
                            <p class="text-body-tertiary mb-0" style="font-size: 14px;">
                                Usuarios regsitardos
                            </p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Gestion de Dispositivos -->
            <div class="col">
                <a href="{{ route("devices.index") }}" class="text-decoration-none text-black menu-card" style="--hover-color:#32A399;">
                    <div class="bg-white shadow rounded-4 h-100 p-4 card-hover">
                        <!-- Icono -->
                        <div class="col-12 d-flex justify-content-between align-items-center">
                            <span class="p-2 rounded-3 h4 text-white" style="background: linear-gradient(135deg,rgba(0, 180, 161, 0.5), rgba(0, 127, 117, 1));">
                                <i class="fa-solid fa-mobile-screen-button"></i>
                            </span>
                            <span class="rounded-pill fw-bold px-3 py-1" style="background-color: #F0FDFA;">
                                {{ $totalDispositivos }}
                            </span>
                        </div>
                        <!-- Texto -->
                        <div class="col-12">
                            <p class="h5 fw-bold">
                                Gestion de Dispositivos
                            </p>
                            <p class="text-body-tertiary mb-0" style="font-size: 14px;">
                                Inventario total
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Estadisticas -->
        <div class="row g-4 py-4">
            <div class="col-12">
                <div class="row h-100 shadow bg-white rounded-4 p-4">
                    <!-- Titulo -->
                    <h5 class="fw-bold">Resumen de Actividad</h5>

                    <!-- Dispositivos Disponibles -->
                    <div class="col-lg-4 col-md-6 col-12 p-2">
                        <div class="rounded-4 h-100 py-4 text-center" style="background-color: #F0FDF4;">
                            <p class="h4 fw-bold" style="color: #00A63E;">
                                {{ $dispositivosDisponibles }}
                            </p>
                            <p class="mb-0" style="font-size: 14px;">
                                Dispositivos disponibles
                            </p>
                        </div>
                    </div>

                    <!-- Dispositivos Usados -->
                    <div class="col-lg-4 col-md-6 col-12 p-2">
                        <div class="rounded-4 h-100 py-4 text-center" style="background-color: #FEFCE8;">
                            <p class="h4 fw-bold" style="color: #D08700;">
                                {{ $dispositivosUsados }}
                            <p class="mb-0" style="font-size: 14px;">
                                Dispositivos en uso
                            </p>
                        </div>
                    </div>

                    <!-- Prestamos Activos -->
                    <div class="col-lg-4 col-md-6 col-12 p-2">
                        <div class="rounded-4 h-100 py-4 text-center" style="background-color: #fdefff;">
                            <p class="h4 fw-bold" style="color: #ce15fc;">
                                {{ $totalPrestamos }}
                            </p>
                            <p class="mb-0" style="font-size: 14px;">
                                Total de Prestamos Activos
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection