@extends('layouts.app')

@section('title', 'Crear Responsiva')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">

        <!-- Titulo -->
        <div class="d-flex align-items-center mb-3">
            <a href="{{ route("dashboard") }}" class="text-decoration-none text-black">
                <i class="h5 fa-solid fa-arrow-left mb-0"></i>
            </a>
            <div class="flex-fill ms-2">
                <p class="h4 fw-bold mb-0">Nueva Responsiva</p>
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

            <form method="POST" action="{{ route('responsivas.store') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label"><i class="fa-regular fa-calendar" style="color: #4630DD;"></i> Fecha de Entrega</label>
                    <input type="date" name="date" min="2020-01-01" max="2030-12-31" class="form-control" value="{{ old('date', now()->toDateString()) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="fa-regular fa-user" style="color: #4630DD;"></i> Usuario</label>
                    <select name="teacher_id" class="form-select select-teacher">
                        <option value="">Seleccione un usuario</option>
                        @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}">
                            {{ $teacher->full_name }} — {{ $teacher->employee_number }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="fa-solid fa-mobile-screen-button" style="color: #4630DD;"></i> Dispositivo</label>
                    <select name="device_id" class="form-select select-device">
                        <option value="">Seleccione un dispositivo</option>
                        @foreach ($devices as $device)
                        <option value="{{ $device->id }}">
                            {{ $device->description }} — {{ $device->serial_number }}
                        </option>
                        @endforeach
                    </select>

                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="fa-solid fa-box-open" style="color: #4630DD;"></i> Condición</label>
                    <input type="text" name="condition" class="form-control" placeholder="Ej. Usado" value="{{ old('condition') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="fa-solid fa-location-dot" style="color: #4630DD;"></i> Ubicación</label>
                    <input type="text" name="location" class="form-control" placeholder="Ej. Campus Maravillas" value="{{ old('location') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="fa-regular fa-circle-check" style="color: #4630DD;"></i> Entregó con</label>
                    <input type="text" name="delivered_by" class="form-control" placeholder="Ej. Cable y cargador" value="{{ old('delivered_by') }}">
                </div>

                <div class="row g-4">
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