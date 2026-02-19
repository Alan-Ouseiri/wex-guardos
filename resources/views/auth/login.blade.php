@extends('layouts.home')

@section('title', 'Login')

@section('content')

<div class='d-flex justify-content-center align-items-center h-100'>
    <div class="col-xl-3 col-lg-5 col-md-8 col-11">
        <div class="col-12 bg-white shadow rounded-4">

            <!-- Logo -->
            <div class="col-12 d-flex flex-wrap justify-content-center align-items-center rounded-top-4 py-4" style="background: linear-gradient(140deg,#2b45e7 0%, #9610f8 50%, #5139f7 100%);">

                <!-- Icono -->
                <span class="text-white mb-0 p-3 rounded-4 bg-white">
                    <i class="fa-regular fa-file-lines h1 mb-0" style="color: #4F39F6;"></i>
                </span>

                <!-- Texto -->
                <div class="col-12 text-center mt-3">
                    <p class="h3 fw-bolder text-white">
                        Sistema de Responsivas
                    </p>
                    <p class="text-white fw-light">
                        Gestion de dispositivos y documentos
                    </p>
                </div>
            </div>

            <!-- Contenido -->
            <div class="col-12 p-4">

                <!-- Titulo -->
                <div class="col-12 text-center mb-3">
                    <p class="h4 fw-bold mb-0">
                        Bienvenido de nuevo
                    </p>
                    <p style="font-size: 13px;">
                        Ingresa tus credenciales para continuar
                    </p>
                </div>

                <!-- Errores -->
                @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
                @endif

                <!-- Formulario -->
                <form method="POST" action="{{ route("auth") }}">
                    @csrf

                    <div class="mb-3">
                        <label><i class="fa-regular fa-envelope" style="color: #5139f7;"></i> Correo Electronico</label>
                        <input type="email" name="email" class="form-control" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label><i class="fa-solid fa-lock" style="color: #5139f7;"></i> Contraseña</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <button class="w-100 text-white p-3 rounded-4 fw-bold" style="background: linear-gradient(90deg,#2b45e7 0%, #9610f8 50%, #5139f7 100%); border: none">Iniciar Sesion</button>
                </form>
            </div>
        </div>

        <!-- Derechos -->
        <p class="mt-3 text-center" style="font-size: 11px;">
            © 2026 Sistema de Responsivas. Todos los derechos reservados.
        </p>
    </div>
</div>


@endsection