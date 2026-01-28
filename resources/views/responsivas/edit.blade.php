@extends('layouts.app')

@section('title', 'Editar Responsiva')

@section('content')

<div class='d-flex justify-content-center mt-5 pb-5'>
    <div class="col-xl-6 col-lg-8 col-11">

        <!-- Titulo -->
        <div class="d-flex align-items-center mb-3">
            <a href="{{ route("dashboard") }}" class="text-decoration-none text-black">
                <i class="h5 fa-solid fa-arrow-left mb-0"></i>
            </a>
            <div class="flex-fill ms-2">
                <p class="h4 fw-bold mb-0">Editar Responsiva</p>
                <span style="font-size: 12px;">Edita los campos de la Responsiva</span>
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

            <form method="POST" action="{{ route('responsivas.update', $responsiva) }}" enctype="multipart/form-data" class="row justify-content-center">
                @csrf

                <!-- Docente / Dispositivo -->
                <div class="col-md-6">
                    <!-- Icono -->
                    <div class="col-12 pb-2" style="border-bottom: solid 2px #DC4D0D;">
                        <i class="fa-regular fa-user" style="color: #DC4D0D;"></i><span class="fw-bold ps-2">Datos del Usuario</span>
                    </div>

                    <!-- Nuevo Docente -->
                    <div class="mt-3">
                        <select name="teacher_id" class="form-select" required>
                            @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}"
                                {{ $responsiva->teacher_id == $teacher->id ? 'selected' : '' }}>
                                {{ $teacher->name ." ". $teacher->surname." - ".$teacher->employee_number }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Icono -->
                    <div class="col-12 mt-4 pb-2" style="border-bottom: solid 2px #12978B;">
                        <i class="fa-solid fa-mobile-screen-button" style="color: #12978B;"></i><span class="fw-bold ps-2">Datos del Dispositivo</span>
                    </div>

                    <!-- Dispositivo Nuevo -->
                    <div class="mt-3">
                        <select name="device_id" class="form-select" required>
                            @foreach($devices as $device)
                            <option value="{{ $device->id }}"
                                {{ $responsiva->device_id == $device->id ? 'selected' : '' }}>
                                {{ $device->description }} - {{ $device->serial_number }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <!-- Responsiva -->
                <div class="col-md-6">

                    <div class="col-12 pb-2" style="border-bottom: solid 2px #543EF6;">
                        <i class="fa-regular fa-file-lines" style="color: #543EF6;"></i><span class="fw-bold ps-2">Datos del Responsiva</span>
                    </div>

                    <div class="col-12 mt-3">

                        <div class="mb-3">
                            <label class="form-label">Fecha</label>
                            <input type="date" name="assigned_date" min="2020-01-01" max="2030-12-31" class="form-control" value="{{ now()->toDateString() }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Condicion</label>
                            <input name="condition" class="form-control" placeholder="Ej. Usado" value="{{ $responsiva->condition }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ubicacion</label>
                            <input name="location" class="form-control" placeholder="Ej. Campus Maravillas" value="{{ $responsiva->location }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Entregó con</label>
                            <input name="delivered_by" class="form-control" placeholder="Ej. Cable y Cargador" value="{{ $responsiva->delivered_by }}">
                        </div>
                        
                    </div>
                </div>

                <!-- Botones -->
                <div class="row border-top border-1  g-2">
                    <div class="col-6">
                        <a href="{{ route('dashboard') }}" class="text-decoration-none text-black">
                            <div class="col-12 border border-2 border-secondary rounded-3 py-2 h-100 w-100 d-flex justify-content-center align-items-center">
                                Cancelar
                            </div>
                        </a>
                    </div>

                    <div class="col-6">
                        <button class="text-white w-100 border border-0 h-100 rounded-3 py-2" style="background-color: #4630DD;">
                            <i class="fa-regular fa-floppy-disk"></i> Editar Responsiva
                        </button>
                    </div>
                </div>
            </form>

        </div>

    </div>
</div>

@endsection