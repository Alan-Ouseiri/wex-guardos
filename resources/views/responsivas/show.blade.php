@extends('layouts.app')

@section('title', 'Ver Responsiva')

@section('content')

<div class='d-flex justify-content-center mt-5 pb-5'>
    <div class="col-xl-6 col-lg-8 col-11">

        <!-- Titulo -->
        <div class="d-flex align-items-center mb-3">
            <a href="{{ route("responsivas.index") }}" class="text-decoration-none text-black">
                <i class="h5 fa-solid fa-arrow-left mb-0"></i>
            </a>
            <div class="flex-fill ms-2">
                <p class="h4 fw-bold mb-0">Ver Responsiva {{ $responsiva->responsiva_number }}</p>
                <span style="font-size: 12px;">Ve los datos a detalle de una Responsiva</span>
            </div>
        </div>

        <!-- Contenido -->
        <div class="col-12 p-4 rounded-4 bg-white shadow">

            <div class="row justify-content-center">
                @csrf

                <!-- Docente / Dispositivo -->
                <div class="col-md-6">
                    <!-- Icono -->
                    <div class="col-12 pb-2" style="border-bottom: solid 2px #DC4D0D;">
                        <i class="fa-regular fa-user" style="color: #DC4D0D;"></i><span class="fw-bold ps-2">Datos del Usuario</span>
                    </div>

                    <!-- Nuevo Docente -->
                    <div class="mt-3">
                        <p><strong>Nombre:</strong> {{ $responsiva->teacher->full_name }}</p>
                        <p><strong>No. Empleado:</strong> {{ $responsiva->teacher->employee_number }}</p>
                        <p><strong>Email:</strong> {{ $responsiva->teacher->email }}</p>
                        <p><strong>Rol:</strong> {{ $responsiva->teacher->role }}</p>
                    </div>

                    <!-- Icono -->
                    <div class="col-12 mt-4 pb-2" style="border-bottom: solid 2px #12978B;">
                        <i class="fa-solid fa-mobile-screen-button" style="color: #12978B;"></i><span class="fw-bold ps-2">Datos del Dispositivo</span>
                    </div>

                    <!-- Dispositivo Nuevo -->
                    <div class="mt-3">
                        <p><strong>Tipo:</strong> {{ $responsiva->device->type }}</p>
                        <p><strong>Marca:</strong> {{ $responsiva->device->brand }}</p>
                        <p><strong>Modelo:</strong> {{ $responsiva->device->model }}</p>
                        <p><strong>No. Serie:</strong> {{ $responsiva->device->serial_number }}</p>
                    </div>

                </div>

                <!-- Responsiva -->
                <div class="col-md-6">

                    <div class="col-12 pb-2" style="border-bottom: solid 2px #543EF6;">
                        <i class="fa-regular fa-file-lines" style="color: #543EF6;"></i><span class="fw-bold ps-2">Datos del Responsiva</span>
                    </div>

                    <div class="col-12 mt-3">

                        <div class="mb-3">
                            <p><strong>Fecha:</strong> {{ $responsiva->assigned_date }}</p>
                            <p><strong>Condicion:</strong> {{ $responsiva->condition }}</p>
                            <p><strong>Ubicacion:</strong> {{ $responsiva->location }}</p>
                            <p><strong>Entregó con:</strong> {{ $responsiva->delivered_by }}</p>
                            <p><strong>Codigo de Verificacion:</strong> {{ $responsiva->verification_code }}</p>
                            <p><strong>Estatus:</strong> {{ $responsiva->status }}</p>

                            @if($responsiva->user_id != null)
                            <p><strong>Responsiva creada por:</strong> {{ $responsiva->user->name }} - {{ $responsiva->user->email }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

@endsection