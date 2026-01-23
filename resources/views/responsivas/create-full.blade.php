@extends('layouts.app')

@section('title', 'Crear Responsiva')

@section('content')

<div class="row">
    <div class="col-12">

        <!-- Titulo -->
        <div class="d-flex align-items-center mb-3">
            <a href="{{ route("dashboard") }}" class="text-decoration-none text-black">
                <i class="h5 fa-solid fa-arrow-left mb-0"></i>
            </a>
            <div class="flex-fill ms-2">
                <p class="h4 fw-bold mb-0">Nueva Responsiva en blanco</p>
                <span style="font-size: 12px;">Completa los datos para generar la Responsiva</span>
            </div>
        </div>

        <!-- Contenido -->
        <div class="col-12 p-4 rounded-4 bg-white shadow">

            <!-- Errores -->
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('responsivas.store.full') }}" enctype="multipart/form-data" class="row justify-content-center">
                @csrf

                <!-- Docente -->
                <div class="col-md-4">
                    <div class="col-12 pb-2" style="border-bottom: solid 2px #4630DD;">
                        <i class="fa-regular fa-user" style="color: #4630DD;"></i><span class="fw-bold ps-2">Datos del Usuario</span>
                    </div>

                    <div class="col-12 mt-3">

                        <div class="mb-3">
                            <label class="form-label">Nombre(s)</label>
                            <input name="teacher[name]" class="form-control" placeholder="Ingresa el nombre">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Apellido(s)</label>
                            <input name="teacher[surname]" class="form-control" placeholder="Ingresa el apellido">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Rol</label>
                            <input name="teacher[role]" class="form-control" placeholder="Ej. Administrativo, Profesor, Profesora">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Correo</label>
                            <input name="teacher[email]" class="form-control" placeholder="Ej. profesor@wexford.edu.mx">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">No. Empleado</label>
                            <input name="teacher[employee_number]" class="form-control" placeholder="No. Empleado">
                        </div>

                    </div>
                </div>

                <!-- Dispositivo -->
                <div class="col-md-4">

                    <div class="col-12 pb-2" style="border-bottom: solid 2px #00A63E;">
                        <i class="fa-solid fa-mobile-screen-button" style="color: #00A63E;"></i><span class="fw-bold ps-2">Datos del Dispositivo</span>
                    </div>

                    <div class="col-12 mt-3">

                        <div class="mb-3">
                            <label class="form-label">Tipo</label>
                            <input name="device[type]" class="form-control" placeholder="Ej. Laptop, iPad, Macbook">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Marca</label>
                            <input name="device[brand]" class="form-control" placeholder="Ej. Apple, Lenovo, MSI">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Modelo</label>
                            <input name="device[model]" class="form-control" placeholder="Ej. 5, Gen 8, Air 11">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">No. Serie</label>
                            <input name="device[serial_number]" class="form-control" placeholder="xxxxxxxxxx">
                        </div>


                    </div>
                </div>

                <!-- Responsiva -->
                <div class="col-md-4">

                    <div class="col-12 pb-2" style="border-bottom: solid 2px #543EF6;">
                        <i class="fa-regular fa-file-lines" style="color: #543EF6;"></i><span class="fw-bold ps-2">Datos del Responsiva</span>
                    </div>

                    <div class="col-12 mt-3">

                        <div class="mb-3">
                            <label class="form-label">Fecha</label>
                            <input type="date" name="assigned_date"  min="2020-01-01" max="2030-12-31" class="form-control" value="{{ now()->toDateString() }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Condicion</label>
                            <input name="condition" class="form-control" placeholder="Ej. Usado">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ubicacion</label>
                            <input name="location" class="form-control" placeholder="Ej. Campus Maravillas">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Entregó con</label>
                            <input name="delivered_by" class="form-control" placeholder="Ej. Cable y Cargador">
                        </div>

                    </div>
                </div>

                <!-- Botones -->
                <div class="row  border-top border-1  g-2">
                    <div class="col-6">
                        <a href="{{ route('dashboard') }}" class="text-decoration-none text-black">
                            <div class="col-12 border border-2 border-secondary rounded-3 py-2 h-100 w-100 text-center">
                                Cancelar
                            </div>
                        </a>
                    </div>

                    <div class="col-6">
                        <button class="text-white w-100 border border-0 h-100 rounded-3 py-2" style="background-color: #4630DD;">
                            <i class="fa-regular fa-floppy-disk"></i> Crear Responsiva
                        </button>
                    </div>
                </div>
            </form>

        </div>

    </div>
</div>

@endsection