@extends('layouts.app')

@section('title', 'Crear Responsiva')

@section('content')

    <!-- Atras -->
    <div class="col-12 d-flex mt-4">
        <a href="{{ route('dashboard') }}" class="boton-desplegable">
            <i class="fa-solid fa-arrow-left"></i>
            <span class="texto-animado">Atrás</span>
        </a>
    </div>

    <!-- Contenido -->
    <div class='d-flex justify-content-center mt-3 pb-5'>
        <div class="col-xl-8 col-lg-10 col-11 bg-gradient-green rounded-4" style="padding: 1px;">
            <div class="bg-white rounded-4 p-3">

                <!-- Titulo -->
                <div class="d-flex align-items-center justify-content-between border-bottom pb-3">
                    <div>
                        <h2 class="fw-bold text-green mb-0">
                            <i class="fa-regular fa-file-lines"></i> Nueva Responsiva en blanco
                        </h2>
                        <span class="text-secondary" style="font-size: 14px;">
                            Completa los datos para generar la Responsiva
                        </span>
                    </div>
                </div>

                <!-- Mensajes -->
                <div class="pt-3">
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
                </div>

                <!-- Contenido -->
                <div class="col-12">

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

                    <form method="POST" action="{{ route('responsivas.store.full') }}" enctype="multipart/form-data"
                        class="row justify-content-center">
                        @csrf

                        <!-- Docente -->
                        <div class="col-md-4">
                            <!-- Icono -->
                            <div class="col-12 pb-2" style="border-bottom: solid 2px #DC4D0D;">
                                <i class="fa-regular fa-user" style="color: #DC4D0D;"></i><span class="fw-bold ps-2">Datos
                                    del
                                    Usuario</span>
                            </div>

                            <!-- Nuevo Docente -->
                            <div class="col-12 mt-3">

                                <div class="mb-3">
                                    <label class="form-label">Nombre(s) <span class="text-danger">*</span> </label>
                                    <input name="teacher[name]" class="form-control" placeholder="Ingresa el nombre"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Apellido(s) <span class="text-danger">*</span></label>
                                    <input name="teacher[surname]" class="form-control" placeholder="Ingresa el apellido"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Rol <span class="text-danger">*</span></label>
                                    <input name="teacher[role]" class="form-control"
                                        placeholder="Ej. Administrativo, Profesor, Profesora" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Correo <span class="text-danger">*</span></label>
                                    <input name="teacher[email]" class="form-control"
                                        placeholder="Ej. profesor@wexford.edu.mx" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">No. Empleado</label>
                                    <input name="teacher[employee_number]" class="form-control" placeholder="No. Empleado">
                                </div>

                            </div>
                        </div>

                        <!-- Dispositivo -->
                        <div class="col-md-4">
                            <!-- Icono -->
                            <div class="col-12 pb-2" style="border-bottom: solid 2px #12978B;">
                                <i class="fa-solid fa-mobile-screen-button" style="color: #12978B;"></i><span
                                    class="fw-bold ps-2">Datos del Dispositivo</span>
                            </div>

                            <!-- Dispositivo Nuevo -->
                            <div class="col-12 mt-3">

                                <div class="mb-3">
                                    <label class="form-label">Tipo <span class="text-danger">*</span></label>
                                    <input name="device[type]" class="form-control" placeholder="Ej. Laptop, iPad, Macbook"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Marca <span class="text-danger">*</span></label>
                                    <input name="device[brand]" class="form-control" placeholder="Ej. Apple, Lenovo, MSI"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Modelo <span class="text-danger">*</span></label>
                                    <input name="device[model]" class="form-control" placeholder="Ej. 5, Gen 8, Air 11"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">No. Serie <span class="text-danger">*</span></label>
                                    <input name="device[serial_number]" class="form-control" placeholder="xxxxxxxxxx"
                                        required>
                                </div>


                            </div>
                        </div>

                        <!-- Responsiva -->
                        <div class="col-md-4">

                            <div class="col-12 pb-2" style="border-bottom: solid 2px #543EF6;">
                                <i class="fa-regular fa-file-lines text-blue"></i><span class="fw-bold ps-2">Datos del
                                    Responsiva</span>
                            </div>

                            <div class="col-12 mt-3">

                                <div class="mb-3">
                                    <label class="form-label">Fecha <span class="text-danger">*</span></label>
                                    <input type="date" name="assigned_date" min="2020-01-01" max="2030-12-31"
                                        class="form-control" value="{{ now()->toDateString() }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Condicion <span class="text-danger">*</span></label>
                                    <input name="condition" class="form-control" placeholder="Ej. Usado" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Ubicacion <span class="text-danger">*</span></label>
                                    <input name="location" class="form-control" placeholder="Ej. Campus Maravillas"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Entregó con <span class="text-danger">*</span></label>
                                    <input name="delivered_by" class="form-control" placeholder="Ej. Cable y Cargador"
                                        required>
                                </div>

                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="row justify-content-end pt-3 border-top border-1">
                            <div class="col-auto border border-1 border-secondary rounded-3 py-2">
                                <a href="{{ route('dashboard') }}" class="text-decoration-none text-black">
                                    Cancelar
                                </a>
                            </div>
                            <div class="col-auto">
                                <button class="text-white w-100 border border-0 h-100 rounded-3 py-2 px-2 bg-green">
                                    <i class="fa-regular fa-floppy-disk"></i> Crear Responsiva
                                </button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>


@endsection