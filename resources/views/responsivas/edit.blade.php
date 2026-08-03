@extends('layouts.app')

@section('title', 'Editar Responsiva')

@section('content')

    <!-- Atras -->
    <div class="col-12 d-flex mt-4">
        <a href="{{ route('responsivas.index') }}" class="boton-desplegable">
            <i class="fa-solid fa-arrow-left"></i>
            <span class="texto-animado">Atrás</span>
        </a>
    </div>

    <!-- Contenido -->
    <div class='d-flex justify-content-center mt-5 pb-5'>
        <div class="col-xl-7 col-lg-9 col-11 rounded-4 bg-gradient-cyan shadow" style="padding: 1px;">
            <div class="bg-white rounded-4 p-3">

                <!-- Titulo -->
                <div class="d-flex align-items-center justify-content-between border-bottom pb-3">
                    <div>
                        <h2 class="fw-bold text-blue mb-0">
                            <i class="fa-solid fa-pencil"></i> Editar Responsiva
                        </h2>
                        <span class="text-secondary" style="font-size: 14px;">
                            Edita los campos de la Responsiva
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

                    <form method="POST" action="{{ route('responsivas.update', $responsiva) }}"
                        enctype="multipart/form-data" class="row justify-content-center">
                        @csrf

                        <!-- Docente / Dispositivo -->
                        <div class="col-md-6">
                            <!-- Icono -->
                            <div class="col-12 pb-2" style="border-bottom: solid 2px #DC4D0D;">
                                <i class="fa-regular fa-user" style="color: #DC4D0D;"></i><span class="fw-bold ps-2">Datos
                                    del
                                    Usuario</span>
                            </div>

                            <!-- Nuevo Docente -->
                            <div class="mt-3">
                                <select name="teacher_id" class="form-select" required>
                                    @foreach($teachers as $teacher)
                                        <option value="{{ $teacher->id }}" {{ $responsiva->teacher_id == $teacher->id ? 'selected' : '' }}>
                                            {{ $teacher->name . " " . $teacher->surname . " - " . $teacher->employee_number }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Icono -->
                            <div class="col-12 mt-4 pb-2" style="border-bottom: solid 2px #12978B;">
                                <i class="fa-solid fa-mobile-screen-button" style="color: #12978B;"></i><span
                                    class="fw-bold ps-2">Datos del Dispositivo</span>
                            </div>

                            <!-- Dispositivo Nuevo -->
                            <div class="mt-3">
                                <select name="device_id" class="form-select" required>
                                    @foreach($devices as $device)
                                        <option value="{{ $device->id }}" {{ $responsiva->device_id == $device->id ? 'selected' : '' }}>
                                            {{ $device->description }} - {{ $device->serial_number }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <!-- Responsiva -->
                        <div class="col-md-6">

                            <div class="col-12 pb-2" style="border-bottom: solid 2px #543EF6;">
                                <i class="fa-regular fa-file-lines" style="color: #543EF6;"></i><span
                                    class="fw-bold ps-2">Datos
                                    del Responsiva</span>
                            </div>

                            <div class="col-12 mt-3">

                                <div class="mb-3">
                                    <label class="form-label">Fecha</label>
                                    <input type="date" name="assigned_date" min="2020-01-01" max="2030-12-31"
                                        class="form-control" value="{{ now()->toDateString() }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Condicion</label>
                                    <input name="condition" class="form-control" placeholder="Ej. Usado"
                                        value="{{ $responsiva->condition }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Ubicacion</label>
                                    <input name="location" class="form-control" placeholder="Ej. Campus Maravillas"
                                        value="{{ $responsiva->location }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Entregó con</label>
                                    <input name="delivered_by" class="form-control" placeholder="Ej. Cable y Cargador"
                                        value="{{ $responsiva->delivered_by }}">
                                </div>

                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="row justify-content-end pt-3">
                            <div class="col-auto border border-1 border-secondary rounded-3 py-2">
                                <a href="{{ route('responsivas.index') }}" class="text-decoration-none text-black">
                                    Cancelar
                                </a>
                            </div>
                            <div class="col-auto">
                                <button class="text-white w-100 border border-0 h-100 rounded-3 py-2 px-2 bg-blue">
                                    <i class="fa-regular fa-floppy-disk"></i> Guardar Cambios
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection